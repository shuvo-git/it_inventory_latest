<?php

namespace App\Modules\SendToRepair\Models;

use App\Modules\StockIn\Models\StockInDetails;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RepairDetails extends Model
{
    protected $table = "repair_product_details";
    protected $guarded = ['id'];

    public function stockin_detail()
    {
        return $this->belongsTo(StockInDetails::class, 'product_unique_id');
    }

}
