<?php

namespace App\Modules\WarrantyClaim\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WarrantyClaimController extends Controller
{

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        return view("WarrantyClaim::welcome");
    }
}
