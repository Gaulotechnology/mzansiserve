
	 <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA2fZA6EQJe-qaGwnWFmEfI9ytECYC-BNY&callback=initMap"></script>
        <script type="text/javascript">
        //<![CDATA[
         
        var map;
        var base_url = "<?php echo base_url() ?>";
		var maps_array='<?php print_r(json_encode($services)) ?>';
		
        // Ban Jelačić Square - Center of Zagreb, Croatia
        var center = new google.maps.LatLng(-26.270760, 28.112268);
         
        var geocoder = new google.maps.Geocoder();
        var infowindow = new google.maps.InfoWindow();
         
        function init() {
             
            var mapOptions = {
                zoom: 5,
                center: center,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            }
             
            map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
             
           

           // makeRequest(base_url + 'page/get_locations', function(data) {
             
             var data = JSON.parse(maps_array);
              
             for (var i = 0; i < data.length; i++) {
                 displayLocation(data[i]);
             }
        // });
        }
        function displayLocation(location) {
			
         var content =   '<div class="infoWindow"><strong>'  + location.title + '</strong>'
                         + '<br/>'     + location.service_name
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
	<div class="banner text-center">
    <div class="container">    
			<h1>Easiest way to get to the next point Bringing services to you</h1>
			<p></p>
			<div class="col-md-4"></div>
			<div class="col-md-4">
			<a href="<?php echo base_url('page/login') ?>" style="width:50%;">Add Service</a>
			<a style="background:#01a115;"  data-toggle="modal" data-target="#modal-default" style="width:50%;">Request Service</a>
			</div>
			<div class="col-md-4"></div>
						</div>
	</div>
	<!-- Services -->
	<div class="total-ads main-grid-border">
	<form action="<?php echo base_url() ?>page/service_provider/search" method="post">
		<div class="container">
			<div class="select-box">
				<div class="select-city-for-local-ads ads-list">
					<label>Select your city to see local ads</label>
						<select name="city">
												
												<optgroup label="Popular Cities">
													<option selected style="display:none;color:#eee;">Entire South Africa</option>
													<option >Durban</option>
													<option >Petersburg</option>
													<option >Pretoria</option>
													<option >Sandton</option>
													<option >Petermaritzburg</option>
													<option >Johannesburg</option>
													
												</optgroup>
													
												
																								
													
			            </select>
				</div>
				<div class="browse-category ads-list">
					<label>Browse Categories</label>

					<select  class="form-control" name="service_name" placeholder="" required >
					<option selected="selected">Select Service</option>
                                <option>Tutor</option>
                                <option>Private Nurse</option>
                                <option>Event Manager</option>
                                <option>DJ & intertainment</option>
                                <option>Sound Rental</option>
                                <option>Party Venue</option>
                                <option>Home & Garden Services</option>
                                <option>Child caretaker</option>
                                <option>Musicians & artist</option>
                                <option>Aplliance repairs</option>
                                <option>Cleaning services</option>
                                <option>DSTV maintatence</option>
                                <option>Electronics & IT services</option>
                                <option>Health & beauty</option>
                                <option>Salon</option>
                                <option>Catering</option>
                                <option>Chef</option>
                                <option>Sports & fitness Personal trainers</option>
                                <option>Security & Emergency Services</option>
                                <option>Travel & Tourism</option>
                                <option>Warehousing & Logistics</option>
                                <option>Other services</option>
                                </select>
				</div>
				<div class="search-product ads-list">
					<label>Search for a specific professional service</label>
					<div class="search">
						<div id="custom-search-input">
						<div class="input-group">
							<input type="text" class="form-control input-lg" placeholder="Tutor" name="anything" />
							<span class="input-group-btn">
								<button class="btn btn-info btn-lg" type="submit">
									<i class="glyphicon glyphicon-search"></i>
								</button>
							</span>
						</div>
					</div>
					</div>
				</div>
				</form>
				<div class="clearfix"></div>
			</div>
			<ol class="breadcrumb" style="margin-bottom: 5px;">
			  <li><a href="index.html">Home</a></li>
			  <li><a href="categories.html">Categories</a></li>
			  <li class="active">Services</li>
			</ol>
			
			<div class="ads-grid">
			
			<?php if(isset($services)){
               
			   ?>
			 <?php 
			
			 //if(isset($maps)): ?>
			   <body onload="init();">
		   <section id="main">
		   <div id="map_canvas" style="width: 100%; height: 500px;"></div>
			</section>
			   </body>
			 <?php 
			  ///print_r($services);
			foreach($services as $row): 
										?>
		 
			 <?php endforeach; ?>
		   <?php //endif; ?>
			   <div class="ads-display col-md-12">
				   <div class="wrapper">					
				   <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
					 <ul id="myTab" class="nav nav-tabs nav-tabs-responsive" role="tablist">
					 </ul>
					 <div id="myTabContent" class="tab-content">
					   <div role="tabpanel" class="tab-pane fade in active" id="home" aria-labelledby="home-tab">
						  <div>
							 <div id="container">
							   <div class="view-controls-list" id="viewcontrols">
								   <label>view :</label>
								   <a class="gridview"><i class="glyphicon glyphicon-th"></i></a>
								   <a class="listview active"><i class="glyphicon glyphicon-th-list"></i></a>
							   </div>
							   <div class="clearfix"></div>
						   <ul class="list">
						   <?php foreach($services as $row): 
							
							 ?>
							   <a href="<?php echo base_url() ?>page/single_provider/<?php echo $row->provider_id ?>">
								   <li>
								   <section class="list-left">
								   <h5 class="title"><?php echo $row->title ?></h5>
								   <p class="catpath"><?php echo $category->name ?> » <?php echo $row->service_name ?></p>
								   <p class="catpath"><?php echo $row->description ?> </p>
								   <p class="catpath">Rating:
								   <i class="fa fa-star"></i>
								   <i class="fa fa-star"></i>
								   <i class="fa fa-star-half-o"></i>
								   <i class="fa fa-star-o"></i>
								   <i class="fa fa-star-o"></i>
									   </p>
								   </section>
								   <section class="list-right">
								   <span class="date">200M Away</span>
								   <span class="cityname"><?php echo $row->province ?></span>
								   <p>
								   <span class="cityname"><button type="button" class="btn btn-success">request now</button></span>
								   </section>
								   <div class="clearfix"></div>
								   </li> 
							   </a>
							   
							   <?php endforeach ?>
						   
						   </ul>
					   </div>
						   </div>
					   </div>
					   <?php echo $this->pagination->create_links(); ?>
					 </div>
				   </div>
			   </div>
			   </div>
			   <div class="clearfix"></div>
		   </div>
											   <?php  }?>
		   <!-- section end -->
		</div>	
	</div>
	