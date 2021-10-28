<?php

namespace App\Modules\SendToRepair\Http\Controllers;

use App\Classes\StockStatus;
use App\Http\Controllers\Controller;
use App\Modules\Products\Models\Products;
use App\Modules\SendToRepair\Models\RepairDetails;
use App\Modules\SendToRepair\Models\SendToRepair;
use App\Modules\StockIn\Models\StockInDetails;
use App\Modules\Supplier\Models\Supplier;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SendToRepairController extends Controller
{
    public function index(Request $request)
    {
        $Repairs = $this->__filter($request);
        $pageInfo = ["title"=>"Repairs"];

        return view("SendToRepair::index",compact('Repairs','pageInfo'));
    }
    private function __filter($request) {
        $return = SendToRepair:://with('StockInDetails');  
        query();


        if ($request->filled('supplier_id')) {
            $return->where('supplier_id', 'like', '%' . $request->supplier_id . '%');
        }


        return $return
        //->join('', 'users.id', '=', 'contacts.user_id')
        ->orderBy('id', 'ASC')
        ->paginate(20);
    }

    public function create()
    {
        $supplierList = $this->makeDD(Supplier::all()->pluck('supplier_name','id'),"Supplier"); 
        $productList = $this->makeDD(Products::all()->pluck('name','id'),"Product");
        $deliveredProductList = $this->makeDD(StockInDetails::where('status',StockStatus::$IN_BRANCH)->select('id','unique_id')->pluck('unique_id','id'),"Product Unique ID");
        $pageInfo = ["title"=>"Send to Repair"];
        
        return view("SendToRepair::create",compact('pageInfo','supplierList','productList','deliveredProductList'));
    }

    public function store(Request $request)
    {
        
        $this->validate($request, [
            
            'supplier_id' => 'required|integer|min:1',
            'delivery_person' => 'required|string|min:3,max:50',
            'delivery_person_mobile_no' => 'required|digits:11',
            'remarks' => 'nullable|string|min:3,max:300',
            'send_date' => 'required|date_format:Y-m-d',

            'product_id' => 'required|array',
            'product_id.*' => 'required|integer|min:1',
            'product_unique_id' => 'required|array',
            'product_unique_id.*' => 'required|integer|min:1',
        ]);
        
        
        try {
            DB::begintransaction();
            
            $sendToRepair = new SendToRepair();
            $sendToRepair->supplier_id                = $request->supplier_id;
            $sendToRepair->delivery_person            = $request->delivery_person;
            $sendToRepair->delivery_person_mobile_no  = $request->delivery_person_mobile_no;
            $sendToRepair->remarks                    = $request->remarks;
            $sendToRepair->send_date                  = $request->send_date;
            $sendToRepair->created_by                 = auth()->user()->id;
            $sendToRepair->save();

            

            $cnt = count($request->product_id);
            for ($i = 0; $i < $cnt; $i++) 
            {
                
                $data[] = [

                    'repair_id'   => $sendToRepair->id,
                    'product_id'  => $request->product_id[$i],
                    'product_unique_id'  => $request->product_unique_id[$i],
                    'problem_desc'  => $request->problem_desc[$i],
                    'created_at'  => Carbon::now(),
                ];
                StockInDetails::where('id',$request->product_unique_id[$i])
                    ->update(['status'=>StockStatus::$IN_VENDOR]);
            }
            
            RepairDetails::insert($data);
            
            DB::commit();

            return redirect()->to('returns')->with("success", "Product Delivered for Repair Successfully");
        } catch (Exception $ex) 
        {
            Log::error($ex);
            DB::rollback();
            return redirect()->back()->withErrors("Internal Server Error")->withInput();
        }
    }


    public function getReturnedProduct(Request $request){
        $id = $request->product_id;
        $deliveredStocksById = StockInDetails::select('id','unique_id')
            ->where('product_id',$id)
            ->where('status',StockStatus::$IN_BRANCH)
            ->get();
        $str = '<option value="">Choose Product Unique ID</option>';
        foreach ($deliveredStocksById as $k => $v) 
        {
            $str .= '<option value="'.$v->id.'">'. $v->unique_id.'</option>';
        }
        return $str;
    }

    public function getProductExpiryDate(Request $request){
        $d = StockInDetails::where('id',$request->product_id)->first()->warranty_expiry_date;
        return 'Expiry Date: '.Carbon::parse($d)->format('d M, Y');
    }
}
