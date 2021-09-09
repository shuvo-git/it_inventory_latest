<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function makeDD($obj, $specificName=null) {
        $fieldName = 'Choose One ...';
        if($specificName!=null)
            $fieldName = 'Choose '.$specificName;
        $arr = [''=>$fieldName];
        foreach ($obj as $key => $value) {
            $arr += [$key => $value];
        }
        return $arr;
    }
}
