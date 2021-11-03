<?php

namespace App\Modules\StockIn\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Modules\StockIn\Models\StockIn;
use App\Modules\Supplier\Models\Supplier;
use App\Modules\Products\Models\Products;
use App\Modules\StockIn\Models\StockInDetails;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;
use Carbon\Carbon;

class StockInController extends Controller
{
    public function index(Request $request)
    {
        $StockIns = $this->__filter($request);
        $pageInfo = ["title"=>"Stock"];

        return view("StockIn::index",compact('StockIns','pageInfo'));
    }
    private function __filter($request) {
        $stock_in = StockIn:://with('StockInDetails');  
        query();


        if ($request->filled('supplier_id')) {
            $stock_in->where('supplier_id', 'like', '%' . $request->supplier_id . '%');
        }


        return $stock_in
        //->join('', 'users.id', '=', 'contacts.user_id')
        ->orderBy('id', 'ASC')
        ->paginate(20);
    }

    public function show($id){
        $StockIn = StockIn::findOrFail($id);
        $StockInDetails = StockInDetails::where('stockin_id',$StockIn->id)->get();
        $supplierList = $this->makeDD(Supplier::all()->pluck('supplier_name','id'),"Supplier");
        $productList = $this->makeDD(Products::all()->pluck('name','id'),"Product");
        $ymdList = $this->makeDD([
            "y" => "Year",
            "m" => "month",
            "d" => "day"
        ]);
        $pageInfo = ["title"=>"View Stock"];

        return view("StockIn::show",compact('StockIn','StockInDetails','pageInfo','supplierList','productList','ymdList'));
    }

    public function create(){
        $supplierList = $this->makeDD(Supplier::all()->pluck('supplier_name','id'),"Supplier");
        $productList = $this->makeDD(Products::all()->pluck('name','id'),"Product");
        $ymdList = $this->makeDD([
            "y" => "Year",
            "m" => "month",
            "d" => "day"
        ]);
        $pageInfo = ["title"=>"Create New Stock"];

        return view("StockIn::create",compact('pageInfo','supplierList','productList','ymdList'));
    }

    public function store(Request $request) 
    {
        //if (!auth()->user()->can('Settings'))
        //    abort(403);
        $this->validate($request, [
            'invoice_no' => 'required|string|min:3',
            'registration_no' => 'required|string|min:3',
            'narration' => 'required|string|min:3,max:300',
            'supplier_id' => 'required|integer|min:1',

            'product_id' => 'required|array',
            'product_id.*' => 'required|integer|min:1',
            'unit_price' => 'required|array',
            'unit_price.*' => 'required|numeric',
            'warranty_period' => 'required|array',
            'warranty_period.*' => 'required|integer|min:1',
            'warranty_ymd' => 'required|array',
            'warranty_ymd.*' => 'required',
        ]);

        try {
            DB::begintransaction();

            $stock_in = new StockIn();
            $stock_in->invoice_no       = $request->invoice_no;
            $stock_in->registration_no  = $request->registration_no;
            $stock_in->narration        = $request->narration;
            $stock_in->supplier_id      = $request->supplier_id;
            $stock_in->created_by = auth()->user()->id;
            $stock_in->save();

            echo '<pre>';

            $cnt = count($request->product_id);
            for ($i = 0; $i < $cnt; $i++) 
            {
                $dt = new Carbon($request->purchase_date);
                    if($request->warranty_ymd[$i]=="d")
                        $dt->addDays($request->warranty_period[$i]);
                    else if($request->warranty_ymd[$i]=="m")
                        $dt->addMonths($request->warranty_period[$i]);
                    else if($request->warranty_ymd[$i]=="y")
                        $dt->addYears($request->warranty_period[$i]);

                    
                $data[] = [

                    'stockin_id'            => $stock_in->id,
                    'product_id'            => $request->product_id[$i],

                    'unit_price'            => $request->unit_price[$i],
                    'quantity'              => 1,
                    'total_price'           => $request->unit_price[$i]*1,

                    'purchase_date'         => $request->purchase_date,
                    'warranty_period'       => $request->warranty_period[$i],
                    'warranty_ymd'          => $request->warranty_ymd[$i],
                    'warranty_expiry_date'  => $dt->format('Y-m-d'),
                    'unique_id'             => $request->unique_id[$i],

                    'created_at' => Carbon::now(),
                    //'created_by' => auth()->user()->id,
                ];
                Products::find($request->product_id[$i])->increment('available_qty');
            }
            StockInDetails::insert($data);

            DB::commit();

            return redirect()->to('stock-in')->with("success", "New Stock(s) Added Successfully");
        } catch (Exception $ex) {
            Log::error($ex);
            DB::rollback();
            return redirect()->back()->withErrors("Internal Server Error")->withInput();
        }
    }

    public function edit($id) {
        $StockIn = StockIn::findOrFail($id);
        $StockInDetails = StockInDetails::where('stockin_id',$StockIn->id)->get();
        $supplierList = $this->makeDD(Supplier::all()->pluck('supplier_name','id'),"Supplier");
        $productList = $this->makeDD(Products::all()->pluck('name','id'),"Product");
        $ymdList = $this->makeDD([
            "y" => "Year",
            "m" => "month",
            "d" => "day"
        ]);
        $pageInfo = ["title"=>"Create New Stock"];

        return view("StockIn::edit",compact('StockIn','StockInDetails','pageInfo','supplierList','productList','ymdList'));
    }

    public function update($id, Request $request) {
        //if (!auth()->user()->can('Settings'))
        //    abort(403);
        $this->validate($request, [
            'invoice_no' => 'required|string|min:3',
            'registration_no' => 'required|string|min:3',
            'narration' => 'required|string|min:3,max:300',
            'supplier_id' => 'required|integer|min:1',

            'product_id' => 'required|array',
            'product_id.*' => 'required|integer|min:1',
            'unit_price' => 'required|array',
            'unit_price.*' => 'required|numeric',
            'warranty_period' => 'required|array',
            'warranty_period.*' => 'required|integer|min:1',
            'warranty_ymd' => 'required|array',
            'warranty_ymd.*' => 'required',
        ]);

        try {
            DB::begintransaction();
            $stock_in = StockIn::findOrFail($id);
            
            $stock_in->invoice_no       = $request->invoice_no;
            $stock_in->registration_no  = $request->registration_no;
            $stock_in->narration        = $request->narration;
            $stock_in->supplier_id      = $request->supplier_id;
            $stock_in->created_by = auth()->user()->id;
            $stock_in->save();
            
            $cnt = count($request->product_id);
            for ($i = 0; $i < $cnt; $i++) 
            {

                $dt = new Carbon($request->purchase_date);
                    if($request->warranty_ymd[$i]=="d")
                        $dt->addDays($request->warranty_period[$i]);
                    else if($request->warranty_ymd[$i]=="m")
                        $dt->addMonths($request->warranty_period[$i]);
                    else if($request->warranty_ymd[$i]=="y")
                        $dt->addYears($request->warranty_period[$i]);

                
                if(isset($request->id[$i])){
                    $stock_in_detail = StockInDetails::where('id',$request->id[$i])->first();
                }
                else {
                    $stock_in_detail = new StockInDetails;
                    Products::find($request->product_id[$i])->increment('available_qty');
                }
                

                $stock_in_detail->stockin_id            = $stock_in->id;
                $stock_in_detail->product_id            = $request->product_id[$i];

                $stock_in_detail->unit_price            = $request->unit_price[$i];
                $stock_in_detail->quantity              = 1;
                $stock_in_detail->total_price           = $request->unit_price[$i]*1;

                $stock_in_detail->purchase_date         = $request->purchase_date;
                $stock_in_detail->warranty_period       = $request->warranty_period[$i];
                $stock_in_detail->warranty_ymd          = $request->warranty_ymd[$i];
                $stock_in_detail->unique_id             = $request->unique_id[$i];
                $stock_in_detail->warranty_expiry_date  = $dt->format('Y-m-d');
                $stock_in_detail->save();
            }
            //dd($request->all());
            DB::commit();

            return redirect()->to('stock-in')->with("success", "Stock Updated Successfully");
        } catch (Exception $ex) {
            Log::error($ex);
            DB::rollback();
            return redirect()->back()->withErrors("Internal Server Error")->withInput();
        }
    }

    public function updateStockStatus(Request $request)
    {
        $this->validate($request, [
            'stock_id'      => 'required|integer|min:1',
            'status_value'  => 'required|integer|min:1'
        ]);
        
        try {
            DB::begintransaction();
            $stock_in = StockInDetails::findOrFail($request->stock_id);
            StockInDetails::where('id',$request->stock_id)
                ->update(['status'=>$request->status_value]);

            if($request->status_value == 55){
                Products::find($stock_in->product_id)->decrement('available_qty');
            }

            $response = [
                'message'=>'success',
                'code'=>'1'
            ];
            return $response;
        }
        catch (Exception $ex) 
        {
            Log::error($ex);
            DB::rollback();
            $response = [
                'message'=>'error',
                'code'=>'2',
                'desc'=>$ex
            ];
            return $response;
        }
        
    }

    public function destroy($id) {
        //if (!auth()->user()->can('Settings'))
        //    abort(403);

        try {
            DB::beginTransaction();
            $stock_in = StockIn::findOrFail($id);
            $stock_in_detail = $stock_in->stockInDetails;
            $stock_in_detail->delete();
            $stock_in->delete();
            $stock_in->deleted_by = auth()->user()->id;
            $stock_in->save();
            DB::commit();
            return redirect()->back()->with("success", "Stock Successfully Deleted");
        } catch (Exception $ex) {
            Log::error($ex);
            DB::rollback();
            return redirect()->back()->withErrors("Internal Server Error");
        }
    }
}
