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
                            <h5>Hsn Register</h5>
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
                                <th>Name</th>
                                <th>Short Name</th>
                                <th>Code</th>
                                <th>Tax %</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($hsns as $key => $hsn)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $hsn->name }}</td>
                                <td>{{ $hsn->short_name }}</td>
                                <td>{{ $hsn->code }}</td>
                                <td>{{ $hsn->tax_percentage }}%</td>
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