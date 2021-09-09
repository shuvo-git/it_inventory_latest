<?php

namespace App\Modules\StockIn\Models;

use App\Modules\Supplier\Models\Supplier;
use App\Modules\StockIn\Models\StockInDetails;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StockIn extends Model
{
    use SoftDeletes;
    protected $table = "stock_in";
    protected $guarded = ["id"];

    public function getSupplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }
    public function stockInDetails(){
        return $this->hasOne(StockInDetails::class, 'stockin_id');
    }
    
}
