@extends('website.layouts.app')

@section('website')
<div class="container py-96">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    Now return back to Application to make login
                    {{ __('Now return back to Application to make login') }}
                    <a class="btn btn-primary" href="{{route('Website.Index')}}">Home</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
