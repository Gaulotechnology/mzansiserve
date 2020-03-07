
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
	<!-- Terms of use -->
	<div class="contact main-grid-border">
		<div class="container">
			<h2 class="head text-center">Contact Us</h2>
			<section id="hire">    
				<form id="filldetails" method="post" action="<?php echo base_url() ?>page/contact/send" enctype="multipart/form-data">
					  <div class="field name-box">
							<input type="text" id="name" name="name" placeholder="Who Are You?"/>
							<label for="name">Name</label>
							<span class="ss-icon">check</span>
					  </div>
					  
					  <div class="field email-box">
							<input type="text" id="email" name="email" placeholder="example@email.com"/>
							<label for="email">Email</label>
							<span class="ss-icon">check</span>
					  </div>
					  
					  
					  <div class="field phonenum-box">
							<input type="text" id="email" name="cell_number" placeholder="Phone Number"/>
							<label for="email">Phone</label>
							<span class="ss-icon">check</span>
					  </div>

					  <div class="field msg-box">
							<textarea id="msg" rows="4" name="message" placeholder="Your message goes here..."></textarea>
							<label for="msg">Your Msg</label>
							<span class="ss-icon">check</span>
					  </div>

					 
			  
		
						 <h3 class="tlt">Add Attachment:</h3>
							
				<a>Choose file</a>
				<input class="form-control" type="file" name="upload" multiple />
		
			<ul class="show">
				<!-- The file uploads will be shown here -->
			</ul>
	
		<div class="clear"></div>
		<div class="submit">
		<input class="button" type="submit" value="Send" />
		</form>
		</div>
	
		<!-- JavaScript Includes -->
		<script src="<?php echo base_url() ?>assets/js/jquery.knob.js"></script>

		<!-- jQuery File Upload Dependencies -->
		<script src="<?php echo base_url() ?>assets/js/jquery.ui.widget.js"></script>
		<script src="<?php echo base_url() ?>assets/js/jquery.fileupload.js"></script>
		
		<!-- Our main JS file -->
		<script src="<?php echo base_url() ?>assets/js/script.js"></script>
						</div>
			</section>
			<script>
				  $('textarea').blur(function () {
				$('#hire textarea').each(function () {
					$this = $(this);
					if (this.value != '') {
						$this.addClass('focused');
						$('textarea + label + span').css({ 'opacity': 1 });
					} else {
						$this.removeClass('focused');
						$('textarea + label + span').css({ 'opacity': 0 });
					}
				});
			});
			$('#hire .field:first-child input').blur(function () {
				$('#hire .field:first-child input').each(function () {
					$this = $(this);
					if (this.value != '') {
						$this.addClass('focused');
						$('.field:first-child input + label + span').css({ 'opacity': 1 });
					} else {
						$this.removeClass('focused');
						$('.field:first-child input + label + span').css({ 'opacity': 0 });
					}
				});
			});
			$('#hire .field:nth-child(2) input').blur(function () {
				$('#hire .field:nth-child(2) input').each(function () {
					$this = $(this);
					if (this.value != '') {
						$this.addClass('focused');
						$('.field:nth-child(2) input + label + span').css({ 'opacity': 1 });
					} else {
						$this.removeClass('focused');
						$('.field:nth-child(2) input + label + span').css({ 'opacity': 0 });
					}
				});
			});
			$('#hire .field:nth-child(3) input').blur(function () {
				$('#hire .field:nth-child(3) input').each(function () {
					$this = $(this);
					if (this.value != '') {
						$this.addClass('focused');
						$('.field:nth-child(3) input + label + span').css({ 'opacity': 1 });
					} else {
						$this.removeClass('focused');
						$('.field:nth-child(3) input + label + span').css({ 'opacity': 0 });
					}
				});
			});
			$('#hire .field:nth-child(4) input').blur(function () {
				$('#hire .field:nth-child(4) input').each(function () {
					$this = $(this);
					if (this.value != '') {
						$this.addClass('focused');
						$('.field:nth-child(4) input + label + span').css({ 'opacity': 1 });
					} else {
						$this.removeClass('focused');
						$('.field:nth-child(4) input + label + span').css({ 'opacity': 0 });
					}
				});
			});
		  //@ sourceURL=pen.js
		</script>    
		<script>
	  if (document.location.search.match(/type=embed/gi)) {
		window.parent.postMessage("resize", "*");
	  }
	</script>
		</div>	
	</div>
	<!-- // Terms of use -->
	