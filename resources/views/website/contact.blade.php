@extends('website.layouts.app')

@section('website')
<section class="section white" style="margin-top: 40px;">
			<div class="inner">
				<div class="container">
					<div class="row">
						<div class="col-sm-8">
							<div class="contact">
								<h4 class="mb-10">Contact Form</h4>
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
												<input type="email" id="contact-email" name="email" placeholder="Email*" required />
											</div>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                                            @enderror
										</div>
										<div class="col-sm-12">
											<div class="form-group {{ $errors->has('phone') ? 'is-invalid' : '' }}">
												<input type="phone" id="contact-phone" name="phone" placeholder="Phone" required/>
											</div>
                                            @error('phone')
                                                <div class="invalid-feedback">{{ $errors->first('phone') }}</div>
                                            @enderror
										</div>
										<div class="col-sm-12">
											<div class="form-group {{ $errors->has('message') ? 'is-invalid' : '' }}">
												<textarea name="message" id="contact-message" placeholder="Comment*" required rows="7"></textarea>
											</div>
                                            @error('message')
                                                <div class="invalid-feedback">{{ $errors->first('message') }}</div>
                                            @enderror
										</div>
									</div>
									<div class="form-group">
										<button type="submit" class="button light-blue">Submit</button>
									</div>
									<div id="contact-loading" class="alert alert-info form-alert">
										<span class="icon"><i class="fa fa-info"></i></span>
										<span class="message">Loading...</span>
									</div>
								</form>
							</div> <!-- end .contact -->
						</div> <!-- end .col-sm-8 -->
						<div class="col-sm-4">
							<div class="contact-details">
								<div class="item">
									<div class="icon"><i class="ion-ios-location-outline"></i></div>
									<div class="content">
										<h6>Address</h6>
										<span>{{$Settings->location}}</span>
									</div> <!-- end .content -->
								</div> <!-- end .item -->
								<div class="item">
									<div class="icon"><i class="ion-ios-telephone-outline"></i></div>
									<div class="content">
										<h6>Phone</h6>
										<span>Office: {{$Settings->phone}}</span>
										<span>WhatsApp: {{$Settings->whatsapp}}</span>
									</div> <!-- end .content -->
								</div> <!-- end .item -->
								<div class="item">
									<div class="icon"><i class="ion-ios-email-outline"></i></div>
									<div class="content">
										<h6>Email</h6>
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
