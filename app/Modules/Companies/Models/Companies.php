<?php

namespace App\Modules\Companies\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Companies extends Model
{
    use SoftDeletes;
    protected $guarded = ['id'];
    
    function products()
    {
        return $this->hasMany(\App\Modules\Products\Models\Products::class);
    }
}
