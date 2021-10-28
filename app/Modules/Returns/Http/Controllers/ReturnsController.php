<?php

namespace App\Modules\Returns\Http\Controllers;

use App\Classes\StockStatus;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Log;

use App\Modules\Products\Models\Products;
use App\Modules\Returns\Models\ReturnDetails;
use App\Modules\Returns\Models\Returns;
use App\Modules\StockIn\Models\StockInDetails;

class ReturnsController extends Controller
{
    
    public function index(Request $request)
    {
        $Returns = $this->__filter($request);
        $pageInfo = ["title"=>"Returns"];

        return view("Returns::index",compact('Returns','pageInfo'));
    }
    private function __filter($request) {
        $return = Returns:://with('StockInDetails');  
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
        $deliveredProductList = $this->makeDD(StockInDetails::where('status',StockStatus::$IN_BRANCH)->select('id','unique_id')->pluck('unique_id','id'),"Product Unique ID");
        $branchDivList = $this->makeDD(DB::table('branch')->get()->pluck('br_name','id'),"Branch/Division");
        $pageInfo = ["title"=>"Create New Return"];
        $conditionList = $this->makeDD( [
            1=>'Good',
            2=>'Partially Damaged',
            3=>'Fully Damaged',
        ] ,"Condition");
        return view("Returns::create",compact('pageInfo','branchDivList','productList','deliveredProductList','conditionList'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            
            'branch_or_division_id' => 'required|integer|min:1',
            'delivery_person' => 'required|string|min:3,max:50',
            'delivery_person_mobile_no' => 'required|digits:11',
            'narration' => 'nullable|string|min:3,max:300',
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
            
            $return = new Returns();
            $return->branch_or_division_id      = $request->branch_or_division_id;
            $return->delivery_person            = $request->delivery_person;
            $return->delivery_person_mobile_no  = $request->delivery_person_mobile_no;
            $return->remarks                    = $request->remarks;
            $return->return_date                = $request->return_date;
            $return->created_by                 = auth()->user()->id;
            $return->save();

            

            $cnt = count($request->product_id);
            for ($i = 0; $i < $cnt; $i++) 
            {
                
                $data[] = [

                    'return_id'   => $return->id,
                    'stockin_details_id'  => $request->product_unique_id[$i],
                    'conditions'  => $request->conditions[$i],
                    'reason'      => $request->reason[$i],
                    'created_at'  => Carbon::now(),
                ];
                StockInDetails::where('id',$request->product_unique_id[$i])
                    ->update(['status'=>StockStatus::$BR_RETURN]);
            }
            
            ReturnDetails::insert($data);
            
            
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
        $Return = Returns::findOrFail($id);
        $ReturnDetails = ReturnDetails::where('return_id',$Return->id)->get();
        $pageInfo = ["title"=>"View Return "];
        $conditionList = $this->makeDD( [
            1=>'Good',
            2=>'Partially Damaged',
            3=>'Fully Damaged',
        ] ,"Condition");

        return view("Returns::show",compact('pageInfo','ReturnDetails','Return','conditionList'));
    }

    public function getDeliveredProduct(Request $request){
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
}
