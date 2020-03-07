<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right"><a href="" data-toggle="tooltip" title="Add New" class="btn btn-primary"><i class="fa fa-plus"></i></a>
        <button type="button" data-toggle="tooltip" title="Delete" class="btn btn-danger" onclick="confirm('Are you sure?') ? $('#form-information').submit() : false;"><i class="fa fa-trash-o"></i></button>
      </div>
      <h1>Information</h1>
      <ul class="breadcrumb">
                <li><a href="">Home</a></li>
                <li><a href="">Information</a></li>
              </ul>
    </div>
  </div>
  <div class="container-fluid">
            <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i> Information List</h3>
      </div>
      <div class="panel-body">
        <form action="" method="post" enctype="multipart/form-data" id="form-information">
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
                  <td class="text-left"> <a href="" class="asc">Information Title</a>
                    </td>
                  <td class="text-right"> <a href="">Sort Order</a>
                    </td>
                  <td class="text-right">Action</td>
                </tr>
              </thead>
              <tbody>
                                                <tr>
                  <td class="text-center">                    <input type="checkbox" name="selected[]" value="4" />
                    </td>
                  <td class="text-left">About Us</td>
                  <td class="text-right">1</td>
                  <td class="text-right"><a href="" data-toggle="tooltip" title="Edit" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
                </tr>
                                <tr>
                  <td class="text-center">                    <input type="checkbox" name="selected[]" value="6" />
                    </td>
                  <td class="text-left">Delivery Information</td>
                  <td class="text-right">2</td>
                  <td class="text-right"><a href="" data-toggle="tooltip" title="Edit" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
                </tr>
                                <tr>
                  <td class="text-center">                    <input type="checkbox" name="selected[]" value="3" />
                    </td>
                  <td class="text-left">Privacy Policy</td>
                  <td class="text-right">3</td>
                  <td class="text-right"><a href="" data-toggle="tooltip" title="Edit" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
                </tr>
                                <tr>
                  <td class="text-center">                    <input type="checkbox" name="selected[]" value="5" />
                    </td>
                  <td class="text-left">Terms &amp; Conditions</td>
                  <td class="text-right">4</td>
                  <td class="text-right"><a href="" data-toggle="tooltip" title="Edit" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
                </tr>
                                              </tbody>
            </table>
          </div>
        </form>
        <div class="row">
          <div class="col-sm-6 text-left"></div>
          <div class="col-sm-6 text-right">Showing 1 to 4 of 4 (1 Pages)</div>
        </div>
      </div>
    </div>
  </div>
</div>
