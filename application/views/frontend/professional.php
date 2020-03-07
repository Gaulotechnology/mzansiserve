

     <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA2fZA6EQJe-qaGwnWFmEfI9ytECYC-BNY&callback=initMap"></script>
        <script type="text/javascript">
        //<![CDATA[
         
        var map;
        var base_url = "<?php echo base_url() ?>";
		var maps_array='<?php print_r(json_encode($professions)) ?>';
		
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
                         + '<br/>'     + location.profession_name
                         + '<br/>'     + location.description + '</div>';
          
         if (parseInt(location.geocodez) == null) {
             geocoder.geocode( { 'address': location.work_address }, function(results, status) {
                 if (status == google.maps.GeocoderStatus.OK) {
                      
                     var marker = new google.maps.Marker({
                         map: map, 
                         position: results[0].geometry.location,
                         title: location.profession_name
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
		<div class="container">
        <form action="<?php echo base_url() ?>page/professional/search" method="post">
			<div class="select-box">
				<div class="select-city-for-local-ads ads-list">
					<label>Select your city to see local ads</label>
						<select name="city">
												<optgroup label="Popular Cities">
													<option value="All" selected style="display:none;color:#eee;">Entire South Africa</option>
                                                    <?php 
                                                    
                                                    foreach($cities as $city){ ?>
                                                        <option value="<?php echo $city['id'] ?>"><?php echo $city['city'] ?></option>
                                                     <?php
                                                    }
                                                    
                                                    ?>
												</optgroup>
																								
													
			            </select>
				</div>
				<div class="browse-category ads-list">
					<label>Browse Categories</label>
					<select class="form-control" name="profession_name">
                                
                                    <optgroup label="Healthcare Practitioners and Technical Occupations:">
									<option selected="selected">Select Service</option>
                                     <option value="1">-  Chiropractor</option>
                                    <option value="2">-  Dentist</option>
                                    <option value="3">-  Dietitian or Nutritionist</option>
                                    <option value="4">-  Optometrist</option>
                                    <option value="5">-  Pharmacist</option>
                                    <option value="6">-  Physician</option>
                                    <option value="7">-  Physician Assistant</option>
                                    <option value="8">-  Podiatrist</option>
                                    <option value="9">-  Registered Nurse</option>
                                    <option value="10">-  Therapist</option>
                                    <option value="11">-  Veterinarian</option>
                                    <option value="12">-  Health Technologist or Technician</option>
                                    <option value="13">-  Other Healthcare Practitioners and Technical Occupation</option>
                                     </optgroup>
                                    <optgroup label="Healthcare Support Occupations:">
                                    <option value="14">-  Nursing, Psychiatric, or Home Health Aide</option>
                                    <option value="15">-  Occupational and Physical Therapist Assistant or Aide</option>
                                     <option value="16">-  Other Healthcare Support Occupation</option>
                                     </optgroup>
                                    <optgroup label="Business, Executive, Management, and Financial Occupations:">
                                    <option value="17">-  Chief Executive</option>
                                    <option value="18">-  General and Operations Manager</option>
                                    <option value="19">-  Advertising, Marketing, Promotions, Public Relations, and Sales Manager</option>
                                    <option value="20">-  Operations Specialties Manager (e.g., IT or HR Manager)</option>
                                    <option value="21">-  Construction Manager</option>
                                    <option value="22">-  Engineering Manager</option>
                                    <option value="23">-  Accountant, Auditor</option>
                                    <option value="24">-  Business Operations or Financial Specialist</option>
                                    <option value="25">-  Business Owner</option>
                                    <option value="26">-  Other Business, Executive, Management, Financial Occupation</option>
                                    </optgroup>
                                    <optgroup label="Architecture and Engineering Occupations:">
                                    <option value="27">-  Architect, Surveyor, or Cartographer</option>
                                    <option value="28">-  Engineer</option>
                                    <option value="29">-  Other Architecture and Engineering Occupation</option>
                                     </optgroup>
                                    <optgroup label="Education, Training, and Library Occupations:">
                                    <option value="30">-  Postsecondary Teacher (e.g., College Professor)</option>
                                    <option value="31">-  Primary, Secondary, or Special Education School Teacher</option>
                                    <option value="32">-  Other Teacher or Instructor</option>
                                    <option value="33">-  Other Education, Training, and Library Occupation</option>
                                    </optgroup>
                                     <optgroup label="Other Professional Occupations:">
                                    <option value="34">-  Arts, Design, Entertainment, Sports, and Media Occupations</option>
                                    <option value="35">-  Computer Specialist, Mathematical Science</option>
                                    <option value="36">-  Counselor, Social Worker, or Other Community and Social Service Specialist</option>
                                    <option value="37">-  Lawyer, Judge</option>
                                    <option value="38">-  Life Scientist (e.g., Animal, Food, Soil, or Biological Scientist, Zoologist)</option>
                                    <option value="39">-  Physical Scientist (e.g., Astronomer, Physicist, Chemist, Hydrologist)</option>
                                    <option value="40">-  Religious Worker (e.g., Clergy, Director of Religious Activities or Education)</option>
                                    <option value="41">-  Social Scientist and Related Worker</option>
                                    <option value="42">-  Other Professional Occupation</option>
                                    </optgroup>
                                    <optgroup label="Office and Administrative Support Occupations:">
                                    <option value="43">-  Supervisor of Administrative Support Workers</option>
                                    <option value="44">-  Financial Clerk</option>
                                    <option value="45">-  Secretary or Administrative Assistant</option>
                                    <option value="46">-  Material Recording, Scheduling, and Dispatching Worker</option>
                                    <option value="47">-  Other Office and Administrative Support Occupation</option>
                                    </optgroup>
                                    <optgroup label="Services Occupations:">
                                    <option value="48">-  Protective Service (e.g., Fire Fighting, Police Officer, Correctional Officer)</option>
                                    <option value="49">-  Chef or Head Cook</option>
                                    <option value="50">-  Cook or Food Preparation Worker</option>
                                    <option value="51">-  Food and Beverage Serving Worker (e.g., Bartender, Waiter, Waitress)</option>
                                    <option value="52">-  Building and Grounds Cleaning and Maintenance</option>
                                    <option value="53">-  Personal Care and Service (e.g., Hairdresser, Flight Attendant, Concierge)</option>
                                    <option value="54">-  Sales Supervisor, Retail Sales</option>
                                    <option value="55">-  Retail Sales Worker</option>
                                    <option value="56">-  Insurance Sales Agent</option>
                                    <option value="57">-  Sales Representative</option>
                                    <option value="58">-  Real Estate Sales Agent</option>
                                    <option value="59">-  Other Services Occupation</option>
                                    </optgroup>
                                    <optgroup label="Agriculture, Maintenance, Repair, and Skilled Crafts Occupations:">
                                     <option value="60">-  Construction and Extraction (e.g., Construction Laborer, Electrician)</option>
                                    <option value="61">-  Farming, Fishing, and Forestry</option>
                                    <option value="62">-  Installation, Maintenance, and Repair</option>
                                    <option value="63">-  Production Occupations</option>
                                    <option value="64">-  Other Agriculture, Maintenance, Repair, and Skilled Crafts Occupation</option>
                                    </optgroup>
                                    <optgroup label="Transportation Occupations:">
                                    <option value="65">-  Aircraft Pilot or Flight Engineer</option>
                                    <option value="66">-  Motor Vehicle Operator (e.g., Ambulance, Bus, Taxi, or Truck Driver)</option>
                                    <option value="67">-  Other Transportation Occupation</option>
                                    </optgroup>
                                     <optgroup label="Other Occupations:">
                                    <option value="68">-  Military</option>
                                    <option value="69">-  Homemaker</option>
                                    <option value="70">-  Other Occupation</option>
                                    <option value="71">-  Don't Know</option>
                                    <option value="72">-  Not Applicable</option>
                                    </optgroup>

                                </select>
				</div>
				<div class="search-product ads-list">
					<label>Search for a specific professional service</label>
					<div class="search">
						<div id="custom-search-input">
						<div class="input-group">
							<input type="text" class="form-control input-lg" name="company_name" placeholder="company name" />
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
            <?php 
           
            if(isset($professions)){
             
              
                ?>
              <?php //if(isset($maps)): ?>
			<body onload="init();">
			<section id="main">
            <div id="map_canvas" style="width: 100%; height: 500px;"></div>
             </section>
                </body>
                
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
                            <?php foreach($professions as $row): ?>
								<a href="<?php echo base_url() ?>page/single_profession/<?php echo $row->profession_id ?>">
									<li>
									<section class="list-left">
									<h5 class="title"><?php echo $row->title ?></h5>
									<p class="catpath"><?php echo $category->name ?> » Other Services</p>
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
	