<?php

namespace App\Modules\Sell\Models;

use Illuminate\Database\Eloquent\Model;

class ReturnItem extends Model
{
    protected $guarded = ['id'];
    
    function product()
    {
        return $this->belongsTo(\App\Modules\Products\Models\Products::class);
    }
}
