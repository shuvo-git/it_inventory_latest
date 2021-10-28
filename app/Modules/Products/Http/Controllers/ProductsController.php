<?php

namespace App\Modules\Products\Http\Controllers;

use App\Classes\StockStatus;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Modules\Products\Models\Products;
//use App\Modules\Companies\Models\Companies;
use App\Modules\Products\Models\Category;
use App\Modules\Brand\Models\Brand;
use App\Modules\SubGroup\Models\SubGroup;


use App\Http\Traits\FileProcessTrait;
use Rap2hpoutre\FastExcel\FastExcel;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller {

    use FileProcessTrait;

    /**
     * 
     *
     * Working Code 05/09/2021
     */
    public function index(Request $request) {
        if (!auth()->user()->can('Product Management'))
            abort(403);
        $products = $this->__filter($request);

        return view("Products::index", compact('products'));
    }

    private function __filter($request) {
        $query = Products::query();

        if ($request->filled('status')) {
            $query->where('status', '=', $request->status);
        } else {
            $query->where('status', '=', 1);
        }
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
     
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('sub_category')) {
            $query->where('sub_category_id', $request->category);
        }

        if ($request->filled('date_from') and $request->filled('date_to')) {
            $date_from = Carbon::parse($request->input('date_from'))->startOfDay();
            $date_to = Carbon::parse($request->input('date_to'))->endOfDay();
            $query->whereDate('created_at', '>=', $date_from)->whereDate('created_at', '<=', $date_to);
        }

        return $query->paginate(50);
    }

    /**
     * Working Code 01/09/2021
     */
    public function create(Request $request) {
        if (!auth()->user()->can('Product Management'))
            abort(403);

        return view("Products::create");
    }

    /**
     * Working Code 05/09/2021
     */
    public function store(Request $request) 
    {
        if (!auth()->user()->can('Product Management'))
            abort(403);

        $this->validate($request, [
            'category' => 'required|array',
            'category.*' => 'required|integer|exists:categories,id',
            'sub_group' => 'required|array',
            'sub_group.*' => 'required|integer|exists:sub_categories,id',
            'brand' => 'required|array',
            'brand.*' => 'required|integer|exists:brands,id',
            'name' => 'required|array',
            'name.*' => 'required|string',
            'depriciation_period' => 'required|array',
            'depriciation_period.*' => 'required|integer|min:1',
            'depriciation_amount' => 'required|array',
            'depriciation_amount.*' => 'required|integer'
        ]);

        try {
            for ($i = 0; $i < count($request->category); $i++) 
            {
                $data[] = [
                    'name' => $request->name[$i],
                    'category_id' => $request->category[$i],
                    'sub_category_id' => $request->sub_group[$i],
                    'brand_id' => $request->brand[$i],
                    'depriciation_period'=> $request->depriciation_period[$i],
                    'depriciation_amount'=> $request->depriciation_amount[$i],
                    'created_at' => Carbon::now(),
                    'created_by' => auth()->user()->id,
                ];
            }
            if (isset($data)) {
                Products::insert($data);
                return redirect()->route('products.index')->with("success", "Product Successfully Inserted");
            } else {
                return redirect()->back()->withInput()->withErrors("Invalid data provided for product createtion");
            }
        } catch (\Exception $ex) {
            Log::error($ex);
            return redirect()->back()->withErrors("Internal Server Error");
        }
    }

    /**
     * Working Code 05/09/2021
     */
    public function update($id, Request $request) {
        if (!auth()->user()->can('Product Management'))
            abort(403);
        $this->validate($request, [
            'category' => 'required|integer|exists:categories,id',
            'sub_category' => 'required|integer|exists:sub_categories,id',
            'brand' => 'required|integer|exists:brands,id',
            'name' => 'required|string',
        ]);

        $product = Products::findOrFail($id);
        $product->category_id       = $request->category;
        $product->sub_category_id   = $request->sub_category;
        $product->name              = $request->name;
        $product->brand_id          = $request->brand;

        $product->updated_by = auth()->user()->id;
        $product->save();

        return redirect()->back()->with('success', 'Product Successfully updated');
    }

    public function bulkUpload(Request $request) {
        $this->validate($request, [
            'file' => 'required|file'
        ]);

        try {
            $fileName = $this->processSingle($request, 'file', 'doc/uploads');
            $collection = (new FastExcel)->import($fileName);
            foreach ($collection as $col) {
                if(!$col['company'] || $col['company']=='')
                {
                    Log::info($col);
                    return redirect()->back()->withErrors("Invalid Company Name. Please check your file.");
                }
                if(!$col['category'] || $col['category']=='')
                {
                    Log::info($col);
                    return redirect()->back()->withErrors("Invalid Category Name. Please check your file.");
                }
                // $company = Companies::firstOrCreate(['name' => $col['company']]);
                $category = Category::firstOrCreate(['name' => $col['category']]);
                if (!$col['name'] || !$col['buy_qty'] || !$col['buy_price'] || !$col['sell_price']) {
                    Log::info($col);
                    return redirect()->back()->withErrors("Product name or buy qty or buy price or sell price missing.");
                }
                if ($col['exp_date']) {
                    $date = str_replace('/', '-', $col['exp_date']); //25-03-2020
                    $date = carbon::parse($date)->format('Y-m-d');
                } else {
                    $date = null;
                }
                $data[] = [
                    'companies_id' => $company->id,
                    'category_id' => $category->id,
                    'name' => $col['name'],
                    'buy_qty' => $col['buy_qty'],
                    'available_qty' => $col['buy_qty'],
                    'buy_price' => $col['buy_price'],
                    'sell_price' => $col['sell_price'],
                    'group' => $col['group'],
                    'details' => $col['details'],
                    // 'short_list_qty' => $col['short_list_qty'],
                    'exp_date' => $date,
                    'created_by' => auth()->user()->id,
                    'created_at' => Carbon::now(),
                ];
            }
            if (isset($data)) {
                Products::insert($data);
                unlink($fileName);
                return redirect()->route('products.index')->with("success", "Product Successfully Inserted");
            } else {
                return redirect()->back()->withInput()->withErrors("Invalid data provided for product createtion");
            }
        } catch (Exception $ex) {
            Log::error($ex);
            return redirect()->back()->withErrors("Internal Server Error");
        }

        dd($request->all());
    }

    public function details(Request $request) {
        $product = Products::select('id', 'buy_price', 'sell_price', 'short_list_qty', 'details', 'group', 'exp_date')->where('name', $request->name)->first();
        return response()->json($product);
    }

    public function productDetails(Request $request) {
        $product = Products::select('name', 'id', 'buy_price')->where('id', $request->id)->first();
        return response()->json($product);
    }

    public function subGroup(Request $request) {
        $subGroup = SubGroup::select('name', 'id')->where('category_id', $request->goupId)->first();
        return response()->json($subGroup);
    }

    public function destroy($id) {
        if (!auth()->user()->can('Product Management'))
            abort(403);

        try {
            $product = Products::findOrFail($id);
            $product->deleted_by = auth()->user()->id;
            $product->deleted_at = Carbon::now();
            $product->save();
            return redirect()->back()->with("success", "Product Successfully Deleted");
        } catch (Exception $ex) {
            Log::error($ex);
            return redirect()->back()->withErrors("Internal Server Error");
        }
    }

    public function shortList(Request $request) {
        if (!auth()->user()->can('Product Management'))
            abort(403);
        $query = Products::query();
        
        $query->selectRaw('buying_products.id,buying_products.name,companies.name as company,categories.name as category, sum(buying_products.available_qty) as available_qty,buying_products.short_list_qty');
        $query->leftJoin('companies','companies.id','buying_products.companies_id');
        $query->leftJoin('categories','categories.id','buying_products.category_id');
        if ($request->filled('company')) {
            $query->where('buying_products.companies_id', $request->company);
        }
        if ($request->filled('category')) {
            $query->where('buying_products.category_id', $request->category);
        }
        $query->groupBy('company');
        $query->groupBy('name');
        $query->havingRaw('available_qty <= short_list_qty');
        $shortLists = $query->get();
        
        return view("Products::shortList", compact('shortLists'));
    }
    public function upcomingExp(Request $request) {
        if (!auth()->user()->can('Product Management'))
            abort(403);
        
        $date = Carbon::now()->addDay(60)->format('Y-m-d');
        $query = Products::query();
        $query->with('company','category');
        $query->where('available_qty','>',0);
        $query->where('exp_date','<=',$date);
        $products = $query->get();
        return view("Products::expList", compact('products'));
    }

}
