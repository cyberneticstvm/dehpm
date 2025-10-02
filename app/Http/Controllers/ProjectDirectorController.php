<?php

namespace App\Http\Controllers;

use App\Models\Director;
use App\Models\Extra;
use App\Models\ProjectDirector;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ProjectDirectorController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('project-director-list'), only: ['index']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('project-director-create'), only: ['create', 'store']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('project-director-edit'), only: ['edit', 'update']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('project-director-delete'), only: ['destroy']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('project-director-restore'), only: ['restore']),
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
        $prodirs = ProjectDirector::withTrashed()->orderByDesc('id')->get();
        return view('project-director.index', compact('prodirs'));
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
        $request->validate([
            'project_id' => 'required',
            'director_id' => 'required',
            'contribution' => 'required|numeric|gt:0',
            'profit_percentage' => 'required|numeric|gt:0',
            'date_of_join' => 'required|date',
            'type' => 'required',
            'number_of_installments' => 'required_if:type,Installment',
            'installment_start_date' => 'required_if:type,Installment',
        ]);
        try {
            $input = $request->all();
            $type = Extra::where('name', $request->type)->firstOrFail();
            $input['created_by'] = $request->user()->id;
            $input['updated_by'] = $request->user()->id;
            $input['type'] = $type->id;
            if ($request->type == 'Installment'):
                $input['installment_amount'] = $request->contribution / $request->number_of_installments;
                $input['installment_end_date'] = Carbon::parse($request->installment_start_date)->addMonths((int)$request->number_of_installments);
            else:
                $input['installment_amount'] = NULL;
                $input['installment_end_date'] = NULL;
            endif;
            ProjectDirector::create($input);
        } catch (Exception $e) {
            return redirect()->back()->with("error", $e->getMessage())->withInput($request->all());
        }
        return redirect()->route('project.director.register')->with("success", "Director created for the Project successfully");
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
        $prodir = ProjectDirector::findOrFail(decrypt($id));
        $types = $this->types;
        $directors = $this->directors;
        return view('project-director.edit', compact('prodir', 'types', 'directors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'director_id' => 'required',
            'contribution' => 'required|numeric|gt:0',
            'profit_percentage' => 'required|numeric|gt:0',
            'date_of_join' => 'required|date',
            'type' => 'required',
            'number_of_installments' => 'required_if:type,Installment',
            'installment_start_date' => 'required_if:type,Installment',
        ]);
        //try {
        $input = $request->all();
        $type = Extra::where('name', $request->type)->firstOrFail();
        $input['updated_by'] = $request->user()->id;
        $input['type'] = $type->id;
        if ($request->type == 'Installment'):
            $input['installment_amount'] = $request->contribution / $request->number_of_installments;
            $input['installment_end_date'] = Carbon::parse($request->installment_start_date)->addMonths((int)$request->number_of_installments);
        else:
            $input['installment_amount'] = NULL;
            $input['installment_end_date'] = NULL;
        endif;
        ProjectDirector::findOrFail(decrypt($id))->update($input);
        //} catch (Exception $e) {
        //return redirect()->back()->with("error", $e->getMessage())->withInput($request->all());
        //}
        return redirect()->route('project.director.register')->with("success", "Director updated for the Project successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        ProjectDirector::findOrFail(decrypt($id))->delete();
        return redirect()->route('project.director.register')->with("success", "Director removed from the project successfully");
    }

    public function restore(string $id)
    {
        ProjectDirector::withTrashed()->where('id', decrypt($id))->restore();
        return redirect()->route('project.director.register')->with("success", "Director restored to the project successfully");
    }
}
