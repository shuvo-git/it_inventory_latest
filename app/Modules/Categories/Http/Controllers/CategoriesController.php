<?php

namespace App\Modules\Categories\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Modules\Products\Models\Category;
use DB;
use Log;
use Carbon\Carbon;

class CategoriesController extends Controller
{

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        if (!auth()->user()->can('Product Management'))
            abort(403);
        $categories = $this->__filter($request);
        return view("Categories::index", compact('categories'));
    }

    private function __filter($request) {
        $category = Category::query();


        if ($request->filled('name')) {
            $category->where('name', 'like', '%' . $request->name . '%');
        }


        return $category->orderBy('name', 'ASC')->paginate(20);
    }

    public function store(Request $request) {
        if (!auth()->user()->can('Product Management'))
            abort(403);

        $this->validate($request, [
            'name' => 'required|string|min:3|unique:categories,name'
        ]);

        try {
            DB::begintransaction();

            $category = new Category();
            $category->name = $request->name;
            $category->created_at = Carbon::now();
            $category->save();

            DB::commit();

            return redirect()->back()->with("success", "Category Created Successfully");
        } catch (Exception $ex) {
            Log::error($ex);
            DB::rollback();
            return redirect()->back()->withErrors("Internal Server Error")->withInput();
        }
    }

    public function update($id, Request $request) {
        if (!auth()->user()->can('Product Management'))
            abort(403);

       $this->validate($request, [
            'name' => 'required|string|min:3|unique:categories,name,'.$id
        ]);

        try {
            DB::begintransaction();
            $category = Category::findOrFail($id);
            $category->name = $request->name;
            $category->updated_at = Carbon::now();
            $category->save();
            DB::commit();

            return redirect()->back()->with("success", "Category Successfully Updated");
        } catch (Exception $ex) {
            Log::error($ex);
            DB::rollback();
            return redirect()->back()->withErrors("Internal Server Error")->withInput();
        }
    }

    public function destroy($id) {
        if (!auth()->user()->can('Product Management'))
            abort(403);

        try {
            $category = Category::findOrFail($id);
            $category->deleted_by = auth()->user()->id;
            $category->deleted_at = Carbon::now();
            $category->save();
            return redirect()->back()->with("success", "Category Successfully Deleted");
        } catch (Exception $ex) {
            Log::error($ex);
            return redirect()->back()->withErrors("Internal Server Error");
        }
    }
}
