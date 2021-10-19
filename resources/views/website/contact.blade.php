@extends('website.layouts.app')

@section('website')
<section class="section white" style="margin-top: 40px;">
			<div class="inner">
				<div class="container">
					<div class="row">
						<div class="col-sm-8 col-xs-12">
							<div class="contact sm:mt- mt-14">
								<h4 class="mb-10">@lang('Contact us')</h4>
								<form action="{{route("Website.SendContact")}}" method="post" id="contact-form">
                                  @csrf
                                  @if(session()->has('created'))
                                        <div class="m-4 alert alert-success ">
                                            <p>{{ session('created') }}</p>
                                        </div>
                                    @endif
									<div class="row">
										<div class="col-sm-12">
											<div class="form-group {{ $errors->has('email') ? 'is-invalid' : '' }}">
												<input class='form-control' type="email" id="contact-email" name="email" placeholder="@lang('Email')*" required />
											</div>
                                            @error('email')
                                                <div class="text-red-700 invalid-feedback">{{ $errors->first('email') }}</div>
                                            @enderror
										</div>
										<div class="col-sm-12">
											<div class="form-group {{ $errors->has('phone') ? 'is-invalid' : '' }}">
												<input class="form-control" type="phone" id="contact-phone" name="phone" placeholder="@lang('Phone')*" required/>
											</div>
                                            @error('phone')
                                                <div class="text-red-700 invalid-feedback">{{ $errors->first('phone') }}</div>
                                            @enderror
										</div>
										<div class="col-sm-12">
											<div class="form-group {{ $errors->has('message') ? 'is-invalid' : '' }}">
												<textarea class="form-control" name="message" id="contact-message" placeholder="@lang('Message')*" required rows="7"></textarea>
											</div>
                                            @error('message')
                                                <div class="text-red-700 invalid-feedback">{{ $errors->first('message') }}</div>
                                            @enderror
										</div>
									</div>
									<div class="form-group">
										<button type="submit" class="my-5 button light-blue">@lang('Send')</button>
									</div>
									<div id="contact-loading" class="alert alert-info form-alert">
										<span class="icon"><i class="fa fa-info"></i></span>
										<span class="message">@lang('Loading')</span>
									</div>
								</form>
							</div> <!-- end .contact -->
						</div> <!-- end .col-sm-8 -->
						<div class="col-sm-4 col-xs-12">
							<div class="contact-details">
								<div class="item">
									<div class="icon"><i class="ion-ios-location-outline"></i></div>
									<div class="content">
										<h6>@lang('Address')</h6>
										<span>{{$Settings->location}}</span>
									</div> <!-- end .content -->
								</div> <!-- end .item -->
								<div class="item">
									<div class="icon"><i class="ion-ios-telephone-outline"></i></div>
									<div class="content">
										<h6>@lang('Phone')</h6>
										<span><i class="mx-5 fas fa-phone-square"></i>{{$Settings->phone}}</span>
										<span><i class="mx-5 text-green-500 fab fa-whatsapp"></i>{{$Settings->whatsapp}}</span>
									</div> <!-- end .content -->
								</div> <!-- end .item -->
								<div class="item">
									<div class="icon"><i class="ion-ios-email-outline"></i></div>
									<div class="content">
										<h6>@lang('Email')</h6>
										<span>Office:  {{$Settings->email }}</span>
									</div> <!-- end .content -->
								</div> <!-- end .item -->
							</div> <!-- end .contact-details -->
						</div> <!-- end .col-sm-4 -->
					</div> <!-- end .row -->
				</div> <!-- end .container -->
			</div> <!-- end .inner -->
		</section> <!-- end .section -->
@endsection
