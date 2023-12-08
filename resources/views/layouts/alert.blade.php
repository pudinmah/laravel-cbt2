@if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible show fade">
        <div class="alert-body">
            <button class="close" data-dismiss="alert">
                x
            </button>
            <p class="text-center">{{ $message }} </p>
        </div>
    </div>
@endif
