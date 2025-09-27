<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $branches = Branch::withTrashed()->orderByDesc('updated_at')->get();
        return view('branch.index', compact('branches'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $credentials = $request->validate([
            'name' => 'required|unique:branches,name',
            'code' => 'required|unique:branches,code',
            'mobile' => 'required|numeric|digits:10',
            'address' => 'required',
        ]);
        try {
            $inputs = $request->all();
            $inputs['created_by'] = Auth::user()->id;
            $inputs['updated_by'] = Auth::user()->id;
            Branch::create($inputs);
        } catch (Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
        return redirect()->route('branch.register')->with("success", "Branch created successfully!");
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $branch = Branch::where('code', $request->code)->firstOrFail();
        $credentials = $request->validate([
            'name' => 'required|unique:branches,name,' . $branch->id,
            'code' => 'required|unique:branches,code,' . $branch->id,
            'mobile' => 'required|numeric|digits:10',
            'address' => 'required',
        ]);
        try {
            $inputs = $request->all();
            $inputs['updated_by'] = Auth::user()->id;
            $branch->update($inputs);
        } catch (Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
        return redirect()->route('branch.register')->with("success", "Branch updated successfully!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Branch::findOrFail(decrypt($id))->delete();
        return redirect()->route('branch.register')->with("success", "Branch deleted successfully!");
    }

    public function restore(string $id)
    {
        Branch::withTrashed()->where('id', decrypt($id))->restore();
        return redirect()->route('branch.register')->with("success", "Branch restored successfully!");
    }
}
