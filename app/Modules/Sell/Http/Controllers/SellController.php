<?php

namespace App\Modules\Sell\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Modules\Sell\Models\Order;
use App\Modules\Sell\Models\OrderDetail;
use App\Modules\Sell\Models\DailySell;
use App\Modules\Sell\Models\MonthlySell;
use App\Modules\Settings\Models\Settings;

use App\Modules\Products\Models\Products;
use App\Modules\Categories\Models\Categories;

use App\Traits\UpdateSells;

use DB;
use Log;

use Carbon\Carbon;
use Mpdf\Mpdf;

class SellController extends Controller {

    use UpdateSells;

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        if (!auth()->user()->can('Invoice Management'))
            abort(403);
//        dd(Carbon::format('Y-m-d'));
        $orders = $this->__filter($request);
        return view("Sell::index", compact('orders'));
    }

    private function __filter($request) {
        $query = Order::query();

        if ($request->filled('mobile')) {
            $query->where('customer_mobile', $request->mobile);
        }
        if ($request->filled('invoice_no')) {
            $query->where('invoice_no', $request->invoice_no);
        }

        if ($request->filled('date_from') and $request->filled('date_to')) {
            $date_from = Carbon::parse($request->input('date_from'))->startOfDay();
            $date_to = Carbon::parse($request->input('date_to'))->endOfDay();
            $query->whereDate('created_at', '>=', $date_from)->whereDate('created_at', '<=', $date_to);
        }
        $query->orderBy('id', 'desc');
        return $query->paginate(50);
    }

    public function create() {
        if (!auth()->user()->can('Invoice Management'))
            abort(403);

        $products = Products::select("name as product", "id")->where('status', 1)->pluck('product', 'id');

        return view("Sell::create", compact('products'));
    }

    public function details(Request $request) {
        $product = Products::select('name', 'id', 'sell_price')->where('id', $request->id)->first();
        return response()->json($product);
    }

    public function categoryProducts(Request $request) {
        $product = Products::select(DB::raw("name as product, id"))->where('status', 1)->where('sell_category_id', $request->category_id)->get(); //->pluck('product', 'id');
        return response()->json($product);
    }

    public function store(Request $request) {

        $this->validate($request, [
            'product_id' => 'required|array',
            'product_id.*' => 'required|exists:products,id',
            'qty' => 'required|array',
            'qty.*' => 'required|integer',
            'discount' => 'required|array',
            'discount.*' => 'required|numeric|min:0',
        ]);

        try {
            DB::beginTransaction();
            $i = 0;
            $noOfProduct = 0;
            $totalPrice = 0;
            $totalDiscount = 0;
            $totalProfit = 0;

            foreach ($request->product_id as $id) {
                $product = Product::where('id', $id)->where('status', 1)->first();

                if (!$product) {
                    Log::error("Invaid product id selected. Or Product may be out of stock. ID = " . $id);
                    return redirect()->back()->withInput()->withErrors("Invaid product id selected. Or Product may be out of stock. ID=" . $id);
                }
                /*if ($product->available_qty < $request->qty[$i]) {
                    Log::error("Requested quantity is not available of " . $product->name . " id=" . $id . " available_qty=" . $product->available_qty);
                    return redirect()->back()->withInput()->withErrors("Requested quantity is not available of " . $product->name . " available qty=" . $product->available_qty);
                }*/

                $price = $request->qty[$i] * $product->sell_price;
                //$profit = $price - $request->qty[$i] * $product->buy_price - $request->discount[$i];
                if ($price <= $request->discount[$i]) {
                    return redirect()->back()->withInput()->withErrors("Discount can not be same as total price or greater then total price. Product total price = " . $price . " and discount = " . $request->discount[$i]);
                }

                $noOfProduct += $request->qty[$i];
                $totalPrice += $price;
                $totalDiscount += $request->discount[$i];
                //$totalProfit += $profit;
                $orderDetails[] = [
                    'product_id' => $id,
                    'qty' => $request->qty[$i],
                    'unit_price' => $product->sell_price,
                    'total_price' => $price,
                    'discount' => $request->discount[$i],
                    'grand_total' => $price - $request->discount[$i]
                ];

                //$product->sell_qty += $request->qty[$i];

                // $product->available_qty = $product->buy_qty - $product->sell_qty;

                /*if ($product->available_qty == 0) {
                    $product->status = 0;
                }*/

                $product->save();
                $this->__updateDailySell($product->id, $price - $request->discount[$i], 0);
                $i++;
            }
            $order = [
                'invoice_no' => $this->__getInvoiceNo(),
                'customer_name' => $request->customer_name,
                'customer_mobile' => $request->customer_mobile_no,
                'number_of_product' => $noOfProduct,
                'total_price' => $totalPrice,
                'discount' => $totalDiscount,
                'grand_price' => $totalPrice - $totalDiscount,
                //'profit' => $totalProfit,
                'created_at' => Carbon::now(),
                'sell_by' => auth()->user()->id
            ];

            $orderId = Order::create($order);

            if (isset($orderDetails)) {
                foreach ($orderDetails as $od) 
                {
                    $od['order_id'] = $orderId->id;

                    OrderDetail::create($od);
                }
            }
            DB::commit();
            if ($request->save_and_print) {
                return redirect()->route('sell.show', $orderId->id);
            } else {
                return redirect()->back()->with('success', "Sales Complete");
            }
        } catch (\Exception $ex) {
            DB::rollback();
            Log::error($ex);
            return redirect()->back()->withInput()->withErrors("Something went wrong.");
        }
    }

    public function show($id) {
        try {
            $order = Order::findOrFail($id);
            $settings = Settings::findOrFail('1');
            // return view("Sell::invoice_view", compact('order'));

            $mpdf = new Mpdf([
                'mode' => 'utf-8',
                'format' => [88, 265],
                'tempDir'       => storage_path(),
                'default_font_size' => '8',
                'margin_left' => 5,
                'margin_right' => 5,
                'margin_top' => 5,
                'margin_bottom' => 5,
                'margin_header' => 9,
                'margin_footer' => 9,
            ]);
            $mpdf->SetDisplayMode('fullpage');
            $mpdf->setAutoTopMargin = 'stretch';
            $mpdf->list_indent_first_level = 0; // 1 or 0 - whether to indent the first level of a list

            $voucher = view("Sell::print_invoice", compact('order', 'settings'));
            $html_data = $voucher->render();

            $mpdf->WriteHTML($html_data);
            $mpdf->Output('BillDuplicateVoucher.pdf', 'I');
        } catch(\Exception $e) {
            \Log::error($e->getMessage());
        }
    }

    private function __getInvoiceNo() {
        $lastInvoice = Order::select('invoice_no')->orderBy('id', 'desc')->first();
        if (!$lastInvoice) {
            return date('ymd') . '100';
        } else {
            $no = substr($lastInvoice->invoice_no, 6);
            $no++;
            return date('ymd') . $no;
        }
    }

}
