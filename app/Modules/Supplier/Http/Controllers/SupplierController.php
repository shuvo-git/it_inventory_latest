<?php

namespace App\Modules\Supplier\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Supplier\Models\Supplier;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
{
    public function index(Request $request) {
        if (!auth()->user()->can('Settings'))
            abort(403);
        $suppliers = $this->__filter($request);
        $pageInfo = [
            "title"=>"Supplier"
        ];
        return view("Supplier::index", compact('suppliers','pageInfo'));
    }

    private function __filter($request) {
        $supplier = Supplier::query();


        if ($request->filled('supplier_name')) {
            $supplier->where('supplier_name', 'like', '%' . $request->supplier_name . '%');
        }


        return $supplier->orderBy('supplier_name', 'ASC')->paginate(20);
    }

    public function store(Request $request) {
        if (!auth()->user()->can('Settings'))
            abort(403);

        $this->validate($request, [
            'supplier_name' => 'required|string|min:3',
            'supplier_contact_person' => 'required|string|min:3',
            'supplier_contact_no' => 'required|string|min:3',
            'supplier_address' => 'required|string|min:3',
        ]);

        try {
            DB::begintransaction();

            $supplier = new Supplier();
            $supplier->supplier_name = $request->supplier_name;
            $supplier->supplier_contact_person = $request->supplier_contact_person;
            $supplier->supplier_contact_no = $request->supplier_contact_no;
            $supplier->supplier_address = $request->supplier_address;
            $supplier->created_by = auth()->user()->id;
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
            'supplier_name' => 'required|string|min:3',
            'supplier_contact_person' => 'required|string|min:3',
            'supplier_contact_no' => 'required|string|min:3',
            'supplier_address' => 'required|string|min:3',
        ]);

        try {
            DB::begintransaction();
            $supplier = Supplier::findOrFail($id);
            $supplier->supplier_name = $request->supplier_name;
            $supplier->supplier_contact_person = $request->supplier_contact_person;
            $supplier->supplier_contact_no = $request->supplier_contact_no;
            $supplier->supplier_address = $request->supplier_address;
            $supplier->updated_by = auth()->user()->id;
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
            $supplier->delete();

            $supplier->deleted_by = auth()->user()->id;
            $supplier->save();
            return redirect()->back()->with("success", "Supplier Successfully Deleted");
        } catch (Exception $ex) {
            Log::error($ex);
            return redirect()->back()->withErrors("Internal Server Error");
        }
    }
}
