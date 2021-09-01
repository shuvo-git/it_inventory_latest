<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modules\Sell\Models\DailySell;
use App\Modules\Sell\Models\MonthlySell;
use Carbon\Carbon;
use Log;
use App\Modules\Products\Models\Products;
class HomeController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $colors = [];

    public function __construct() {
        $this->middleware('auth');
        $this->colors = ['#66CDAA', '#6495ED','#FF69B4','#D2B48C','#E6E6FA'];
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        $totalProducts = Products::with('category')->selectRaw('sum(available_qty) as total,category_id')->where('status',1)->groupBy('category_id')->get();
        
        //$dailySells = DailySell::where('sell_date', Carbon::now()->format('Y-m-d'))->get();

        $colors = $this->colors;

        return view('home', compact('colors', 'totalProducts'));//'monthlySells', 
    }

    private function __monthlyBarChart($data) {

        foreach ($data->groupBy('month') as $key => $value) {
            $labels[] = \DateTime::createFromFormat('!m', $key)->format('F');
        }
        $i = 0;
        foreach ($data->groupBy('category.name') as $category => $value) {
            $data = null;
            foreach ($value as $v) {
                $data[] = $v->total_sell;
            }
            $datasets[] = [
                'label' => $category ?? null,
                'data' => $data ?? null,
                'backgroundColor' => @$this->colors[$i++],
                'borderWidth' => 1
            ];
        }
        return $dataset = [
            'labels' => $labels ?? null,
            'datasets' => $datasets ?? null
        ];
    }
    private function __currentMonthBarChart() {

        $data = DailySell::with('category')->whereBetween('sell_date', [date("Y-m-01"),Carbon::now()->format('Y-m-d')])->get();
        foreach ($data->groupBy('sell_date') as $key => $value) {
            $labels[] = $key;
        }
        $i = 0;
        foreach ($data->groupBy('category.name') as $category => $value) {
            $data = null;
            foreach ($value as $v) {
                $data[] = $v->total_sell;
            }
            $datasets[] = [
                'label' => $category ?? null,
                'data' => $data ?? null,
                'backgroundColor' => $this->colors[$i++],
                'borderWidth' => 1
            ];
        }
        return $dataset = [
            'labels' => $labels ?? null,
            'datasets' => $datasets ?? null
        ];
    }

    private function __monthlyPieChart($data) {
        $i = 0;
        foreach ($data as $key => $value) {
            $labels[] = $value->category->name;
            $d[] = $value->total_sell;
            $colors[] = $this->colors[$i++];
        }
        
        $datasets[] = [
            'data' => $d ?? null,
            'backgroundColor' => $colors ?? null
        ];
        return $dataset = [
            'labels' => $labels ?? null,
            'datasets' => $datasets ?? null
        ];
    }

}
