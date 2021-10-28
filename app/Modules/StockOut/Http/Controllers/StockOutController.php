<?php

namespace App\Modules\StockOut\Http\Controllers;

use App\Classes\StockStatus;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

use App\Modules\Products\Models\Products;
use App\Modules\StockIn\Models\StockInDetails;
use App\Modules\StockOut\Models\StockOut;
use App\Modules\StockOut\Models\StockOutDetails;

class StockOutController extends Controller
{
    public function index(Request $request)
    {
        $StockOuts = $this->__filter($request);
        $branchDivList = $this->makeDD(DB::table('branch')->get()->pluck('br_name','id'),"Branch/Division");
        $productList = $this->makeDD(
            Products::select('id',DB::raw("CONCAT(name,' ( Available Quantity - ',available_qty,')') as name") )->where([['available_qty','>',0]])->pluck('name','id'),
            "Product"
        );
        $pageInfo = ["title"=>"Stock Out"];

        return view("StockOut::index",compact('StockOuts','pageInfo','branchDivList','productList'));
    }

    private function __filter($request) 
    {
        $stock_in = StockOut:://with('StockInDetails');  
        query();


        if ($request->filled('supplier_id')) {
            $stock_in->where('supplier_id', 'like', '%' . $request->supplier_id . '%');
        }


        return $stock_in
        //->join('', 'users.id', '=', 'contacts.user_id')
        ->orderBy('id', 'ASC')
        ->paginate(20);
    }

    public function create(){
        $branchDivList = $this->makeDD(DB::table('branch')->get()->pluck('br_name','id'),"Branch/Division");
        $productList = $this->makeDD(
            Products::select(
                    'id',
                    DB::raw("CONCAT(name,' ( Available Quantity - ',available_qty,')') as name") 
                )->where([['available_qty','>',0]])->pluck('name','id'),
                "Product"
            );
        $stockInDetailsList = $this->makeDD([],"Product Unique ID");
        $pageInfo = ["title"=>"Create New Stock Out"];
        return view('StockOut::create',compact('pageInfo','pageInfo','branchDivList','productList','stockInDetailsList'));
    }

    public function store(Request $request){
        //if (!auth()->user()->can('Settings'))
        //    abort(403);
        
        $this->validate($request, [
            'challan_no' => 'required|string|min:3',
            'branch_or_division_id' => 'required|integer|min:1',
            'requisition_no' => 'required|string|min:3',
            'delivery_date' => 'required|date_format:Y-m-d',
            'narration' => 'nullable|string|min:3,max:300',

            'product_id' => 'required|array',
            'product_id.*' => 'required|integer|min:1',
            'stockin_details_id' => 'required|array',
            'stockin_details_id.*' => 'required|integer|min:1',
        ]);
        
        try {
            DB::begintransaction();

            $stock_out = new StockOut();
            $stock_out->challan_no              = $request->challan_no;
            $stock_out->branch_or_division_id   = $request->branch_or_division_id;
            $stock_out->requisition_no          = $request->requisition_no;
            $stock_out->delivery_date           = $request->delivery_date;
            $stock_out->narration               = $request->narration;
            $stock_out->created_by              = auth()->user()->id;
            $stock_out->save();

            $cnt = count($request->product_id);
            for ($i = 0; $i < $cnt; $i++) 
            {
                
                $data[] = [

                    'stockout_id'           => $stock_out->id,
                    'stockin_details_id'    => $request->stockin_details_id[$i],
                    'created_at'            => Carbon::now(),
                ];

                
                Products::find($request->product_id[$i])->decrement('available_qty');
                try {
                    \Log::info("Updating Status for Stockout::$request->product_id[$i]");
                    StockInDetails::where('id',$request->product_id[$i])
                    ->update(['status'=>StockStatus::$IN_BRANCH]);
                    \Log::info("Updated Status for Stockout::$request->product_id[$i], \n ");
                } catch (\Throwable $th) {
                    \Log::debug($th->getMessage());
                }
                
                    
            }
            
            
            StockOutDetails::insert($data);
            
            
            DB::commit();

            return redirect()->to('stock-out')->with("success", "Stock Delivered Successfully");
        } catch (Exception $ex) {
            Log::error($ex);
            DB::rollback();
            return redirect()->back()->withErrors("Internal Server Error: ".$ex)->withInput();
        }
    }

    public function show($id){
        $StockOut = StockOut::findOrFail($id);
        $StockOutDetails = StockOutDetails::where('stockout_id',$StockOut->id)->get();
        $productList = $this->makeDD(Products::all()->pluck('name','id'),"Product");
        $stockInDetailsList = $this->makeDD([],"Product Unique ID");
        $ymdList = $this->makeDD([
            "y" => "Year",
            "m" => "month",
            "d" => "day"
        ]);
        $pageInfo = ["title"=>"View Stock Out"];

        return view("StockOut::show",compact('StockOut','StockOutDetails','pageInfo','productList','stockInDetailsList','ymdList'));
    }

    public function update($id,Request $request){
        //if (!auth()->user()->can('Settings'))
        //    abort(403);
        
        $this->validate($request, [
            'challan_no' => 'required|string|min:3',
            'branch_or_division_id' => 'required|integer|min:1',
            'requisition_no' => 'required|string|min:3',
            'product_id' => 'required|integer|min:1',
            'delivery_date' => 'required|date_format:Y-m-d',
            'narration' => 'nullable|string|min:3,max:300',
        ]);

        try {
            DB::begintransaction();

            $stock_out = StockOut::findOrFail($id);
            $stock_out->challan_no              = $request->challan_no;
            $stock_out->branch_or_division_id   = $request->branch_or_division_id;
            $stock_out->requisition_no          = $request->requisition_no;
            $stock_out->product_id              = $request->product_id;
            $stock_out->delivery_date           = $request->delivery_date;
            $stock_out->narration               = $request->narration;
            $stock_out->updated_by              = auth()->user()->id;
            $stock_out->save();

            DB::commit();

            return redirect()->back()->with("success", "Stock Delivery Updated Successfully");
        } catch (Exception $ex) {
            Log::error($ex);
            DB::rollback();
            return redirect()->back()->withErrors("Internal Server Error")->withInput();
        }
    }

    public function getStockDetails(Request $request){
        $id = $request->product_id;
        $stocksById = StockInDetails::select('id','unique_id')
            ->where('product_id',$id)
            ->where('status',StockStatus::$IN_STOCK)
            ->get();
        $str = '<option value="">Choose Product Unique ID</option>';
        foreach ($stocksById as $k => $v) 
        {
            $str .= '<option value="'.$v->id.'">'. $v->unique_id.'</option>';
        }
        return $str;
    }
}
