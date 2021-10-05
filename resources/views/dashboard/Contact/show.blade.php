{{-- Extends layout --}}
@extends('layout.master')

{{-- Content --}}
@section('content')


    {{-- Dashboard 1 --}}
    <div class="card card-custom gutter-b">

        <div class="container">
            <div class="text-right">
                <a href="{{ route('dashboard.contact.index') }}" style="margin-top: 16px;" class="btn btn-primary mr-2">  @lang('Back')  <i class="fa fa-arrow-left fa-sm"></i></a>
            </div>
            <div class="card-header">
                <h1 class="text-primary">@lang('Contact') : {{ $contact->id }}</h1>
            </div>
            <div class="card-body">
                <p class="h4">{{ $contact->message }}</p>
            </div>
            <div class="card-footer">
                <h3>@lang('Email') : <strong>{{ $contact->email }}</strong></h3>
                <h3>@lang('Phone') : <strong>{{ $contact->phone }}</strong></h3>
                <span class="text-muted">@lang('Date') : <strong>{{ $contact->created_at->format('d - m - Y') }}</strong></span>
            </div>
        </div>
    </div>

@endsection
