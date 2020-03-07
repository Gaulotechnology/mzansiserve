

	 <section>
			<div id="page-wrapper" class="sign-in-wrapper">
				<div class="graphs">
					<div class="sign-in-form">
						<div class="sign-in-form-top">
							<h1>Password Reset</h1>
						</div>
						<form action="<?php echo base_url('page/reset_password/set') ?>" method="post">
						
						
						<div class="signin">
						<?php if(isset($forgot_password)){ ?>
						<div class="form-forgotpassword-success">
                            <i class="entypo-check"></i>
                            <h3>Reset email has been sent.</h3>
                            <p>Please check your email inbox, password reset instruction is sent!</p>
                        </div>
						<?php } ?>
							<div class="signin-rit">
								
								
								<div class="clearfix"> </div>
								
								  <div class="text-success" style="text-align:center;">
								  <?php  echo $this->session->flashdata('flash_message') ?>
								 </div>
							</div>
						
							<div class="log-input">
								<div class="log-input-left">
								<div class="text-danger" id="email_info"> </div>
								   <input type="password" class="password" name="password"  onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Your password';}"/>
								   <?php if(isset($key)){ ?>
									<input type="hidden"  name="key" value="<?php echo $key ?>" />
								  
									<?php	}?>
								
								</div>
								
								<div class="clearfix"> </div>
							</div>
							<div class="log-input">
								<div class="log-input-left">
								   <input type="password" class="password" name="cpassword" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Confirm Password:';}"/>
								</div>
								
								<div class="clearfix"> </div>
							</div>
							<input type="submit" value="Reset Password">
						</form>	 
						</div>
						<div class="new_people">
							<h2>I remember my password</h2>
							<p>You can login here if you still remember your password</p>
							<a href="<?php echo base_url('page/login') ?>">Login !</a>
						</div>
					</div>
				</div>
			</div>
		 <!-- Bottom Scripts -->
		