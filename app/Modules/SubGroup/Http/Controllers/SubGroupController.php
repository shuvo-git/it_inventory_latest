<?php

namespace App\Modules\SubGroup\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Modules\SubGroup\Models\SubGroup;

use DB;
use Log;
use Carbon\Carbon;

class SubGroupController extends Controller
{

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        if (!auth()->user()->can('Settings'))
            abort(403);
        $subGroups = $this->__filter($request);
        return view("SubGroup::index", compact('subGroups'));
    }

    private function __filter($request) {
        $subGroup = SubGroup::query();

        if ($request->filled('name')) {
            $subGroup->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('category')) {
            $subGroup->where('category_id', 'like', '%' . $request->category . '%');
        }

        return $subGroup->orderBy('name', 'ASC')->paginate(20);
    }

    public function store(Request $request) {
        if (!auth()->user()->can('Settings'))
            abort(403);

        $this->validate($request, [
            'name' => 'required|string|min:3|unique:sub_categories,name',
            'category_id' => 'required'
        ]);

        try {
            DB::begintransaction();

            $subGroup = new SubGroup();
            $subGroup->category_id = $request->category_id;
            $subGroup->name = $request->name;
            $subGroup->created_at = Carbon::now();
            $subGroup->save();

            DB::commit();

            return redirect()->back()->with("success", "Sub Group Created Successfully");
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
            'name' => 'required|string|min:3|unique:sub_categories,name,'.$id,
            'category_id' => 'required'
        ]);

        try {
            DB::begintransaction();
            $subGroup = SubGroup::findOrFail($id);
            $subGroup->category_id = $request->category_id;
            $subGroup->name = $request->name;
            $subGroup->updated_at = Carbon::now();
            $subGroup->save();
            DB::commit();

            return redirect()->back()->with("success", "Sub Group Successfully Updated");
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
            $subGroup = SubGroup::findOrFail($id);
            $subGroup->deleted_by = auth()->user()->id;
            $subGroup->deleted_at = Carbon::now();
            $subGroup->save();
            return redirect()->back()->with("success", "Sub Group Successfully Deleted");
        } catch (Exception $ex) {
            Log::error($ex);
            return redirect()->back()->withErrors("Internal Server Error");
        }
    }
}
