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
                            <h5>Create Head (Income & Expense)</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    {{ html()->form('POST', route('head.save'))->open() }}
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label class="form-label req" for="basicFullname">Head Name</label>
                            <div class="input-group input-group-merge">
                                <span id="basicFullname2" class="input-group-text"><i class="bx bx-building-house"></i></span>
                                {{ html()->text('name', old('name'))->class('form-control')->placeholder('Head Name')->required() }}
                            </div>
                            @error('name')
                            <small class="text-danger">{{ $errors->first('name') }}</small>
                            @enderror
                        </div>
                        <div class="col-sm-3">
                            <label for="selectpickerBasic" class="form-label req">Type</label>
                            {{ html()->select($name = 'type', $value = $types, old('type'))->class('select2 form-select')->placeholder('Select')->required() }}
                            @error('roles')
                            <small class="text-danger">{{ $errors->first('roles') }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-3">
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