<?php

namespace App\Modules\Returns\Models;

use Illuminate\Database\Eloquent\Model;

use App\Modules\StockIn\Models\StockInDetails;

class ReturnDetails extends Model
{
    protected $table = "branch_return_details";
    protected $guarded = ['id'];

    public function stock_in_detail()
    {
        return $this->belongsTo(StockInDetails::class, 'stockin_details_id');
    }
}
