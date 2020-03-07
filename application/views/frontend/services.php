
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
			<div class="select-box">
				<div class="select-city-for-local-ads ads-list">
					<label>Select your city to see local ads</label>
						<select>
												<optgroup label="Popular Cities">
													<option selected style="display:none;color:#eee;">Entire South Africa</option>
													
												</optgroup>
																								
													
			            </select>
				</div>
				<div class="browse-category ads-list">
					<label>Browse Categories</label>
					<select class="selectpicker show-tick" data-live-search="true">
						<option data-tokens="Services"> Professional Services</option>
						<?php foreach($services as $row): ?>
						<option data-tokens="Services"><?php echo $row->name; ?></option>
						<?php endforeach ?>
					</select>
				</div>
				<div class="search-product ads-list">
					<label>Search for a specific professional service</label>
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
			  <li class="active">Services</li>
			</ol>
			<div class="ads-grid">
			
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
								<a href="<?php echo base_url() ?>single">
									<li>
									<section class="list-left">
									<h5 class="title">Magtouch Electronics</h5>
									<p class="catpath">Services » Other Services</p>
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
									<span class="cityname">Johanneburg</span>
									<p>
									<span class="cityname"><button class="btn btn-success">request now</button></span>
									</section>
									<div class="clearfix"></div>
									</li> 
								</a>
								
								
								<a href="<?php echo base_url() ?>single">
									<li>
									<section class="list-left">
									<h5 class="title">Gaulo Electronics</h5>
									<p class="catpath">Services » Other Services</p>
									<p class="catpath">Rating:
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star-o"></i>
										</p>
									</section>
									<section class="list-right">
									<span class="date">25km Away</span>
									<span class="cityname">Sandton</span>
									<p>
									<span class="cityname"><button class="btn btn-success">request now</button></span>
									</section>
									<div class="clearfix"></div>
									</li> 
								<div class="clearfix"></div>
								</a>
							</ul>
						</div>
							</div>
						</div>
						<ul class="pagination pagination-sm">
							<li><a href="#">Prev</a></li>
							<li><a href="#">1</a></li>
							<li><a href="#">2</a></li>
							<li><a href="#">3</a></li>
							<li><a href="#">4</a></li>
							<li><a href="#">5</a></li>
							<li><a href="#">6</a></li>
							<li><a href="#">7</a></li>
							<li><a href="#">8</a></li>
							<li><a href="#">Next</a></li>
						</ul>
					  </div>
					</div>
				</div>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>	
	</div>
	