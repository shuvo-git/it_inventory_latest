<?php

namespace App\Modules\Products\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Products extends Model {

    use SoftDeletes;

    protected $table = 'products'; //'buying_products';
    
    protected $guarded = ['id'];

    function subGroup() {
        return $this->belongsTo(\App\Modules\SubGroup\Models\SubGroup::class, 'sub_category_id', 'id');
    }
    function brand() {
        return $this->belongsTo(\App\Modules\Brand\Models\Brand::class, 'brand_id', 'id');
    }
    
    function category() {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

}
