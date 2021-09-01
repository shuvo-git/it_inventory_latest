<?php

namespace App\Modules\SubGroup\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubGroup extends Model
{
    use SoftDeletes;

    protected $table = 'sub_categories';

    protected $guarded = ['id'];

    function group(){
    	return $this->belongsTo(\App\Modules\Products\Models\Category::class, 'category_id', 'id');
    }
}
