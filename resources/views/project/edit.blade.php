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
                            <h5>Update Project</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    {{ html()->form('POST', route('project.update', encrypt($project->id)))->open() }}
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label class="form-label req" for="basicFullname">Project Name</label>
                            <div class="input-group input-group-merge">
                                <span id="basicFullname2" class="input-group-text"><i class="bx bx-building-house"></i></span>
                                {{ html()->text('name', $project->name)->class('form-control')->placeholder('Project Name')->required() }}
                            </div>
                            @error('name')
                            <small class="text-danger">{{ $errors->first('name') }}</small>
                            @enderror
                        </div>
                        <div class="col-sm-3">
                            <label class="form-label req" for="basicFullname">Project Code</label>
                            <div class="input-group input-group-merge">
                                <span id="basicFullname2" class="input-group-text"><i class="bx bx-code"></i></span>
                                {{ html()->text('code', $project->code)->maxlength(25)->class('form-control')->placeholder('Project Code')->attribute('readonly', true) }}
                            </div>
                            @error('code')
                            <small class="text-danger">{{ $errors->first('code') }}</small>
                            @enderror
                        </div>
                        <div class="col-sm-3">
                            <label class="form-label req" for="basicFullname">Project Cost</label>
                            <div class="input-group input-group-merge">
                                <span id="basicFullname2" class="input-group-text"><i class="bx bx-rupee"></i></span>
                                {{ html()->text('cost', $project->cost)->maxlength(10)->class('form-control')->placeholder('0.00')->required() }}
                            </div>
                            @error('cost')
                            <small class="text-danger">{{ $errors->first('cost') }}</small>
                            @enderror
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label req" for="basicFullname">Address</label>
                            <div class="input-group input-group-merge">
                                <span id="basicFullname2" class="input-group-text"><i class="bx bx-pin"></i></span>
                                {{ html()->textarea('address', $project->address)->class('form-control')->placeholder('Address')->required() }}
                            </div>
                            @error('address')
                            <small class="text-danger">{{ $errors->first('address') }}</small>
                            @enderror
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label" for="basicFullname">Project Details</label>
                            <div class="input-group input-group-merge">
                                <span id="basicFullname2" class="input-group-text"><i class="bx bx-file"></i></span>
                                {{ html()->textarea('details', $project->details)->class('form-control')->placeholder('Project Details') }}
                            </div>
                            @error('details')
                            <small class="text-danger">{{ $errors->first('details') }}</small>
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