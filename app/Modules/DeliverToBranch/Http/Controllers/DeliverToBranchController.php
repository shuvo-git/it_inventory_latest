<?php

namespace App\Modules\DeliverToBranch\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DeliverToBranchController extends Controller
{

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        return view("DeliverToBranch::welcome");
    }
}
