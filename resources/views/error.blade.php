@extends("base")
@section("content")
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <!-- Website Analytics-->
        <div class="col-lg-12 col-md-12 mb-4">
            <div class="card">
                <div class="card-body text-center">
                    <img src="{{ asset('/assets/svg/sad-face.svg') }}" width="15%" />
                    <p class="text-danger text-center">{{ $exception->getMessage() }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection