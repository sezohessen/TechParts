{{-- This page to show the admin who is has role user and also have seller's data --}}
{{-- That is happen where the admin change the seller role to user --}}
@if ($data->hasRole('seller'))
    <span>{{ $data->first_name }} {{ $data->last_name }}</span>
@else
    <strong class="text-danger">{{ $data->first_name }} {{ $data->last_name }}</strong>
@endif

