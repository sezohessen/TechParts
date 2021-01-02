@if ($errors->any())
    <div class="alert alert-danger  m-4 p-4">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(session()->has('success'))
    <div class="alert alert-success  m-4 p-4 ">
        <h4>{{ session('success') }}</h4>
    </div>
@endif

@if(session()->has('success'))
    <div class="alert alert-success  m-4 p-4 ">
        <h4>{{ session('success') }}</h4>
    </div>
@endif
