@if ($errors->any())
    <div class="alert alert-danger  m-4 p-4">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(session()->has('created'))
    <div class="alert alert-success  m-4 p-4 ">
        <h4>{{ session('created') }}</h4>
    </div>
@endif

@if(session()->has('updated'))
    <div class="alert alert-primary  m-4 p-4 ">
        <h4>{{ session('updated') }}</h4>
    </div>
@endif
@if(session()->has('deleted'))
    <div class="alert alert-danger  m-4 p-4 ">
        <h4>{{ session('deleted') }}</h4>
    </div>
@endif

