<?php

namespace App\Modules\Returns\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

use App\Modules\Products\Models\Products;
use App\Branch;

class Returns extends Model
{
    protected $table = "branch_returns";
    protected $guarded = ['id'];

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
