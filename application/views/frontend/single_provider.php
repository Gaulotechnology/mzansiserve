
	

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA2fZA6EQJe-qaGwnWFmEfI9ytECYC-BNY&callback=initMap"></script>
        <script type="text/javascript">
        //<![CDATA[
         
        var map;
        var base_url = "<?php echo base_url() ?>";
		var maps_array='<?php print_r(json_encode($provider[0])) ?>';
		
        // Ban Jelačić Square - Center of Zagreb, Croatia
        var center = new google.maps.LatLng(-26.270760, 28.112268);
      
        var geocoder = new google.maps.Geocoder();
        var infowindow = new google.maps.InfoWindow();
         
        function init() {
			
            var mapOptions = {
                zoom: 10,
                center: center,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            }
             
            map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
             
			
			var data = JSON.parse(maps_array);
          
			alert(JSON.stringify(maps_array));
            
			
			
			
                 displayLocation(maps_array);
      
        }
        function displayLocation(location) {
		
         var content =   '<div class="infoWindow" style="width:100px; height:200px;"><strong>'  + location.title + '</strong>'
                         + '<br/>'     + location.service_name
						 + '<br/><a href="#">'     + 'View More' + '</a>' 
                         + '<br/>'     + location.description + '</div>';
						
         if (parseInt(location.geocodez) == null) {
             geocoder.geocode( { 'address': location.work_address }, function(results, status) {
                 if (status == google.maps.GeocoderStatus.OK) {
                      
                     var marker = new google.maps.Marker({
                         map: map, 
                         position: results[0].geometry.location,
                         title: location.service_name
                     });
                      
                     google.maps.event.addListener(marker, 'click', function() {
                         infowindow.setContent(content);
                         infowindow.open(map,marker);
                     });
                 }
             });
         } else {
			 if(location.geocodez!=null){
				var pos_segs = location.geocodez.split(', ');
				
			
             var position = new google.maps.LatLng(parseFloat(pos_segs['0']), parseFloat(pos_segs['1']));
            
			 var marker = new google.maps.Marker({
                 map: map, 
                 position: position,
                 title: location.title
             });
              
             google.maps.event.addListener(marker, 'click', function() {
                 infowindow.setContent(content);
                 infowindow.open(map,marker);
             });
			}
         }
     }
        function makeRequest(url, callback) {
	
    if (window.XMLHttpRequest) {
        request = new XMLHttpRequest(); // IE7+, Firefox, Chrome, Opera, Safari
    } else {
        request = new ActiveXObject("Microsoft.XMLHTTP"); // IE6, IE5
    }
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            callback(request);
        }
    }
    request.open("GET", url, true);
    request.send();
}
        //]]>
        </script>

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
					
					
					<body onload="init();">
					<section id="main">
            		<div id="map_canvas" style="width: 100%; height: 500px;"></div>
             		</section>
                	</body>
					
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