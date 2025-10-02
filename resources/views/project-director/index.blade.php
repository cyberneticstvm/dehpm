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
                            <h5>Projects - Directors Register</h5>
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
                        </div>
                    </div>
                </div>
                <div class="card-datatable table-responsive px-5">
                    <table class="datatables-basic table table-bordered">
                        <thead>
                            <tr>
                                <th>SL No</th>
                                <th>Project Name</th>
                                <th>Director Name</th>
                                <th>Contribution</th>
                                <th>Profit %</th>
                                <th>Type</th>
                                <th>Joined Date</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($prodirs as $key => $prodir)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $prodir->project->name }}</td>
                                <td>{{ $prodir->director->name }}</td>
                                <td>{{ $prodir->contribution }}</td>
                                <td>{{ $prodir->profit_percentage }}</td>
                                <td>{{ $prodir->ctype->name }}</td>
                                <td>{{ $prodir->date_of_join->format('d.M.Y') }}</td>
                                <td class="text-center">{!! $prodir->deleteStatus() !!}</td>
                                <td class="text-center">
                                    <a href="{{ route('project.director.edit', encrypt($prodir->id)) }}" class="text-warning">Edit</a>&nbsp;&nbsp;|&nbsp;&nbsp;
                                    @if($prodir->deleted_at)
                                    <a href="{{ route('project.director.restore', encrypt($prodir->id)) }}" class="text-success proceed">Restore</a>
                                    @else
                                    <a href="{{ route('project.director.delete', encrypt($prodir->id)) }}" class="text-danger dlt">Delete</a>
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
@endsection