<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="button" data-toggle="tooltip" title="Filter" onclick="$('#filter-review').toggleClass('hidden-sm hidden-xs');" class="btn btn-default hidden-md hidden-lg"><i class="fa fa-filter"></i></button>
        <a href="" data-toggle="tooltip" title="Add New" class="btn btn-primary"><i class="fa fa-plus"></i></a>
        <button type="button" data-toggle="tooltip" title="Delete" class="btn btn-danger" onclick="confirm('Are you sure?') ? $('#form-review').submit() : false;"><i class="fa fa-trash-o"></i></button>
      </div>
      <h1>Reviews</h1>
      <ul class="breadcrumb">
                <li><a href="">Home</a></li>
                <li><a href="">Reviews</a></li>
              </ul>
    </div>
  </div>
  <div class="container-fluid">        <div class="row">
      <div id="filter-review" class="col-md-3 col-md-push-9 col-sm-12 hidden-sm hidden-xs">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-filter"></i> Filter</h3>
          </div>
          <div  class="panel-body">
            <div class="form-group">
              <label class="control-label" for="input-product">Product</label>
              <input type="text" name="filter_product" value="" placeholder="Product" id="input-product" class="form-control" />
            </div>
            <div class="form-group">
              <label class="control-label" for="input-author">Author</label>
              <input type="text" name="filter_author" value="" placeholder="Author" id="input-author" class="form-control" />
            </div>
            <div class="form-group">
              <label class="control-label" for="input-status">Status</label>
              <select name="filter_status" id="input-status" class="form-control">
                <option value=""></option>
                
    
                <option value="1">Enabled</option>
                
     
                <option value="0">Disabled</option>
                
                                  
              </select>
            </div>
            <div class="form-group">
              <label class="control-label" for="input-date-added">Date Added</label>
              <div class="input-group date">
                <input type="text" name="filter_date_added" value="" placeholder="Date Added" data-date-format="YYYY-MM-DD" id="input-date-added" class="form-control" />
                <span class="input-group-btn">
                <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                </span></div>
            </div>
            <div class="form-group text-right">
              <button type="button" id="button-filter" class="btn btn-default"><i class="fa fa-filter"></i> Filter</button>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-9 col-md-pull-3 col-sm-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-list"></i> Review List</h3>
          </div>
          <div class="panel-body">
            <form action="" method="post" enctype="multipart/form-data" id="form-review">
              <div class="table-responsive">
                <table class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
                      <td class="text-left"> <a href="">Product</a> </td>
                      <td class="text-left"> <a href="">Author</a> </td>
                      <td class="text-right"> <a href="">Rating</a> </td>
                      <td class="text-left"> <a href="">Status</a> </td>
                      <td class="text-left"> <a href="" class="desc">Date Added</a> </td>
                      <td class="text-right">Action</td>
                    </tr>
                  </thead>
                  <tbody>
                  
                                    <tr>
                    <td class="text-center" colspan="7">No results!</td>
                  </tr>
                                      </tbody>
                  
                </table>
              </div>
            </form>
            <div class="row">
              <div class="col-sm-6 text-left"></div>
              <div class="col-sm-6 text-right">Showing 0 to 0 of 0 (0 Pages)</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript"><!--
$('#button-filter').on('click', function() {
	url = 'index.php?route=catalog/review&user_token=HPs3S0oyk7Np0JYUttf4dWE4kEVOxE03';
	
	var filter_product = $('input[name=\'filter_product\']').val();
	
	if (filter_product) {
		url += '&filter_product=' + encodeURIComponent(filter_product);
	}
	
	var filter_author = $('input[name=\'filter_author\']').val();
	
	if (filter_author) {
		url += '&filter_author=' + encodeURIComponent(filter_author);
	}
	
	var filter_status = $('select[name=\'filter_status\']').val();
	
	if (filter_status !== '') {
		url += '&filter_status=' + encodeURIComponent(filter_status); 
	}		
			
	var filter_date_added = $('input[name=\'filter_date_added\']').val();
	
	if (filter_date_added) {
		url += '&filter_date_added=' + encodeURIComponent(filter_date_added);
	}

	location = url;
});
//--></script> 
  <script type="text/javascript"><!--
$('.date').datetimepicker({
	language: 'en-gb',
	pickTime: false
});
//--></script></div>
