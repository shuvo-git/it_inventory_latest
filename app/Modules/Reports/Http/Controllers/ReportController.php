<?php

namespace App\Modules\Reports\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Sell\Models\DailySell;
use App\Modules\Sell\Models\MonthlySell;
use App\Modules\Accounting\Models\Expense;
use App\Modules\CustomerManagement\Models\CustomerDue;
use App\Modules\Sell\Models\OrderDetail;
use App\Modules\Products\Models\Products;
use Carbon\Carbon;
use Log;
use DB;
use App\Modules\Sell\Models\DailyBalance;
use App\Modules\LoanManagement\Models\LoanDetail;

class ReportController extends Controller {

    public function setBalance(Request $request) {
        $this->validate($request, [
            'balance' => 'required|numeric|min:0'
        ]);

        try {
            if(DB::table('daily_balances')->where('date',date('Y-m-d'))->exists())
            {
                DB::table('daily_balances')->where('date',date('Y-m-d'))->update(['date' => date('Y-m-d'), 'balance' => $request->balance,'created_at'=>Carbon::now()]);
            }
            else
            {
                $data = ['date' => date('Y-m-d'), 'balance' => $request->balance,'created_at'=>Carbon::now()];
                
                DB::table('daily_balances')->insert($data);
            }
            
            return redirect()->back()->with('success', 'Balance Successfully set');
        } catch (\Exception $ex) {
            Log::error($ex);
            return redirect()->back()->withErrors("Internal Server Error");
        }
    }

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function daily(Request $request) {
        $dailySells = $this->__dailySell($request);
        $purchaseExpenses = $this->__purchaseExpense($request);
        $otherExpenses = $this->__otherExpense($request);
        //$dues = $this->__dailyDeu($request);
        //$loans = $this->__dailyLoan($request);
        $sellDate = $request->filled('date') ? $request->date : date('Y-m-d');
        $previousDay = Carbon::parse($sellDate)->subDays(1)->format('Y-m-d');

        $lastDayBalance = DailyBalance::select('balance')->where('date', $previousDay)->first();
        $lastDayBalance = $lastDayBalance ? $lastDayBalance->balance : 0;
        return view("Reports::dailyReport", compact('dailySells', 'purchaseExpenses', 'otherExpenses', 'sellDate', 'lastDayBalance'));
    }

    public function monthly(Request $request) {
        if ($request->filled('year')) {
            $year = $request->year;
        } else {
            $year = date('Y');
        }
        $monthlySell = MonthlySell::selectRaw('SUM(total_sell) as total_sell, SUM(total_profit) as total_profit,month')
                ->where('year', $year)
                ->groupBy('month')
                ->get();
        $monthlyMedicinePurchaseExpense = Expense::selectRaw("YEAR(created_at) year,MONTH(created_at) month, SUM(amount) as amount")
                ->whereIn('expense_category_id', [4, 10])
                ->whereYear('created_at', $year)
                ->groupBy('year')
                ->groupBy('month')
                ->get();
        $monthlyTotalExpense = Expense::selectRaw("YEAR(created_at) year,MONTH(created_at) month, SUM(amount) as amount")
                ->whereNotIn('expense_category_id', [4, 10])
                ->whereYear('created_at', $year)
                ->groupBy('year')
                ->groupBy('month')
                ->get();
        $monthlyDue = CustomerDue::selectRaw("YEAR(created_at) year,MONTH(created_at) month, SUM(credit_amount - debit_amount) as amount")
                ->whereYear('created_at', $year)
                ->groupBy('year')
                ->groupBy('month')
                ->get();


        $reports = [];
        $i = 0;
        foreach ($monthlySell as $sell) {
            $reports[$i]['month'] = \DateTime::createFromFormat('!m', $sell->month)->format('F');
            ;
            $reports[$i]['total_sell'] = $sell->total_sell;
            $reports[$i]['total_profit'] = $sell->total_profit;
            foreach ($monthlyMedicinePurchaseExpense as $mp) {
                if ($mp->month == $sell->month) {
                    $reports[$i]['medicine_purchase'] = $mp->amount;
                }
            }
            foreach ($monthlyTotalExpense as $te) {
                if ($te->month == $sell->month) {
                    $reports[$i]['total_expense'] = $te->amount;
                }
            }
            foreach ($monthlyDue as $md) {
                if ($md->month == $sell->month) {
                    $reports[$i]['total_due'] = $md->amount;
                }
            }

            $i++;
        }
//        dd($reports);

        return view("Reports::monthlyReport", compact('reports'));
    }

    public function productWiseSell(Request $request) {
        $query = OrderDetail::query();
        $query->selectRaw("selling_products.name as name,sum(order_details.qty) as qty, order_details.unit_price,sum(order_details.total_price) as total_price, sum(order_details.discount) as discount,sum(order_details.grand_total) as grand_total");
        $query->leftJoin('selling_products', 'selling_products.id', 'order_details.product_id');
        if ($request->filled('date_from') and $request->filled('date_to')) {
            $date_from = Carbon::parse($request->input('date_from'))->startOfDay();
            $date_to = Carbon::parse($request->input('date_to'))->endOfDay();
            $query->whereDate('order_details.created_at', '>=', $date_from)->whereDate('order_details.created_at', '<=', $date_to);
        } else {
            $query->whereDate('order_details.created_at', date('Y-m-d'));
        }



        $query->groupBy('selling_products.name');
        $query->orderBy('qty', 'desc');
        $sells = $query->paginate(50);

//        dd($sells->toArray());
        return view('Reports::product_wise_sell', compact('sells'));
    }

    public function dayWiseSell(Request $request) {
        $query = DailySell::query();
        $query->leftJoin('selling_products', 'selling_products.id', 'daily_sells.category_id');
        $query->orderBy('sell_date', 'desc');
        $query->orderBy('category_id', 'asc');
        if ($request->filled('date_from') and $request->filled('date_to')) {
            $date_from = Carbon::parse($request->input('date_from'))->startOfDay();
            $date_to = Carbon::parse($request->input('date_to'))->endOfDay();
            $query->where('sell_date', '>=', $date_from)->whereDate('sell_date', '<=', $date_to);
        } else {
            $query->where('sell_date', '>=', Carbon::now()->firstOfMonth()->format('Y-m-d'))->whereDate('sell_date', '<=', Carbon::now()->endOfMonth()->format('Y-m-d'));
        }

        $sells = $query->get();
        $sells = $sells->groupBy('sell_date');
        return view('Reports::dayWiseReport', compact('sells'));
    }

    private function __dailySell($request) {
        $query = DailySell::query();
        $query->orderBy('sell_date', 'desc');
        if ($request->filled('date')) {
            $date = Carbon::parse($request->input('date'))->startOfDay();
            $query->whereDate('sell_date', $date);
        } else {
            $query->whereDate('sell_date', Carbon::now()->format('Y-m-d'));
        }

        return $query->get();
    }

    private function __purchaseExpense($request) {
        $query = Products::query();
        $query->with('category');
        // $query->whereIn('expense_category_id', [4, 10]);

        if ($request->filled('date')) {
            $date = Carbon::parse($request->input('date'))->startOfDay();
            $query->whereDate('created_at', $date);
        } else {
            $query->whereDate('created_at', Carbon::now()->format('Y-m-d'));
        }

        return $query->get();
    }

    private function __otherExpense($request) {
        $query = Expense::query();
        // $query->with('category');
        // $query->whereNotIn('expense_category_id', [4, 10]);

        if ($request->filled('date')) {
            $date = Carbon::parse($request->input('date'))->startOfDay();
            $query->whereDate('created_at', $date);
        } else {
            $query->whereDate('created_at', Carbon::now()->format('Y-m-d'));
        }

        return $query->get();
    }

    private function __dailyDeu($request) {
        $query = CustomerDue::query();
        $query->selectRaw('id,customer_id,note,sum(credit_amount) as credit_amount, sum(debit_amount) as debit_amount');
        $query->with('customer');
        if ($request->filled('date')) {
            $date = Carbon::parse($request->input('date'))->startOfDay();
            $query->whereDate('created_at', $date);
        } else {
            $query->whereDate('created_at', Carbon::now()->format('Y-m-d'));
        }
        $query->groupBy('customer_id');
        $query->orderBy('created_at', 'asc');
        return $query->get();
    }

    private function __dailyLoan($request) {
        $query = LoanDetail::query();
        $query->selectRaw('id,loan_provider_id,note,sum(credit_amount) as credit_amount, sum(debit_amount) as debit_amount');
        $query->with('provider');
        if ($request->filled('date')) {
            $date = Carbon::parse($request->input('date'))->startOfDay();
            $query->whereDate('created_at', $date);
        } else {
            $query->whereDate('created_at', Carbon::now()->format('Y-m-d'));
        }
        $query->groupBy('loan_provider_id');
        $query->orderBy('created_at', 'asc');
        return $query->get();
    }

}
