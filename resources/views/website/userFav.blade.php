@extends('website.layouts.app')

@section('css')
<style lang="">
    .featured-cars .details {
	background: #eff3f5;
	border: 1px solid #dde2e5;
    height: 50px;
	text-align: center;
	font-size: 15px;
    padding: 3px;
	font-weight: 400;
}
.featured-cars .details div {
    display: -webkit-box;
    overflow : hidden;
    text-overflow: ellipsis;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
}
.featured-cars .details i {
	color: #8c9aa5;
	margin-right: 8px;
}
.featured-cars .details .seats {
	float: left;
	width: 25%;
	border-right: 1px solid #dde2e5;
}
.featured-cars .details .fuel {
	float: left;
	border-right: 1px solid #dde2e5;
}
.featured-cars .details .type {
	float: left;
}
</style>
@endsection
<!-- Start page -->
@section('website')

 <section class="container">
        <div class="py-20 mt-40">
            <div class="favorite-parts row">
                <h1 class="py-4 mb-10 text-4xl text-center text-gray-300 bg-blue-900 border-4 rounded-t-full ">
                    @lang('Your Favorite Parts')
                </h1>
                    @if(session()->has('deleted'))
                        <div class="m-4 text-center text-gray-100 bg-blue-900 alert">
                            <p>{{ session('deleted') }}</p>
                        </div>
                    @endif
                    @if(session()->has('created'))
                        <div class="m-4 text-center text-gray-100 bg-blue-900 alert">
                            <p>{{ session('created') }}</p>
                        </div>
                    @endif
                    <!-- Seller parts -->
                @foreach ($parts->favorite as $part)
                    <div class="my-10 col-md-4">
                    <div class="relative item">
                        <!-- Remove part from favorite -->
                        <div class="absolute top-0 right    -0 z-40 text-red-500 close-icon">
                            <form method="POST" action="{{route('Website.destroyFavorite',$part->id)}}">
                                @method('DELETE')
                                @csrf
                                <button type="submit"  href="#">
                                <i class="p-2 text-3xl text-gray-300 bg-red-600 rounded-lg fas fa-times"></i>
                                </button>
                            </form>
                        </div>
                    <div class="featured-car">
                        <div class="image">
                            <a href="{{ route('Website.ShowPart',$part->id) }}">
                            <img src="{{find_image($part->FirstImage->image , 'img/PartImgs/')}}"
                            style="max-height: 200px;display: block;margin-left: auto;margin-right: auto;"
                             alt="{{ $part->FirstImage->image->name }}" class="img-responsive"></a>
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
                                        <h5 class="my-5 text-3xl">
                                            <a href="{{ route('Website.ShowPart',$part->id) }}"> {{ LangDetail($part->name,$part->name_ar) }} </a>
                                        </h5>
                                    </div> <!-- end .clearfix -->

                                </div>
                                <div class="col-md-3">
                                    @if ($part->price)
                                        <span class="block my-5 text-green-500 price">{{ $part->price }} @lang('L.E')</span>
                                    @endif
                                </div>
                            </div>

                        </div> <!-- end .content -->
                        <div class="clearfix bg-gray-300 details">
                            <div class="float-right fuel"><i class="fas fa-car"></i> {{$part->car->make->name }} </div>
                            <div class="type"><i class="icon-car-door"></i> {{$part->car->model->name }} </div>
                        </div> <!-- end .details -->
                    </div> <!-- end .featured-car -->
                </div> <!-- end .item -->
                    </div>
                @endforeach
            </div>
        </div>
 </section>

@endsection

<!-- Js -->
@section('js')

@endsection
