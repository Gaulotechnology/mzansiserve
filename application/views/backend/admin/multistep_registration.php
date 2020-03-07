
      <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/bootstrap.css">
      <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/multiform.css">
      <link href="https://fonts.googleapis.com/css?family=Montaga|Montserrat" rel="stylesheet">
      <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 400px;
        width: 100%;
      }
      /* Optional: Makes the sample page fill the window. */

      #floating-panel {
     
        top: 10px;
        left: 25%;
        z-index: 5;
        background-color: #fff;
        padding: 5px;
        text-align: center;
        font-family: 'Roboto','sans-serif';
        line-height: 30px;
        padding-left: 10px;
      }
    </style>
      <div class="row">
	  
	  <?php 
                   
	    foreach($edit_data as $row){
					 
					   ?>
         <div class="col-md-10 col-md-offset-1">
            <div id="main_form">
               <ul id="p_bar">
                  <li class="active">Personal Details</li>
				  <li >Company_details</li>
				  <li >Profession</li>
                  <li >Account Setup</li>
			   </ul>
			   <div class="col-md-11 col-md-offset-1">
			   <div class="info-box bg-green">
            <span class="info-box-icon"><i class="fa fa-bookmark-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Registration</span>
              <span class="info-box-number">70%</span>

              <div class="progress">
                <div class="progress-bar" style="width: 70%"></div>
              </div>
                  <span class="progress-description">
                    70% complete, services will only work upon completion
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
		  <!-- /.info-box -->
				   </div>
			   <?php echo form_open(base_url() . 'page/multistep_registration/update_profile_info' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top' , 'enctype' => 'multipart/form-data'));?>
               <fieldset class="f1">
                  <h2 class="m_head">Personal Details</h2>
                  <h4 class="s_head">Tell us something more about you</h4>
				  <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="name" value="<?php echo $row['fullname'];?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo "surname" ?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="surname" value="<?php echo $row['surname'];?>"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('email');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="email" value="<?php echo $row['email'];?>"/>
                                </div>
                            </div>
                            <?php if($role>1){ ?>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo "Date Of Birth" ?></label>
                                <div class="col-sm-5">
                                    <input type="date" class="form-control" name="dob" value="<?php echo $docs->dob ?>" placeholder="2018/12/11" required  />
                                </div>
							</div>
						
              <!-- /.form group -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo "Nationality" ?></label>
                                <div class="col-sm-5">
                                <select name="country" id="country" class="form-control" required>
					                <option selected="selected" value="2">Select Country</option>
					                 <?php foreach($nationality as $nat){ ?>
					                <option value="<?php echo $nat->iso_code_2 ?>">  <?php echo $nat->name ?></option>
					  
					                 <?php } ?>
					            </select>
                                </div>
                            </div>

                            <script>
                            $( document ).ready(function() {
                                $("#id_number").hide();
                                $("#passport_number").hide();
                            
                                $('#identity').on('change', function() {
                                                var value = $(this).val();
                                            
                                                if(value=="ID"){
                                                    $("#id_number").show();
                                                    $("#passport_number").hide();
                                                }  
                                                if(value=="PASS"){
                                                    $("#id_number").hide();
                                                    $("#passport_number").show();
                                                }  
                                                });
                                            });
                                </script>  
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Identity</label>
                                <div class="col-sm-4">
                                   <select id="identity" class="form-control" required>
                                   <option value="ID">Identity Number</option>
                                   <option value="PASS">Passport</option>
                                   </select>    
                                  
                                </div>
                            </div>
                            <div class="form-group" id="id_number">
                                <label class="col-sm-3 control-label"><?php echo "Identity Number" ?></label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="id_number"  value="<?php echo $docs->id_number ?>" required />
                                </div>
                                <div class="col-sm-2">
                                    <input type="file"  name="id_copy"  required />Attach copy
                                </div>
                            </div>
                            <div id="passport_number">
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo "Passport issuer" ?></label>
                                <div class="col-sm-5">
                                <select name="passport_issuer" id="country" class="form-control" required>
					                <option selected="selected" value="2">Select Country</option>
                                    <option value="2">South Africa</option>
					                 <?php foreach($nationality as $nat){ ?>
					                <option value="<?php echo $nat->iso_code_2 ?>">  <?php echo $nat->name ?></option>
					  
					                 <?php } ?>
					            </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo "Passport number" ?></label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="passport_number"  value="<?php echo $docs->passport_number ?>" required />
                                </div>
                                <div class="col-sm-2">
                                    <input type="file"  name="passport_copy"  required />Attach copy
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo "Passport expiration" ?></label>
                                <div class="col-sm-5">
                                    <input type="date" class="form-control" name="passport_expiry"  value="<?php echo $docs->passport_expiration ?>" required />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo "Physical Address" ?></label>
                                <div class="col-sm-5">
                                  <textarea name="physical_address" class="form-control"><?php echo $docs->physical_address ?>
                                </textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo "Proof of residence" ?></label>
                                <div class="col-sm-5">
                                    <input type="file"  name="residence_proof"  value="<?php echo $docs->residence_proof ?>" required />
                                </div>
                            </div>
                            </div>

							<!-- EMERGENCY CONTACT -->
								<div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo "Emergency Contacts" ?></label>
                                <div class="col-sm-9" >
                                <select type="text" class="form-control" id="emergency" style="width:200px;"  required >
                                <option value="none">None</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                                        <script>
                                         $('#emergency').on('change', function() {
                                                var value = $(this).val();
                                                $("#EmergencyContacts").empty();
                                                if(value!="none"){
                                                $("#EmergencyContacts").append("<label>Emergency Contact Numbers</label>"); 
                                                for( var i=0; i<value; i++){
                                                $("#EmergencyContacts").append("<input class='form-control' type='text' name='em_name[]' style='width:300px;' placeholder='contact name'><input class='form-control' type='text' placeholder='contact number' name='em_number[]'><br>");   
                                                } }  
                                                });
                                        </script>
                                </div>
                                <label class="col-sm-3 control-label"></label>
                                <div class="col-sm-5">
                                    <div id="EmergencyContacts">
                                
                                    </div>
                                </div>
                            </div>  
                            <?php if($role>2) {
                                ?>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo "Reference Details" ?></label>
                                <div class="col-sm-9" >
                                <select type="text" class="form-control" id="referrals" style="width:200px;"  required >

                                    <option value="2" selected="selected">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                                        <script>
                                         $('#referrals').on('change', function() {
                                                var value = $(this).val();
                                                $("#NumberContacts").empty();
                                                if(value!="none"){
                                                $("#NumberContacts").append("<label>Contact Numbers</label>"); 
                                                for( var i=0; i<value; i++){
                                                $("#NumberContacts").append("<input class='form-control' type='text' name='referral_name[]' style='width:300px;' placeholder='contact name'><input class='form-control' type='text' placeholder='contact number' name='referral_number[]'><br>");   
                                                } }  
                                                });
                                        </script>
                                </div>
                                <label class="col-sm-3 control-label"></label>
                                <div class="col-sm-5">
                                    <div id="NumberContacts">
                                
                                    </div>
                                </div>
                            </div>  
                            <?php  
                            }
                            ?>
                             <!-- EMERGENCY CONTACT -->
                             <div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('photo');?></label>
                                
                                <div class="col-sm-5">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                                            <img src="<?php echo $this->crud_model->get_image_url('users' , $row['user_id']);?>" alt="...">
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                                        <div>
                                            <span class="btn btn-white btn-file">
                                                <span class="fileinput-new">Select image</span>
                                                <span class="fileinput-exists">Change</span>
                                                <input type="file" name="userfile" accept="image/*">
                                            </span>
                                            <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             <!-- TERMS -->
						<?php } ?>
                  <div class="form-group" >
                     <button type="button" class="btn btn-primary btn-lg next1">Next</button>
                  </div>
               </fieldset>
               <fieldset class="f2">
                  <h2 class="m_head">Company Details</h2>
                  <h4 class="s_head" >Your presence on social network</h4>
                   <!-- COMPANY DETAILS -->  
				   <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo "Enter Work Address" ?></label>
                    <div class="col-sm-9">
                                 
                                    <!--- MAPS -->

                                    <div id="floating-panel">
      <textarea id="address" type="textbox" style="width:100%;">Johannesburg, RSA</textarea>
      <input type="hidden"  id="geocodez" name="geocodez" >
      <input id="submit" type="button" value="Geocode" style="visibility:hidden;">
    </div>
    <div id="map"></div>
    <script>

   
 
      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 8,
          center: {lat: -26.2041028, lng: 28.047305100000017}
        });
        var geocoder = new google.maps.Geocoder();

        document.getElementById('submit').addEventListener('click', function() {
          geocodeAddress(geocoder, map);
        });
        $( "#address" ).on( "mouseleave", function() {
        geocodeAddress(geocoder, map);
    
  });
      }

      function geocodeAddress(geocoder, resultsMap) {
        var address = document.getElementById('address').value;
        geocoder.geocode({'address': address}, function(results, status) {
         //alert(results[0].geometry.location);
          if (status === 'OK') {
            $( "#geocodez" ).val(results[0].geometry.location);
            resultsMap.setCenter(results[0].geometry.location);
            var marker = new google.maps.Marker({
              map: resultsMap,
              position: results[0].geometry.location
            });
          } else {
            alert('Geocode was not successful for the following reason: ' + status);
          }
        });
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA2fZA6EQJe-qaGwnWFmEfI9ytECYC-BNY&callback=initMap">
    </script>



                                    <!-- MAPS -->


                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo "Work Tel" ?></label>
                                <div class="col-sm-5">
                                <input type="text" class="form-control" name="company_phone"  value="<?php echo $docs->company_phone ?>" required />
                                </div>
                            </div>  
                             
                         
                            <?php if($role>ROLE_USER) { ?>
                            <!-- COMPANY DIRECTORS -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo "Company Directors" ?></label>
                                <div class="col-sm-9" >
                                <select type="text" class="form-control" id="directors" style="width:200px;"  required >
                                <option value="none">None</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                                        <script>
                                         $('#directors').on('change', function() {
                                                var value = $(this).val();
                                                $("#CompanyDirectors").empty();
                                                if(value!="none"){
                                                $("#CompanyDirectors").append("<label>Director Details</label>"); 
                                                for( var i=0; i<value; i++){
                                                $("#CompanyDirectors").append("<input class='form-control' type='text' name='director_name[]' style='width:300px;' placeholder='contact name'><input class='form-control' type='text' placeholder='contact number' name='director_number[]'><br>");   
                                                } }  
                                                });
                                        </script>
                                </div>
                                <label class="col-sm-3 control-label"></label>
                                <div class="col-sm-5">
                                    <div id="CompanyDirectors">
                                
                                    </div>
                                </div>
						
							
							<?php } ?>
                  <div class="form-group" >
                     <button  type="button" class="btn btn-primary btn-lg previous1">Previous</button>
                     <button  type="button" class="btn btn-primary btn-lg next2 ">Next</button>
				  </div>
			   </fieldset>
			  
               <fieldset class="f3">
				  <?php if($role==ROLE_DRIVER){
								?>
					
					<h2 class="m_head">Driver Details</h2>
				  <h4 class="s_head" >Your presence on social network</h4>
                <!-- Driver Details Box -->
				  <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo "Vehicle Model" ?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="vehicle_model" required />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo "Vehicle Registration" ?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="vehicle_number" required />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo "Car ownership docs" ?></label>
                                <div class="col-sm-5">
                                    <input type="file"  name="vehicle_docs" required />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo "Proof of Insurance" ?></label>
                                <div class="col-sm-5">
                                    <input type="file"  name="insurance_docs" required />
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo "Drivers Licence Number" ?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="driver_licence"  value="<?php echo $docs->driver_licence ?>" required />
                                </div>
                            </div>
                           
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo "Company Registration Number" ?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="registration_number" required />
                                </div>
							</div>
							<div class="form-group" >
                     <button type="button"  class="btn btn-primary btn-lg previous2">Previous</button>
                     <button type="button"  class="btn btn-primary btn-lg next3 ">Next</button>
				  </div>
				 
							<?php } ?>
                          
							<?php if($role==ROLE_PROFESSIONAL){ ?>
								
								<h2 class="m_head">Profession Details</h2>
				  				<h4 class="s_head" >Your presence on social network</h4>
                            <!-- Professional Service Details Box -->
							<div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo "Qualification" ?></label>
                                <div class="col-sm-5">
                                <select class="form-control" name="qualification">
                                    <option>Certificates</option>
                                    <option>Advanced Certificates</option>
                                    <option>National Higher Certificates</option>
                                    <option>Diplomas</option>
                                    <option>National Professional Diplomas</option>
                                    <option>Bachelor’s degrees</option>
                                    <option>Honours Degree</option>
                                    <option>Master's Degree</option>
                                    <option>Doctoral Degree</option>
                                    <option>Other</option>
                                </select>
                                </div>
                            </div>  
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo "Year of Completion" ?></label>
                                <div class="col-sm-5">
                                <select class="form-control" name="year_completion">
                                <?php $start=date("Y"); 
                                      $end=$start-40; 
                                      for($i=$start;$i>$end ;$i--){
                                          echo "<option>$i</option>";
                                      }
                                      ?>
                                    
                                </select>
                                </div>
                            </div>  

                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo "Institution" ?></label>
                                <div class="col-sm-5">
                                <input type="text" class="form-control" name="institution" required />
                                </div>
                            </div>  
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo "Professional Body" ?></label>
                                <div class="col-sm-5">
                                <input type="text" class="form-control" name="professional_body" required />
                                </div>
                            </div>  

                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo "Profession Reg Number" ?></label>
                                <div class="col-sm-5">
                                <input type="text" class="form-control" name="practice_number" placeholder="Practice Number" required />
                                </div>
                            </div>  

                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo "Name of Profession" ?></label>
                                <div class="col-sm-5">
                                 <select class="form-control" name="profession_name">
                                
                                    <optgroup label="Healthcare Practitioners and Technical Occupations:">
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
                          </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo "Speciality/ Subject" ?></label>
                                <div class="col-sm-5">
                                <input type="text" class="form-control" name="subject_specialty" placeholder="" required />
                                </div>
							</div>  
							
                            
							<?php } ?>


                  
									
						<?php if($role==ROLE_PROVIDER){ ?>
					
								<h2 class="m_head">Service Providers</h2>
				  				<h4 class="s_head" >Your presence on social network</h4>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo "Services" ?></label>
                                <div class="col-sm-5">
                                <select  class="form-control" name="service_name" placeholder="" required >
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
                            </div>  

                   
                            <?php } ?>
                            <div class="form-group" >
                     <button type="button"  class="btn btn-primary btn-lg previous2">Previous</button>
                     <button type="button"  class="btn btn-primary btn-lg next3 ">Next</button>
                    </div>
							</fieldset>
                            <!-- SERVICES PROVIDER -->
								


               <fieldset class="f4">
                  <h2 class="m_head">Payment Details</h2>
                  <h4 class="s_head" >Add Payment Details</h4>
                 
                            <!-- CREDIR CARD -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo "Card type" ?></label>
                                <div class="col-sm-5">
                                <select class="form-control" name="card_type" required >
                                <?php foreach($card_types as $card) : ?>
                                    <option value="<?php echo $card->id; ?>"><?php echo $card->name; ?></option>
                                <?php endforeach; ?>
                                </select>
                                </div>
                            </div>  
                            <div class="form-group">
                         
                                <label class="col-sm-3 control-label"><?php echo "Card Name" ?></label>
                                <div class="col-sm-5">
                                <input type="text" class="form-control" name="card_holder" value=" <?php echo $payment_details->card_holder; ?>" placeholder="" required />
                                </div>
                            </div>  
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo "Card Number" ?></label>
                                <div class="col-sm-5">
                                <input type="text" class="form-control" name="card_number" value="<?php echo $payment_details->card_number; ?>" min="16" maxlength="16" placeholder="" required />
                                </div>
                            </div>  
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo "Card Expiry" ?></label>
                                <div class="col-sm-3">
                                <select type="text" class="form-control  col-md-1" name="expiry_month" placeholder="YYYY" style="width:200px;" value="<?php echo $payment_details->card_expiration; ?>" required >
                                        <?php 
                                        $start=1;
                                        $end=12;
                                        echo "<option>Select Month</option>";
                                        for($i=$start; $i<=$end; $i++ ){
                                            echo "<option>".$i."</option>";
                                        }
                                        
                                        ?>
                                        </select> 
                              
                           
                                <select type="text" class="form-control col-md-1" name="expiry_year" placeholder="YYYY" style="width:200px;" required >
                                        <?php 
                                        $start=date("Y");
                                        $end=$start+10;
                                        echo "<option>Select Year</option>";
                                        for($i=$start; $i<=$end; $i++ ){
                                            echo "<option>".$i."</option>";
                                        }
                                        
                                        ?>
                                </select>  
                               
                                </div>
                            </div>  
                   
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo "Card CVV Number" ?></label>
                                <div class="col-sm-5">
                                <input type="text" class="form-control"  name="cvv_number" placeholder="" value="<?php echo $payment_details->cvv; ?>" min="3" maxlength="3" required />
                                </div>
                            </div>  
                            <!-- CREDIR CARD -->
                  <div class="form-group">
                     <button  type="button" class="btn btn-primary btn-lg previous3">Previous</button>
                     <button class="btn btn-primary btn-lg submit">Submit</button>
                  </div>
			   </fieldset>
			   </form>
            </div>
		 </div>
									<?php } ?>
      </div>
      <script src="<?php echo base_url() ?>assets/js/jquery-2.2.3.min.js"></script>
      <script type="text/javascript" src="<?php echo base_url() ?>assets/js/multiform.js"></script>
  