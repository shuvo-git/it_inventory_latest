<?php

namespace App\Modules\Brand\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Modules\Brand\Models\Brand;
use DB;
use Log;
use Carbon\Carbon;

class BrandController extends Controller
{

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        if (!auth()->user()->can('Settings'))
            abort(403);
        $brands = $this->__filter($request);
        return view("Brand::index", compact('brands'));
    }

    private function __filter($request) {
        $brand = Brand::query();


        if ($request->filled('name')) {
            $brand->where('name', 'like', '%' . $request->name . '%');
        }


        return $brand->orderBy('name', 'ASC')->paginate(20);
    }

    public function store(Request $request) {
        if (!auth()->user()->can('Settings'))
            abort(403);

        $this->validate($request, [
            'name' => 'required|string|min:1|unique:brands,name'
        ]);

        try {
            DB::begintransaction();

            $brand = new Brand();
            $brand->name = $request->name;
            $brand->created_at = Carbon::now();
            $brand->save();

            DB::commit();

            return redirect()->back()->with("success", "Brand Created Successfully");
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
            'name' => 'required|string|min:1|unique:brands,name,'.$id
        ]);

        try {
            DB::begintransaction();
            $brand = Brand::findOrFail($id);
            $brand->name = $request->name;
            $brand->updated_at = Carbon::now();
            $brand->save();
            DB::commit();

            return redirect()->back()->with("success", "Brand Successfully Updated");
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
            $brand = Brand::findOrFail($id);
            $brand->deleted_by = auth()->user()->id;
            $brand->deleted_at = Carbon::now();
            $brand->save();
            return redirect()->back()->with("success", "Category Successfully Deleted");
        } catch (Exception $ex) {
            Log::error($ex);
            return redirect()->back()->withErrors("Internal Server Error");
        }
    }
}
