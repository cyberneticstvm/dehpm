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
                            <h5>Update Director to the Project</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    {{ html()->form('POST', route('project.director.update', encrypt($prodir->id)))->open() }}
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label for="selectpickerBasic" class="form-label req">Director</label>
                            {{ html()->select('director_id', $directors, $prodir->director_id)->class('select2 form-select')->placeholder('Select')->required() }}
                            @error('director_id')
                            <small class="text-danger">{{ $errors->first('director_id') }}</small>
                            @enderror
                        </div>
                        <div class="col-sm-3">
                            <label for="selectpickerBasic" class="form-label req">Total Contribution</label>
                            {{ html()->text('contribution', $prodir->contribution)->class('form-control')->placeholder('0.00')->required() }}
                            @error('contribution')
                            <small class="text-danger">{{ $errors->first('contribution') }}</small>
                            @enderror
                        </div>
                        <div class="col-sm-3">
                            <label for="selectpickerBasic" class="form-label req">Profit %</label>
                            {{ html()->text('profit_percentage', $prodir->profit_percentage)->class('form-control')->placeholder('0.00')->required() }}
                            @error('profit_percentage')
                            <small class="text-danger">{{ $errors->first('profit_percentage') }}</small>
                            @enderror
                        </div>
                        <div class="col-sm-3">
                            <label for="selectpickerBasic" class="form-label req">Date of Join</label>
                            {{ html()->date('date_of_join', $prodir->date_of_join->format('Y-m-d'))->class('form-control') }}
                            @error('date_of_join')
                            <small class="text-danger">{{ $errors->first('date_of_join') }}</small>
                            @enderror
                        </div>

                        <div class="col-sm-3">
                            <label for="selectpickerBasic" class="form-label">No. of Installments</label>
                            {{ html()->text('number_of_installments', $prodir->number_of_installments)->class('form-control')->placeholder('0') }}
                            @error('number_of_installments')
                            <small class="text-danger">{{ $errors->first('number_of_installments') }}</small>
                            @enderror
                        </div>
                        <div class="col-sm-3">
                            <label for="selectpickerBasic" class="form-label">Installment Start Date</label>
                            {{ html()->date('installment_start_date', $prodir->installment_start_date?->format('Y-m-d'))->class('form-control') }}
                            @error('installment_start_date')
                            <small class="text-danger">{{ $errors->first('installment_start_date') }}</small>
                            @enderror
                        </div>
                        <div class="col-sm-3">
                            <label for="selectpickerBasic" class="form-label req">Contribution Type</label><br />
                            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                @forelse($types as $key => $type)
                                <input type="radio" class="btn-check" name="type" id="btnradio_{{ $type->id }}" value="{{ $type->name }}" {{ ($type->id == $prodir->type) ? 'checked' : '' }} />
                                <label class="btn btn-outline-primary" for="btnradio_{{ $type->id }}">{{ $type->name }}</label>
                                @empty
                                @endforelse
                            </div>
                            @error('type')
                            <small class="text-danger">{{ $errors->first('type') }}</small>
                            @enderror
                        </div>
                        <div class="col-sm-6">
                            <label for="selectpickerBasic" class="form-label">Remarks</label>
                            {{ html()->textarea('remarks', $prodir->remarks)->class('form-control')->placeholder('Remarks') }}
                            @error('remarks')
                            <small class="text-danger">{{ $errors->first('remarks') }}</small>
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