<?php

namespace App\Http\Controllers;

use App\Models\Extra;
use App\Models\Head;
use App\Models\IncomeExpense;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Session;

class IncomeExpenseController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('income-expense-list'), only: ['index']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('income-expense-create'), only: ['create', 'store']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('income-expense-edit'), only: ['edit', 'update']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('income-expense-delete'), only: ['destroy']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('income-expense-restore'), only: ['restore']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    private $type, $heads;
    public function __construct(Request $request)
    {
        $this->type = Extra::where('name', $request->type)->first();
        $this->heads = Head::where('type', $this->type->id)->pluck('name', 'id');
    }

    public function index($type)
    {
        $type = $this->type;
        $tname = $type->name;
        $ies = IncomeExpense::withTrashed()->whereIn('head_id', Head::where('type', $type->id)->pluck('id'))->where('branch_id', Session::get('branch')->id)->whereDate('ie_date', Carbon::today())->get();
        return view('ie.index', compact('ies', 'tname'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($type)
    {
        $heads = $this->heads;
        $type = $this->type;
        return view('ie.create', compact('heads', 'type'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $type)
    {
        $request->validate([
            'ie_date' => 'required|date',
            'head_id' => 'required',
            'amount' => 'required|numeric|gt:0'
        ]);
        try {
            $input = $request->all();
            $input['created_by'] = $request->user()->id;
            $input['updated_by'] = $request->user()->id;
            $input['branch_id'] = Session::get('branch')->id;
            IncomeExpense::create($input);
        } catch (Exception $e) {
            return redirect()->back()->with("error", $e->getMessage())->withInput($request->all());
        }
        return redirect()->route('ie.register', $type)->with("success", "Record created successfully");
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
        $ie = IncomeExpense::findOrFail(decrypt($id));
        $heads = $this->heads;
        $type = $this->type;
        return view('ie.edit', compact('heads', 'ie', 'type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id, string $type)
    {
        $request->validate([
            'ie_date' => 'required|date',
            'head_id' => 'required',
            'amount' => 'required|numeric|gt:0'
        ]);
        try {
            $input = $request->all();
            $input['updated_by'] = $request->user()->id;
            IncomeExpense::findOrFail(decrypt($id))->update($input);
        } catch (Exception $e) {
            return redirect()->back()->with("error", $e->getMessage())->withInput($request->all());
        }
        return redirect()->route('ie.register', $type)->with("success", "Record updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, string $type)
    {
        IncomeExpense::findOrFail(decrypt($id))->delete();
        return redirect()->route('ie.register', $type)->with("success", "Record deleted successfully");
    }

    public function restore(string $id, string $type)
    {
        IncomeExpense::withTrashed()->where('id', decrypt($id))->restore();
        return redirect()->route('ie.register', $type)->with("success", "Record restored successfully");
    }
}
