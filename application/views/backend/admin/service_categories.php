<script type="text/javascript" 
           src="http://maps.google.com/maps/api/js?sensor=false"></script>
          
<div class="row">
	<div class="col-md-12">
    
    	<!------CONTROL TABS START------>
		<ul class="nav nav-tabs bordered">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
					<?php echo "category list";?>
                    	</a></li>
			<li>
            	<a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
					<?php echo "add service"; ?>
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------>
        



		<div class="tab-content">
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">
				
                <table class="table table-bordered datatable" id="table_export">
                	<thead>
                		<tr>
                    		<th><div>#</div></th>
                            <th><div><?php echo "category"; ?></div></th>
                            <th><div><?php echo  "service name" ?></div></th>
                    		<th><div><?php echo "descriptiom"; ?></div></th>
                    		<th><div><?php echo get_phrase('options');?></div></th>
						</tr>
					</thead>
                    <tbody>
                        <?php 
                         $this->db->select('A.name category_name, B.name service_name, B.description');
                         $this->db->join('category A', 'A.id=B.category_id','LEFT');
                         $categories   = $this->db->get('sub_category B')->result_array();
                        $count = 1;foreach($categories  as $row):?>
                        <tr>
                            <td><?php echo $count++;?></td>
                            <td><?php echo $row['category_name'];?></td>
							<td><?php echo $row['service_name'];?></td>
							<td><?php echo $row['description'];?></td>
							<td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                    Action <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                    
                                    <!-- EDITING LINK -->
                                    <li>
                                        <a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_device_edit/<?php echo $row['id'];?>');">
                                            <i class="entypo-pencil"></i>
                                                <?php echo get_phrase('edit');?>
                                            </a>
                                                    </li>
                                    <li class="divider"></li>

                                    <li>
                                        <a href="#" onclick="showAjaxModal('<?php echo base_url();?>locate/<?php echo $row['imei'];?>');">
                                            <i class="fa fa-map-marker"></i>
                                                <?php echo get_phrase('locate');?>
                                            </a>
                                                    </li>
                                    <li class="divider"></li>
                                    
                                    
                                    <!-- DELETION LINK -->
                                    <li>
                                        <a href="#" onclick="confirm_modal('<?php echo base_url();?>devices/delete/<?php echo $row['id'];?>');">
                                            <i class="entypo-trash"></i>
                                                <?php echo get_phrase('delete');?>
                                            </a>
                                                    </li>
                                </ul>
                            </div>
        					</td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
			</div>
            <!----TABLE LISTING ENDS--->
            
            
			<!----CREATION FORM STARTS---->
			<div class="tab-pane box" id="add" style="padding: 5px">
            <div class="row">
            <div class="col-xs-9">
     <div> <div class="box-content">
               
               <?php echo form_open(base_url('page/service_categories/create')  , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
              
               <div class="padded" style="margin-top:10px;">
                      
                  
                       <div class="form-group">
                           <label class="col-sm-3 control-label"><?php echo "Service name";//get_phrase('name');?></label>
                           <div class="col-sm-8">
                               <input type="text" class="form-control required" name="name" />
                           </div>
                       </div>
                       <div class="form-group">
                           <label class="col-sm-3 control-label"><?php echo "description";//get_phrase('name_numeric');?></label>
                           <div class="col-sm-8">
                               <input type="text" class="form-control required" name="description"/>
                           </div>
                       </div>
                      
                       <?php 
        if($role==ROLE_ADMIN){
            ?>
                       <div class="form-group">
                           <label class="col-sm-3 control-label"><?php echo "Service Category";//get_phrase('teacher');?></label>
                           <div class="col-sm-8">
                               <select name="category_id" class="form-control required">
                               <option value=""><?php echo get_phrase('select');?></option>
                                   <?php 
                                   $category = $this->db->get('category')->result_array();
                                   foreach($category as $row):
                                   ?>
                                       
                                       <option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
                                   <?php
                                   endforeach;
                                   ?>
                               </select>
                           </div>
                       </div>
                       <?php } ?>
                   </div>

                   <div class="form-group">
                         <div class="col-sm-offset-3 col-sm-5">
                             <button type="submit" class="btn btn-primary"><?php echo "add service";//get_phrase('add_class');?></button>
                         </div>
                       </div>
               </form>
               </div>                
           </div></div>
   
   
   <div class="col-xs-3">
     <div> 
    <?php echo $qrcode ?>
    </div>
   </div>
   </div>
                               
			</div>
			<!----CREATION FORM ENDS-->
             <!--TEST CODE -->
             <div class="row">
	
</div>
    <!--TEST CODE -->
		</div>
	</div>
</div>

<script type="text/javascript">

jQuery(document).ready(function($)
{
    

    var datatable = $("#table_export").dataTable({
        "sPaginationType": "bootstrap",
        "sDom": "<'row'<'col-xs-3 col-left'l><'col-xs-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-3 col-left'i><'col-xs-9 col-right'p>>",
        "oTableTools": {
            "aButtons": [
                
                {
                    "sExtends": "xls",
                    "mColumns": [1,2]
                },
                {
                    "sExtends": "pdf",
                    "mColumns": [1,2]
                },
                {
                    "sExtends": "print",
                    "fnSetText"	   : "Press 'esc' to return",
                    "fnClick": function (nButton, oConfig) {
                        datatable.fnSetColumnVis(0, false);
                        datatable.fnSetColumnVis(3, false);
                        
                        this.fnPrint( true, oConfig );
                        
                        window.print();
                        
                        $(window).keyup(function(e) {
                              if (e.which == 27) {
                                  datatable.fnSetColumnVis(0, true);
                                  datatable.fnSetColumnVis(3, true);
                              }
                        });
                    },
                    
                },
            ]
        },
        
    });
    
    $(".dataTables_wrapper select").select2({
        minimumResultsForSearch: -1
    });
});
    
</script>