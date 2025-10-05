<?php

namespace App\Http\Controllers;

use App\Models\ManufactureSupplier;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ManSupController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('manufacturer-supplier-list'), only: ['index']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('manufacturer-supplier-create'), only: ['create', 'store']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('manufacturer-supplier-edit'), only: ['edit', 'update']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('manufacturer-supplier-delete'), only: ['destroy']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('manufacturer-supplier-restore'), only: ['restore']),
        ];
    }

    private $types;
    public function __construct()
    {
        $this->types = ['Manufacturer', 'Supplier'];
    }
    /**
     * Display a listing of the resource.
     */
    public function index($type)
    {
        $mansups = ManufactureSupplier::withTrashed()->where('type', $type)->orderBy('name')->get();
        return view('ms.index', compact('mansups', 'type'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($type)
    {
        return view('ms.create', compact('type'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $type)
    {
        $request->validate([
            'name' => 'required',
        ]);
        try {
            $input = $request->all();
            $input['created_by'] = $request->user()->id;
            $input['updated_by'] = $request->user()->id;
            $input['type'] = $type;
            ManufactureSupplier::create($input);
        } catch (Exception $e) {
            return redirect()->back()->with("error", $e->getMessage())->withInput($request->all());
        }
        return redirect()->route('ms.register', $type)->with("success", "Record created successfully");
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
        $ms = ManufactureSupplier::findOrFail(decrypt($id));
        return view('ms.edit', compact('ms'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id, string $type)
    {
        $request->validate([
            'name' => 'required',
        ]);
        try {
            $input = $request->all();
            $input['updated_by'] = $request->user()->id;
            ManufactureSupplier::findOrFail(decrypt($id))->update($input);
        } catch (Exception $e) {
            return redirect()->back()->with("error", $e->getMessage())->withInput($request->all());
        }
        return redirect()->route('ms.register', $type)->with("success", "Record updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, string $type)
    {
        ManufactureSupplier::findOrFail(decrypt($id))->delete();
        return redirect()->route('ms.register', $type)->with("success", "Record deleted successfully");
    }

    public function restore(string $id, string $type)
    {
        ManufactureSupplier::withTrashed()->where('id', decrypt($id))->restore();
        return redirect()->route('ms.register', $type)->with("success", "Record restored successfully");
    }
}
