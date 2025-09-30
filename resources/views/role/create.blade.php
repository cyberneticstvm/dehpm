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
                            <h5>Create Role & Permissions</h5>
                        </div>
                        <div class="col text-end">
                            <a href="#" class="btn btn-icon btn-primary">
                                <span class="tf-icons bx bx-plus"></span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    {{ html()->form('POST', route('role.save'))->open() }}
                    <div class="row">
                        <div class="col-sm-6">
                            <label class="form-label req" for="basicFullname">Role Name</label>
                            <div class="input-group input-group-merge">
                                <span id="basicFullname2" class="input-group-text"><i class="bx bx-user-minus"></i></span>
                                {{ html()->text('name', old('name'))->class('form-control')->placeholder('Role Name')->required() }}
                            </div>
                            @error('name')
                            <small class="text-danger">{{ $errors->first('name') }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-sm-12"><label class="form-label req" for="basicFullname">Permissions</label></div>
                        @foreach($permissions as $permission)
                        <div class="col-sm-2">
                            <label class="form-check-label" for="">{{ $permission->name }}</label><br />
                            {{ html()->checkbox($name = 'permission[]', $checked=false, $value = $permission->id)->class('form-check-input') }}
                        </div>
                        @endforeach
                        @error('permission')
                        <small class="text-danger">{{ $errors->first('permission') }}</small>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col text-end">
                            {{ html()->submit('Save')->class('btn btn-submit btn-primary data-submit me-sm-3 me-1') }}
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