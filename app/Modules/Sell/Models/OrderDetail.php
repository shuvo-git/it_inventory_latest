<?php

namespace App\Modules\Sell\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $guarded = ['id'];
    
    function product()
    {
        return $this->belongsTo(\App\Modules\SellingProduct\Models\SellingProduct::class);
    }
}
