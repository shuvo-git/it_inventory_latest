<?php
namespace App\Traits;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author soulo
 */
use App\Modules\Sell\Models\DailySell;
use App\Modules\Sell\Models\MonthlySell;
use App\Modules\Products\Models\Category;
use Carbon\Carbon;
trait UpdateSells {
    public function __updateDailySell($category_id, $sell, $profit) {
        $dailySell = DailySell::where('category_id', $category_id)->where('sell_date', date('Y-m-d'))->first();
        if ($dailySell) {
            $dailySell->total_sell += $sell;
            $dailySell->total_profit += $profit;
            $dailySell->save();
        } else {
            $category = Category::get();
            foreach ($category as $cat) {
                $dailySell = new DailySell();
                $dailySell->category_id = $cat->id;
                $dailySell->sell_date = Carbon::now();
                if ($cat->id == $category_id) {
                    $dailySell->total_sell = $sell;
                    $dailySell->total_profit = $profit;
                } else {
                    $dailySell->total_sell = 0;
                    $dailySell->total_profit = 0;
                }
                $dailySell->save();
            }
        }

        $this->__updateMonthlySell($category_id, $sell, $profit);
    }

    public function __updateMonthlySell($category_id, $sell, $profit) {
        $monthlySell = MonthlySell::where('category_id', $category_id)->where('year', date('Y'))->where('month', date('m'))->first();
        if ($monthlySell) {
            $monthlySell->total_sell += $sell;
            $monthlySell->total_profit += $profit;
            $monthlySell->save();
        } else {
            $category = Category::get();
            foreach ($category as $cat) {
                $monthlySell = new MonthlySell();
                $monthlySell->category_id = $cat->id;
                $monthlySell->year = Carbon::now()->format('Y');
                $monthlySell->month = Carbon::now()->format('m');

                if ($cat->id == $category_id) {
                    $monthlySell->total_sell = $sell;
                    $monthlySell->total_profit = $profit;
                } else {
                    $monthlySell->total_sell = 0;
                    $monthlySell->total_profit = 0;
                }
                $monthlySell->save();
            }
        }
    }
}
