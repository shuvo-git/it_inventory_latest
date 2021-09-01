<?php

namespace App\Modules\Sell\Models;

use Illuminate\Database\Eloquent\Model;

class DailySell extends Model
{
    protected $guarded = ['id'];

    function saleProduct()
    {
        return $this->belongsTo(\App\Modules\SellingProduct\Models\SellingProduct::class, 'category_id', 'id');
    }
}
