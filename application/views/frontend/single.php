
	<style>
       /* Set the size of the div element that contains the map */
      #map {
        height: 400px;  /* The height is 400 pixels */
        width: 100%;  /* The width is the width of the web page */
       }
    </style>

	
	<!--single-page-->
	<div class="single-page main-grid-border">
		<div class="container">
			<ol class="breadcrumb" style="margin-bottom: 5px;">
				<li><a href="index.html">Home</a></li>
				<li><a href="all-classifieds.html">All Ads</a></li>
				<li class="active"><a href="<?php echo base_url() ?>mobiles">Mobiles</a></li>
				<li class="active"><?php echo $provider[0]->service_name; ?></li>
			</ol>
			<div class="product-desc">
				<div class="col-md-7 product-view">
					<h2><?php echo $provider[0]->service_name; ?></h2>
					<p> <i class="glyphicon glyphicon-map-marker"></i><a href="#"><?php echo $provider[0]->country ?></a>, <a href="#">city</a>| Added at <?php echo date("Y-m-d H:i:s", $provider[0]->ad_date); ?>, Ad ID: <?php echo $provider[0]->provider_id ?></p>
					<div class="flexslider">
						<ul class="slides">
							<li data-thumb="<?php echo base_url() ?>assets/homepage/images/ss1.jpg">
								<img src="<?php echo base_url() ?>assets/homepage/images/ss1.jpg" />
							</li>
							<li data-thumb="<?php echo base_url() ?>assets/homepage/images/ss2.jpg">
								<img src="<?php echo base_url() ?>assets/homepage/images/ss2.jpg" />
							</li>
							<li data-thumb="<?php echo base_url() ?>assets/homepage/images/ss3.jpg">
								<img src="<?php echo base_url() ?>assets/homepage/images/ss3.jpg" />
							</li>
						</ul>
					</div>
					<!-- FlexSlider -->
					  <script defer src="js/jquery.flexslider.js"></script>
					<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" />

						<script>
					// Can also be used with $(document).ready()
					$(window).load(function() {
					  $('.flexslider').flexslider({
						animation: "slide",
						controlNav: "thumbnails"
					  });
					});
					</script>
					<!-- //FlexSlider -->
					<div class="product-details">
						<h4>Company : <a href="#"><?php echo $provider[0]->title; ?></a></h4>
						<h4>Views : <strong>150</strong></h4>
						<p><strong>Display </strong>: <?php echo $provider[0]->title; ?></p>
						<p><strong>Summary</strong> : <?php echo $provider[0]->description; ?></p>
					
					</div>
					<div class="col-md-12 product-view">
					
					<div id="map"></div>
    <script>
// Initialize and add the map
function initMap() {
  // The location of Uluru
  var uluru = {lat: -26.0232035, lng: 27.9135218};
  // The map, centered at Uluru
  var map = new google.maps.Map(
      document.getElementById('map'), {zoom: 4, center: uluru});
  // The marker, positioned at Uluru
  var marker = new google.maps.Marker({position: uluru, map: map});
}
    </script>
    <!--Load the API from the specified URL
    * The async attribute allows the browser to render the page while the API loads
    * The key parameter will contain your own API key (which is not needed for this tutorial)
    * The callback parameter executes the initMap() function
    -->
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA2fZA6EQJe-qaGwnWFmEfI9ytECYC-BNY&callback=initMap">
    </script>
					
					</div>
					<div class="col-md-12 product-view">
					<h3>All adverts and pics come here</h3>
					<div class="clearfix"></div>
				<p>
					<?php 
					
					$images=json_decode($provider[0]->service_images);
					foreach($images as $image){
					echo "<div class='col-md-4 product-view'  >
					<img src=".base_url().$image." style='height:200px; height:200px;'></div>";
					}
					?>
					
					</div>
				</div>
			
				<div class="col-md-5 product-details-grid">
					<div class="item-price">
						<div class="product-price">
							<p class="p-price">Service Category</p>
							<h3 class="rate"></h3>
							<div class="clearfix"></div>
						</div>
						<div class="condition">
							<p class="p-price">Business Hours</p>
							<h4>8am to 5 pm</h4>
							<div class="clearfix"></div>
						</div>
						<div class="itemtype">
							<p class="p-price">Service Type </p>
							<h4><?php echo $provider[0]->service_name; ?></h4>
							<div class="clearfix"></div>
						</div>
					</div>
					<div class="interested text-center">
						<h4>Interested in this service<small> Contact the provider</small></h4>
						<p><i class="glyphicon glyphicon-earphone"></i><?php echo maskPhoneNumber($provider[0]->cellphone); ?></p>
					</div>
						<div class="tips">
						<h4>Safety Tips for users</h4>
							<ol>
								<li><a href="#">Contrary to popular belief.</a></li>
								<li><a href="#">Contrary to popular belief.</a></li>
								<li><a href="#">Contrary to popular belief.</a></li>
								<li><a href="#">Contrary to popular belief.</a></li>
							
							</ol>
						</div>
				</div>
			
			<div class="clearfix"></div>
		
			</div>
		</div>
	</div>
	<!--//single-page-->