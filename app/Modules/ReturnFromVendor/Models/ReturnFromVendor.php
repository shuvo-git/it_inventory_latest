<?php

namespace App\Modules\ReturnFromVendor\Models;

use App\Modules\Products\Models\Products;
use App\Modules\Supplier\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ReturnFromVendor extends Model
{
    protected $table = "return_from_vendors";
    protected $guared = ["id"];

    

    public function supplier(){
        return $this->belongsTo(Supplier::class,'supplier_id');
    }
    

    public function date($value)
    {
        return Carbon::parse($value)->format('d M, Y');
    }
}
