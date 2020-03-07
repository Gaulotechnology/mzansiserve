
	<div class="banner text-center">
	  <div class="container">    
			<h1>Sell or Advertise   <span class="segment-heading">    anything online </span> with Resale</h1>
			<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry</p>
			<a href="<?php echo base_url() ?>post_ad">Post Free Ad</a>
	  </div>
	</div>
	<!-- Products -->
	<div class="total-ads main-grid-border">
		<div class="container">
			<div class="select-box">
				<div class="select-city-for-local-ads ads-list">
					<label>Select your city to see local ads</label>
						<select>
												<optgroup label="Popular Cities">
													<option selected style="display:none;color:#eee;">Entire South Africa</option>
													<option>Gauteng</option>
													<option>Eastern Cape</option>
													<option>Polokwane</option>
													<option>Nothern Cape</option>
													<option>North West</option>
													<option>Western Cape</option>
													
												</optgroup>
												
																
												
			            </select>
				</div>
				<div class="browse-category ads-list">
					<label>Browse Categories</label>
					<select class="selectpicker show-tick" data-live-search="true">
					  <option data-tokens="Pets">Pets</option>
					  <option data-tokens="Mobiles">Mobiles</option>
					  <option data-tokens="Electronics & Appliances">Electronics & Appliances</option>
					  <option data-tokens="Cars">Cars</option>
					  <option data-tokens="Bikes">Bikes</option>
					  <option data-tokens="Furniture">Furniture</option>
					  <option data-tokens="Books, Sports & Hobbies">Books, Sports & Hobbies</option>
					  <option data-tokens="Fashion">Fashion</option>
					  <option data-tokens="Kids">Kids</option>
					  <option data-tokens="Services">Services</option>
					  <option data-tokens="Jobs">Jobs</option>
					  <option data-tokens="Real Estate">Real Estate</option>
					</select>
				</div>
				<div class="search-product ads-list">
					<label>Search for a specific product</label>
					<div class="search">
						<div id="custom-search-input">
						<div class="input-group">
							<input type="text" class="form-control input-lg" placeholder="Buscar" />
							<span class="input-group-btn">
								<button class="btn btn-info btn-lg" type="button">
									<i class="glyphicon glyphicon-search"></i>
								</button>
							</span>
						</div>
					</div>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
			<ol class="breadcrumb" style="margin-bottom: 5px;">
			  <li><a href="index.html">Home</a></li>
			  <li><a href="categories.html">Categories</a></li>
			  <li class="active">Pets</li>
			</ol>
			<div class="ads-grid">
				<div class="side-bar col-md-3">
					<div class="search-hotel">
					<h3 class="sear-head">Name contains</h3>
					<form>
						<input type="text" value="Product name..." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Product name...';}" required="">
						<input type="submit" value=" ">
					</form>
				</div>
				
				<div class="range">
					<h3 class="sear-head">Price range</h3>
							<ul class="dropdown-menu6">
								<li>
									                
									<div id="slider-range"></div>							
										<input type="text" id="amount" style="border: 0; color: #ffffff; font-weight: normal;" />
									</li>			
							</ul>
							<!---->
							<script type="text/javascript" src="js/jquery-ui.js"></script>
							<script type='text/javascript'>//<![CDATA[ 
							$(window).load(function(){
							 $( "#slider-range" ).slider({
										range: true,
										min: 0,
										max: 9000,
										values: [ 50, 6000 ],
										slide: function( event, ui ) {  $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
										}
							 });
							$( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) + " - $" + $( "#slider-range" ).slider( "values", 1 ) );

							});//]]>  

							</script>
							
				</div>
				<div class="brand-select">
					<h3 class="sear-head">Category</h3>
					  <select class="selectpicker" data-live-search="true">
					  <option data-tokens="All">All</option>
					  <option data-tokens="Beagle">Beagle</option>
					  <option data-tokens="Cocker Spaniel">Cocker Spaniel</option>
					  <option data-tokens="Dalmatian">Dalmatian</option>
					  <option data-tokens="Husky">Husky</option>
					  <option data-tokens="Other Breeds">Other Breeds</option>
					</select>
				</div>
				<div class="featured-ads">
					<h2 class="sear-head fer">Featured Ads</h2>
					<div class="featured-ad">
						<a href="<?php echo base_url() ?>single">
							<div class="featured-ad-left">
								<img src="<?php echo base_url() ?>assets/homepage/images/f1.jpg" title="ad image" alt="" />
							</div>
							<div class="featured-ad-right">
								<h4>Lorem Ipsum is simply dummy text of the printing industry</h4>
								<p>R 450</p>
							</div>
							<div class="clearfix"></div>
						</a>
					</div>
					<div class="featured-ad">
						<a href="<?php echo base_url() ?>single">
							<div class="featured-ad-left">
								<img src="<?php echo base_url() ?>assets/homepage/images/f2.jpg" title="ad image" alt="" />
							</div>
							<div class="featured-ad-right">
								<h4>Lorem Ipsum is simply dummy text of the printing industry</h4>
								<p>R 380</p>
							</div>
							<div class="clearfix"></div>
						</a>
					</div>
					<div class="featured-ad">
						<a href="<?php echo base_url() ?>single">
							<div class="featured-ad-left">
								<img src="<?php echo base_url() ?>assets/homepage/images/f3.jpg" title="ad image" alt="" />
							</div>
							<div class="featured-ad-right">
								<h4>Lorem Ipsum is simply dummy text of the printing industry</h4>
								<p>R 560</p>
							</div>
							<div class="clearfix"></div>
						</a>
					</div>
					<div class="clearfix"></div>
				</div>
				</div>
				<div class="ads-display col-md-9">
					<div class="wrapper">					
					<div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
					  <ul id="myTab" class="nav nav-tabs nav-tabs-responsive" role="tablist">
						<li role="presentation" class="active">
						  <a href="#home" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">
							<span class="text">All Ads</span>
						  </a>
						</li>
						<li role="presentation" class="next">
						  <a href="#profile" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile">
							<span class="text">Ads with Photos</span>
						  </a>
						</li>
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
								<div class="sort">
								   <div class="sort-by">
										<label>Sort By : </label>
										<select>
														<option value="">Most recent</option>
														<option value="">Price: Rs Low to High</option>
														<option value="">Price: Rs High to Low</option>
										</select>
									   </div>
									 </div>
								<div class="clearfix"></div>
							<ul class="list">

							<?php
					
							foreach($products as $row): ?>
								<a href="<?php echo base_url() ?>single">
									<li>
									<img src="<?php echo base_url() ?>assets/images/<?php echo $row->image ?>" title="" alt="" />
									<section class="list-left">
									<h5 class="title"><?php echo $row->name?></h5>
									<span class="adprice"><?php echo CURRENCY  ?><?php echo $row->price ?></span>
									<p class="catpath"><?php echo $row->category ?> » <?php echo $row->name ?> </p>
									</section>
									<section class="list-right">
									<span class="date"> <?php echo $row->date_added ?> </span>
									<span class="cityname"><?php echo $row->location ?></span>
									</section>
									<div class="clearfix"></div>
									</li> 
								</a>
						<?php endforeach; ?>
						
							</ul>
							 <?php echo $this->pagination->create_links(); ?>
						</div>
						
							</div>
						</div>
						<div role="tabpanel" class="tab-pane fade" id="profile" aria-labelledby="profile-tab">
						 <div>
												<div id="container">
								<div class="view-controls-list" id="viewcontrols">
									<label>view :</label>
									<a class="gridview"><i class="glyphicon glyphicon-th"></i></a>
									<a class="listview active"><i class="glyphicon glyphicon-th-list"></i></a>
								</div>
								<div class="sort">
								   <div class="sort-by">
										<label>Sort By : </label>
										<select>
														<option value="">Most recent</option>
														<option value="">Price: Rs Low to High</option>
														<option value="">Price: Rs High to Low</option>
										</select>
									   </div>
									 </div>
								<div class="clearfix"></div>
							<ul class="list">
								<a href="<?php echo base_url() ?>single">
									<li>
									<img src="<?php echo base_url() ?>assets/homepage/images/d1.jpg" title="" alt="" />
									<section class="list-left">
									<h5 class="title">There are many variations of passages of Lorem Ipsum</h5>
									<span class="adprice"><?php echo CURRENCY  ?>290</span>
									<p class="catpath">Dogs » Pug</p>
									</section>
									<section class="list-right">
									<span class="date">Today, 17:55</span>
									<span class="cityname">City name</span>
									</section>
									<div class="clearfix"></div>
									</li> 
								</a>
								<a href="<?php echo base_url() ?>single">
									<li>
									<img src="<?php echo base_url() ?>assets/homepage/images/d2.jpg" title="" alt="" />
									<section class="list-left">
									<h5 class="title">It is a long established fact that a reader</h5>
									<span class="adprice"><?php echo CURRENCY  ?>310</span>
									<p class="catpath">Dogs » Pug</p>
									</section>
									<section class="list-right">
									<span class="date">Today, 17:45</span>
									<span class="cityname">City name</span>
									</section>
									<div class="clearfix"></div>
									</li> 
								</a>
								<a href="<?php echo base_url() ?>single">
									<li>
									<img src="<?php echo base_url() ?>assets/homepage/images/d3.jpg" title="" alt="" />
									<section class="list-left">
									<h5 class="title">Contrary to popular belief, Lorem Ipsum is not</h5>
									<span class="adprice"><?php echo CURRENCY  ?>190</span>
									<p class="catpath">Dogs » Pug</p>
									</section>
									<section class="list-right">
									<span class="date">Today, 17:30</span>
									<span class="cityname">City name</span>
									</section>
									<div class="clearfix"></div>
									</li> 
								</a>
								<a href="<?php echo base_url() ?>single">
									<li>
									<img src="<?php echo base_url() ?>assets/homepage/images/d4.jpg" title="" alt="" />
									<section class="list-left">
									<h5 class="title">The standard chunk of Lorem Ipsum used since the</h5>
									<span class="adprice"><?php echo CURRENCY  ?>480</span>
									<p class="catpath">Dogs » Pug</p>
									</section>
									<section class="list-right">
									<span class="date">Today, 17:25</span>
									<span class="cityname">City name</span>
									</section>
									<div class="clearfix"></div>
									</li> 
								</a>
								<a href="<?php echo base_url() ?>single">
									<li>
									<img src="<?php echo base_url() ?>assets/homepage/images/d5.jpg" title="" alt="" />
									<section class="list-left">
									<h5 class="title">Sed ut perspiciatis unde omnis iste natus error sit voluptatem</h5>
									<span class="adprice"><?php echo CURRENCY  ?>859</span>
									<p class="catpath">Dogs » Pug</p>
									</section>
									<section class="list-right">
									<span class="date">Today, 17:24</span>
									<span class="cityname">City name</span>
									</section>
									<div class="clearfix"></div>
									</li> 
								</a>
								<a href="<?php echo base_url() ?>single">
									<li>
									<img src="<?php echo base_url() ?>assets/homepage/images/d6.jpg" title="" alt="" />
									<section class="list-left">
									<h5 class="title">But I must explain to you how all this mistaken idea of denouncing</h5>
									<span class="adprice"><?php echo CURRENCY  ?>1299</span>
									<p class="catpath">Dogs » Pug</p>
									</section>
									<section class="list-right">
									<span class="date">Today, 17:22</span>
									<span class="cityname">City name</span>
									</section>
									<div class="clearfix"></div>
									</li> 
								</a>
								<a href="<?php echo base_url() ?>single">
									<li>
									<img src="<?php echo base_url() ?>assets/homepage/images/d1.jpg" title="" alt="" />
									<section class="list-left">
									<h5 class="title">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis</h5>
									<span class="adprice"><?php echo CURRENCY  ?>1099</span>
									<p class="catpath">Dogs » Pug</p>
									</section>
									<section class="list-right">
									<span class="date">Today, 17:21</span>
									<span class="cityname">City name</span>
									</section>
									<div class="clearfix"></div>
									</li> 
								</a>
								<a href="<?php echo base_url() ?>single">
									<li>
									<img src="<?php echo base_url() ?>assets/homepage/images/d7.jpg" title="" alt="" />
									<section class="list-left">
									<h5 class="title">On the other hand, we denounce with righteous dislike men</h5>
									<span class="adprice"><?php echo CURRENCY  ?>290</span>
									<p class="catpath">Dogs » Pug</p>
									</section>
									<section class="list-right">
									<span class="date">Today, 17:20</span>
									<span class="cityname">City name</span>
									</section>
									<div class="clearfix"></div>
									</li> 
								</a>
								<a href="<?php echo base_url() ?>single">
									<li>
									<img src="<?php echo base_url() ?>assets/homepage/images/d8.jpg" title="" alt="" />
									<section class="list-left">
									<h5 class="title">There are many variations of passages of Lorem Ipsum</h5>
									<span class="adprice"><?php echo CURRENCY  ?>899</span>
									<p class="catpath">Dogs » Pug</p>
									</section>
									<section class="list-right">
									<span class="date">Today, 17:05</span>
									<span class="cityname">City name</span>
									</section>
									<div class="clearfix"></div>
									</li> 
								</a>
								<a href="<?php echo base_url() ?>single">
									<li>
									<img src="<?php echo base_url() ?>assets/homepage/images/d9.jpg" title="" alt="" />
									<section class="list-left">
									<h5 class="title">ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et qua</h5>
									<span class="adprice"><?php echo CURRENCY  ?>199</span>
									<p class="catpath">Dogs » Pug</p>
									</section>
									<section class="list-right">
									<span class="date">Today, 17:04</span>
									<span class="cityname">City name</span>
									</section>
									<div class="clearfix"></div>
									</li> 
								</a>
								<a href="<?php echo base_url() ?>single">
									<li>
									<img src="<?php echo base_url() ?>assets/homepage/images/d10.jpg" title="" alt="" />
									<section class="list-left">
									<h5 class="title">There are many variations of passages of Lorem Ipsum</h5>
									<span class="adprice"><?php echo CURRENCY  ?>250</span>
									<p class="catpath">Dogs » Pug</p>
									</section>
									<section class="list-right">
									<span class="date">Today, 17:03</span>
									<span class="cityname">City name</span>
									</section>
									<div class="clearfix"></div>
									</li> 
								</a>
								<a href="<?php echo base_url() ?>single">
									<li>
									<img src="<?php echo base_url() ?>assets/homepage/images/d11.jpg" title="" alt="" />
									<section class="list-left">
									<h5 class="title">who are so beguiled and demoralized by the charms of pleasure of the moment</h5>
									<span class="adprice"><?php echo CURRENCY  ?>189</span>
									<p class="catpath">Dogs » Pug</p>
									</section>
									<section class="list-right">
									<span class="date">Today, 17:03</span>
									<span class="cityname">City name</span>
									</section>
									<div class="clearfix"></div>
									</li> 
								</a>
								<a href="<?php echo base_url() ?>single">
									<li>
									<img src="<?php echo base_url() ?>assets/homepage/images/d12.jpg" title="" alt="" />
									<section class="list-left">
									<h5 class="title">you need to be sure there isn't anything embarrassing hidden</h5>
									<span class="adprice"><?php echo CURRENCY  ?>1090</span>
									<p class="catpath">Dogs » Pug</p>
									</section>
									<section class="list-right">
									<span class="date">Today, 17:03</span>
									<span class="cityname">City name</span>
									</section>
									<div class="clearfix"></div>
									</li> 
								</a>
								<a href="<?php echo base_url() ?>single">
									<li>
									<img src="<?php echo base_url() ?>assets/homepage/images/d13.jpg" title="" alt="" />
									<section class="list-left">
									<h5 class="title">looked up one of the more obscure Latin words</h5>
									<span class="adprice"><?php echo CURRENCY  ?>599</span>
									<p class="catpath">Dogs » Pug</p>
									</section>
									<section class="list-right">
									<span class="date">Today, 17:02</span>
									<span class="cityname">City name</span>
									</section>
									<div class="clearfix"></div>
									</li> 
								<div class="clearfix"></div>
								</a>
							</ul>
						</div>
							</div>
						</div>
						
					  </div>
					</div>
				</div>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>	
	</div>
	<!-- // Pets -->
	