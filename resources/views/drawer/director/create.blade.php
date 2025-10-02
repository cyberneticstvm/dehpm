<div class="offcanvas offcanvas-end" id="add-new-director">
    <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title" id="exampleModalLabel">Add New Director to <span class="addNewDirectorSpan"></span></h5>
        <button
            type="button"
            class="btn-close text-reset"
            data-bs-dismiss="offcanvas"
            aria-label="Close"></button>
    </div>
    <div class="offcanvas-body flex-grow-1">
        {{ html()->form('POST')->route('project.director.save')->attribute('id', 'form-add-new-record')->class('add-new-record pt-0 row g-2')->open() }}
        <input type="hidden" name="project_id" id="pid" value="" />
        <div class="col-sm-12">
            <label for="selectpickerBasic" class="form-label req">Director</label>
            {{ html()->select('director_id', $directors, old('director_id'))->class('select2 form-select')->placeholder('Select')->required() }}
            @error('director_id')
            <small class="text-danger">{{ $errors->first('director_id') }}</small>
            @enderror
        </div>
        <div class="col-sm-7">
            <label for="selectpickerBasic" class="form-label req">Total Contribution</label>
            {{ html()->text('contribution', old('contribution'))->class('form-control')->placeholder('0.00')->required() }}
            @error('contribution')
            <small class="text-danger">{{ $errors->first('contribution') }}</small>
            @enderror
        </div>
        <div class="col-sm-5">
            <label for="selectpickerBasic" class="form-label req">Profit %</label>
            {{ html()->text('profit_percentage', old('profit_percentage'))->class('form-control')->placeholder('0.00')->required() }}
            @error('profit_percentage')
            <small class="text-danger">{{ $errors->first('profit_percentage') }}</small>
            @enderror
        </div>
        <div class="col-sm-6">
            <label for="selectpickerBasic" class="form-label req">Date of Join</label>
            {{ html()->date('date_of_join', old('date_of_join') ?? date('Y-m-d'))->class('form-control') }}
            @error('date_of_join')
            <small class="text-danger">{{ $errors->first('date_of_join') }}</small>
            @enderror
        </div>
        <div class="col-sm-12">
            <label for="selectpickerBasic" class="form-label req">Contribution Type</label>
            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                @forelse($types as $key => $type)
                <input type="radio" class="btn-check" name="type" id="btnradio_{{ $type->id }}" value="{{ $type->name }}" checked />
                <label class="btn btn-outline-primary" for="btnradio_{{ $type->id }}">{{ $type->name }}</label>
                @empty
                @endforelse
            </div>
            @error('type')
            <small class="text-danger">{{ $errors->first('type') }}</small>
            @enderror
        </div>
        <div class="col-sm-6">
            <label for="selectpickerBasic" class="form-label">No. of Installments</label>
            {{ html()->text('number_of_installments', old('number_of_installments'))->class('form-control')->placeholder('0') }}
            @error('number_of_installments')
            <small class="text-danger">{{ $errors->first('number_of_installments') }}</small>
            @enderror
        </div>
        <div class="col-sm-6">
            <label for="selectpickerBasic" class="form-label">Installment Start Date</label>
            {{ html()->date('installment_start_date', old('installment_start_date'))->class('form-control') }}
            @error('installment_start_date')
            <small class="text-danger">{{ $errors->first('installment_start_date') }}</small>
            @enderror
        </div>
        <div class="col-sm-12">
            <label for="selectpickerBasic" class="form-label">Remarks</label>
            {{ html()->textarea('remarks', old('remarks'))->class('form-control')->placeholder('Remarks') }}
            @error('remarks')
            <small class="text-danger">{{ $errors->first('remarks') }}</small>
            @enderror
        </div>
        <div class="col-sm-12 text-end mt-3">
            {{ html()->submit('Save')->class('btn btn-submit btn-primary data-submit me-sm-3 me-1') }}
            {{ html()->reset('Cancel')->class('btn btn-outline-secondary')->attribute('data-bs-dismiss', 'offcanvas') }}
        </div>
        {{ HTML()->form()->close() }}
    </div>
</div>