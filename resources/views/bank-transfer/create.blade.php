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
                            <h5>Create Bank Transfer</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    {{ html()->form('POST', route('btransfer.save'))->open() }}
                    <div class="row g-3">
                        <div class="col-sm-3">
                            <label for="selectpickerBasic" class="form-label req">Transfer Date</label>
                            {{
                                html()->date('transfer_date', (old('transfer_date')) ?? date('Y-m-d'))->class('form-control')->when(Auth::user()->roles()->first()->name != 'Administrator', function($el){
                                    return $el->attrubute('readonly', true);
                                })
                            }}
                            @error('transfer_date')
                            <small class="text-danger">{{ $errors->first('transfer_date') }}</small>
                            @enderror
                        </div>
                        <div class="col-sm-3">
                            <label for="selectpickerBasic" class="form-label req">Amount</label>
                            {{ html()->text('amount', old('amount'))->class('form-control')->placeholder('0.00')->required() }}
                            @error('amount')
                            <small class="text-danger">{{ $errors->first('amount') }}</small>
                            @enderror
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label" for="basicFullname">Notes / Remarks</label>
                            <div class="input-group input-group-merge">
                                <span id="basicFullname2" class="input-group-text"><i class="bx bx-file"></i></span>
                                {{ html()->textarea('remarks', old('remarks'))->class('form-control')->placeholder('Notes / Remarks') }}
                            </div>
                            @error('remarks')
                            <small class="text-danger">{{ $errors->first('remarks') }}</small>
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