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
                            <h5>Update User</h5>
                        </div>
                        <div class="col text-end">
                            <a href="#" class="btn btn-icon btn-primary">
                                <span class="tf-icons bx bx-plus"></span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    {{ html()->form('POST', route('user.update', encrypt($user->id)))->open() }}
                    <div class="row g-3">
                        <div class="col-sm-3">
                            <label class="form-label req" for="basicFullname">Full Name</label>
                            <div class="input-group input-group-merge">
                                <span id="basicFullname2" class="input-group-text"><i class="bx bx-user"></i></span>
                                {{ html()->text('name', $user->name)->class('form-control')->placeholder('Full Name')->required() }}
                            </div>
                            @error('name')
                            <small class="text-danger">{{ $errors->first('name') }}</small>
                            @enderror
                        </div>
                        <div class="col-sm-3">
                            <label class="form-label" for="basicFullname">Mobile Number</label>
                            <div class="input-group input-group-merge">
                                <span id="basicFullname2" class="input-group-text"><i class="bx bx-mobile"></i></span>
                                {{ html()->text('mobile', $user->mobile)->class('form-control')->maxlength(10)->placeholder('Mobile')->required() }}
                            </div>
                            @error('mobile')
                            <small class="text-danger">{{ $errors->first('mobile') }}</small>
                            @enderror
                        </div>
                        <div class="col-sm-3">
                            <label class="form-label req" for="basicFullname">Email</label>
                            <div class="input-group input-group-merge">
                                <span id="basicFullname2" class="input-group-text"><i class="bx bx-envelope"></i></span>
                                {{ html()->email('email', $user->email)->class('form-control')->placeholder('Email')->required() }}
                            </div>
                            @error('email')
                            <small class="text-danger">{{ $errors->first('email') }}</small>
                            @enderror
                        </div>
                        <div class="col-sm-3">
                            <label for="selectpickerBasic" class="form-label req">Role</label>
                            {{ html()->select($name = 'roles', $value = $roles, $userRole)->class('select2 form-select')->placeholder('Select')->required() }}
                            @error('roles')
                            <small class="text-danger">{{ $errors->first('roles') }}</small>
                            @enderror
                        </div>
                        <div class="col-sm-3">
                            <label for="selectpickerBasic" class="form-label">Password</label>
                            {{ html()->password('password', NULL)->class('form-control')->placeholder('******') }}
                            @error('password')
                            <small class="text-danger">{{ $errors->first('password') }}</small>
                            @enderror
                        </div>
                        <div class="col-sm-6">
                            <label for="selectpickerBasic" class="form-label req">Branches <small>(Multiple selection enabled)</small></label>
                            {{ html()->select($name = 'branches[]', $value = $branches, $user->branches->pluck('branch_id'))->class('select2 form-select')->multiple()->required() }}
                            @error('branches')
                            <small class="text-danger">{{ $errors->first('branches') }}</small>
                            @enderror
                        </div>
                        <div class="col-sm-3">
                            <label for="selectpickerBasic" class="form-label req">Allowed Devices <small>(Multiple selection enabled)</small></label>
                            {{ html()->select($name = 'devices[]', $value = $devices, $user->devices->pluck('device_id'))->class('select2 form-select')->multiple()->required() }}
                            @error('devices')
                            <small class="text-danger">{{ $errors->first('devices') }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col text-end">
                            {{ html()->submit('Update')->class('btn btn-submit btn-primary data-submit me-sm-3 me-1') }}
                            {{ html()->reset('Cancel')->class('btn btn-outline-secondary')->attribute('onClick', 'window.history.back()') }}
                        </div>
                    </div>
                    {{ html()->form()->close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection