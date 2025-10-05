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
                            <h5>Update {{ $product->hsn->name }}</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    {{ html()->form('POST', route('product.update', ['id' => encrypt($product->id), 'hsn' => encrypt($product->hsn_id)]))->open() }}
                    <div class="row g-3">
                        <div class="col-sm-4">
                            <label class="form-label req" for="basicFullname">Product Name</label>
                            <div class="input-group input-group-merge">
                                <span id="basicFullname2" class="input-group-text"><i class="bx bx-package"></i></span>
                                {{ html()->text('name', $product->name)->class('form-control')->placeholder('Product Name')->required() }}
                            </div>
                            @error('name')
                            <small class="text-danger">{{ $errors->first('name') }}</small>
                            @enderror
                        </div>
                        <div class="col-sm-3">
                            <label for="selectpickerBasic" class="form-label req">Hsn</label>
                            {{ html()->select($name = 'hsn_id', $value = $hsns, $product->hsn_id)->class('select2 form-select')->placeholder('Select')->attribute('disabled', true) }}
                            @error('hsn_id')
                            <small class="text-danger">{{ $errors->first('hsn_id') }}</small>
                            @enderror
                        </div>
                        <div class="col-sm-3">
                            <label for="selectpickerBasic" class="form-label req">Manufacturer</label>
                            {{ html()->select($name = 'manufacturer_id', $value = $manufacturers, $product->manufacturer_id)->class('select2 form-select')->placeholder('Select')->required() }}
                            @error('manufacturer_id')
                            <small class="text-danger">{{ $errors->first('manufacturer_id') }}</small>
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