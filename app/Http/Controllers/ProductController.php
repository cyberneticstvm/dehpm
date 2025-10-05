<?php

namespace App\Http\Controllers;

use App\Models\Hsn;
use App\Models\ManufactureSupplier;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('product-list'), only: ['index']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('product-create'), only: ['create', 'store']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('product-edit'), only: ['edit', 'update']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('product-delete'), only: ['destroy']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('product-restore'), only: ['restore']),
        ];
    }

    protected $hsns, $manufacturers;

    public function __construct()
    {
        $this->hsns = Hsn::pluck('name', 'id');
        $this->manufacturers = ManufactureSupplier::where('type', 'Manufacturer')->pluck('name', 'id');
    }
    /**
     * Display a listing of the resource.
     */

    public function hsn()
    {
        $hsns = Hsn::withTrashed()->get();
        return view('product.hsn', compact('hsns'));
    }

    public function index($hsn)
    {
        $hsn = Hsn::findOrFail(decrypt($hsn));
        $products = Product::withTrashed()->where('hsn_id', $hsn->id)->get();
        return view('product.index', compact('products', 'hsn'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($hsn)
    {
        $hsns = $this->hsns;
        $manufacturers = $this->manufacturers;
        $hsn = Hsn::findOrFail(decrypt($hsn));
        return view('product.create', compact('hsns', 'manufacturers', 'hsn'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $hsn)
    {
        $request->validate([
            'name' => 'required',
            'hsn_id' => 'required',
            'manufacturer_id' => 'required',
        ]);
        try {
            $hsn = Hsn::findOrFail(decrypt($hsn));
            $input = $request->all();
            $input['created_by'] = $request->user()->id;
            $input['updated_by'] = $request->user()->id;
            $shortname = $hsn->short_name;
            $input['code'] = DB::table('products')->selectRaw("CONCAT_WS('-', '$shortname', LPAD(IFNULL(MAX(CAST(SUBSTRING(code, 4) AS INTEGER)) + 1, 10001), 5, '0')) AS pcode")->where('hsn_id', $hsn->id)->first()->pcode;
            Product::create($input);
        } catch (Exception $e) {
            return redirect()->back()->with("error", $e->getMessage())->withInput($request->all());
        }
        return redirect()->route('product.register', encrypt($hsn->id))->with("success", "Product created successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, string $hsn)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail(decrypt($id));
        $hsns = $this->hsns;
        $manufacturers = $this->manufacturers;
        return view('product.edit', compact('product', 'hsns', 'manufacturers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id, string $hsn)
    {
        $request->validate([
            'name' => 'required',
            'manufacturer_id' => 'required',
        ]);
        try {
            $input = $request->all();
            $input['updated_by'] = $request->user()->id;
            $product = Product::findOrFail(decrypt($id));
            $product->update($input);
        } catch (Exception $e) {
            return redirect()->back()->with("error", $e->getMessage())->withInput($request->all());
        }
        return redirect()->route('product.register', encrypt($product->hsn_id))->with("success", "Record updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, string $hsn)
    {
        $product = Product::findOrFail(decrypt($id));
        $product->delete();
        return redirect()->route('product.register', encrypt($product->hsn_id))->with("success", "Record deleted successfully");
    }

    public function restore(string $id, string $hsn)
    {
        $product = Product::withTrashed()->where('id', decrypt($id))->first();
        $product->restore();
        return redirect()->route('product.register', encrypt($product->hsn_id))->with("success", "Record restored successfully");
    }
}
