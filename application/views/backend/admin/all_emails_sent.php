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
                            <th><div><?php echo "title";//get_phrase('class_name');?></div></th>
                    		<th><div><?php echo "sender";//get_phrase('class_name');?></div></th>
                    		<th><div><?php echo "receiver";//get_phrase('numeric_name');?></div></th>
                    		<th><div><?php echo get_phrase('options');?></div></th>
						</tr>
					</thead>
                    <tbody>
                        <?php 
                       
                         $sent_mail   = $this->db->get('email_sent')->result_array();
                        $count = 1;foreach($sent_mail as $row):?>
                        <tr>
                            <td><?php echo $count++;?></td>
                            <td><?php echo $row['title'];?></td>
                            <td><?php echo $row['from'];?></td>
							<td><?php echo $row['to'];?></td>
							
							<td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                    Action <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                    
                                    <!-- EDITING LINK -->
                                    <li>
                                        <a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_email_view/<?php echo $row['sent_id'];?>');">
                                            <i class="entypo-pencil"></i>
                                                <?php echo get_phrase('view');?>
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
		</div>
	</div>
</div>



<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->                      
<script type="text/javascript">

	jQuery(document).ready(function($)
	{
		

		var datatable = $("#table_export").dataTable();
		
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
	});
		
</script>