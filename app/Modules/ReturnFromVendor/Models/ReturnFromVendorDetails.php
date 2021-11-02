<?php

namespace App\Modules\ReturnFromVendor\Models;

use App\Modules\Products\Models\Products;
use Illuminate\Database\Eloquent\Model;
use App\Modules\ReturnFromVendor\Models\ReturnFromVendor;
use App\Modules\StockIn\Models\StockInDetails;

class ReturnFromVendorDetails extends Model
{
    protected $table = "return_from_vendor_details";
    protected $guared = ["id"];

    public function stockin_detail()
    {
        return $this->belongsTo(StockInDetails::class, 'stockin_details_id');
    }

    public function ret_from_vendor_detail(){
        return $this->belongsTo(ReturnFromVendor::class,'return_from_vendor_id');
    }

    
}
