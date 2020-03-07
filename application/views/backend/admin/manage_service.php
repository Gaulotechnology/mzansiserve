<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
           <button type="submit" form="form-product" formaction="" data-toggle="tooltip" title="Copy" class="btn btn-default"><i class="fa fa-copy"></i></button>
          <?php
if($this->session->flashdata('flash_message')=="delete successful"){ ?>
<?php } ?>
<?php if($this->session->flashdata('flash_message')=="delete failed"){ ?>

<?php } ?>
      </div>
      <h1>Services</h1>
   
      <ul class="breadcrumb">
                <li><a href="">Services</a></li>
                <li><a href="">Manage Services</a></li>
              </ul>
    </div>
  </div>
  <div class="container-fluid">        <div class="row">
          <?php //if(isset($services[0]->service_name)){  ?>
  
      <div class="col-md-12 col-sm-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-list"></i> Service List</h3>
          </div>
          <div class="panel-body">
            <form action="<?php echo base_url() ?>products/delete" method="post" enctype="multipart/form-data" id="form-product">
              <div class="table-responsive">
                <table class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <td class="text-center">Image</td>
                      <td class="text-left"> <a href="" class="asc">Service Category</a> </td>
                      <td class="text-left"> <a href="">Contact Email</a> </td>
                      <td class="text-left"> <a href="">Contact Number</a> </td>
                      <td class="text-right"> <a href="">Location</a> </td>
                      <td class="text-left"> <a href="">Status</a> </td>
                      <td class="text-right">Action</td>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($services as $prod) {
                  
                        $user_id=$this->session->userdata('login_user_id'); ?>
                  
                    <tr>
                   
                    <td class="text-center"> <img src="<?php echo base_url() ?>uploads/users_image/<?php echo  $user_id.".jpg" ?>" alt="><?php echo $prod->name ?>" class="img-thumbnail" style="height:30px;" /> </td>
                    <td class="text-left"><?php echo $prod->service_name ?></td>
                    <td class="text-left"><?php echo $prod->email ?></td>
                    <td class="text-left"><?php echo $prod->cellphone ?></td>
                    <td class="text-right"> 
                      <div class="text-danger"><a href="#">-288888888, 23444444444</a></div>
                      </td>
                     <td class="text-left">Active</td>
                    <td class="text-right"><a href="#" class="btn btn-primary" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_services_edit/<?php echo $prod->id ?>');"><i class="fa fa-pencil"></i></a></td>
                  </tr>
                    <?php
                    } ?>

                                   
                                                        </tbody>
                  
                </table>
              </div>
            </form>
            <div class="row">
              <div class="col-sm-6 text-left"></div>
              <div class="col-sm-6 text-right"><?php echo $this->pagination->create_links(); ?></div>
            </div>

            <div class="panel-body">
            <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-list"></i> Service Description</h3>
          </div>
          </div>
            <form action="<?php echo base_url() ?>page/manage_service/update" method="post" enctype="multipart/form-data" id="form-product">
              <div class="table-responsive">
                <table class="table bordered table-hover">
                 <thead>
                 <tr>
                 <tr><td>Title <?php echo $prod->pID?></td><td><input type="text" class="form-control" value="<?php echo $prod->title ?>" name="title"></td><td>
                 </tr>
                 <tr><td>Description</td><td>
                 <textarea class="form-control" name="description"><?php echo $prod->description ?></textarea>
                 <input type="hidden" name="provider" id="provider" value="<?php echo $prod->provider_id ?>">
                 <input type="hidden" name="user_id" id="provider" value="<?php echo  $user_id ?>">
                 <input type="hidden" name="pID"  value="<?php echo $prod->pID  ?>">

                 
                 </td></tr>
                 <tr><td>Add Images</td><td>
                 <input type="file" class="form-control" name="service_image[]" multiple/>
                 </thead>

                 <tbody id="serviceAds">

                 </tbody>

                 <tfoot>
                 <tr><td></td><td><input type="submit" class="btn btn-primary" value="update services"></td></tr>
                 </tfoot>
                </table>
              </div>
            </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php
         // }
          //else{
            //echo "Registration is not yet complete <a href='".base_url()."page/multistep_registration'>click here to complete</a>";
         // }

    

           ?>       
                    <div style="height:300px;"></div>
  </div>

  <script type="text/javascript">

$( document ).ready(function() {
  $('#service_images').on('change', function() {
  var value = $(this).val();
  $("#serviceAds").empty();
  if(value!="none"){
  $("#serviceAds").append("<label>Emergency Contact Numbers</label>"); 
  for( var i=0; i<value; i++){
   $("#serviceAds").append("<tr><td></td><td><input type='file' class='form-control' name='service_image[]'></td></tr>");   
    } }  
      });
  
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
});
</script> 
  <script type="text/javascript">

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
</script></div>