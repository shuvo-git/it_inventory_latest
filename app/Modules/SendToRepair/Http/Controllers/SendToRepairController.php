<?php

namespace App\Modules\SendToRepair\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SendToRepairController extends Controller
{

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        return view("SendToRepair::welcome");
    }
}
