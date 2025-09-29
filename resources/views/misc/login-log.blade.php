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
                            <h5>Login Log</h5>
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
                            <button type="button" class="btn btn-icon btn-primary modalDrawer" data-identifier="add-new-branch">
                                <span class="tf-icons bx bx-plus"></span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-datatable table-responsive px-5">
                    <table class="datatables-basic table table-bordered">
                        <thead>
                            <tr>
                                <th>SL No</th>
                                <th>User</th>
                                <th>Device</th>
                                <th>IP</th>
                                <th>Country</th>
                                <th>Region</th>
                                <th>City</th>
                                <th>Zip Code</th>
                                <th>Logged In</th>
                                <th>Logged Out</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($logs as $key => $log)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $log->user->name }}</td>
                                <td>{{ $log->user_agent }}</td>
                                <td>{{ $log->ip_address }}</td>
                                <td>{{ $log->country }}</td>
                                <td>{{ $log->region }}</td>
                                <td>{{ $log->city }}</td>
                                <td>{{ $log->zip }}</td>
                                <td>{{ $log->login_at->format('d.M.Y h:i A') }}</td>
                                <td>{{ $log->logout_at?->format('d.M.Y h:i A') }}</td>
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
@include("drawer.branch.create")
@include("drawer.branch.edit")
@endsection