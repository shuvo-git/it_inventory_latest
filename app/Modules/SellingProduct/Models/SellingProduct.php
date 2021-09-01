<?php

namespace App\Modules\SellingProduct\Models;

use Illuminate\Database\Eloquent\Model;
use App\Modules\SellingCategories\Models\SellingCategories;

use Illuminate\Database\Eloquent\SoftDeletes;

class SellingProduct extends Model
{
    use SoftDeletes;
    
    protected $guarded = ['id'];

    function sellingCategory() {
        return $this->belongsTo(SellingCategories::class, 'sell_category_id', 'id');
    }
}
