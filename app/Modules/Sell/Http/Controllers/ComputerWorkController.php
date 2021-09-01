<?php

namespace App\Modules\Sell\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Log;
use Carbon\Carbon;
use App\Modules\Sell\Models\ComputerWork;

class ComputerWorkController extends Controller {

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        if (!auth()->user()->can('Sell Management'))
            abort(403);
        $computerWorks = $this->__filter($request);
        return view("Sell::computer_work.index", compact('computerWorks'));
    }

    private function __filter($request) {
        $query = ComputerWork::query();

        if ($request->filled('date_from') and $request->filled('date_to')) {
            $date_from = Carbon::parse($request->input('date_from'))->startOfDay();
            $date_to = Carbon::parse($request->input('date_to'))->endOfDay();
            $query->whereDate('created_at', '>=', $date_from)->whereDate('created_at', '<=', $date_to);
        } else {
            $query->whereDate('created_at', Carbon::now()->format('Y-m-d'));
        }

        $query->orderBy('id', 'desc');

        return $query->paginate(30);
    }

    public function store(Request $request) {
        if (!auth()->user()->can('Sell Management'))
            abort(403);

        $this->validate($request, [
            'total_amount' => 'required|numeric|min:0',
            'cost' => 'required|numeric|min:0',
            'note' => 'required|string|min:3'
        ]);

        if ($request->total_amount < $request->cost) {
            return redirect()->back()->withErrors("The total amount can not be less than the total cost")->withInput();
        }
        $profit = $request->total_amount - $request->cost;
        try {
            $cWork = new ComputerWork();
            $cWork->total_amount = $request->total_amount;
            $cWork->cost = $request->cost;
            $cWork->profit = $profit;
            $cWork->note = $request->note;
            $cWork->created_at = Carbon::now();
            $cWork->save();
            return redirect()->back()->with("success", "Insert Successfully");
        } catch (Exception $ex) {
            Log::error($ex);
            return redirect()->back()->withErrors("Internal Server Error")->withInput();
        }
    }

    public function update($id, Request $request) {
        if (!auth()->user()->can('Sell Management'))
            abort(403);

        $this->validate($request, [
            'total_amount' => 'required|numeric|min:0',
            'cost' => 'required|numeric|min:0',
            'note' => 'required|string|min:3'
        ]);

        if ($request->total_amount < $request->cost) {
            return redirect()->back()->withErrors("The total amount can not be less than the total cost")->withInput();
        }
        $profit = $request->total_amount - $request->cost;
        try {
            $cWork = ComputerWork::findOrFail($id);
            $cWork->total_amount = $request->total_amount;
            $cWork->cost = $request->cost;
            $cWork->profit = $profit;
            $cWork->note = $request->note;
            $cWork->created_at = Carbon::now();
            $cWork->save();
            return redirect()->back()->with("success", "Update Successfully");
        } catch (Exception $ex) {
            Log::error($ex);
            return redirect()->back()->withErrors("Internal Server Error")->withInput();
        }
    }

}
