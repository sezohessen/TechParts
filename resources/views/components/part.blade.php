@foreach ($parts as $part )
    @if ($makeCol)
        <div class="col-md-{{ $makeCol }} mb-10">
    @endif
        <div class="item">
            <div class="featured-car">
                <div class="image">
                    <a href="{{ route('Website.ShowPart',$part->id) }}"><img src="{{find_image($part->FirstImage->image , 'img/PartImgs/')}}" alt="{{ $part->FirstImage->image->name }}" class="img-responsive"></a>
                    <div class="car-details">
                        <!-- IF there is no reviews -->
                        @if (!NoReview($part->id))
                        <!-- Tottal Rating -->
                        <div class="rating rating-component">
                            {{  TotalRating($part->id) }}
                        </div>
                        @endif
                    </div>
                </div> <!-- end .image -->
                <div class="content">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="clearfix">
                                <h5>
                                    <a href="{{ route('Website.ShowPart',$part->id) }}"> {{ LangDetail($part->name,$part->name_ar) }} </a>
                                </h5>
                                <span>
                                    @if (request()->get('order')=='nearest')
                                    {{-- @php
                                        $distance = distance(request()->get('lat'),request()->get('long'),$part->seller->lat,$part->seller->long,"K");
                                    @endphp --}}
                                        @if (@$part->distance)
                                            <p class="text-info font-medium">{{ number_format(@$part->distance,2,',','') }} @lang('km Away')</p>
                                        @endif
                                    @endif
                                </span>
                            </div> <!-- end .clearfix -->

                        </div>
                        <div class="col-md-3">
                            @if ($part->price)
                                <span class="block price">{{ $part->price }} @lang('L.E')</span>
                            @endif
                        </div>
                    </div>

                </div> <!-- end .content -->
                <div class="clearfix details">
                    <div class="fuel"><i class="fas fa-car"></i> {{$part->car->make->name }} </div>
                    <div class="type"><i class="icon-car-door"></i> {{$part->car->model->name }} </div>
                </div> <!-- end .details -->
            </div> <!-- end .featured-car -->
        </div> <!-- end .item -->
    @if ($makeCol)
        </div>
    @endif
@endforeach
