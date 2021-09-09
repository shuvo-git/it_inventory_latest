<?php

namespace App\Modules\StockIn\Models;

use App\Modules\Products\Models\Products;
use App\Modules\StockIn\Models\StockIn;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Carbon\Carbon;

class StockInDetails extends Model
{
    use SoftDeletes;
    protected $table = "stock_details";
    protected $guarded = ["id"];

    public function stockin() {
        return $this->belongsTo(StockIn::class,'id','stockin_id');
    }

    public function product() {
        return $this->belongsTo(Products::class,'product_id');
    }

    public function date($value)
    {
        return Carbon::parse($value)->format('d M, Y');
    }
    
}
