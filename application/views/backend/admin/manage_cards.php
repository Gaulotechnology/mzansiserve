<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
      
      <button type="button" data-toggle="tooltip" title="Filter" onclick="$('#filter-product').toggleClass('hidden-sm hidden-xs');" class="btn btn-default hidden-md hidden-lg"><i class="fa fa-filter"></i></button>
      <a href="javascript:;" class="btn btn-primary" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_cards_add/<?php echo $card->id ?>');"><i class="fa fa-plus"></i></a>
        <button type="submit" form="form-product" formaction="" data-toggle="tooltip" title="Copy" class="btn btn-default"><i class="fa fa-copy"></i></button>
        <button type="button" form="form-product" formaction="" data-toggle="tooltip" title="Delete" class="btn btn-danger" onclick="confirm('Are you sure?') ? $('#form-product').submit() : false;"><i class="fa fa-trash-o"></i></button>
        
        <?php
if($this->session->flashdata('flash_message')=="delete successful"){ ?>
<?php } ?>
<?php if($this->session->flashdata('flash_message')=="delete failed"){ ?>

<?php } ?>
      </div>
      <h1>Services</h1>
      <ul class="breadcrumb">
                <li><a href="">Cards</a></li>
                <li><a href="">Manage Cards</a></li>
              </ul>
    </div>
  </div>
  <div class="container-fluid">        <div class="row">
      
      <div class="col-md-12 col-sm-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-list"></i> Cards List</h3>
          </div>
          <div class="panel-body">
            <form action="<?php echo base_url() ?>page/manage_cards/delete" method="post" enctype="multipart/form-data" id="form-product">
              <div class="table-responsive">
                <table class="table table-bordered table-hover">
                  <thead>
                    <tr>
                    <td></td>
                      <td class="text-left"> <a href="" class="asc">Card Number</a> </td>
                      <td class="text-left"> <a href="">Holder</a> </td>
                      <td class="text-right"> <a href="">Expiry</a> </td>
                      <td class="text-left"> <a href="">Type</a> </td>
                      <td class="text-right">Action</td>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    foreach($cards as $card){
                     
                    ?>
                  
                    <tr>
                    <td class="text-left"><input type="checkbox" name="cards[]" value="<?php echo $card->id ?>"></td>
                      <td class="text-left"><?php echo $card->card_number ?></td>
                    <td class="text-left"><?php echo $card->card_holder ?></td>
                    <td class="text-right"> 
                      <div class="text-danger"><a href="#"><?php echo $card->card_expiry ?></a></div>
                      </td>
                    <td class="text-right"> <span class="label label-success"><?php echo $card->card_name ?></span> </td>
                    <td class="text-right"> <a href="#" class="btn btn-primary" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_cards_edit/<?php echo $card->id ?>');"><i class="fa fa-pencil"></i></a></td>
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

  location = '<?php echo base_url() ?>page/manage_cards/' + url;
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
      url: '<?php echo base_url() ?>page/manage_cards/' +  encodeURIComponent(request),
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