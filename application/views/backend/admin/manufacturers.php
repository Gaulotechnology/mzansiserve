<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right"><a href="" data-toggle="tooltip" title="Add New" class="btn btn-primary"><i class="fa fa-plus"></i></a>
        <button type="button" data-toggle="tooltip" title="Delete" class="btn btn-danger" onclick="confirm('Are you sure?') ? $('#form-manufacturer').submit() : false;"><i class="fa fa-trash-o"></i></button>
      </div>
      <h1>Manufacturers</h1>
      <ul class="breadcrumb">
                <li><a href="">Home</a></li>
                <li><a href="">Manufacturers</a></li>
              </ul>
    </div>
  </div>
  <div class="container-fluid">
            <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i> Manufacturer List</h3>
      </div>
      <div class="panel-body">
        <form action="" method="post" enctype="multipart/form-data" id="form-manufacturer">
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
                  <td class="text-left"> <a href="" class="asc">Manufacturer Name</a>
                    </td>
                  <td class="text-right"> <a href="">Sort Order</a>
                    </td>
                  <td class="text-right">Action</td>
                </tr>
              </thead>
              <tbody>
                                                <tr>
                  <td class="text-center">                    <input type="checkbox" name="selected[]" value="8" />
                    </td>
                  <td class="text-left">Apple</td>
                  <td class="text-right">0</td>
                  <td class="text-right"><a href="" data-toggle="tooltip" title="Edit" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
                </tr>
                                <tr>
                  <td class="text-center">                    <input type="checkbox" name="selected[]" value="9" />
                    </td>
                  <td class="text-left">Canon</td>
                  <td class="text-right">0</td>
                  <td class="text-right"><a href="" data-toggle="tooltip" title="Edit" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
                </tr>
                                <tr>
                  <td class="text-center">                    <input type="checkbox" name="selected[]" value="7" />
                    </td>
                  <td class="text-left">Hewlett-Packard</td>
                  <td class="text-right">0</td>
                  <td class="text-right"><a href="" data-toggle="tooltip" title="Edit" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
                </tr>
                                <tr>
                  <td class="text-center">                    <input type="checkbox" name="selected[]" value="5" />
                    </td>
                  <td class="text-left">HTC</td>
                  <td class="text-right">0</td>
                  <td class="text-right"><a href="" data-toggle="tooltip" title="Edit" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
                </tr>
                                <tr>
                  <td class="text-center">                    <input type="checkbox" name="selected[]" value="6" />
                    </td>
                  <td class="text-left">Palm</td>
                  <td class="text-right">0</td>
                  <td class="text-right"><a href="" data-toggle="tooltip" title="Edit" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
                </tr>
                                <tr>
                  <td class="text-center">                    <input type="checkbox" name="selected[]" value="10" />
                    </td>
                  <td class="text-left">Sony</td>
                  <td class="text-right">0</td>
                  <td class="text-right"><a href="" data-toggle="tooltip" title="Edit" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
                </tr>
                                              </tbody>
            </table>
          </div>
        </form>
        <div class="row">
          <div class="col-sm-6 text-left"></div>
          <div class="col-sm-6 text-right">Showing 1 to 6 of 6 (1 Pages)</div>
        </div>
      </div>
    </div>
  </div>
</div>
