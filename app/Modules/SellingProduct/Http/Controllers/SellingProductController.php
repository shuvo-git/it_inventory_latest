<?php

namespace App\Modules\SellingProduct\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Modules\SellingProduct\Models\SellingProduct;
use App\Modules\SellingCategories\Models\SellingCategories;

use Carbon\Carbon;
use Log;

class SellingProductController extends Controller
{

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        if (!auth()->user()->can('Product Management'))
            abort(403);
        $products = $this->__filter($request);

        return view("SellingProduct::index", compact('products'));
    }

    private function __filter($request) {
        $query = SellingProduct::query();

        if ($request->filled('status')) {
            $query->where('status', '=', $request->status);
        }

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
        
        if ($request->filled('category')) {
            $query->where('sell_category_id', $request->category);
        }
        
        if ($request->filled('date_from') and $request->filled('date_to')) {
            $date_from = Carbon::parse($request->input('date_from'))->startOfDay();
            $date_to = Carbon::parse($request->input('date_to'))->endOfDay();
            $query->whereDate('created_at', '>=', $date_from)->whereDate('created_at', '<=', $date_to);
        }

        return $query->paginate(50);
    }


    public function create(Request $request) {
        if (!auth()->user()->can('Product Management'))
            abort(403);

        return view("SellingProduct::create");
    }

    public function store(Request $request) {
        if (!auth()->user()->can('Product Management'))
            abort(403);
        $this->validate($request, [
            'category' => 'required|array',
            'category.*' => 'required|integer|exists:selling_categories,id',
            'name' => 'required|array',
            'name.*' => 'required|string',
            'sell_price' => 'required|array',
            'sell_price.*' => 'required|numeric|min:0',
            'details' => 'required|array',
        ]);

        try {
            for ($i = 0; $i < count($request->name); $i++) {
                $data[] = [
                    'name' => $request->name[$i],
                    'sell_category_id' => $request->category[$i],
                    'sell_price' => $request->sell_price[$i],
                    'details' => $request->details[$i],
                    'created_by' => auth()->user()->id,
                    'created_at' => Carbon::now(),
                ];
            }
            if (isset($data)) {
                SellingProduct::insert($data);
                return redirect()->route('selling-product.index')->with("success", "Product Successfully Added");
            } else {
                return redirect()->back()->withInput()->withErrors("Invalid data provided for product createtion");
            }
        } catch (\Exception $ex) {
            \Log::error($ex);
            return redirect()->back()->withErrors("Internal Server Error");
        }
    }

    public function update($id, Request $request) {
        if (!auth()->user()->can('Product Management'))
            abort(403);
        $this->validate($request, [
            'name' => 'required',
            'category' => 'required|integer|exists:categories,id',
            'sell_price' => 'required|numeric|min:0',
            'details' => 'sometimes|nullable',
            'status' => 'required'
        ]);

        $product = SellingProduct::findOrFail($id);
        $product->name = $request->name;
        $product->sell_category_id = $request->category;
        $product->sell_price = $request->sell_price;
        $product->details = $request->details;
        $product->status = $request->status;
        $product->updated_by = auth()->user()->id;
        $product->updated_at = Carbon::now();
        $product->save();

        return redirect()->back()->with('success', 'Product Successfully Updated');
    }

    public function details(Request $request) {
        $product = SellingProduct::select('id', 'sell_price', 'details')->where('name', $request->name)->first();
        return response()->json($product);
    }

    public function destroy($id) {
        if (!auth()->user()->can('Product Management'))
            abort(403);

        try {
            $product = SellingProduct::findOrFail($id);
            $product->deleted_by = auth()->user()->id;
            $product->deleted_at = Carbon::now();
            $product->save();
            return redirect()->back()->with("success", "Product Successfully Deleted");
        } catch (Exception $ex) {
            Log::error($ex);
            return redirect()->back()->withErrors("Internal Server Error");
        }
    }
}
