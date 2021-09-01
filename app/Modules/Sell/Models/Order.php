<?php

namespace App\Modules\Sell\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = ['id'];
    
    function details()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
