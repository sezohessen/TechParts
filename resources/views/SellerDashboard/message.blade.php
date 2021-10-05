@if ($errors->any())
    <div class="alert alert-danger  m-4 ">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(session()->has('created'))
    <div class="alert alert-success  m-4  " role="alert">
        <strong>{{ session('created') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
@if(session()->has('exist'))
    <div class="alert alert-danger  m-4  " role="alert">
        <strong>{{ session('exist') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
@if(session()->has('updated'))
    <div class="alert alert-primary  m-4  " role="alert">
        <strong>{{ session('updated') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
@if(session()->has('deleted'))
    <div class="alert alert-danger  m-4  " role="alert">
        <strong>{{ session('deleted') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

