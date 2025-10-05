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
                            <h5>Update {{ $ms->type }}</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    {{ html()->form('POST', route('ms.update', ['id' => encrypt($ms->id), 'type' => $ms->type]))->open() }}
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label class="form-label req" for="basicFullname">Name</label>
                            <div class="input-group input-group-merge">
                                <span id="basicFullname2" class="input-group-text"><i class="bx bx-name"></i></span>
                                {{ html()->text('name', $ms->name)->class('form-control')->placeholder('Name')->required() }}
                            </div>
                            @error('email')
                            <small class="text-danger">{{ $errors->first('email') }}</small>
                            @enderror
                        </div>
                        <div class="col-sm-3">
                            <label class="form-label" for="basicFullname">Mobile Number</label>
                            <div class="input-group input-group-merge">
                                <span id="basicFullname2" class="input-group-text"><i class="bx bx-mobile"></i></span>
                                {{ html()->text('mobile', $ms->mobile)->class('form-control')->maxlength(10)->placeholder('Mobile')->required() }}
                            </div>
                            @error('mobile')
                            <small class="text-danger">{{ $errors->first('mobile') }}</small>
                            @enderror
                        </div>
                        <div class="col-sm-3">
                            <label class="form-label" for="basicFullname">Email</label>
                            <div class="input-group input-group-merge">
                                <span id="basicFullname2" class="input-group-text"><i class="bx bx-envelope"></i></span>
                                {{ html()->email('email', $ms->email)->class('form-control')->placeholder('Email')->required() }}
                            </div>
                            @error('email')
                            <small class="text-danger">{{ $errors->first('email') }}</small>
                            @enderror
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label" for="basicFullname">Address</label>
                            <div class="input-group input-group-merge">
                                <span id="basicFullname2" class="input-group-text"><i class="bx bx-file"></i></span>
                                {{ html()->textarea('address', $ms->address)->class('form-control')->placeholder('Address') }}
                            </div>
                            @error('address')
                            <small class="text-danger">{{ $errors->first('address') }}</small>
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