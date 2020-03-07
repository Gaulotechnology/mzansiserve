<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right"><a href="" data-toggle="tooltip" title="Add New" class="btn btn-primary"><i class="fa fa-plus"></i></a>
        <button type="submit" form="form-recurring" formaction="" data-toggle="tooltip" title="Copy" class="btn btn-default"><i class="fa fa-copy"></i></button>
        <button type="button" data-toggle="tooltip" title="Delete" class="btn btn-danger" onclick="confirm('Are you sure?') ? $('#form-recurring').submit() : false;"><i class="fa fa-trash-o"></i></button>
      </div>
      <h1>Recurring Profiles</h1>
      <ul class="breadcrumb">
                <li><a href="">Home</a></li>
                <li><a href="">Recurring Profiles</a></li>
              </ul>
    </div>
  </div>
  <div class="container-fluid">
            <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i> Recurring Profile List</h3>
      </div>
      <div class="panel-body">
        <form action="" method="post" enctype="multipart/form-data" id="form-recurring">
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <td class="text-center" width="1"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
                  <td class="text-left">  <a href="">Name</a>
                    </td>
                  <td class="text-right"> <a href="">Sort Order</a>
                    </td>
                  <td class="text-right">Action</td>
                </tr>
              </thead>
              <tbody>
                                <tr>
                  <td class="text-center" colspan="4">No results!</td>
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