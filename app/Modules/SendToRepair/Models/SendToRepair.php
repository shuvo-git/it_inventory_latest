<?php

namespace App\Modules\SendToRepair\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SendToRepair extends Model
{
    protected $table = "send_to_repair";
    protected $guarded = ['id'];
}
