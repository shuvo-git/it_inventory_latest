<?php

namespace App\Modules\ReturnFromVendor\Http\Controllers;

use App\Classes\StockStatus;
use App\Http\Controllers\Controller;
use App\Modules\Products\Models\Products;
use App\Modules\ReturnFromVendor\Models\ReturnFromVendor;
use App\Modules\ReturnFromVendor\Models\ReturnFromVendorDetails;
use App\Modules\StockIn\Models\StockInDetails;
use App\Modules\Supplier\Models\Supplier;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
        $this->validate($request, [
            
            'supplier_id' => 'required|integer|min:1',
            'delivery_person_name' => 'required|string|min:3,max:50',
            'delivery_person_phn_no' => 'required|digits:11',
            'remarks' => 'nullable|string|max:300',
            'return_date' => 'required|date_format:Y-m-d',

            'product_id' => 'required|array',
            'product_id.*' => 'required|integer|min:1',
            'product_unique_id' => 'required|array',
            'product_unique_id.*' => 'required|integer|min:1',
            'conditions' => 'required|array',
            'conditions.*' => 'required|integer|min:1',
            'reason' => 'required|array',
            'reason.*' => 'nullable|string|min:3,max:300',
        ]);
        
        
        try {
            DB::begintransaction();
            
            $ret_v = new ReturnFromVendor();
            $ret_v->supplier_id             = $request->supplier_id;
            $ret_v->delivery_person_name    = $request->delivery_person_name;
            $ret_v->delivery_person_phn_no  = $request->delivery_person_phn_no;
            $ret_v->remarks                 = $request->remarks;
            $ret_v->delivery_date           = $request->return_date;
            $ret_v->created_by              = auth()->user()->id;
            $ret_v->save();

            

            $cnt = count($request->product_id);
            for ($i = 0; $i < $cnt; $i++) 
            {   
                $data[] = [

                    'return_from_vendor_id'     => $ret_v->id,
                    'product_id'                => $request->product_id[$i],
                    'stockin_details_id'        => $request->product_unique_id[$i],
                    'condition'                => $request->conditions[$i],
                    'remarks'                    => $request->reason[$i],
                    'created_at'                => Carbon::now(),
                ];

                if($request->conditions[$i] == 4){
                    Products::find($request->product_id[$i])->increment('available_qty');
                    StockInDetails::where('id',$request->product_unique_id[$i])
                        ->update(['status'=>StockStatus::$IN_STOCK]);
                }
                else{
                    StockInDetails::where('id',$request->product_unique_id[$i])
                        ->update(['status'=>StockStatus::$BR_DAMAGED]);
                }
            }
            //dd($request->all());
            ReturnFromVendorDetails::insert($data);
            
            
            DB::commit();

            return redirect()->to('returns')->with("success", "Stock Delivered Successfully");
        } catch (Exception $ex) 
        {
            Log::error($ex);
            DB::rollback();
            return redirect()->back()->withErrors("Internal Server Error")->withInput();
        }
    }

    public function show($id)
    {
        $retVendor = ReturnFromVendor::findOrFail($id);
        $retVendorDetails = ReturnFromVendorDetails::where('return_from_vendor_id',$retVendor->id)->get();
        $pageInfo = ["title"=>"View Return From Vendor"];
        $conditionList = $this->makeDD( [
            4=>'Repaired',
            5=>'Damaged',
        ] ,"Condition");

        return view("ReturnFromVendor::show",compact('pageInfo','retVendor','retVendorDetails','conditionList'));
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
