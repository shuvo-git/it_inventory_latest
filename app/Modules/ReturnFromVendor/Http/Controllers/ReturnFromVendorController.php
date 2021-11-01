<?php

namespace App\Modules\ReturnFromVendor\Http\Controllers;

use App\Classes\StockStatus;
use App\Http\Controllers\Controller;
use App\Modules\Products\Models\Products;
use App\Modules\ReturnFromVendor\Models\ReturnFromVendor;
use App\Modules\StockIn\Models\StockInDetails;
use App\Modules\Supplier\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReturnFromVendorController extends Controller
{

    
    public function index(Request $request)
    {
        $ReturnFromVendors = $this->__filter($request);
        $pageInfo = ["title"=>"Return From Vendor"];

        return view("ReturnFromVendor::index",compact('ReturnFromVendors','pageInfo'));
    }
    private function __filter($request) {
        $return = ReturnFromVendor:://with('StockInDetails');  
        query();


        if ($request->filled('supplier_id')) {
            $return->where('supplier_id', 'like', '%' . $request->supplier_id . '%');
        }


        return $return
        //->join('', 'users.id', '=', 'contacts.user_id')
        ->orderBy('id', 'ASC')
        ->paginate(20);
    }

    public function create(){
        
        $productList = $this->makeDD(Products::all()->pluck('name','id'),"Product");
        $inVendorProductList = $this->makeDD(
            StockInDetails::where('status',StockStatus::$IN_VENDOR)->select('id','unique_id')->pluck('unique_id','id'),
            "Product Unique ID"
        );
        $supplierList = $this->makeDD(
            DB::table('suppliers')
            ->select('supplier_name','id')
            ->orderBy("supplier_name","ASC")
            ->pluck('supplier_name','id'),
            "Supplier"
        );
        
        $pageInfo = ["title"=>"Create New Return From Vendor"];
        $conditionList = $this->makeDD( [
            4=>'Repaired',
            5=>'Damaged',
        ] ,"Condition");
        return view("ReturnFromVendor::create",compact('pageInfo','supplierList','productList','inVendorProductList','conditionList'));
    }

    public function store(Request $request)
    {
        dd($request->all());
    }

    public function getInVendorProduct(Request $request)
    {
        $id = $request->product_id;
        $supplier_id = $request->supplier_id;

        $inVendorById = DB::table('stock_details')
                        ->select('stock_details.unique_id','stock_details.id')
                        ->join('repair_product_details','repair_product_details.product_unique_id','=','stock_details.id')
                        ->join('send_to_repair','send_to_repair.id','=','repair_product_details.repair_id')
                        ->where('send_to_repair.supplier_id',$supplier_id)
                        ->where('stock_details.product_id',$id)
                        ->where('stock_details.status',StockStatus::$IN_VENDOR)
                        ->get();
                        //->toSql();
                        //dd($inVendorById);

        $str = '<option value="">Choose Product Unique ID</option>';
        foreach ($inVendorById as $k => $v) 
        {
            $str .= '<option value="'.$v->id.'">'. $v->unique_id.'</option>';
        }

        return $str;
    }
}
