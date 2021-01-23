<?php
   use App\Models\Agency;
?>
@if($center_type==Agency::center_type_Agency)
    @if ($agency_type==Agency::Ag_Agency)
        <span class='label label-success label-inline mr-2'style='padding: 10px;width: 128px;'>
            @lang('Agency')
        </span>
    @elseif($agency_type==Agency::Ag_Distributor)
        <span class='label label-success label-inline mr-2'style='padding: 10px;width: 128px;'>
            @lang('Distributor')
        </span>
    @else
        <span class='label label-warning label-inline mr-2'style='padding: 10px;width: 128px;'>
            @lang('UnSelected')
        </span>
    @endif
@elseif($center_type==Agency::center_type_Maintenance)
    @if ($maintenance_type==Agency::Main_Service_center)
    <span class='label label-primary label-inline mr-2'style='padding: 10px;width: 128px;'>
        @lang('Service center')
    </span>
    @elseif($maintenance_type==Agency::Main_Workshop)
    <span class='label label-primary label-inline mr-2'style='padding: 10px;width: 128px;'>
        @lang('Workshop')
    </span>
    @else
    <span class='label label-warning label-inline mr-2'style='padding: 10px;width: 128px;'>
        @lang('UnSelected')
    </span>
    @endif
@else
    <span class='label label-danger label-inline mr-2'style='padding: 10px;width: 128px;'>
        @lang('Spare parts')
    </span>
@endif
