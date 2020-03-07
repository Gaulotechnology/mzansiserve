<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right"><a href="" data-toggle="tooltip" title="Add New" class="btn btn-primary"><i class="fa fa-plus"></i></a> <a href="" data-toggle="tooltip" title="Rebuild" class="btn btn-default"><i class="fa fa-refresh"></i></a>
        <button type="button" data-toggle="tooltip" title="Delete" class="btn btn-danger" onclick="confirm('Are you sure?') ? $('#form-category').submit() : false;"><i class="fa fa-trash-o"></i></button>
      </div>
      <h1>Categories</h1>
      <ul class="breadcrumb">
                <li><a href="">Home</a></li>
                <li><a href="">Categories</a></li>
              </ul>
    </div>
  </div>
  <div class="container-fluid">
            <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i> Category List</h3>
      </div>
      <div class="panel-body">
        <form action="" method="post" enctype="multipart/form-data" id="form-category">
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
                  <td class="text-left">                    <a href="" class="asc">Category Name</a>
                    </td>
                  <td class="text-right">                    <a href="">Sort Order</a>
                    </td>
                  <td class="text-right">Action</td>
                </tr>
              </thead>
              <tbody>
                                                <tr>
                  <td class="text-center">                    <input type="checkbox" name="selected[]" value="33" />
                    </td>
                  <td class="text-left">Cameras</td>
                  <td class="text-right">6</td>
                  <td class="text-right"><a href="" data-toggle="tooltip" title="Edit" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
                </tr>
                                <tr>
                  <td class="text-center">                    <input type="checkbox" name="selected[]" value="25" />
                    </td>
                  <td class="text-left">Components</td>
                  <td class="text-right">3</td>
                  <td class="text-right"><a href="" data-toggle="tooltip" title="Edit" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
                </tr>
                                <tr>
                  <td class="text-center">                    <input type="checkbox" name="selected[]" value="29" />
                    </td>
                  <td class="text-left">Components&nbsp;&nbsp;&gt;&nbsp;&nbsp;Mice and Trackballs</td>
                  <td class="text-right">1</td>
                  <td class="text-right"><a href="" data-toggle="tooltip" title="Edit" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
                </tr>
                                <tr>
                  <td class="text-center">                    <input type="checkbox" name="selected[]" value="28" />
                    </td>
                  <td class="text-left">Components&nbsp;&nbsp;&gt;&nbsp;&nbsp;Monitors</td>
                  <td class="text-right">1</td>
                  <td class="text-right"><a href="" data-toggle="tooltip" title="Edit" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
                </tr>
                                <tr>
                  <td class="text-center">                    <input type="checkbox" name="selected[]" value="35" />
                    </td>
                  <td class="text-left">Components&nbsp;&nbsp;&gt;&nbsp;&nbsp;Monitors&nbsp;&nbsp;&gt;&nbsp;&nbsp;test 1</td>
                  <td class="text-right">0</td>
                  <td class="text-right"><a href="" data-toggle="tooltip" title="Edit" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
                </tr>
                                <tr>
                  <td class="text-center">                    <input type="checkbox" name="selected[]" value="36" />
                    </td>
                  <td class="text-left">Components&nbsp;&nbsp;&gt;&nbsp;&nbsp;Monitors&nbsp;&nbsp;&gt;&nbsp;&nbsp;test 2</td>
                  <td class="text-right">0</td>
                  <td class="text-right"><a href="" data-toggle="tooltip" title="Edit" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
                </tr>
                                <tr>
                  <td class="text-center">                    <input type="checkbox" name="selected[]" value="30" />
                    </td>
                  <td class="text-left">Components&nbsp;&nbsp;&gt;&nbsp;&nbsp;Printers</td>
                  <td class="text-right">1</td>
                  <td class="text-right"><a href="" data-toggle="tooltip" title="Edit" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
                </tr>
                                <tr>
                  <td class="text-center">                    <input type="checkbox" name="selected[]" value="31" />
                    </td>
                  <td class="text-left">Components&nbsp;&nbsp;&gt;&nbsp;&nbsp;Scanners</td>
                  <td class="text-right">1</td>
                  <td class="text-right"><a href="" data-toggle="tooltip" title="Edit" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
                </tr>
                                <tr>
                  <td class="text-center">                    <input type="checkbox" name="selected[]" value="32" />
                    </td>
                  <td class="text-left">Components&nbsp;&nbsp;&gt;&nbsp;&nbsp;Web Cameras</td>
                  <td class="text-right">1</td>
                  <td class="text-right"><a href="" data-toggle="tooltip" title="Edit" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
                </tr>
                                <tr>
                  <td class="text-center">                    <input type="checkbox" name="selected[]" value="20" />
                    </td>
                  <td class="text-left">Desktops</td>
                  <td class="text-right">1</td>
                  <td class="text-right"><a href="" data-toggle="tooltip" title="Edit" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
                </tr>
                                <tr>
                  <td class="text-center">                    <input type="checkbox" name="selected[]" value="27" />
                    </td>
                  <td class="text-left">Desktops&nbsp;&nbsp;&gt;&nbsp;&nbsp;Mac</td>
                  <td class="text-right">2</td>
                  <td class="text-right"><a href="" data-toggle="tooltip" title="Edit" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
                </tr>
                                <tr>
                  <td class="text-center">                    <input type="checkbox" name="selected[]" value="26" />
                    </td>
                  <td class="text-left">Desktops&nbsp;&nbsp;&gt;&nbsp;&nbsp;PC</td>
                  <td class="text-right">1</td>
                  <td class="text-right"><a href="" data-toggle="tooltip" title="Edit" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
                </tr>
                                <tr>
                  <td class="text-center">                    <input type="checkbox" name="selected[]" value="18" />
                    </td>
                  <td class="text-left">Laptops &amp; Notebooks</td>
                  <td class="text-right">2</td>
                  <td class="text-right"><a href="" data-toggle="tooltip" title="Edit" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
                </tr>
                                <tr>
                  <td class="text-center">                    <input type="checkbox" name="selected[]" value="46" />
                    </td>
                  <td class="text-left">Laptops &amp; Notebooks&nbsp;&nbsp;&gt;&nbsp;&nbsp;Macs</td>
                  <td class="text-right">0</td>
                  <td class="text-right"><a href="" data-toggle="tooltip" title="Edit" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
                </tr>
                                <tr>
                  <td class="text-center">                    <input type="checkbox" name="selected[]" value="45" />
                    </td>
                  <td class="text-left">Laptops &amp; Notebooks&nbsp;&nbsp;&gt;&nbsp;&nbsp;Windows</td>
                  <td class="text-right">0</td>
                  <td class="text-right"><a href="" data-toggle="tooltip" title="Edit" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
                </tr>
                                <tr>
                  <td class="text-center">                    <input type="checkbox" name="selected[]" value="34" />
                    </td>
                  <td class="text-left">MP3 Players</td>
                  <td class="text-right">7</td>
                  <td class="text-right"><a href="" data-toggle="tooltip" title="Edit" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
                </tr>
                                <tr>
                  <td class="text-center">                    <input type="checkbox" name="selected[]" value="43" />
                    </td>
                  <td class="text-left">MP3 Players&nbsp;&nbsp;&gt;&nbsp;&nbsp;test 11</td>
                  <td class="text-right">0</td>
                  <td class="text-right"><a href="" data-toggle="tooltip" title="Edit" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
                </tr>
                                <tr>
                  <td class="text-center">                    <input type="checkbox" name="selected[]" value="44" />
                    </td>
                  <td class="text-left">MP3 Players&nbsp;&nbsp;&gt;&nbsp;&nbsp;test 12</td>
                  <td class="text-right">0</td>
                  <td class="text-right"><a href="" data-toggle="tooltip" title="Edit" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
                </tr>
                                <tr>
                  <td class="text-center">                    <input type="checkbox" name="selected[]" value="47" />
                    </td>
                  <td class="text-left">MP3 Players&nbsp;&nbsp;&gt;&nbsp;&nbsp;test 15</td>
                  <td class="text-right">0</td>
                  <td class="text-right"><a href="" data-toggle="tooltip" title="Edit" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
                </tr>
                                <tr>
                  <td class="text-center">                    <input type="checkbox" name="selected[]" value="48" />
                    </td>
                  <td class="text-left">MP3 Players&nbsp;&nbsp;&gt;&nbsp;&nbsp;test 16</td>
                  <td class="text-right">0</td>
                  <td class="text-right"><a href="" data-toggle="tooltip" title="Edit" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
                </tr>
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