<?php

namespace App\Modules\SendToRepair\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RepairDetails extends Model
{
    protected $table = "repair_product_details";
    protected $guarded = ['id'];
}
