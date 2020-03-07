
	

						<!-- Submit Ad -->
	<div class="submit-ad main-grid-border">
		<div class="container">
		
					<div class="sign-up">
						<h1>Create an account</h1>
						<p class="creating">Having hands on experience in creating innovative designs,I do offer design 
							solutions which harness.</p>
									
					</div>

			<div class="post-ad-form">
			<div class="text-danger" style="text-align:center;"><?php  echo $this->session->flashdata('accept_terms') ?></div>
			<br>
							
          <!-- /.box -->
				<form id="signup-form" method="post" action="<?php echo base_url('login/register/create') ?>">
				
				<label>User Type <span>*</span></label>
					<select name="level" id="level">
					  <option selected="selected" value="2">User</option>
					  <option value="3">Driver</option>
					  <option value="4">Professional</option>
					  <option value="5">Service Provider</option>
					</select>
					<div class="clearfix"></div>

				
					<label>Fullnames <span>*</span></label>
					<input type="text" name="fullname" id="username" class="phone" required>
					<div class="clearfix"></div>
		
					<label>Surname <span>*</span></label>
					<input type="text" name="surname" required>
					<div class="clearfix"></div>

			
					<label>Your Email Address<span>*</span></label>
					<div class="text-danger" id="email_info"> </div>
					<input type="text" class="email" id="email" name="email"  required pattern="^\S+@\S+\.\S+$" title="example@mail.com">
					<div class="clearfix"></div>	
				
					<label>Cell Number<span>*</span></label>
					<input type="tel" class="phone" name="cellphone" min="10" placeholder="" required>
					<div class="clearfix"></div>

					<label>Country<span>*</span></label>
					<select name="country" id="country" required>
					  <option selected="selected" value="2">Select Country</option>
					  <?php foreach($countries as $country){ ?>
					  <option value="<?php echo $country->iso_code_2 ?>">  <?php echo $country->name ?></option>
					  
					  <?php } ?>
					</select>
					<div class="clearfix"></div>

					<!--  PROVINCES -->
					<div class="provinces" id="provinces">

					<label>Province<span>*</span></label>
					<select name="province" id="province" required>
					  <option selected="selected">Eastern Cape</option>
					  <option >Free State</option>
					  <option >Gauteng</option>
					  <option >KwaZulu-Natal</option>
					  <option >Limpopo</option>
					  <option >Mpumalanga</option >
					  <option >Northern Cape</option >
					  <option >North West</option >
					  <option >Western Cape</option >
					  
					  
					</select>
					<div class="clearfix"></div>
					</div>
			   <!-- PROVINCES -->
					
					
					<label>password <span>*</span></label>
					<div class="text-danger" id="password-strength-status" ></div>
					<input type="password" class="phone"  id="password" name="password" placeholder="" autocomplete="off" required>
					<div class="clearfix"></div>
					
					<label>Confirm Password <span>*</span></label>
					<div class="text-danger" id="cpassword_info"> </div>
					<input type="password" id="cpassword" class="phone" id="cpassword" placeholder="" autocomplete="off" required>
					<div class="clearfix"></div>

					<label>Accept Terms <span>*</span></label>
					<label class="checkbox"><input type="checkbox" class="checkbox"name="terms"   autocomplete="off" required></label>
					<div class="clearfix"></div>

					<div class="personal-details">
						<div class="clearfix"></div>
						
						<p class="post-terms">By ticking <strong>checkbox</strong> you accept our <a href="terms.html" target="_blank">Terms of Use </a> and <a href="privacy.html" target="_blank">Privacy Policy</a></p>
					<input type="submit" id="signup-form" value="Signup">					
					<div class="clearfix"></div>
					</form>
					</div>
			</div>
		</div>	
	</div>
	<!-- // Submit Ad -->


		