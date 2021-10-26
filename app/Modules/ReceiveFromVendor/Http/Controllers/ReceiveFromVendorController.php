<?php

namespace App\Modules\ReceiveFromVendor\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\ReceiveFromVendor\Models\ReceiveFromVendor;
use Illuminate\Http\Request;

class ReceiveFromVendorController extends Controller
{

    var $_FROM_VENDOR = 5;
    public function index(Request $request)
    {
        $ReceiveFromVendors = $this->__filter($request);
        $pageInfo = ["title"=>"Receive from Vendor"];

        return view("ReceiveFromVendor::index",compact('ReceiveFromVendors','pageInfo'));
    }
    private function __filter($request) 
    {
        $return = ReceiveFromVendor:://with('StockInDetails');  
        query();


        if ($request->filled('supplier_id')) {
            $return->where('supplier_id', 'like', '%' . $request->supplier_id . '%');
        }


        return $return
        //->join('', 'users.id', '=', 'contacts.user_id')
        ->orderBy('id', 'ASC')
        ->paginate(20);
    }
}
