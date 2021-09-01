<?php

namespace App\Modules\Sell\Models;

use Illuminate\Database\Eloquent\Model;

class MonthlySell extends Model
{
    protected $guarded = ['id'];
    function category()
    {
        return $this->belongsTo(\App\Modules\Products\Models\Category::class);
    }
}
