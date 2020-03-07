<script type="text/javascript" 
           src="http://maps.google.com/maps/api/js?sensor=false"></script>
          
<div class="row">
	<div class="col-md-12">
    
    	<!------CONTROL TABS START------>
		<ul class="nav nav-tabs bordered">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
					<?php echo "devices list";//get_phrase('class_list');?>
                    	</a></li>
			<li>
            	<a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
					<?php echo "add device";//get_phrase('add_class');?>
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
                            <th><div><?php echo "company";//get_phrase('class_name');?></div></th>
                            <th><div><?php echo get_phrase('device id');?></div></th>
                    		<th><div><?php echo "name";//get_phrase('class_name');?></div></th>
                    		<th><div><?php echo "surname";//get_phrase('numeric_name');?></div></th>
                    		<th><div><?php echo "phone";// get_phrase('teacher');?></div></th>
                    		<th><div><?php echo get_phrase('options');?></div></th>
						</tr>
					</thead>
                    <tbody>
                        <?php 
                         $this->db->where('isDeleted',0);
                         if ($role==ROLE_clients) {
                            $client_id=$this->session->userdata('client_id');
                            $this->db->where('client_id', $client_id);
                        }
                         $devices    = $this->db->get('devices')->result_array();
                        $count = 1;foreach($devices as $row):?>
                        <tr>
                            <td><?php echo $count++;?></td>
                            <td> <img width="20" height="20" src="<?php echo $this->crud_model->get_image_url('clients' , $row['client_id']);?>" alt="..."></td>
							<td><?php echo $row['device_id'];?></td>
                            <td><?php echo $row['username'];?></td>
							<td><?php echo $row['email'];?></td>
							<td><?php echo $row['phone'];?></td>
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
               
               <?php echo form_open(base_url() . 'devices/create' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
              
               <div class="padded" style="margin-top:10px;">
                       <div class="form-group">
                           <label class="col-sm-3 control-label"><?php echo "device id";//get_phrase('name');?></label>
                           <div class="col-sm-5">
                               <input type="text" class="form-control required" name="device_id" data-validate="required" value="<?php echo $device_id; ?>" readonly/>
                               
                           </div>
                       </div>
                  
                       <div class="form-group">
                           <label class="col-sm-3 control-label"><?php echo "username";//get_phrase('name');?></label>
                           <div class="col-sm-8">
                               <input type="text" class="form-control required" name="username" />
                           </div>
                       </div>
                       <div class="form-group">
                           <label class="col-sm-3 control-label"><?php echo "email";//get_phrase('name_numeric');?></label>
                           <div class="col-sm-8">
                               <input type="text" class="form-control required" name="email"/>
                           </div>
                       </div>
                       <div class="form-group">
                           <label class="col-sm-3 control-label"><?php echo "phone";//get_phrase('name_numeric');?></label>
                           <div class="col-sm-8">
                               <input type="text" class="form-control required" name="phone"/>
                           </div>
                       </div>
                       <?php 
        if($role==ROLE_ADMIN){
            ?>
                       <div class="form-group">
                           <label class="col-sm-3 control-label"><?php echo "clients";//get_phrase('teacher');?></label>
                           <div class="col-sm-8">
                               <select name="client_id" class="form-control required">
                               <option value=""><?php echo get_phrase('select');?></option>
                                   <?php 
                                   $this->db->where('isDeleted', 0);
                                   $clients = $this->db->get('clients')->result_array();
                                   foreach($clients as $row):
                                   ?>
                                       
                                       <option value="<?php echo $row['client_id'];?>"><?php echo $row['clients_name'];?></option>
                                   <?php
                                   endforeach;
                                   ?>
                               </select>
                           </div>
                       </div>
                       <?php }else{ 
									$client_id=$this->session->userdata('client_id');?>
								<input type="hidden" name="client_id" value="<?php echo $client_id; ?>">
								<?php } ?>
                   </div>

           <div class="form-group">
               <div class="col-sm-offset-3 col-sm-8">
                   <table class="table table-hover mb-0">
                   <!--Table head-->
                       <thead>
                           <tr>
                               <th>

                                   <label for="checkbox" class="mr-2 label-table"></label>
                               </th>
                               <th class="th-lg"><a>Module Name </a></th>
                                <th class="th-lg"><a href="">Description</a></th>

                           </tr>
                       </thead>
                       <!--Table head-->

<!--Table body-->
       <tbody>

           <tr>
               <th scope="row">
                               <input type='hidden' value='0' name='ptt'>
                               <input type="checkbox" id="checkbox1" value="1"  name="ptt">
                               <label for="checkbox1" class="label-table"></label>
               </th>
               <td>Push to Talk</td>
               <td>Enabling of the Control allow a live surveilance of every device connected</td>

           </tr>

<tr>
<th scope="row">
<input type='hidden' value='0' name='advanced'>
<input type="checkbox" id="checkbox1" value="1"  name="advanced">
<label for="checkbox1" class="label-table"></label>
</th>
<td>Advanced Alert</td>
<td>This module allows, fire, and other signals to be sent</td>

</tr>
<tr>
<th scope="row">
<input type='hidden' value='0' name='armed'>
<input type="checkbox" id="checkbox1" value="1"  name="armed">
<label for="checkbox1" class="label-table"></label>
</th>
<td>Armed Response</td>
<td>This module allows emergency service to be contacted</td>

</tr>
<tr>
<th scope="row">
<input type='hidden' value='0' name='sms'>
<input type="checkbox" id="checkbox1" value="1"  name="sms">
<label for="checkbox1" class="label-table"></label>
</th>
<td>SMS Alert</td>
<td>This module allows you to send customised sms to group member</td>

</tr>
<tr>
<th scope="row">
<input type='hidden' value='0' name='control'>
<input type="checkbox" id="checkbox1" value="1"  name="control">
<input type="hidden" name="qrcode" value='<?php echo $qrcode ?>'>
<label for="checkbox1" class="label-table"></label>
</th>
<td>Control Room</td>
<td>This module allows the user to send signal to the control room</td>

</tr>
</tbody>
<!--Table body-->
</table>
</div>
</div>
                   <div class="form-group">
                         <div class="col-sm-offset-3 col-sm-5">
                             <button type="submit" class="btn btn-primary"><?php echo "add device";//get_phrase('add_class');?></button>
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
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo "add bulk users";?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open(base_url() . 'devices/bulk_add' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
	
				
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo "excel file"; //get_phrase('excel_file');?></label>
                        
						<div class="col-sm-5">
							<div class="fileinput fileinput-new" data-provides="fileinput">
								<div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
									<img src="http://placehold.it/200x200" alt="...">
								</div>
								<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
								<div>
									<span class="btn btn-white btn-file">
										<span class="fileinput-new">Select file</span>
										<span class="fileinput-exists">Change</span>
										<input type="file" name="result_file" >
									</span>
									<a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
								</div>
							</div>
						</div>
					</div>
                    
                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info"><?php echo "upload";//get_phrase('add_student');?></button>
						</div>
					</div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
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