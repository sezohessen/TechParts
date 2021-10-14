@foreach ($parts as $part)
    @if ($makeCol)
        <div class="col-md-{{ $makeCol }} mb-10 col-xs-12 col-sm-6">
    @endif
        <div class="item">
            <div class="relative featured-car">
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
                        <div @if($fav)class="col-sm-8 col-xs-7"@else class="col-md-8 col-xs-10" @endif>
                            <div class="clearfix">
                                <h5>
                                    <a href="{{ route('Website.ShowPart',$part->id) }}"> {{ LangDetail($part->name,$part->name_ar) }}</a>
                                </h5>
                                <span>
                                    @if (request()->get('order')=='nearest')
                                    {{-- @php
                                        $distance = distance(request()->get('lat'),request()->get('long'),$part->seller->lat,$part->seller->long,"K");
                                    @endphp --}}
                                        @if (@$part->distance)
                                            <p class="font-medium text-info">{{ number_format(@$part->distance,2,',','') }} @lang('km Away')</p>
                                        @endif
                                    @endif
                                </span>
                            </div> <!-- end .clearfix -->

                        </div>
                        <div class="col-sm-2 col-xs-3">
                            @if ($part->price)
                                <span class="block price">{{ $part->price }} @lang('L.E')</span>
                            @endif
                        </div>
                         @if ($fav)
                            <!-- start Favorite section -->
                            <div class="col-sm-2 col-xs-1">
                                <!-- If item in favorite -->
                                @if (App\Models\UserFav::where('user_id', @Auth()->user()->id)->where('part_id', $part->id)->first())
                                    <form>
                                        @csrf
                                        <div class="absolute top-0 z-40 p-4 leading-5 text-gray-900 transition duration-500 ease-in-out shadow-inner hover:text-red-700 rounded-2xl">
                                            <button type="submit"  data-id="{{ $part->id }}" id="Fav_{{ $part->id }}" class="DeleteFromFav">
                                            <i class="fa fa-times-circle"></i>
                                            </button>
                                        </div>
                                    </form>
                                @else
                                    <!-- Add part to favorite -->
                                    <form>
                                        @csrf
                                        <div class="absolute top-0 z-40 p-4 leading-5 text-gray-900 transition duration-500 ease-in-out shadow-inner hover:text-yellow-400 rounded-2xl">
                                            <button type="submit"  data-id="{{ $part->id }}" id="Fav_{{ $part->id }}" class="AddToFav">
                                            <i class="far fa-heart"></i>
                                            </button>
                                        </div>
                                    </form>
                                @endif
                            </div>
                         @endif
                         <!-- end Favorite section -->
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
@section('jsFav')
<script>
    $("body").on("click", ".AddToFav", function(e) {
        console.log(11);
        e.preventDefault();
        console.log($)
        $(this).removeClass('AddToFav').addClass('DeleteFromFav');
        let id = $(this).data('id');
        var url = '{{ route("Website.addToFavorite", ":id") }}';
        url = url.replace(':id',id);
        $.ajax({
            type:"POST",
            url: url,
            data: {
                    'id': id,
                    "_token": "{{ csrf_token() }}"
                },
                success: function (data) {
                    if(data.success==true){
                        document.getElementById("QtyCount").innerHTML = "( "+ data.Qty +" )";
                    }
                    $('#Fav_' + id + ' i').removeClass('far fa-heart').addClass('fa fa-times-circle',{duration:1000});


                },
                error: function (XMLHttpRequest) {
                    if (XMLHttpRequest.status == 401) {
                        // unauthorized
                        window.location.href = '/login';
                    }
                }
        });
    });
    $("body").on("click", ".DeleteFromFav", function(e) {
        e.preventDefault();
        console.log(22);
        $(this).removeClass('DeleteFromFav').addClass('AddToFav');
        let id = $(this).data('id');
        var $tr = $(this).closest('.fav .col-md-4');
        var url = '{{ route("Website.destroyFavorite", ":id") }}';
        url = url.replace(':id',id);
        $.ajax({
            type:"DELETE",
            url: url,
            data: {
                    'id': id,
                    "_token": "{{ csrf_token() }}"
                },
                success: function (data) {
                    if(data.success==true){
                        document.getElementById("QtyCount").innerHTML = "( "+ data.Qty +" )";
                        $tr.fadeOut(500,function(){
                            $tr.remove();
                        });
                    }
                    $('#Fav_' + id + ' i').removeClass('fa fa-times-circle').addClass('far fa-heart',{duration:1000});

                },
                error: function (XMLHttpRequest) {
                    if (XMLHttpRequest.status == 401) {
                        // unauthorized
                        window.location.href = '/login';
                    }
                }
        });
    });
</script>
@endsection
