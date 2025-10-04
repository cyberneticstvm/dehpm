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
                            <h5>Bank Transfer Register</h5>
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
                            <a href="{{ route('btransfer.create') }}" class="btn btn-icon btn-primary">
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
                                <th>Transfer Date</th>
                                <th>Description</th>
                                <th>Amount</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($btransfers as $key => $btransfer)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $btransfer->transfer_date->format('d.M.Y') }}</td>
                                <td>{{ $btransfer->remarks }}</td>
                                <td class="text-end">{{ $btransfer->amount }}</td>
                                <td class="text-center">{!! $btransfer->deleteStatus() !!}</td>
                                <td class="text-center">
                                    <a href="{{ route('btransfer.edit', encrypt($btransfer->id)) }}" class="text-warning">Edit</a>&nbsp;&nbsp;|&nbsp;&nbsp;
                                    @if($btransfer->deleted_at)
                                    <a href="{{ route('btransfer.restore', encrypt($btransfer->id)) }}" class="text-success proceed">Restore</a>
                                    @else
                                    <a href="{{ route('btransfer.delete', encrypt($btransfer->id)) }}" class="text-danger dlt">Delete</a>
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