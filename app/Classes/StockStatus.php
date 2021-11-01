<?php

namespace App\Classes;

class StockStatus{
    public static $IN_STOCK = 1;
    public static $IN_BRANCH = 15;
    
    public static $BR_RETURN = 20;
    public static $BR_DAMAGED_PARTIALLY = 30;
    public static $BR_DAMAGED = 55;

    public static $IN_VENDOR = 35;
    public static $FROM_VENDOR = 40;

    public function __construct() {}
}