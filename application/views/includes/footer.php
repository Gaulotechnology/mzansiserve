<!--footer section start-->		
		<footer>
			<div class="footer-top">
				<div class="container">
					<div class="foo-grids">
						<div class="col-md-3 footer-grid">
							<h4 class="footer-head">Who We Are</h4>
							<p>We are group of individuals who work together , making services available whenever you need them. Services are just on your fingers</p>
							<p>We provide and bring the services you need now straight to your door step</p>
						</div>
						<div class="col-md-3 footer-grid">
							<h4 class="footer-head">Help</h4>
							<ul>			
								<li><a href="<?php echo base_url('page/faq') ?>">Faq</a></li>
								<li><a href="<?php echo base_url('page/feedback') ?>">Feedback</a></li>
                                <li><a href="<?php echo base_url('page/contact') ?>">Contact</a></li>
                                <li><a href="<?php echo base_url('page/services') ?>">Services</a></li>
							
							</ul>
						</div>
						<div class="col-md-3 footer-grid">
							<h4 class="footer-head">Information</h4>
							<ul>
								<li><a href="<?php echo base_url('page/terms') ?>">Terms of Use</a></li>	
								<li><a href="<?php echo base_url('page/privacy') ?>">Privacy Policy</a></li>	
							</ul>
						</div>
						<div class="col-md-3 footer-grid">
							<h4 class="footer-head">Contact Us</h4>
							<span class="hq">Our headquarters</span>
							<address>
								<ul class="location">
									<li><span class="glyphicon glyphicon-map-marker"></span></li>
									<li>MZANSISERVE SANDTON HEAD OFFICE</li>
									<div class="clearfix"></div>
								</ul>	
								<ul class="location">
									<li><span class="glyphicon glyphicon-earphone"></span></li>
									<li>+27 78 114 2274</li>
									<div class="clearfix"></div>
								</ul>	
								<ul class="location">
									<li><span class="glyphicon glyphicon-envelope"></span></li>
									<li><a href="mailto:info@mzansiserves.com">info@mzansiserves.com</a></li>
									<div class="clearfix"></div>
								</ul>						
							</address>
						</div>
						<div class="clearfix"></div>
					</div>						
				</div>	
			</div>	
			<div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span></button>
				  <h2>Select a service of choice</h2>
			  </div>
			  <form method="post" action="<?php echo base_url('page/service_option') ?>">
              <div class="modal-body">
   
				<div class="form-group">
				<select  name="choice" class="form-group" style="width:90%; height:40px; font-size:20px;">
					  <option value="1">Book A Trip</option>
					  <option value="2">Request Professional Service</option>
					  <option value="3">Request General Service</option>
					</select>
					<div class="clearfix"></div>
</div>
				
              </div>
              <div class="modal-footer">
               
                <button type="submit" class="btn btn-primary">Request Now</button>
			  </div>
			  </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
			<div class="footer-bottom text-center">
			<div class="container">
				<div class="footer-logo">
				<a href="<?php echo base_url()  ?>"><span>Mzansi</span>Serve</a> 
				</div>
				<div class="footer-social-icons">
					<ul>
						<li><a class="facebook" href="http://www.facebook.com"><span>Facebook</span></a></li>
						<li><a class="twitter" href="http://www.twitter.com"><span>Twitter</span></a></li>
						<li><a class="flickr" href="http://www.flickr.com"><span>Flickr</span></a></li>
						<li><a class="googleplus" href="http://www.googlepus.com"><span>Google+</span></a></li>
						<li><a class="dribbble" href="http://www.dribble.com"><span>Dribbble</span></a></li>
					</ul>
				</div>
				<div class="copyrights">
					<p> © <?php echo date("Y") ?> Mzansiserve. All Rights Reserved | Design by  <a href="http://www.gaulotechnology.c.nf/"> Gaudencio Solivatore</a></p>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
		</footer>
		<script src="<?php echo base_url() ?>assets/js/register.js"></script>
		<!--footer section end-->
		
</body>
</html>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/floating-wpp.css">
    <script type="text/javascript" src="<?php echo base_url() ?>assets/js/floating-wpp.js"></script>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif
        }
    </style>
</head>

<body>
<div id="myButton"></div>
</body>

<script type="text/javascript">
    $(function () {
        $('#myButton').floatingWhatsApp({
            phone: '+27781142274',
            popupMessage: 'Hello, how can we help you?',
            message: "I'd like to know about mzansiserve",
            showPopup: true,
            showOnIE: false,
            headerTitle: 'Welcome!',
            headerColor: 'crimson',
            backgroundColor: 'crimson',
            buttonImage: '<img src="<?php echo base_url() ?>assets/images/whatsapp.svg" />'
        });
    });
</script>

</html>
