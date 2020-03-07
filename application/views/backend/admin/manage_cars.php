<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
      <button type="button" data-toggle="tooltip" title="Filter" onclick="$('#filter-product').toggleClass('hidden-sm hidden-xs');" class="btn btn-default hidden-md hidden-lg"><i class="fa fa-filter"></i></button>
      <a href="#" class="btn btn-primary" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_cars_add/<?php echo $card->id ?>');"><i class="fa fa-plus"></i></a>
        <button type="submit" form="form-product" formaction="" data-toggle="tooltip" title="Copy" class="btn btn-default"><i class="fa fa-copy"></i></button>
        <button type="button" form="form-product" formaction="" data-toggle="tooltip" title="Delete" class="btn btn-danger" onclick="confirm('Are you sure?') ? $('#form-product').submit() : false;"><i class="fa fa-trash-o"></i></button>
        <?php
if($this->session->flashdata('flash_message')=="delete successful"){ ?>
<?php } ?>
<?php if($this->session->flashdata('flash_message')=="delete failed"){ ?>

<?php } ?>
      </div>
      <h1>Cars</h1>
      <ul class="breadcrumb">
                <li><a href="">Cars</a></li>
                <li><a href="">Manage Cars</a></li>
              </ul>
    </div>
  </div>
  <div class="container-fluid">        <div class="row">
      
      <div class="col-md-12 col-sm-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-list"></i> Cars List</h3>
          </div>
          <div class="panel-body">
            <form action="<?php echo base_url() ?>page/manage_cars/delete" method="post" enctype="multipart/form-data" id="form-product">
              <div class="table-responsive">
                <table class="table table-bordered table-hover">
                  <thead>
                    <tr>
                    <td></td>
                     
                      <td class="text-left"> <a href="">Car Type</a> </td>
                      <td class="text-right"> <a href="">Car Model</a> </td>
                      <td class="text-left"> <a href="" class="asc">Car Reg</a> </td>
                      <td class="text-left"> <a href="">Type</a> </td>
                      <td class="text-right">Action</td>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    foreach($cars as $car){
                     
                    ?>
                  
                    <tr>
                    <td class="text-left"><input type="checkbox" name="cars[]" value="<?php echo $car->id ?>"></td>
                      <td class="text-left"><?php echo $car->vehicle_type ?></td>
                    <td class="text-left"><?php echo $car->vehicle_model ?></td>
                    <td class="text-right"> 
                      <div class="text-danger"><a href="#"><?php echo $car->vehicle_registration ?> </a></div>
                      </td>
                    <td class="text-right"> <span class="label label-success"><?php echo $car->vehicle_type ?></span> </td>
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