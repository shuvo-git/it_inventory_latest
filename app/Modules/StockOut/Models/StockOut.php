<?php

namespace App\Modules\StockOut\Models;

use App\Branch;
use App\Modules\Products\Models\Products;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class StockOut extends Model
{
    use SoftDeletes;

    protected $table = "stock_outs";
    protected $guared = ['id'];

    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }

    public function branch(){
        return $this->belongsTo(Branch::class,'branch_or_division_id');
    }

    public function date($value)
    {
        return Carbon::parse($value)->format('d M, Y');
    }
}
