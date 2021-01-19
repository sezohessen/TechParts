@if($center_type==0)
    @if ($agency_type==1)
        <p>@lang('Agency')</p>
    @else
        <p>@lang('Distributor')</p>
    @endif
@elseif($center_type==1)
    @if ($maintenance_type==1)
    <p>@lang('Service center')</p>
    @else
    <p>@lang('Workshop')</p>
    @endif
@else
    <p>@lang('Spare parts')</p>
@endif
