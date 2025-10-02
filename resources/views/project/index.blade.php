@extends("base")
@section("content")
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <!-- Website Analytics-->
        <div class="col-lg-12 col-md-12 mb-4">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h5>Project Register</h5>
                        </div>
                        <div class="col text-end">
                            <div class="btn-group">
                                <button
                                    type="button"
                                    class="btn btn-secondary dropdown-toggle"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    Export
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="javascript:void(0);"><i class="fa fa-file-excel text-success"></i>&nbsp;&nbsp;Excel</a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0);"><i class="fa fa-file-pdf text-danger"></i>&nbsp;&nbsp;Pdf</a></li>
                                </ul>
                            </div>
                            <a href="{{ route('project.create') }}" class="btn btn-icon btn-primary">
                                <span class="tf-icons bx bx-plus"></span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-datatable table-responsive px-5">
                    <table class="datatables-basic table table-bordered">
                        <thead>
                            <tr>
                                <th>SL No</th>
                                <th>Name</th>
                                <th>Code</th>
                                <th>Cost</th>
                                <th>Address</th>
                                <th>Add</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($projects as $key => $project)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $project->name }}</td>
                                <td>{{ $project->code }}</td>
                                <td>{{ $project->cost }}</td>
                                <td>{{ $project->address }}</td>
                                <td class="text-center"><a href="javascript:void(0)" class="modalDrawer addNewDirector" data-identifier="add-new-director" data-pid="{{ $project->id }}" data-pname="{{ $project->name }}"><i class="fa fa-user"></i></a></td>
                                <td class="text-center">{!! $project->deleteStatus() !!}</td>
                                <td class="text-center">
                                    <a href="{{ route('project.edit', encrypt($project->id)) }}" class="text-warning">Edit</a>&nbsp;&nbsp;|&nbsp;&nbsp;
                                    @if($project->deleted_at)
                                    <a href="{{ route('project.restore', encrypt($project->id)) }}" class="text-success proceed">Restore</a>
                                    @else
                                    <a href="{{ route('project.delete', encrypt($project->id)) }}" class="text-danger dlt">Delete</a>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@include("drawer.director.create")
@endsection