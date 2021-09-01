<?php

namespace App\Modules\Companies\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Companies\Models\Companies;
use DB;
use Log;
use Carbon\Carbon;
class CompaniesController extends Controller {

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        if (!auth()->user()->can('Company Management'))
            abort(403);
        $companies = $this->__filter($request);
        return view("Companies::index", compact('companies'));
    }

    private function __filter($request) {
        $company = Companies::query();


        if ($request->filled('name')) {
            $company->where('name', 'like', '%' . $request->name . '%');
        }
        if ($request->filled('sr_name')) {
            $company->where('name', 'like', '%' . $request->sr_name . '%');
        }
        if ($request->filled('sr_mobile_no')) {
            $company->where('mobile_no', 'like', '%' . $request->mobile_no . '%');
        }


        return $company->orderBy('name', 'ASC')->paginate(20);
    }

    public function store(Request $request) {
        if (!auth()->user()->can('Company Management'))
            abort(403);

        $this->validate($request, [
            'name' => 'required|string|min:3|unique:companies,name',
            'sr_name' => 'sometimes|nullable|string|min:3',
            'sr_mobile_no' => 'sometimes|nullable|string|min:11|max:14'
        ]);

        if ($request->filled('sr_mobile_no')) {
            $validPhoneNumber = mobileNoValidate($request->sr_mobile_no, 'local');
            if (!$validPhoneNumber) {
                return redirect()->back()->withErrors('Invalid Mobile Number No')->withInput();
            }
        }

        try {
            DB::begintransaction();

            $company = new Companies();
            $company->name = $request->name;
            $company->sr_name = $request->sr_name;
            $company->sr_mobile_no = $request->sr_mobile_no;
            $company->created_at = Carbon::now();
            $company->created_by = auth()->user()->id;
            $company->save();

            DB::commit();

            return redirect()->back()->with("success", "Supplier Added Successfully");
        } catch (Exception $ex) {
            Log::error($ex);
            DB::rollback();
            return redirect()->back()->withErrors("Internal Server Error")->withInput();
        }
    }

    public function update($id, Request $request) {
        if (!auth()->user()->can('Company Management'))
            abort(403);

       $this->validate($request, [
            'name' => 'required|string|min:3|unique:companies,name,'.$id,
            'sr_name' => 'sometimes|nullable|string|min:3',
            'sr_mobile_no' => 'sometimes|nullable|string|min:11|max:14'
        ]);
        if ($request->filled('sr_mobile_no')) {
            $validPhoneNumber = mobileNoValidate($request->sr_mobile_no, 'local');
            if (!$validPhoneNumber) {
                return redirect()->back()->withErrors('Invalid Mobile Number No')->withInput();
            }
        }

        try {
            DB::begintransaction();
            $company = Companies::findOrFail($id);
            $company->name = $request->name;
            $company->sr_name = $request->sr_name;
            $company->sr_mobile_no = $request->sr_mobile_no;
            $company->updated_at = Carbon::now();
            $company->updated_by = auth()->user()->id;
            $company->save();
            DB::commit();

            return redirect()->back()->with("success", "Supplier Info Successfully Updated");
        } catch (Exception $ex) {
            Log::error($ex);
            DB::rollback();
            return redirect()->back()->withErrors("Internal Server Error")->withInput();
        }
    }

    public function destroy($id) {
        if (!auth()->user()->can('Company Management'))
            abort(403);

        try {
            Companies::where('id', $id)->delete();
            return redirect()->back()->with("success", "Supplier Info Successfully Deleted");
        } catch (Exception $ex) {
            Log::error($ex);
            return redirect()->back()->withErrors("Internal Server Error");
        }
    }

}
