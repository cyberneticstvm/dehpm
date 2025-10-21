<?php

namespace App\Http\Controllers;

use App\Models\Hsn;
use App\Models\ManufactureSupplier;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseDetail;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PurchaseController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            new middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('purchase-list'), only: ['index']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('purchase-create'), only: ['create', 'store']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('purchase-edit'), only: ['edit', 'update']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('purchase-delete'), only: ['destroy']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('purchase-restore'), only: ['restore']),
        ];
    }

    private $hsns, $suppliers;
    public function __construct()
    {
        $this->hsns = Hsn::orderBy('name')->pluck('name', 'id');
        $this->suppliers = ManufactureSupplier::where('type', 'Supplier')->orderBy('name')->pluck('name', 'id');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $purchases = Purchase::withTrashed()->orderByDesc('id')->get();
        return view('purchase.index', compact('purchases'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $hsns = $this->hsns;
        $suppliers = $this->suppliers;
        return view('purchase.create', compact('hsns', 'suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pdate' => 'required|date',
            'supplier_id' => 'required',
            'supplier_invoice' => 'required',
        ]);
        try {
            $inputs = $request->except(array('hsns', 'products', 'qty', 'expiry_date', 'batch_number', 'purchase_price', 'selling_price', 'total'));
            DB::transaction(function () use ($inputs, $request) {
                $inputs['branch_id'] = Session::get('branch')->id;
                $inputs['created_by'] = $request->user()->id;
                $inputs['updated_by'] = $request->user()->id;
                $purchase = Purchase::create($inputs);
                $details = [];
                foreach ($request->products as $key => $item):
                    $details[] = [
                        'purchase_id' => $purchase->id,
                        'hsn_id' => $request->hsns[$key],
                        'product_id' => $item,
                        'qty' => $request->qty[$key],
                        'expiry_date' => $request->expiry_date[$key] ?? NULL,
                        'batch_number' => $request->batch_number[$key] ?? NULL,
                        'purchase_price_qty' => $request->purchase_price[$key],
                        'selling_price_qty' => $request->selling_price[$key],
                        'total' => $request->qty[$key] * $request->purchase_price[$key],
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ];
                endforeach;
                PurchaseDetail::insert($details);
            });
        } catch (Exception $e) {
            return redirect()->back()->with("error", $e->getMessage())->withInput($request->all());
        }
        return redirect()->route('purchase.register')->with("success", "Purchase created successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $hsns = $this->hsns;
        $suppliers = $this->suppliers;
        $purchase = Purchase::findOrFail(decrypt($id));
        $products = Product::all();
        return view('purchase.edit', compact('hsns', 'suppliers', 'purchase', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'pdate' => 'required|date',
            'supplier_id' => 'required',
            'supplier_invoice' => 'required',
        ]);
        try {
            $inputs = $request->except(array('hsns', 'products', 'qty', 'expiry_date', 'batch_number', 'purchase_price', 'selling_price', 'total'));
            DB::transaction(function () use ($id, $inputs, $request) {
                $inputs['updated_by'] = $request->user()->id;
                $purchase = Purchase::findOrFail(decrypt($id));
                $purchase->update($inputs);
                $details = [];
                foreach ($request->products as $key => $item):
                    $details[] = [
                        'purchase_id' => $purchase->id,
                        'hsn_id' => $request->hsns[$key],
                        'product_id' => $item,
                        'qty' => $request->qty[$key],
                        'expiry_date' => $request->expiry_date[$key] ?? NULL,
                        'batch_number' => $request->batch_number[$key] ?? NULL,
                        'purchase_price_qty' => $request->purchase_price[$key],
                        'selling_price_qty' => $request->selling_price[$key],
                        'total' => $request->qty[$key] * $request->purchase_price[$key],
                        'created_at' => $purchase->created_at,
                        'updated_at' => Carbon::now(),
                    ];
                endforeach;
                PurchaseDetail::where('purchase_id', $purchase->id)->forceDelete();
                PurchaseDetail::insert($details);
            });
        } catch (Exception $e) {
            return redirect()->back()->with("error", $e->getMessage())->withInput($request->all());
        }
        return redirect()->route('purchase.register')->with("success", "Purchase updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $purchase = Purchase::findOrFail(decrypt($id));
        $purchase->delete();
        PurchaseDetail::where('purchase_id', $purchase->id)->delete();
        return redirect()->route('purchase.register')->with("success", "Purchase deleted successfully");
    }

    public function restore(string $id)
    {
        $purchase = Purchase::withTrashed()->where('id', decrypt($id))->first();
        $purchase->restore();
        PurchaseDetail::withTrashed()->where('purchase_id', $purchase->id)->restore();
        return redirect()->route('purchase.register')->with("success", "Purchase restored successfully");
    }
}
