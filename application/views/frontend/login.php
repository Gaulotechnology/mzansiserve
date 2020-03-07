

	 <section>
			<div id="page-wrapper" class="sign-in-wrapper">
				<div class="graphs">
					<div class="sign-in-form">
						<div class="sign-in-form-top">
							<h1>Log in</h1>
						</div>
						<form action="<?php echo base_url('login/ajax_login') ?>" method="post">
						

						<div class="signin">
						<?php if(isset($forgot_password)){ ?>
						<div class="form-forgotpassword-success">
                            <i class="entypo-check"></i>
                            <h3>Reset email has been sent.</h3>
                            <p>Please check your email inbox, password reset instruction is sent!</p>
                        </div>
						<?php } ?>
							<div class="signin-rit">
								<span class="checkbox1">
									 <label class="checkbox"><input type="checkbox" name="radio" >Forgot Password ?</label>
								</span>
								<p><a href="<?php echo base_url('page/register') ?>">Register Here</a> </p>
								<div class="clearfix"> </div>
								<?php if(isset($not_set)){ ?>
									<div class="text-success" style="text-align:center;"><?php echo $not_set ?></div>
								<?php } ?>
								  <div class="text-success" style="text-align:center;">
								  <?php  echo $this->session->flashdata('flash_message') ?>
								  <?php  echo $this->session->flashdata('email_verify') ?></div>
							</div>
						
							<div class="log-input">
								<div class="log-input-left">
								<div class="text-danger" id="email_info"> </div>
								   <input type="text" class="user" name="email" value="Your Email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Your Email';}"/>
								</div>
								<span class="checkbox2">
									 <label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i> </i></label>
								</span>
								<div class="clearfix"> </div>
							</div>
							<div class="log-input">
								<div class="log-input-left">
								   <input type="password" class="lock" name="password" value="password" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email address:';}"/>
								</div>
								<span class="checkbox2">
									 <label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i> </i></label>
								</span>
								<div class="clearfix"> </div>
							</div>
							<input type="submit" value="Log in">
						</form>	 
						</div>
						<div class="new_people">
							<h2>For New People</h2>
							<p>Having hands on experience in creating innovative designs,I do offer design 
								solutions which harness.</p>
							<a href="<?php echo base_url('page/register') ?>">Register Now!</a>
						</div>
					</div>
				</div>
			</div>
		 <!-- Bottom Scripts -->
		