@extends('website.layouts.app')
@section('website')
<section class="section white">
			<div class="inner">
				<div class="container">
					<div class="car-details">
						<div class="row">
							<div class="col-sm-8">
								<div class="clearfix">
									<div class="title">Ferrari <span>[ Grand ]</span></div>
									<div class="rating"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i></div>
								</div>
								<div id="car-details-slider" class="image">
									<div class="item"><img src="{{asset('img/website/details.jpg')}}" alt="alt" class="img-responsive"></div>
									<div class="item"><img src="{{asset('img/website/details.jpg')}}" alt="alt" class="img-responsive"></div>
									<div class="item"><img src="{{asset('img/website/details.jpg')}}" alt="alt" class="img-responsive"></div>
								</div>
								<div class="border tabpanel" role="tabpanel">
									<ul class="nav nav-tabs" role="tablist">
										<li role="presentation" class="active"><a href="#heading-tab4" aria-controls="heading-tab4" role="tab" data-toggle="tab">Vehicle Overview</a></li>
										<li role="presentation"><a href="#heading-tab5" aria-controls="heading-tab5" role="tab" data-toggle="tab">Features & Options</a></li>
										<li role="presentation"><a href="#heading-tab6" aria-controls="heading-tab6" role="tab" data-toggle="tab">Technical Specifications</a></li>
									</ul> <!-- end .nav-tabs -->
									<div class="tab-content">
										<div role="tabpanel" class="tab-pane fade in active" id="heading-tab4">
											<p>Vivamus sit amet leo at arcu placerat hendrerit. Suspendisse scelerisque, metus quis iaculis placerat, elit neque lacinia tellus, in mollis nunc sem quis ante. Mauris tincidunt libero sit amet egestas lobortis. Etiam id vulputate elit. Pellentesque commodo, nulla ac mollis interdum, eros nibh porttitor ex, fringilla suscipit urna velit sed elit. Vivamus tincidunt accumsan odio, porttitor congue felis.</p>
											<p>Cras lacinia diam neque, non iaculis ex elementum ac. Phasellus a varius libero. Nulla ut vestibulum quam. Curabitur posuere, felis sed pulvinar elementum, metus eros eleifend urna, eu volutpat lectus sem in felis. In mattis urna justo, nec cursus mauris consectetur at. Vestibulum nec fringilla erat. Pellentesque cursus fermentum nunc vitae mattis. Fusce leo diamfelis sed pulvinar elementum, metus eros eleifend urna, eu volutpat lectus sem in felis. In mattis urna justo, nec cursus mauris consectetur at. Vestibulum nec fringilla erat. Pellentesque cursus fermentum nunc vitae mattis.</p>
											<p>Vivamus sit amet leo at arcu placerat hendrerit. Suspendisse scelerisque, metus quis iaculis placerat, elit neque lacinia tellus, in mollis nunc sem quis ante. Mauris tincidunt libero sit amet egestas lobortis. Etiam id vulputate elit. Pellentesque commodo, nulla ac mollis interdum, eros nibh porttitor ex, fringilla suscipit urna velit sed elit. Vivamus tincidunt accumsan odio, porttitor congue felis.</p>
											<p>Vivamus sit amet leo at arcu placerat hendrerit. Suspendisse scelerisque, metus quis iaculis placerat, elit neque lacinia tellus, in mollis nunc sem quis ante. Mauris tincidunt libero sit amet egestas lobortis. Etiam id vulputate elit. Pellentesque commodo, nulla ac mollis interdum, eros nibh porttitor ex, fringilla suscipit urna velit sed elit. Vivamus tincidunt accumsan odio, porttitor congue felis.</p>
										</div> <!-- end .tab-panel -->
										<div role="tabpanel" class="tab-pane fade" id="heading-tab5">
											<p>Vivamus sit amet leo at arcu placerat hendrerit. Suspendisse scelerisque, metus quis iaculis placerat, elit neque lacinia tellus, in mollis nunc sem quis ante. Mauris tincidunt libero sit amet egestas lobortis. Etiam id vulputate elit. Pellentesque commodo, nulla ac mollis interdum, eros nibh porttitor ex, fringilla suscipit urna velit sed elit. Vivamus tincidunt accumsan odio, porttitor congue felis.</p>
											<p>Cras lacinia diam neque, non iaculis ex elementum ac. Phasellus a varius libero. Nulla ut vestibulum quam. Curabitur posuere, felis sed pulvinar elementum, metus eros eleifend urna, eu volutpat lectus sem in felis. In mattis urna justo, nec cursus mauris consectetur at. Vestibulum nec fringilla erat. Pellentesque cursus fermentum nunc vitae mattis. Fusce leo diamfelis sed pulvinar elementum, metus eros eleifend urna, eu volutpat lectus sem in felis. In mattis urna justo, nec cursus mauris consectetur at. Vestibulum nec fringilla erat. Pellentesque cursus fermentum nunc vitae mattis.</p>
										</div> <!-- end .tab-panel -->
										<div role="tabpanel" class="tab-pane fade" id="heading-tab6">
											<p>Vivamus sit amet leo at arcu placerat hendrerit. Suspendisse scelerisque, metus quis iaculis placerat, elit neque lacinia tellus, in mollis nunc sem quis ante. Mauris tincidunt libero sit amet egestas lobortis. Etiam id vulputate elit. Pellentesque commodo, nulla ac mollis interdum, eros nibh porttitor ex, fringilla suscipit urna velit sed elit. Vivamus tincidunt accumsan odio, porttitor congue felis.</p>
											<p>Cras lacinia diam neque, non iaculis ex elementum ac. Phasellus a varius libero. Nulla ut vestibulum quam. Curabitur posuere, felis sed pulvinar elementum, metus eros eleifend urna, eu volutpat lectus sem in felis. In mattis urna justo, nec cursus mauris consectetur at. Vestibulum nec fringilla erat. Pellentesque cursus fermentum nunc vitae mattis. Fusce leo diamfelis sed pulvinar elementum, metus eros eleifend urna, eu volutpat lectus sem in felis. In mattis urna justo, nec cursus mauris consectetur at. Vestibulum nec fringilla erat. Pellentesque cursus fermentum nunc vitae mattis.</p>
										</div> <!-- end .tab-panel -->
									</div> <!-- end .tab-content -->
								</div> <!-- end .tabpanel -->
							</div> <!-- end .col-sm-8 -->
							<div class="col-sm-4">
								<div class="buttons">
									<a href="#" class="border button dark">Download Manual</a>
									<a href="#" class="border button blue">Schedule A Test Drive</a>
								</div>
								<div class="price">$80000 <span>/ for sale</span></div>
								<div class="main-car-details">
									<div class="clearfix item">
										<div class="option">Year</div>
										<div class="option-content">2013</div>
									</div> <!-- end .item -->
									<div class="clearfix item">
										<div class="option">Make</div>
										<div class="option-content">Ferrari</div>
									</div> <!-- end .item -->
									<div class="clearfix item">
										<div class="option">Model</div>
										<div class="option-content">3-Series</div>
									</div> <!-- end .item -->
									<div class="clearfix item">
										<div class="option">Body Style</div>
										<div class="option-content">Sports Utility Vehicle</div>
									</div> <!-- end .item -->
									<div class="clearfix item">
										<div class="option">Mileage</div>
										<div class="option-content">3</div>
									</div> <!-- end .item -->
									<div class="clearfix item">
										<div class="option">Transmission</div>
										<div class="option-content">6-Speed Manual</div>
									</div> <!-- end .item -->
									<div class="clearfix item">
										<div class="option">Fuel Economy</div>
										<div class="option-content">32 city / 41 hwy</div>
									</div> <!-- end .item -->
									<div class="clearfix item">
										<div class="option">Condition</div>
										<div class="option-content">Brand New</div>
									</div> <!-- end .item -->
									<div class="clearfix item">
										<div class="option">Location</div>
										<div class="option-content">Toronto</div>
									</div> <!-- end .item -->
									<div class="clearfix item">
										<div class="option">Price</div>
										<div class="option-content">$55,000</div>
									</div> <!-- end .item -->
									<div class="clearfix item">
										<div class="option">DriveTrain</div>
										<div class="option-content">AWD</div>
									</div> <!-- end .item -->
									<div class="clearfix item">
										<div class="option">Engine</div>
										<div class="option-content">2.8L Straight Six</div>
									</div> <!-- end .item -->
									<div class="clearfix item">
										<div class="option">Exterior Color</div>
										<div class="option-content">Rhodium Silver Metallic</div>
									</div> <!-- end .item -->
									<div class="clearfix item">
										<div class="option">Interior Color</div>
										<div class="option-content">Alcantara Black</div>
									</div> <!-- end .item -->
									<div class="clearfix item">
										<div class="option">MPG</div>
										<div class="option-content">24 City MPG / 36 Hmy MPG</div>
									</div> <!-- end .item -->
									<div class="clearfix item">
										<div class="option">Stock Number</div>
										<div class="option-content">590178</div>
									</div> <!-- end .item -->
									<div class="clearfix item">
										<div class="option">Vin Number</div>
										<div class="option-content">WP0AB2A74AL092462</div>
									</div> <!-- end .item -->
								</div> <!-- end .main-car-details -->
							</div> <!-- end .col-sm-4 -->
						</div> <!-- end .row -->
					</div> <!-- end .car-details -->
					<div class="listings related-vehicles">
						<div class="clearfix heading"><h5>Related Vehicles</h5></div>
						<div class="clearfix listings-grid">
							<div class="listing">
								<div class="image"><a href="#"><img src="{{asset('img/website/listing01.jpg')}}" alt="listing" class="img-responsive"></a></div>
								<div class="content">
									<div class="title"><a href="#">Ferrari <span>[ Grand ]</span></a></div>
									<p>Lorem Ipsum is simply dummy text of the printing and typeset Ipsum has been the Off-road.</p>
									<div class="price">$80000 <span>/ for sale</span></div>
								</div>
							</div> <!-- end .listing -->
							<div class="listing">
								<div class="image"><a href="#"><img src="{{asset('img/website/listing01.jpg')}}" alt="listing" class="img-responsive"></a></div>
								<div class="content">
									<div class="title"><a href="#">Ferrari <span>[ Grand ]</span></a></div>
									<p>Lorem Ipsum is simply dummy text of the printing and typeset Ipsum has been the Off-road.</p>
									<div class="price green">$80000 <span>/ for rent</span></div>
								</div>
							</div> <!-- end .listing -->
							<div class="listing">
								<div class="image"><a href="#"><img src="{{asset('img/website/listing01.jpg')}}" alt="listing" class="img-responsive"></a></div>
								<div class="content">
									<div class="title"><a href="#">Ferrari <span>[ Grand ]</span></a></div>
									<p>Lorem Ipsum is simply dummy text of the printing and typeset Ipsum has been the Off-road.</p>
									<div class="price">$80000 <span>/ for sale</span></div>
								</div>
							</div> <!-- end .listing -->
							<div class="listing">
								<div class="image"><a href="#"><img src="{{asset('img/website/listing01.jpg')}}" alt="listing" class="img-responsive"></a></div>
								<div class="content">
									<div class="title"><a href="#">Ferrari <span>[ Grand ]</span></a></div>
									<p>Lorem Ipsum is simply dummy text of the printing and typeset Ipsum has been the Off-road.</p>
									<div class="price">$80000 <span>/ for sale</span></div>
								</div>
							</div> <!-- end .listing -->
						</div> <!-- end .listing-grid -->
					</div> <!-- end .listings -->
				</div> <!-- end .container -->
			</div> <!-- end .inner -->
		</section> <!-- end .section -->
@endsection
