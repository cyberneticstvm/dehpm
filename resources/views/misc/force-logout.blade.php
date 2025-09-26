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
                            <h5>Current User Force Logout from All Devices except Current Device</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    {{ html()->form('POST')->route('user.force.logout')->class('mb-3')->open() }}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="email" class="form-label">Password</label>
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-lock"></i></span>
                                    {{ html()->password('password', null)->class('form-control')->placeholder('******')->autofocus() }}
                                </div>
                                @error('password')
                                <small class="text-danger">{{ $errors->first('password') }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 text-end">
                            {{ html()->submit('Logout from all devices')->class('btn btn-submit btn-primary text-end') }}
                        </div>
                    </div>
                    {{ HTML()->form()->close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@include("drawer.add-user")
@endsection