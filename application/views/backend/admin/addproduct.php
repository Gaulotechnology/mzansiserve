<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-product" data-toggle="tooltip" title="Save" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo base_url() ?>addproduct"  data-toggle="tooltip" title="Cancel" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1>Products</h1>
      <ul class="breadcrumb">
                <li><a href="<?php echo base_url() ?>addproduct">Home</a></li>
                <li><a href="<?php echo base_url() ?>addproduct">Products</a></li>
              </ul>
    </div>
  </div>
  <div class="container-fluid">     <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> Add Product</h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo base_url() ?>addproduct" method="post" enctype="multipart/form-data" id="form-product" class="form-horizontal">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-general" data-toggle="tab">General</a></li>
            <li><a href="#tab-data" data-toggle="tab">Data</a></li>
            <li><a href="#tab-links" data-toggle="tab">Links</a></li>
            <li><a href="#tab-attribute" data-toggle="tab">Attribute</a></li>
            <li><a href="#tab-option" data-toggle="tab">Option</a></li>
            <li><a href="#tab-recurring" data-toggle="tab">Recurring</a></li>
            <li><a href="#tab-discount" data-toggle="tab">Discount</a></li>
            <li><a href="#tab-special" data-toggle="tab">Special</a></li>
            <li><a href="#tab-image" data-toggle="tab">Image</a></li>
            <li><a href="#tab-reward" data-toggle="tab">Reward Points</a></li>
            <li><a href="#tab-seo" data-toggle="tab">SEO</a></li>
            <li><a href="#tab-design" data-toggle="tab">Design</a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="tab-general">
              <ul class="nav nav-tabs" id="language">
                                <li><a href="#language1" data-toggle="tab"><img src="<?php echo base_url() ?>assets/language/en-gb/en-gb.png" title="English" /> English</a></li>
                              </ul>
              <div class="tab-content">                <div class="tab-pane" id="language1">
                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-name1">Product Name</label>
                    <div class="col-sm-10">
                      <input type="text" name="product_description[1][name]" value="" placeholder="Product Name" id="input-name1" class="form-control" />
                       </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-description1">Description</label>
                    <div class="col-sm-10">
                      <textarea name="product_description[1][description]" placeholder="Description" id="input-description1" data-toggle="summernote" data-lang="" class="form-control"></textarea>
                    </div>
                  </div>
                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-meta-title1">Meta Tag Title</label>
                    <div class="col-sm-10">
                      <input type="text" name="product_description[1][meta_title]" value="" placeholder="Meta Tag Title" id="input-meta-title1" class="form-control" />
                       </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-meta-description1">Meta Tag Description</label>
                    <div class="col-sm-10">
                      <textarea name="product_description[1][meta_description]" rows="5" placeholder="Meta Tag Description" id="input-meta-description1" class="form-control"></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-meta-keyword1">Meta Tag Keywords</label>
                    <div class="col-sm-10">
                      <textarea name="product_description[1][meta_keyword]" rows="5" placeholder="Meta Tag Keywords" id="input-meta-keyword1" class="form-control"></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label" for="input-tag1"><span data-toggle="tooltip" title="Comma separated">Product Tags</span></label>
                    <div class="col-sm-10">
                      <input type="text" name="product_description[1][tag]" value="" placeholder="Product Tags" id="input-tag1" class="form-control" />
                    </div>
                  </div>
                </div>
                </div>
            </div>
            <div class="tab-pane" id="tab-data">
              <div class="form-group required">
                <label class="col-sm-2 control-label" for="input-model">Model</label>
                <div class="col-sm-10">
                  <input type="text" name="model" list="model" value="" placeholder="Model" id="input-model" class="form-control" />
                  <datalist id="model">
                  <?php 
                    if(is_array($product_type) || is_object($product_type) || isset($product_type)){
                    foreach($product_type as $pt){
                    echo "<option value='".$pt->name."'>".$pt->name."</option>";
                } 
                }?>
                  </datalist>
                  </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-sku"><span data-toggle="tooltip" title="Stock Keeping Unit">SKU</span></label>
                <div class="col-sm-10">
                  <input type="text" name="sku" value="" placeholder="SKU" id="input-sku" class="form-control" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-upc"><span data-toggle="tooltip" title="Universal Product Code">UPC</span></label>
                <div class="col-sm-10">
                  <input type="text" name="upc" value="" placeholder="UPC" id="input-upc" class="form-control" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-ean"><span data-toggle="tooltip" title="European Article Number">EAN</span></label>
                <div class="col-sm-10">
                  <input type="text" name="ean" value="" placeholder="EAN" id="input-ean" class="form-control" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-jan"><span data-toggle="tooltip" title="Japanese Article Number">JAN</span></label>
                <div class="col-sm-10">
                  <input type="text" name="jan" value="" placeholder="JAN" id="input-jan" class="form-control" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-isbn"><span data-toggle="tooltip" title="International Standard Book Number">ISBN</span></label>
                <div class="col-sm-10">
                  <input type="text" name="isbn" value="" placeholder="ISBN" id="input-isbn" class="form-control" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-mpn"><span data-toggle="tooltip" title="Manufacturer Part Number">MPN</span></label>
                <div class="col-sm-10">
                  <input type="text" name="mpn" value="" placeholder="MPN" id="input-mpn" class="form-control" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-location">Location</label>
                <div class="col-sm-10">
                  <input type="text" name="location" value="" placeholder="Location" id="input-location" class="form-control" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-price">Price</label>
                <div class="col-sm-10">
                  <input type="text" name="price" value="" placeholder="Price" id="input-price" class="form-control" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-tax-class">Tax Class</label>
                <div class="col-sm-10">
                  <select name="tax_class_id" id="input-tax-class" class="form-control">
                    <option value="0"> --- None --- </option>
                    

                                        
                    
                    <option value="9">Taxable Goods</option>
                    

                                                            
                    
                    <option value="10">Downloadable Products</option>
                    

                                        
                  
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-quantity">Quantity</label>
                <div class="col-sm-10">
                  <input type="text" name="quantity" value="1" placeholder="Quantity" id="input-quantity" class="form-control" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-minimum"><span data-toggle="tooltip" title="Force a minimum ordered amount">Minimum Quantity</span></label>
                <div class="col-sm-10">
                  <input type="text" name="minimum" value="1" placeholder="Minimum Quantity" id="input-minimum" class="form-control" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-subtract">Subtract Stock</label>
                <div class="col-sm-10">
                  <select name="subtract" id="input-subtract" class="form-control">
                    

                    
                    
                    <option value="1" selected="selected">Yes</option>
                    <option value="0">No</option>
                    

                    
                  
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-stock-status"><span data-toggle="tooltip" title="Status shown when a product is out of stock">Out Of Stock Status</span></label>
                <div class="col-sm-10">
                  <select name="stock_status_id" id="input-stock-status" class="form-control">
                    

                                        
                    
                    <option value="6">2-3 Days</option>
                    

                                                            
                    
                    <option value="7">In Stock</option>
                    

                                                            
                    
                    <option value="5">Out Of Stock</option>
                    

                                                            
                    
                    <option value="8">Pre-Order</option>
                    

                                        
                  
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Requires Shipping</label>
                <div class="col-sm-10">
                  <label class="radio-inline">                     <input type="radio" name="shipping" value="1" checked="checked" />
                    Yes
                     </label>
                  <label class="radio-inline">                     <input type="radio" name="shipping" value="0" />
                    No
                     </label>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-date-available">Date Available</label>
                <div class="col-sm-3">
                  <div class="input-group date">
                    <input type="text" name="date_available" value="2018-07-17" placeholder="Date Available" data-date-format="YYYY-MM-DD" id="input-date-available" class="form-control" />
                    <span class="input-group-btn">
                    <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                    </span></div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-length">Dimensions (L x W x H)</label>
                <div class="col-sm-10">
                  <div class="row">
                    <div class="col-sm-4">
                      <input type="text" name="length" value="" placeholder="Length" id="input-length" class="form-control" />
                    </div>
                    <div class="col-sm-4">
                      <input type="text" name="width" value="" placeholder="Width" id="input-width" class="form-control" />
                    </div>
                    <div class="col-sm-4">
                      <input type="text" name="height" value="" placeholder="Height" id="input-height" class="form-control" />
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-length-class">Length Class</label>
                <div class="col-sm-10">
                  <select name="length_class_id" id="input-length-class" class="form-control">
                    

                                        
                    
                    <option value="1" selected="selected">Centimeter</option>
                    

                                                            
                    
                    <option value="2">Millimeter</option>
                    

                                                            
                    
                    <option value="3">Inch</option>
                    

                                        
                  
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-weight">Weight</label>
                <div class="col-sm-10">
                  <input type="text" name="weight" value="" placeholder="Weight" id="input-weight" class="form-control" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-weight-class">Weight Class</label>
                <div class="col-sm-10">
                  <select name="weight_class_id" id="input-weight-class" class="form-control">
                    

                                        
                    
                    <option value="1" selected="selected">Kilogram</option>
                    

                                                            
                    
                    <option value="2">Gram</option>
                    

                                                            
                    
                    <option value="5">Pound </option>
                    

                                                            
                    
                    <option value="6">Ounce</option>
                    

                                        
                  
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-status">Status</label>
                <div class="col-sm-10">
                  <select name="status" id="input-status" class="form-control">
                    

                    
                    
                    <option value="1" selected="selected">Enabled</option>
                    <option value="0">Disabled</option>
                    

                    
                  
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-sort-order">Sort Order</label>
                <div class="col-sm-10">
                  <input type="text" name="sort_order" value="1" placeholder="Sort Order" id="input-sort-order" class="form-control" />
                </div>
              </div>
            </div>
            <div class="tab-pane" id="tab-links">
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-manufacturer"><span data-toggle="tooltip" title="(Autocomplete)">Manufacturer</span></label>
                <div class="col-sm-10">
                  <input type="text" name="manufacturer" value="" placeholder="Manufacturer" id="input-manufacturer" class="form-control" />
                  <input type="hidden" name="manufacturer_id" value="0" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-category"><span data-toggle="tooltip" title="(Autocomplete)">Categories</span></label>
                <div class="col-sm-10">
                  <input type="text" name="category" value="" placeholder="Categories" id="input-category" class="form-control" />
                  <div id="product-category" class="well well-sm" style="height: 150px; overflow: auto;"> </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-filter"><span data-toggle="tooltip" title="(Autocomplete)">Filters</span></label>
                <div class="col-sm-10">
                  <input type="text" name="filter" value="" placeholder="Filters" id="input-filter" class="form-control" />
                  <div id="product-filter" class="well well-sm" style="height: 150px; overflow: auto;"> </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Stores</label>
                <div class="col-sm-10">
                  <div class="well well-sm" style="height: 150px; overflow: auto;">                     <div class="checkbox">
                      <label>                         <input type="checkbox" name="product_store[]" value="0" checked="checked" />
                        Default
                         </label>
                    </div>
                    </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-download"><span data-toggle="tooltip" title="(Autocomplete)">Downloads</span></label>
                <div class="col-sm-10">
                  <input type="text" name="download" value="" placeholder="Downloads" id="input-download" class="form-control" />
                  <div id="product-download" class="well well-sm" style="height: 150px; overflow: auto;"> </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-related"><span data-toggle="tooltip" title="(Autocomplete)">Related Products</span></label>
                <div class="col-sm-10">
                  <input type="text" name="related" value="" placeholder="Related Products" id="input-related" class="form-control" />
                  <div id="product-related" class="well well-sm" style="height: 150px; overflow: auto;"> </div>
                </div>
              </div>
            </div>
            <div class="tab-pane" id="tab-attribute">
              <div class="table-responsive">
                <table id="attribute" class="table table-striped table-bordered table-hover">
                  <thead>
                    <tr>
                      <td class="text-left">Attribute</td>
                      <td class="text-left">Text</td>
                      <td></td>
                    </tr>
                  </thead>
                  <tbody>
                  
                                                        </tbody>
                  
                  <tfoot>
                    <tr>
                      <td colspan="2"></td>
                      <td class="text-right"><button type="button" onclick="addAttribute();" data-toggle="tooltip" title="Add Attribute" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
            <div class="tab-pane" id="tab-option">
              <div class="row">
                <div class="col-sm-2">
                  <ul class="nav nav-pills nav-stacked" id="option">
                                                            <li>
                      <input type="text" name="option" value="" placeholder="Option" id="input-option" class="form-control" />
                    </li>
                  </ul>
                </div>
                <div class="col-sm-10">
                  <div class="tab-content">                                          </div>
                </div>
              </div>
            </div>
            <div class="tab-pane" id="tab-recurring">
              <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                  <thead>
                    <tr>
                      <td class="text-left">Recurring Profile</td>
                      <td class="text-left">Customer Group</td>
                      <td class="text-left"></td>
                    </tr>
                  </thead>
                  <tbody>
                  
                                                        </tbody>
                  
                  <tfoot>
                    <tr>
                      <td colspan="2"></td>
                      <td class="text-left"><button type="button" onclick="addRecurring()" data-toggle="tooltip" title="Add Recurring" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
            <div class="tab-pane" id="tab-discount">
              <div class="table-responsive">
                <table id="discount" class="table table-striped table-bordered table-hover">
                  <thead>
                    <tr>
                      <td class="text-left">Customer Group</td>
                      <td class="text-right">Quantity</td>
                      <td class="text-right">Priority</td>
                      <td class="text-right">Price</td>
                      <td class="text-left">Date Start</td>
                      <td class="text-left">Date End</td>
                      <td></td>
                    </tr>
                  </thead>
                  <tbody>
                  
                                                        </tbody>
                  
                  <tfoot>
                    <tr>
                      <td colspan="6"></td>
                      <td class="text-left"><button type="button" onclick="addDiscount();" data-toggle="tooltip" title="Add Discount" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
            <div class="tab-pane" id="tab-special">
              <div class="table-responsive">
                <table id="special" class="table table-striped table-bordered table-hover">
                  <thead>
                    <tr>
                      <td class="text-left">Customer Group</td>
                      <td class="text-right">Priority</td>
                      <td class="text-right">Price</td>
                      <td class="text-left">Date Start</td>
                      <td class="text-left">Date End</td>
                      <td></td>
                    </tr>
                  </thead>
                  <tbody>
                  
                                                        </tbody>
                  
                  <tfoot>
                    <tr>
                      <td colspan="5"></td>
                      <td class="text-left"><button type="button" onclick="addSpecial();" data-toggle="tooltip" title="Add Special" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
            <div class="tab-pane" id="tab-image">
              <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                  <thead>
                    <tr>
                      <td class="text-left">Image</td>
                    </tr>
                  </thead>
                  <tbody>
                    
                      <td >

                      <div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"></label>
                        
						<div class="img-thumbnail">
							<div class="fileinput fileinput-new" data-provides="fileinput">
								<div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
									<img src="http://localhost/fa/assets/images/attach.svg">
								</div>
								<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px" ></div>
								<div>
									<span class="btn btn-white btn-file">
										<span class="fileinput-new">Select file</span>
										<span class="fileinput-exists">Change</span>
										<input type="file" name="result_file" >
									</span>
									<a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
								</div>
							</div>
						</div>
					</div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="table-responsive">
                <table id="images" class="table table-striped table-bordered table-hover">
                  <thead>
                    <tr>
                      <td class="text-left">Additional Images</td>
                      <td class="text-right">Sort Order</td>
                      <td></td>
                    </tr>
                  </thead>
                  <tbody>
                  
                                                        </tbody>
                  
                  <tfoot>
                    <tr>
                      <td colspan="2"></td>
                      <td class="text-left"><button type="button" onclick="addImage();" data-toggle="tooltip" title="Add Image" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
            <div class="tab-pane" id="tab-reward">
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-points"><span data-toggle="tooltip" title="Number of points needed to buy this item. If you don't want this product to be purchased with points leave as 0.">Points</span></label>
                <div class="col-sm-10">
                  <input type="text" name="points" value="" placeholder="Points" id="input-points" class="form-control" />
                </div>
              </div>
              <div class="table-responsive">
                <table class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <td class="text-left">Customer Group</td>
                      <td class="text-right">Reward Points</td>
                    </tr>
                  </thead>
                  <tbody>
                  
                                    <tr>
                    <td class="text-left">Default</td>
                    <td class="text-right"><input type="text" name="product_reward[1][points]" value="" class="form-control" /></td>
                  </tr>
                                      </tbody>
                  
                </table>
              </div>
            </div>
            <div class="tab-pane" id="tab-seo">
              <div class="alert alert-info"><i class="fa fa-info-circle"></i> Do not use spaces, instead replace spaces with - and make sure the SEO URL is globally unique.</div>            
              <div class="table-responsive">
                <table class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <td class="text-left">Stores</td>
          <td class="text-left">Keyword</td>
                    </tr>
                  </thead>
                  <tbody>
                                    <tr>
                    <td class="text-left">Default</td>
                    <td class="text-left">                      <div class="input-group"><span class="input-group-addon"><img src="<?php echo base_url() ?>assets/language/en-gb/en-gb.png" title="English" /></span>
                        <input type="text" name="product_seo_url[0][1]" value="" placeholder="Keyword" class="form-control" />
                      </div>
                       
                      </td>
                  </tr>
                                      </tbody>
                  
                </table>
              </div>
            </div>
            <div class="tab-pane" id="tab-design">
              <div class="table-responsive">
                <table class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <td class="text-left">Stores</td>
                      <td class="text-left">Layout Override</td>
                    </tr>
                  </thead>
                  <tbody>
                                    <tr>
                    <td class="text-left">Default</td>
                    <td class="text-left"><select name="product_layout[0]" class="form-control">
                        <option value=""></option>
                        

                                                    
                        
                        <option value="6">Account</option>
                        

                                                                              
                        
                        <option value="10">Affiliate</option>
                        

                                                                              
                        
                        <option value="3">Category</option>
                        

                                                                              
                        
                        <option value="7">Checkout</option>
                        

                                                                              
                        
                        <option value="12">Compare</option>
                        

                                                                              
                        
                        <option value="8">Contact</option>
                        

                                                                              
                        
                        <option value="4">Default</option>
                        

                                                                              
                        
                        <option value="1">Home</option>
                        

                                                                              
                        
                        <option value="11">Information</option>
                        

                                                                              
                        
                        <option value="5">Manufacturer</option>
                        

                                                                              
                        
                        <option value="2">Product</option>
                        

                                                                              
                        
                        <option value="13">Search</option>
                        

                                                                              
                        
                        <option value="9">Sitemap</option>
                        

                                                    
                      
                      </select></td>
                  </tr>
                                    </tbody>
                </table>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <link href="view/javascript/codemirror/lib/codemirror.css" rel="stylesheet" />
  <link href="view/javascript/codemirror/theme/monokai.css" rel="stylesheet" />
  <script type="text/javascript" src="view/javascript/codemirror/lib/codemirror.js"></script> 
  <script type="text/javascript" src="view/javascript/codemirror/lib/xml.js"></script> 
  <script type="text/javascript" src="view/javascript/codemirror/lib/formatting.js"></script> 
  <script type="text/javascript" src="view/javascript/summernote/summernote.js"></script>
  <link href="view/javascript/summernote/summernote.css" rel="stylesheet" />
  <script type="text/javascript" src="view/javascript/summernote/summernote-image-attributes.js"></script> 
  <script type="text/javascript" src="view/javascript/summernote/opencart.js"></script> 
  <script type="text/javascript"><!--
// Manufacturer
$('input[name=\'manufacturer\']').autocomplete({
  'source': function(request, response) {
    $.ajax({
      url: '<?php echo base_url() ?>addproduct' +  encodeURIComponent(request),
      dataType: 'json',
      success: function(json) {
        json.unshift({
          manufacturer_id: 0,
          name: ' --- None --- '
        });

        response($.map(json, function(item) {
          return {
            label: item['name'],
            value: item['manufacturer_id']
          }
        }));
      }
    });
  },
  'select': function(item) {
    $('input[name=\'manufacturer\']').val(item['label']);
    $('input[name=\'manufacturer_id\']').val(item['value']);
  }
});

// Category
$('input[name=\'category\']').autocomplete({
  'source': function(request, response) {
    $.ajax({
      url: '<?php echo base_url() ?>addproduct' +  encodeURIComponent(request),
      dataType: 'json',
      success: function(json) {
        response($.map(json, function(item) {
          return {
            label: item['name'],
            value: item['category_id']
          }
        }));
      }
    });
  },
  'select': function(item) {
    $('input[name=\'category\']').val('');

    $('#product-category' + item['value']).remove();

    $('#product-category').append('<div id="product-category' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="product_category[]" value="' + item['value'] + '" /></div>');
  }
});

$('#product-category').delegate('.fa-minus-circle', 'click', function() {
  $(this).parent().remove();
});

// Filter
$('input[name=\'filter\']').autocomplete({
  'source': function(request, response) {
    $.ajax({
      url: '<?php echo base_url() ?>addproduct' +  encodeURIComponent(request),
      dataType: 'json',
      success: function(json) {
        response($.map(json, function(item) {
          return {
            label: item['name'],
            value: item['filter_id']
          }
        }));
      }
    });
  },
  'select': function(item) {
    $('input[name=\'filter\']').val('');

    $('#product-filter' + item['value']).remove();

    $('#product-filter').append('<div id="product-filter' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="product_filter[]" value="' + item['value'] + '" /></div>');
  }
});

$('#product-filter').delegate('.fa-minus-circle', 'click', function() {
  $(this).parent().remove();
});

// Downloads
$('input[name=\'download\']').autocomplete({
  'source': function(request, response) {
    $.ajax({
      url: '<?php echo base_url() ?>addproduct' +  encodeURIComponent(request),
      dataType: 'json',
      success: function(json) {
        response($.map(json, function(item) {
          return {
            label: item['name'],
            value: item['download_id']
          }
        }));
      }
    });
  },
  'select': function(item) {
    $('input[name=\'download\']').val('');

    $('#product-download' + item['value']).remove();

    $('#product-download').append('<div id="product-download' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="product_download[]" value="' + item['value'] + '" /></div>');
  }
});

$('#product-download').delegate('.fa-minus-circle', 'click', function() {
  $(this).parent().remove();
});

// Related
$('input[name=\'related\']').autocomplete({
  'source': function(request, response) {
    $.ajax({
      url: '<?php echo base_url() ?>addproduct' +  encodeURIComponent(request),
      dataType: 'json',
      success: function(json) {
        response($.map(json, function(item) {
          return {
            label: item['name'],
            value: item['product_id']
          }
        }));
      }
    });
  },
  'select': function(item) {
    $('input[name=\'related\']').val('');

    $('#product-related' + item['value']).remove();

    $('#product-related').append('<div id="product-related' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="product_related[]" value="' + item['value'] + '" /></div>');
  }
});

$('#product-related').delegate('.fa-minus-circle', 'click', function() {
  $(this).parent().remove();
});
//--></script> 
  <script type="text/javascript"><!--
var attribute_row = 0;

function addAttribute() {
    html  = '<tr id="attribute-row' + attribute_row + '">';
  html += '  <td class="text-left" style="width: 20%;"><input type="text" name="product_attribute[' + attribute_row + '][name]" value="" placeholder="Attribute" class="form-control" /><input type="hidden" name="product_attribute[' + attribute_row + '][attribute_id]" value="" /></td>';
  html += '  <td class="text-left">';
    html += '<div class="input-group"><span class="input-group-addon"><img src="<?php echo base_url() ?>assets/language/en-gb/en-gb.png" title="English" /></span><textarea name="product_attribute[' + attribute_row + '][product_attribute_description][1][text]" rows="5" placeholder="Text" class="form-control"></textarea></div>';
      html += '  </td>';
  html += '  <td class="text-right"><button type="button" onclick="$(\'#attribute-row' + attribute_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
    html += '</tr>';

  $('#attribute tbody').append(html);

  attributeautocomplete(attribute_row);

  attribute_row++;
}

function attributeautocomplete(attribute_row) {
  $('input[name=\'product_attribute[' + attribute_row + '][name]\']').autocomplete({
    'source': function(request, response) {
      $.ajax({
        url: '<?php echo base_url() ?>addproduct' +  encodeURIComponent(request),
        dataType: 'json',
        success: function(json) {
          response($.map(json, function(item) {
            return {
              category: item.attribute_group,
              label: item.name,
              value: item.attribute_id
            }
          }));
        }
      });
    },
    'select': function(item) {
      $('input[name=\'product_attribute[' + attribute_row + '][name]\']').val(item['label']);
      $('input[name=\'product_attribute[' + attribute_row + '][attribute_id]\']').val(item['value']);
    }
  });
}

$('#attribute tbody tr').each(function(index, element) {
  attributeautocomplete(index);
});
//--></script> 
  <script type="text/javascript"><!--
var option_row = 0;

$('input[name=\'option\']').autocomplete({
  'source': function(request, response) {
    $.ajax({
      url: '<?php echo base_url() ?>addproduct' +  encodeURIComponent(request),
      dataType: 'json',
      success: function(json) {
        response($.map(json, function(item) {
          return {
            category: item['category'],
            label: item['name'],
            value: item['option_id'],
            type: item['type'],
            option_value: item['option_value']
          }
        }));
      }
    });
  },
  'select': function(item) {
    html  = '<div class="tab-pane" id="tab-option' + option_row + '">';
    html += ' <input type="hidden" name="product_option[' + option_row + '][product_option_id]" value="" />';
    html += ' <input type="hidden" name="product_option[' + option_row + '][name]" value="' + item['label'] + '" />';
    html += ' <input type="hidden" name="product_option[' + option_row + '][option_id]" value="' + item['value'] + '" />';
    html += ' <input type="hidden" name="product_option[' + option_row + '][type]" value="' + item['type'] + '" />';

    html += ' <div class="form-group">';
    html += '   <label class="col-sm-2 control-label" for="input-required' + option_row + '">Required</label>';
    html += '   <div class="col-sm-10"><select name="product_option[' + option_row + '][required]" id="input-required' + option_row + '" class="form-control">';
    html += '       <option value="1">Yes</option>';
    html += '       <option value="0">No</option>';
    html += '   </select></div>';
    html += ' </div>';

    if (item['type'] == 'text') {
      html += ' <div class="form-group">';
      html += '   <label class="col-sm-2 control-label" for="input-value' + option_row + '">Option Value</label>';
      html += '   <div class="col-sm-10"><input type="text" name="product_option[' + option_row + '][value]" value="" placeholder="Option Value" id="input-value' + option_row + '" class="form-control" /></div>';
      html += ' </div>';
    }

    if (item['type'] == 'textarea') {
      html += ' <div class="form-group">';
      html += '   <label class="col-sm-2 control-label" for="input-value' + option_row + '">Option Value</label>';
      html += '   <div class="col-sm-10"><textarea name="product_option[' + option_row + '][value]" rows="5" placeholder="Option Value" id="input-value' + option_row + '" class="form-control"></textarea></div>';
      html += ' </div>';
    }

    if (item['type'] == 'file') {
      html += ' <div class="form-group" style="display: none;">';
      html += '   <label class="col-sm-2 control-label" for="input-value' + option_row + '">Option Value</label>';
      html += '   <div class="col-sm-10"><input type="text" name="product_option[' + option_row + '][value]" value="" placeholder="Option Value" id="input-value' + option_row + '" class="form-control" /></div>';
      html += ' </div>';
    }

    if (item['type'] == 'date') {
      html += ' <div class="form-group">';
      html += '   <label class="col-sm-2 control-label" for="input-value' + option_row + '">Option Value</label>';
      html += '   <div class="col-sm-3"><div class="input-group date"><input type="text" name="product_option[' + option_row + '][value]" value="" placeholder="Option Value" data-date-format="YYYY-MM-DD" id="input-value' + option_row + '" class="form-control" /><span class="input-group-btn"><button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button></span></div></div>';
      html += ' </div>';
    }

    if (item['type'] == 'time') {
      html += ' <div class="form-group">';
      html += '   <label class="col-sm-2 control-label" for="input-value' + option_row + '">Option Value</label>';
      html += '   <div class="col-sm-10"><div class="input-group time"><input type="text" name="product_option[' + option_row + '][value]" value="" placeholder="Option Value" data-date-format="HH:mm" id="input-value' + option_row + '" class="form-control" /><span class="input-group-btn"><button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button></span></div></div>';
      html += ' </div>';
    }

    if (item['type'] == 'datetime') {
      html += ' <div class="form-group">';
      html += '   <label class="col-sm-2 control-label" for="input-value' + option_row + '">Option Value</label>';
      html += '   <div class="col-sm-10"><div class="input-group datetime"><input type="text" name="product_option[' + option_row + '][value]" value="" placeholder="Option Value" data-date-format="YYYY-MM-DD HH:mm" id="input-value' + option_row + '" class="form-control" /><span class="input-group-btn"><button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button></span></div></div>';
      html += ' </div>';
    }

    if (item['type'] == 'select' || item['type'] == 'radio' || item['type'] == 'checkbox' || item['type'] == 'image') {
      html += '<div class="table-responsive">';
      html += '  <table id="option-value' + option_row + '" class="table table-striped table-bordered table-hover">';
      html += '    <thead>';
      html += '      <tr>';
      html += '        <td class="text-left">Option Value</td>';
      html += '        <td class="text-right">Quantity</td>';
      html += '        <td class="text-left">Subtract Stock</td>';
      html += '        <td class="text-right">Price</td>';
      html += '        <td class="text-right">Points</td>';
      html += '        <td class="text-right">Weight</td>';
      html += '        <td></td>';
      html += '      </tr>';
      html += '    </thead>';
      html += '    <tbody>';
      html += '    </tbody>';
      html += '    <tfoot>';
      html += '      <tr>';
      html += '        <td colspan="6"></td>';
      html += '        <td class="text-left"><button type="button" onclick="addOptionValue(' + option_row + ');" data-toggle="tooltip" title="Add Option Value" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>';
      html += '      </tr>';
      html += '    </tfoot>';
      html += '  </table>';
      html += '</div>';

            html += '  <select id="option-values' + option_row + '" style="display: none;">';

            for (i = 0; i < item['option_value'].length; i++) {
        html += '  <option value="' + item['option_value'][i]['option_value_id'] + '">' + item['option_value'][i]['name'] + '</option>';
            }

            html += '  </select>';
      html += '</div>';
    }

    $('#tab-option .tab-content').append(html);

    $('#option > li:last-child').before('<li><a href="#tab-option' + option_row + '" data-toggle="tab"><i class="fa fa-minus-circle" onclick=" $(\'#option a:first\').tab(\'show\');$(\'a[href=\\\'#tab-option' + option_row + '\\\']\').parent().remove(); $(\'#tab-option' + option_row + '\').remove();"></i>' + item['label'] + '</li>');

    $('#option a[href=\'#tab-option' + option_row + '\']').tab('show');

    $('[data-toggle=\'tooltip\']').tooltip({
      container: 'body',
      html: true
    });

    $('.date').datetimepicker({
      language: 'en-gb',
      pickTime: false
    });

    $('.time').datetimepicker({
      language: 'en-gb',
      pickDate: false
    });

    $('.datetime').datetimepicker({
      language: 'en-gb',
      pickDate: true,
      pickTime: true
    });

    option_row++;
  }
});
//--></script> 
  <script type="text/javascript"><!--
var option_value_row = 0;

function addOptionValue(option_row) {
  html  = '<tr id="option-value-row' + option_value_row + '">';
  html += '  <td class="text-left"><select name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][option_value_id]" class="form-control">';
  html += $('#option-values' + option_row).html();
  html += '  </select><input type="hidden" name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][product_option_value_id]" value="" /></td>';
  html += '  <td class="text-right"><input type="text" name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][quantity]" value="" placeholder="Quantity" class="form-control" /></td>';
  html += '  <td class="text-left"><select name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][subtract]" class="form-control">';
  html += '    <option value="1">Yes</option>';
  html += '    <option value="0">No</option>';
  html += '  </select></td>';
  html += '  <td class="text-right"><select name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][price_prefix]" class="form-control">';
  html += '    <option value="+">+</option>';
  html += '    <option value="-">-</option>';
  html += '  </select>';
  html += '  <input type="text" name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][price]" value="" placeholder="Price" class="form-control" /></td>';
  html += '  <td class="text-right"><select name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][points_prefix]" class="form-control">';
  html += '    <option value="+">+</option>';
  html += '    <option value="-">-</option>';
  html += '  </select>';
  html += '  <input type="text" name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][points]" value="" placeholder="Points" class="form-control" /></td>';
  html += '  <td class="text-right"><select name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][weight_prefix]" class="form-control">';
  html += '    <option value="+">+</option>';
  html += '    <option value="-">-</option>';
  html += '  </select>';
  html += '  <input type="text" name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][weight]" value="" placeholder="Weight" class="form-control" /></td>';
  html += '  <td class="text-left"><button type="button" onclick="$(this).tooltip(\'destroy\');$(\'#option-value-row' + option_value_row + '\').remove();" data-toggle="tooltip" rel="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
  html += '</tr>';

  $('#option-value' + option_row + ' tbody').append(html);
  $('[rel=tooltip]').tooltip();

  option_value_row++;
}
//--></script> 
  <script type="text/javascript"><!--
var discount_row = 0;

function addDiscount() {
  html  = '<tr id="discount-row' + discount_row + '">';
    html += '  <td class="text-left"><select name="product_discount[' + discount_row + '][customer_group_id]" class="form-control">';
        html += '    <option value="1">Default</option>';
        html += '  </select></td>';
    html += '  <td class="text-right"><input type="text" name="product_discount[' + discount_row + '][quantity]" value="" placeholder="Quantity" class="form-control" /></td>';
    html += '  <td class="text-right"><input type="text" name="product_discount[' + discount_row + '][priority]" value="" placeholder="Priority" class="form-control" /></td>';
  html += '  <td class="text-right"><input type="text" name="product_discount[' + discount_row + '][price]" value="" placeholder="Price" class="form-control" /></td>';
    html += '  <td class="text-left" style="width: 20%;"><div class="input-group date"><input type="text" name="product_discount[' + discount_row + '][date_start]" value="" placeholder="Date Start" data-date-format="YYYY-MM-DD" class="form-control" /><span class="input-group-btn"><button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button></span></div></td>';
  html += '  <td class="text-left" style="width: 20%;"><div class="input-group date"><input type="text" name="product_discount[' + discount_row + '][date_end]" value="" placeholder="Date End" data-date-format="YYYY-MM-DD" class="form-control" /><span class="input-group-btn"><button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button></span></div></td>';
  html += '  <td class="text-left"><button type="button" onclick="$(\'#discount-row' + discount_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
  html += '</tr>';

  $('#discount tbody').append(html);

  $('.date').datetimepicker({
    pickTime: false
  });

  discount_row++;
}
//--></script> 
  <script type="text/javascript"><!--
var special_row = 0;

function addSpecial() {
  html  = '<tr id="special-row' + special_row + '">';
    html += '  <td class="text-left"><select name="product_special[' + special_row + '][customer_group_id]" class="form-control">';
        html += '      <option value="1">Default</option>';
        html += '  </select></td>';
    html += '  <td class="text-right"><input type="text" name="product_special[' + special_row + '][priority]" value="" placeholder="Priority" class="form-control" /></td>';
  html += '  <td class="text-right"><input type="text" name="product_special[' + special_row + '][price]" value="" placeholder="Price" class="form-control" /></td>';
    html += '  <td class="text-left" style="width: 20%;"><div class="input-group date"><input type="text" name="product_special[' + special_row + '][date_start]" value="" placeholder="Date Start" data-date-format="YYYY-MM-DD" class="form-control" /><span class="input-group-btn"><button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button></span></div></td>';
  html += '  <td class="text-left" style="width: 20%;"><div class="input-group date"><input type="text" name="product_special[' + special_row + '][date_end]" value="" placeholder="Date End" data-date-format="YYYY-MM-DD" class="form-control" /><span class="input-group-btn"><button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button></span></div></td>';
  html += '  <td class="text-left"><button type="button" onclick="$(\'#special-row' + special_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
  html += '</tr>';

  $('#special tbody').append(html);

  $('.date').datetimepicker({
    language: 'en-gb',
    pickTime: false
  });

  special_row++;
}
//--></script> 
  <script type="text/javascript"><!--
var image_row = 0;

function addImage() {
  html  = '<tr id="image-row' + image_row + '">';
  html += '  <td class="text-left"><a href="" id="thumb-image' + image_row + '"data-toggle="image" class="img-thumbnail"><img src="http://localhost/opencart/image/cache/no_image-100x100.png" alt="" title="" data-placeholder="http://localhost/opencart/image/cache/no_image-100x100.png" /></a><input type="hidden" name="product_image[' + image_row + '][image]" value="" id="input-image' + image_row + '" /></td>';
  html += '  <td class="text-right"><input type="text" name="product_image[' + image_row + '][sort_order]" value="" placeholder="Sort Order" class="form-control" /></td>';
  html += '  <td class="text-left"><button type="button" onclick="$(\'#image-row' + image_row  + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
  html += '</tr>';

  $('#images tbody').append(html);

  image_row++;
}
//--></script> 
  <script type="text/javascript"><!--
var recurring_row = 0;

function addRecurring() {
  html  = '<tr id="recurring-row' + recurring_row + '">';
  html += '  <td class="left">';
  html += '    <select name="product_recurring[' + recurring_row + '][recurring_id]" class="form-control">>';
    html += '    </select>';
  html += '  </td>';
  html += '  <td class="left">';
  html += '    <select name="product_recurring[' + recurring_row + '][customer_group_id]" class="form-control">>';
    html += '      <option value="1">Default</option>';
    html += '    <select>';
  html += '  </td>';
  html += '  <td class="left">';
  html += '    <a onclick="$(\'#recurring-row' + recurring_row + '\').remove()" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></a>';
  html += '  </td>';
  html += '</tr>';

  $('#tab-recurring table tbody').append(html);

  recurring_row++;
}
//--></script> 
  <script type="text/javascript"><!--
$('.date').datetimepicker({
  language: 'en-gb',
  pickTime: false
});

$('.time').datetimepicker({
  language: 'en-gb',
  pickDate: false
});

$('.datetime').datetimepicker({
  language: 'en-gb',
  pickDate: true,
  pickTime: true
});
//--></script> 
  <script type="text/javascript"><!--
$('#language a:first').tab('show');
$('#option a:first').tab('show');
//--></script></div>