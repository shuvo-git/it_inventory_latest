<?php

namespace App\Modules\SendToRepair\Models;

use App\Modules\Supplier\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SendToRepair extends Model
{
    protected $table = "send_to_repair";
    protected $guarded = ['id'];

    public function getSupplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }

    public function date($value)
    {
        return Carbon::parse($value)->format('d M, Y');
    }
}
