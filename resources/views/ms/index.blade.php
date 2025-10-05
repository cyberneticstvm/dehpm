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
                            <h5>{{ $type }} Register</h5>
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
                            <a href="{{ route('ms.create', $type) }}" class="btn btn-icon btn-primary">
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
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Address</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($mansups as $key => $ms)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $ms->name }}</td>
                                <td>{{ $ms->email }}</td>
                                <td>{{ $ms->mobile }}</td>
                                <td>{{ $ms->address }}</td>
                                <td class="text-center">{!! $ms->deleteStatus() !!}</td>
                                <td class="text-center">
                                    <a href="{{ route('ms.edit', ['id' => encrypt($ms->id), 'type' => $type]) }}" class="text-warning">Edit</a>&nbsp;&nbsp;|&nbsp;&nbsp;
                                    @if($ms->deleted_at)
                                    <a href="{{ route('ms.restore', ['id' => encrypt($ms->id), 'type' => $type]) }}" class="text-success proceed">Restore</a>
                                    @else
                                    <a href="{{ route('ms.delete', ['id' => encrypt($ms->id), 'type' => $type]) }}" class="text-danger dlt">Delete</a>
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