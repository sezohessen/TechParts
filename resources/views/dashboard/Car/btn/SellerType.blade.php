<?php use App\Models\Car; ?>

    @if(Car::SELLER_AGENCY==$SellerType)
        <span class="label label-warning label-inline mr-2">@lang("Agency")</span>
    @elseif(Car::SELLER_DISTRIBUTOR==$SellerType)
        <span class="label label-danger label-inline mr-2">@lang("Distributor")</span>
    @else
        <span class="label label-info label-inline mr-2">@lang("Individual")</span>
    @endif
