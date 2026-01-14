@if ($errors->any())
    <div class="row ml-0 mr-0 mt-3 mb-3">
        <div class="col-12">
            <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show mb-0">
                <ul class="m-0 p-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endif

@if (session()->has('success'))
    <div class="row ml-0 mr-0 mt-3 mb-3">
        <div class="col-12">
            <div class="alert alert-success mb-0" role="alert">
                <i class="dripicons-checkmark mr-2"></i> {{ session()->get('success') }}
            </div>
        </div>
    </div>
 @endif