<div class="offcanvas offcanvas-end" id="add-new-branch">
    <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title" id="exampleModalLabel">Add New Branch</h5>
        <button
            type="button"
            class="btn-close text-reset"
            data-bs-dismiss="offcanvas"
            aria-label="Close"></button>
    </div>
    <div class="offcanvas-body flex-grow-1">
        {{ html()->form('POST')->route('branch.save')->attribute('id', 'form-add-new-record')->class('add-new-record pt-0 row g-2')->open() }}
        <div class="col-sm-12">
            <label class="form-label req" for="basicFullname">Branch Name</label>
            <div class="input-group input-group-merge">
                <span id="basicFullname2" class="input-group-text"><i class="bx bx-git-branch"></i></span>
                {{ html()->text('name', old('name'))->class('form-control')->placeholder('Branch Name')->required() }}
            </div>
            @error('name')
            <small class="text-danger">{{ $errors->first('name') }}</small>
            @enderror
        </div>
        <div class="col-sm-6">
            <label class="form-label req" for="basicFullname">Branch Code</label>
            <div class="input-group input-group-merge">
                <span id="basicFullname2" class="input-group-text"><i class="bx bx-code"></i></span>
                {{ html()->text('code', old('code'))->class('form-control')->maxlength(10)->placeholder('Branch Code')->required() }}
            </div>
            @error('code')
            <small class="text-danger">{{ $errors->first('code') }}</small>
            @enderror
        </div>
        <div class="col-sm-6">
            <label class="form-label req" for="basicFullname">Mobile</label>
            <div class="input-group input-group-merge">
                <span id="basicFullname2" class="input-group-text"><i class="bx bx-mobile-alt"></i></span>
                {{ html()->text('mobile', old('mobile'))->class('form-control')->maxlength(10)->placeholder('0123456789')->required() }}
            </div>
            @error('mobile')
            <small class="text-danger">{{ $errors->first('mobile') }}</small>
            @enderror
        </div>
        <div class="col-sm-12">
            <label class="form-label" for="basicFullname">Contact Number</label>
            <div class="input-group input-group-merge">
                <span id="basicFullname2" class="input-group-text"><i class="bx bx-phone"></i></span>
                {{ html()->text('contact_number', old('contact_number'))->class('form-control')->placeholder('Contact Number') }}
            </div>
        </div>
        <div class="col-sm-12">
            <label class="form-label req" for="basicFullname">Address</label>
            <div class="input-group input-group-merge">
                <span id="basicFullname2" class="input-group-text"><i class="bxr bx-location"></i></span>
                {{ html()->textarea('address', old('address'))->class('form-control')->placeholder('Address')->required() }}
            </div>
            @error('address')
            <small class="text-danger">{{ $errors->first('address') }}</small>
            @enderror
        </div>
        <div class="col-sm-12 text-end">
            {{ html()->submit('Save')->class('btn btn-submit btn-primary data-submit me-sm-3 me-1') }}
            {{ html()->reset('Cancel')->class('btn btn-outline-secondary')->attribute('data-bs-dismiss', 'offcanvas') }}
        </div>
        {{ HTML()->form()->close() }}
    </div>
</div>