<?php

namespace App\Modules\Supplier\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Supplier\Models\Supplier;

class SupplierController extends Controller
{

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        if (!auth()->user()->can('Settings'))
            abort(403);
        $suppliers = $this->__filter($request);
        return view("Supplier::index", compact('suppliers'));
    }

    private function __filter($request) {
        $supplier = Supplier::query();


        if ($request->filled('name')) {
            $supplier->where('name', 'like', '%' . $request->name . '%');
        }


        return $supplier->orderBy('name', 'ASC')->paginate(20);
    }

    public function store(Request $request) {
        if (!auth()->user()->can('Settings'))
            abort(403);

        $this->validate($request, [
            'name' => 'required|string|min:3'
        ]);

        try {
            DB::begintransaction();

            $supplier = new Supplier();
            $supplier->name = $request->name;
            $supplier->created_at = Carbon::now();
            $supplier->save();

            DB::commit();

            return redirect()->back()->with("success", "Supplier Created Successfully");
        } catch (Exception $ex) {
            Log::error($ex);
            DB::rollback();
            return redirect()->back()->withErrors("Internal Server Error")->withInput();
        }
    }

    public function update($id, Request $request) {
        if (!auth()->user()->can('Settings'))
            abort(403);

       $this->validate($request, [
            'name' => 'required|string|min:3'
        ]);

        try {
            DB::begintransaction();
            $supplier = Supplier::findOrFail($id);
            $supplier->name = $request->name;
            $supplier->updated_at = Carbon::now();
            $supplier->save();
            DB::commit();

            return redirect()->back()->with("success", "Supplier Successfully Updated");
        } catch (Exception $ex) {
            Log::error($ex);
            DB::rollback();
            return redirect()->back()->withErrors("Internal Server Error")->withInput();
        }
    }

    public function destroy($id) {
        if (!auth()->user()->can('Settings'))
            abort(403);

        try {
            $supplier = Supplier::findOrFail($id);
            $supplier->deleted_by = auth()->user()->id;
            $supplier->deleted_at = Carbon::now();
            $supplier->save();
            return redirect()->back()->with("success", "Supplier Successfully Deleted");
        } catch (Exception $ex) {
            Log::error($ex);
            return redirect()->back()->withErrors("Internal Server Error");
        }
    }
}
