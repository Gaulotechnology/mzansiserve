<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="button" data-toggle="tooltip" title="Filter" onclick="$('#filter-product').toggleClass('hidden-sm hidden-xs');" class="btn btn-default hidden-md hidden-lg"><i class="fa fa-filter"></i></button>
        <a href="<?php echo base_url(); ?>page/addproduct" data-toggle="tooltip" title="Add New" class="btn btn-primary"><i class="fa fa-plus"></i></a>
        <button type="submit" form="form-product" formaction="" data-toggle="tooltip" title="Copy" class="btn btn-default"><i class="fa fa-copy"></i></button>
        <button type="button" form="form-product" formaction="" data-toggle="tooltip" title="Delete" class="btn btn-danger" onclick="confirm('Are you sure?') ? $('#form-product').submit() : false;"><i class="fa fa-trash-o"></i></button>
        <?php
if($this->session->flashdata('flash_message')=="delete successful"){ ?>
<?php } ?>
<?php if($this->session->flashdata('flash_message')=="delete failed"){ ?>

<?php } ?>
      </div>
      <h1>Products</h1>
      <ul class="breadcrumb">
                <li><a href="">Home</a></li>
                <li><a href="">Products</a></li>
              </ul>
    </div>
  </div>
  <div class="container-fluid">        <div class="row">
      <div id="filter-product" class="col-md-3 col-md-push-9 col-sm-12 hidden-sm hidden-xs">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-filter"></i> Filter</h3>
          </div>
          <div class="panel-body">
            <div class="form-group">
              <label class="control-label" for="input-name">Product Name</label>
              <input type="text" name="filter_name" value="" placeholder="Product Name" id="input-name" class="form-control" />
            </div>
            <div class="form-group">
              <label class="control-label" for="input-model">Model</label>
              <input type="text" name="filter_model" value="" placeholder="Model" id="input-model" class="form-control" />
            </div>
            <div class="form-group">
              <label class="control-label" for="input-price">Price</label>
              <input type="text" name="filter_price" value="" placeholder="Price" id="input-price" class="form-control" />
            </div>
            <div class="form-group">
              <label class="control-label" for="input-quantity">Quantity</label>
              <input type="text" name="filter_quantity" value="" placeholder="Quantity" id="input-quantity" class="form-control" />
            </div>
            <div class="form-group">
              <label class="control-label" for="input-status">Status</label>
              <select name="filter_status" id="input-status" class="form-control">
                <option value=""></option>
                <option value="1">Enabled</option>
                <option value="0">Disabled</option>
              </select>
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
            <h3 class="panel-title"><i class="fa fa-list"></i> Product List</h3>
          </div>
          <div class="panel-body">
            <form action="<?php echo base_url() ?>products/delete" method="post" enctype="multipart/form-data" id="form-product">
              <div class="table-responsive">
                <table class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
                      <td class="text-center">Image</td>
                      <td class="text-left"> <a href="" class="asc">Product Name</a> </td>
                      <td class="text-left"> <a href="">Model</a> </td>
                      <td class="text-right"> <a href="">Price</a> </td>
                      <td class="text-right"> <a href="">Quantity</a> </td>
                      <td class="text-left"> <a href="">Status</a> </td>
                      <td class="text-right">Action</td>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    foreach($products as $prod){
                    ?>
                  
                    <tr>
                    <td class="text-center"><input type="checkbox" name="selected[]" value="<?php echo $prod->product_id; ?>" />
                      </td>
                    <td class="text-center"> <img src="<?php echo base_url() ?>assets/images/<?php echo $prod->image ?>" alt="><?php echo $prod->name ?>" class="img-thumbnail" style="height:30px;" /> </td>
                    <td class="text-left"><?php echo $prod->name ?></td>
                    <td class="text-left"><?php echo $prod->p_model ?></td>
                    <td class="text-right"> 
                      <div class="text-danger">R<?php echo $prod->price ?></div>
                      </td>
                    <td class="text-right"> <span class="label label-success"><?php echo $prod->quantity ?></span> </td>
                    <td class="text-left">Enabled</td>
                    <td class="text-right"><a href="<?php echo base_url() ?>products/edit" data-toggle="tooltip" title="Edit" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
                  </tr>
                    <?php } ?>

                                   
                                                        </tbody>
                  
                </table>
              </div>
            </form>
            <div class="row">
              <div class="col-sm-6 text-left"></div>
              <div class="col-sm-6 text-right"><?php echo $this->pagination->create_links(); ?></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript"><!--
$('#button-filter').on('click', function() {
  var url = '';

  var filter_name = $('input[name=\'filter_name\']').val();

  if (filter_name) {
    url += '&filter_name=' + encodeURIComponent(filter_name);
  }

  var filter_model = $('input[name=\'filter_model\']').val();

  if (filter_model) {
    url += '&filter_model=' + encodeURIComponent(filter_model);
  }

  var filter_price = $('input[name=\'filter_price\']').val();

  if (filter_price) {
    url += '&filter_price=' + encodeURIComponent(filter_price);
  }

  var filter_quantity = $('input[name=\'filter_quantity\']').val();

  if (filter_quantity) {
    url += '&filter_quantity=' + encodeURIComponent(filter_quantity);
  }

  var filter_status = $('select[name=\'filter_status\']').val();

  if (filter_status !== '') {
    url += '&filter_status=' + encodeURIComponent(filter_status);
  }

  location = '<?php echo base_url() ?>products/' + url;
});
//--></script> 
  <script type="text/javascript"><!--
// IE and Edge fix!
$('button[form=\'form-product\']').on('click', function(e) {
  $('#form-product').attr('action', $(this).attr('formaction'));
});
  
$('input[name=\'filter_name\']').autocomplete({
  'source': function(request, response) {
    $.ajax({
      url: '<?php echo base_url() ?>products/' +  encodeURIComponent(request),
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
    $('input[name=\'filter_name\']').val(item['label']);
  }
});

$('input[name=\'filter_model\']').autocomplete({
  'source': function(request, response) {
    $.ajax({
      url: '<?php echo base_url() ?>products/' +  encodeURIComponent(request),
      dataType: 'json',
      success: function(json) {
        response($.map(json, function(item) {
          return {
            label: item['model'],
            value: item['product_id']
          }
        }));
      }
    });
  },
  'select': function(item) {
    $('input[name=\'filter_model\']').val(item['label']);
  }
});
//--></script></div>