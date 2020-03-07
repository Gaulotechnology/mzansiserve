
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right"><a href="" data-toggle="tooltip" title="Add New" class="btn btn-primary"><i class="fa fa-plus"></i></a> <a href="" data-toggle="tooltip" title="Rebuild" class="btn btn-default"><i class="fa fa-refresh"></i></a>
        <button type="button" data-toggle="tooltip" title="Delete" class="btn btn-danger" onclick="confirm('Are you sure?') ? $('#form-category').submit() : false;"><i class="fa fa-trash-o"></i></button>
      </div>
      <h1>Categories</h1>
      <ul class="breadcrumb">
                <li><a href="">Home</a></li>
                <li><a href="">Blocked Accounts</a></li>
              </ul>
    </div>
  </div>
  <div class="container-fluid">



            <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i> Blocked Account List</h3>
      </div>
      <div class="panel-body">
        <form action="" method="post" enctype="multipart/form-data" id="form-category">
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
                  <td class="text-left"><a href="" class="asc">Service name</a>
                    </td>
                  <td class="text-right"><a href="">User Email</a></td>
                  <td class="text-right"><a href="">Cell Number</a></td>
                  <td class="text-right"><a href="">Uploaded Docs</a></td>
                  <td class="text-right">Action</td>
                </tr>
              </thead>
              <tbody>
              <?php foreach($pending_activations as $act): ?>
                  <tr>
                  <td class="text-center"><input type="checkbox" name="selected[]" value="33" /></td>
                  <td class="text-left"><?php echo $act->service_name ?></td>
                  <td class="text-right"><?php echo $act->email ?></td>
                  <td class="text-right"><?php echo $act->cellphone ?></td>
                  <td class="text-right"><a class="btn btn-info" title="Activate Now" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_download_docs');">Download/View</a></td>
                  <td class="text-right"><a class="btn btn-success" title="Activate Now"  onclick="showAjaxModal('<?php echo base_url().'modal/popup/modal_reactivate/'.$act->userID ?>');">Reactivate Now</button></a>
                </tr>
          <?php endforeach; ?>
                
                               
                </tbody>
            </table>
          </div>
         
        </form>
        <div class="row">
          <div class="col-sm-6 text-left"><ul class="pagination"><li class="active"><span>1</span></li><li><a href="">2</a></li><li><a href="">&gt;</a></li><li><a href="">&gt;|</a></li></ul></div>
          <div class="col-sm-6 text-right">Showing 1 to 20 of 38 (2 Pages)</div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
