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
                            <h5>Roles & Permissions Register</h5>
                        </div>
                        <div class="col text-end">
                            <a href="{{ route('role.create') }}" class="btn btn-icon btn-primary">
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
                                <th>Role Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($roles as $key => $role)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $role->name }}</td>
                                <td class="text-center">
                                    <a href="{{ route('role.edit', encrypt($role->id)) }}" class="text-warning">Edit</a>&nbsp;&nbsp;|&nbsp;&nbsp;
                                    <a href="{{ route('role.delete', encrypt($role->id)) }}" class="text-danger dlt">Delete</a>
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