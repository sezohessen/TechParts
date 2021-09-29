
@foreach ($parts as $part)
    @if ($makeCol)
        <div class="col-md-{{ $makeCol }} mb-10">
    @endif
        <div class="item">
            <div class="relative featured-car">
                <!-- If item in favorite -->
                @if (Auth::check())
                    @if (App\Models\UserFav::where('user_id', Auth()->user()->id)->where('part_id', $part->id)->first())
                        <form method="POST" action="{{route('Website.destroyFavorite',$part->id)}}">
                            @method('DELETE')
                            @csrf
                            <div class="absolute top-0 right-10 z-40 p-4 bg-pink-800 text-blue-50">
                                <button type="submit">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                        </form>
                    @else
                    <!-- Add part to favorite -->
                    <form method="POST" action="{{route('Website.addToFavorite',$part->id)}}">
                        @csrf
                        <div class="absolute top-0 right-10 z-40 p-4 bg-pink-800 text-blue-50">
                            <button type="submit">
                            <i class="far fa-heart"></i>
                            </button>
                        </div>
                    </form>
                    @endif
                @else
                     <!-- Add part to favorite -->
                     <form method="POST" action="{{route('Website.addToFavorite',$part->id)}}">
                        @csrf
                        <div class="absolute top-0 right-10 z-40 p-4 bg-pink-800 text-blue-50">
                            <button type="submit">
                            <i class="far fa-heart"></i>
                            </button>
                        </div>
                    </form>
                @endif
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
