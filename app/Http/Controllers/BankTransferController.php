<?php

namespace App\Http\Controllers;

use App\Models\BankTransfer;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Session;

class BankTransferController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            new middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('bank-transfer-list'), only: ['index']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('bank-transfer-create'), only: ['create', 'store']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('bank-transfer-edit'), only: ['edit', 'update']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('bank-transfer-delete'), only: ['destroy']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('bank-transfer-restore'), only: ['restore']),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $btransfers = BankTransfer::withTrashed()->where('branch_id', Session::get('branch')->id)->whereDate('transfer_date', Carbon::today())->orderByDesc('id')->get();
        return view('bank-transfer.index', compact('btransfers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('bank-transfer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'transfer_date' => 'required|date',
            'amount' => 'required|numeric|gt:0'
        ]);
        try {
            $input = $request->all();
            $input['created_by'] = $request->user()->id;
            $input['updated_by'] = $request->user()->id;
            $input['branch_id'] = Session::get('branch')->id;
            BankTransfer::create($input);
        } catch (Exception $e) {
            return redirect()->back()->with("error", $e->getMessage())->withInput($request->all());
        }
        return redirect()->route('btransfer.register')->with("success", "Bank transfer created successfully");
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
        $btransfer = BankTransfer::findOrFail(decrypt($id));
        return view('bank-transfer.edit', compact('btransfer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'transfer_date' => 'required|date',
            'amount' => 'required|numeric|gt:0'
        ]);
        try {
            $input = $request->all();
            $input['updated_by'] = $request->user()->id;
            BankTransfer::findOrFail(decrypt($id))->update($input);
        } catch (Exception $e) {
            return redirect()->back()->with("error", $e->getMessage())->withInput($request->all());
        }
        return redirect()->route('btransfer.register')->with("success", "Bank transfer updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        BankTransfer::findOrFail(decrypt($id))->delete();
        return redirect()->route('btransfer.register')->with("success", "Bank transfer deleted successfully");
    }

    public function restore(string $id)
    {
        BankTransfer::withTrashed()->where('id', decrypt($id))->restore();
        return redirect()->route('btransfer.register')->with("success", "Bank transfer restored successfully");
    }
}
