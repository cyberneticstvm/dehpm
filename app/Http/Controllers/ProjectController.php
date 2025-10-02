<?php

namespace App\Http\Controllers;

use App\Models\Director;
use App\Models\Extra;
use App\Models\Project;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ProjectController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            new middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('project-list'), only: ['index']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('project-create'), only: ['create', 'store']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('project-edit'), only: ['edit', 'update']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('project-delete'), only: ['destroy']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('project-restore'), only: ['restore']),
        ];
    }
    /**
     * Display a listing of the resource.
     */

    protected $types, $directors;
    public function __construct()
    {
        $this->types = Extra::where('category', 'contribution')->get();
        $this->directors = Director::pluck('name', 'id');
    }

    public function index()
    {
        $projects = Project::withTrashed()->orderByDesc('id')->get();
        $types = $this->types;
        $directors = $this->directors;
        return view('project.index', compact('projects', 'types', 'directors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('project.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:projects,name',
            'code' => 'required|unique:projects,code',
            'cost' => 'required|numeric|gt:0',
            'address' => 'required',
        ]);
        try {
            $input = $request->all();
            $input['created_by'] = $request->user()->id;
            $input['updated_by'] = $request->user()->id;
            Project::create($input);
        } catch (Exception $e) {
            return redirect()->back()->with("error", $e->getMessage())->withInput($request->all());
        }
        return redirect()->route('project.register')->with("success", "Project created successfully");
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
        $project = Project::findOrFail(decrypt($id));
        return view('project.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|unique:projects,name,' . decrypt($id),
            'code' => 'required|unique:projects,code,' . decrypt($id),
            'cost' => 'required|numeric|gt:0',
            'address' => 'required',
        ]);
        try {
            $input = $request->all();
            $input['updated_by'] = $request->user()->id;
            Project::findOrFail(decrypt($id))->update($input);
        } catch (Exception $e) {
            return redirect()->back()->with("error", $e->getMessage())->withInput($request->all());
        }
        return redirect()->route('project.register')->with("success", "Project updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Project::findOrFail(decrypt($id))->delete();
        return redirect()->route('project.register')->with("success", "Project deleted successfully");
    }

    public function restore(string $id)
    {
        Project::withTrashed()->where('id', decrypt($id))->restore();
        return redirect()->route('project.register')->with("success", "Project restored successfully");
    }
}
