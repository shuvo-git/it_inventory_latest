<?php

namespace App\Modules\Sell\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Log;
use App\Modules\Products\Models\Products;
use Carbon\Carbon;
use App\Modules\Sell\Models\DailySell;
use App\Modules\Sell\Models\MonthlySell;
use App\Modules\Sell\Models\ReturnItem;
use App\Traits\UpdateSells;
class ReturnController extends Controller {

    use UpdateSells;
    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        if (!auth()->user()->can('Invoice Management'))
            abort(403);
        $returnItems = $this->__filter($request);
        $products = Products::select(DB::raw("CONCAT(name,' | price: ',buy_price) as product, id"))->pluck('product', 'id');
        return view("Sell::return.index", compact('returnItems', 'products'));
    }

    private function __filter($request) {
        $query = ReturnItem::query();
        $query->with('product');
        if ($request->filled('product')) {
            $query->whereHas('product', function($q)use($request) {
                $q->where('name', $request->product);
            });
        }

        if ($request->filled('date_from') and $request->filled('date_to')) {
            $date_from = Carbon::parse($request->input('date_from'))->startOfDay();
            $date_to = Carbon::parse($request->input('date_to'))->endOfDay();
            $query->whereDate('created_at', '>=', $date_from)->whereDate('created_at', '<=', $date_to);
        } else {
            $query->whereDate('created_at', Carbon::now()->format('Y-m-d'));
        }
        $query->orderBy('id', 'desc');
        return $query->paginate(50);
    }

    public function store(Request $request) {
        $this->validate($request, [
            'product_id' => 'required|exists:buying_products,id',
            'qty' => 'required|integer',
            'discount' => 'required|numeric|min:0',
        ]);

        try {
            DB::beginTransaction();
            $product = Products::where('id', $request->product_id)->first();
            $totalPrice = $product->buy_price * $request->qty;
            $returnableAmount = $totalPrice - $request->discount;
            $profit = $returnableAmount - $product->buy_price * $request->qty;

            $data = [
                'product_id' => $request->product_id,
                'qty' => $request->qty,
                'unit_price' => $product->buy_price,
                'total_price' => $totalPrice,
                'discount' => $request->discount,
                'returnable_amount' => $returnableAmount,
                'created_at' => Carbon::now(),
                'created_by' => auth()->user()->id
            ];

            $product->available_qty = $product->available_qty - $request->qty;
            $product->save();
            ReturnItem::create($data);
            //$this->__updateDailySell($product->category_id, $returnableAmount* -1, $profit * -1);
            DB::commit();
            return redirect()->back()->with('success', "Return request successfull");
        } catch (\Exception $ex) {
            DB::rollback();
            Log::error($ex);
            return redirect()->back()->withInput()->withErrors("Something went wrong.");
        }
    }
}
