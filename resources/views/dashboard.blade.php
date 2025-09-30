@extends("base")
@section("content")
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 breadcrumb-wrapper mb-4">
        <div class="col">Welcome {{ Auth::user()?->name }}, You are currently logged in <span class="text-primary">{{ Session::get('branch')?->name }}</span> Branch!</div>
    </h4>
    <div class="row">
        <!-- Website Analytics-->
        <div class="col-lg-6 col-md-12 mb-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Website Analytics</h5>
                    <div class="dropdown">
                        <button
                            class="btn p-0"
                            type="button"
                            id="analyticsOptions"
                            data-bs-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false">
                            <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="analyticsOptions">
                            <a class="dropdown-item" href="javascript:void(0);">Select All</a>
                            <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                            <a class="dropdown-item" href="javascript:void(0);">Share</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>
</div>
@if(!Session::has('branch'))
<div
    class="modal-onboarding modal fade animate__animated"
    id="branchSelector"
    tabindex="-1"
    aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content text-center">
            {{ html()->form('POST')->route('user.branch.update')->class('mb-3')->open() }}
            <div class="modal-body p-0">
                <div class="onboarding-media">
                    <div class="text-center">
                        <img
                            src="{{ asset('/assets/img/devi/devi-logo-transparent.png') }}"
                            alt="devi-eye-hospitals" width="35%" />
                    </div>
                </div>
                <div class="onboarding-content mb-0">
                    <h4 class="onboarding-title text-body text-center">Select Branch</h4>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label for="roleEx3" class="form-label mt-3">Select Branch</label>
                                {{ html()->select($name = 'branch', $branches, old('branch'))->class('select2 form-select')->placeholder('Select')->required() }}
                                @error('branche')
                                <small class="text-danger">{{ $errors->first('branche') }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="submit" class="btn btn-submit btn-primary">Update</button>
            </div>
            {{ html()->form()->close() }}
        </div>
    </div>
</div>
@endif
@endsection