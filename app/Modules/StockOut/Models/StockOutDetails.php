<?php

namespace App\Modules\StockOut\Models;

use App\Branch;
use App\Modules\Products\Models\Products;
use App\Modules\StockIn\Models\StockInDetails;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class StockOutDetails extends Model
{
    use SoftDeletes;
    protected $table = "stockout_details";
    protected $guared = ['id'];

    public function stock_in_detail()
    {
        return $this->belongsTo(StockInDetails::class, 'stockin_details_id');
    }

    public function date($value)
    {
        return Carbon::parse($value)->format('d M, Y');
    }
}
