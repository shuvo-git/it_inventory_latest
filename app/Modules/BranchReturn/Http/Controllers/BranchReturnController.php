<?php

namespace App\Modules\BranchReturn\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BranchReturnController extends Controller
{

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        return view("BranchReturn::welcome");
    }
}
