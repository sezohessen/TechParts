@extends('website.layouts.app')

@section('website')
<div class="bg-gray-900 body">
    <div class="container py-96">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @if (session('status'))
                            <div class="text-center alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="p-20 mx-auto text-center bg-blue-200 rounded-xl">
                            <span>
                            @lang('You are now logged in')
                            <a class="btn btn-primary" href="{{route('Website.Index')}}">@lang('Home')</a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
