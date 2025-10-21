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
                            <h5>Create Purchase</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    {{ html()->form('POST', route('purchase.save'))->open() }}
                    <div class="row g-3">
                        <div class="col-sm-3">
                            <label for="selectpickerBasic" class="form-label req">Purchase Date</label>
                            {{
                                html()->date('pdate', (old('pdate')) ?? date('Y-m-d'))->class('form-control');
                            }}
                            @error('pdate')
                            <small class="text-danger">{{ $errors->first('pdate') }}</small>
                            @enderror
                        </div>
                        <div class="col-sm-3">
                            <label for="selectpickerBasic" class="form-label req">Supplier</label>
                            {{ html()->select($name = 'supplier_id', $value = $suppliers, old('supplier_id'))->class('select2 form-select')->placeholder('Select')->required() }}
                            @error('supplier_id')
                            <small class="text-danger">{{ $errors->first('supplier_id') }}</small>
                            @enderror
                        </div>
                        <div class="col-sm-3">
                            <label class="form-label req" for="basicFullname">Supplier Invoice</label>
                            <div class="input-group input-group-merge">
                                <span id="basicFullname2" class="input-group-text"><i class="bx bx-file"></i></span>
                                {{ html()->text('supplier_invoice', old('supplier_invoice'))->class('form-control')->placeholder('Supplier Invoice')->required() }}
                            </div>
                            @error('supplier_invoice')
                            <small class="text-danger">{{ $errors->first('supplier_invoice') }}</small>
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
                        <div class="card">
                            <div class="card-header row">
                                <div class="col-md-6">
                                    <h5>Product Details</h5>
                                </div>
                                <div class="col-md-6 text-end">
                                    <a href="javascript:void(0)" class="btn btn-icon btn-primary btnPurchaseRow">
                                        <span class="tf-icons bx bx-plus"></span>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body text-nowrap table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr class="text-nowrap">
                                            <th>Category</th>
                                            <th>Product</th>
                                            <th>Qty</th>
                                            <th>Expiry</th>
                                            <th>Batch</th>
                                            <th>P.Price/Qty</th>
                                            <th>S.Price/Qty</th>
                                            <th>Total</th>
                                            <th>Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0 tblPurchase">
                                        <tr>
                                            <td>
                                                {{ html()->select($name = 'hsns[]', $value = $hsns, old('hsn'))->class('select2 form-select selHsn')->attribute('id', 'hsn_'.time())->placeholder('Select')->required() }}
                                            </td>
                                            <td>
                                                {{ html()->select($name = 'products[]', '', old('products'))->class('select2 form-select selPdct')->attribute('id', 'product_'.time())->placeholder('Select')->required() }}
                                            </td>
                                            <td>
                                                {{ html()->number('qty[]', '', '', '', '1')->class('form-control text-end qty')->placeholder('0')->required() }}
                                            </td>
                                            <td>
                                                {{ html()->date('expiry_date[]', '')->class('form-control') }}
                                            </td>
                                            <td>
                                                {{ html()->text('batch_number[]', '')->class('form-control')->placeholder('Batch') }}
                                            </td>
                                            <td>
                                                {{ html()->number('purchase_price[]', '', '0', '', '')->class('form-control text-end pprice')->placeholder('0.00')->required() }}
                                            </td>
                                            <td>
                                                {{ html()->number('selling_price[]', '', '0', '', '')->class('form-control text-end sprice')->placeholder('0.00')->required() }}
                                            </td>
                                            <td class="text-end">
                                                {{ html()->number('total[]', '', '0', '', '')->class('form-control text-end total')->placeholder('0.00')->attribute('readonly', true) }}
                                            </td>
                                            <td class="text-center">

                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="7" class="text-end fw-bold">Total</td>
                                            <td class="sum fw-bold text-end">0.00</td>
                                            <td></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
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