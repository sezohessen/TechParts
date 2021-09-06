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
    <div class="alert alert-success  m-4  ">
        <p>{{ session('created') }}</p>
    </div>
@endif
@if(session()->has('exist'))
    <div class="alert alert-danger  m-4  ">
        <p>{{ session('exist') }}</p>
    </div>
@endif
@if(session()->has('updated'))
    <div class="alert alert-primary  m-4  ">
        <p>{{ session('updated') }}</p>
    </div>
@endif
@if(session()->has('deleted'))
    <div class="alert alert-danger  m-4  ">
        <p>{{ session('deleted') }}</p>
    </div>
@endif

