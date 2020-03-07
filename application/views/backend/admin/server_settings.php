<div class="row">
	<div class="col-md-12">
    
    	<!------CONTROL TABS START------>
		<ul class="nav nav-tabs bordered">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
					<?php echo get_phrase('server list');?>
                    	</a></li>
			<li>
            	<a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
					<?php echo get_phrase('add server');?>
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
                    		<th><div><?php echo "name";//get_phrase('class_name');?></div></th>
                    		<th><div><?php echo "ip address";//get_phrase('numeric_name');?></div></th>
                    		<th><div><?php echo "port";// get_phrase('teacher');?></div></th>
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
                         $server_settings    = $this->db->get('server_settings')->result_array();
                        $count = 1;foreach($server_settings as $row):?>
                        <tr>
                            <td><?php echo $count++;?></td>
                            <td> <img width="20" height="20" src="<?php echo $this->crud_model->get_image_url('clients' , $row['client_id']);?>" alt="..."></td>
							
                            <td><?php echo $row['server_name'];?></td>
							<td><?php echo $row['server_ip'];?></td>
							<td><?php echo $row['server_port'];?></td>
							<td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                    Action <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                    
                                    <!-- EDITING LINK -->
                                    <li>
                                        <a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_server_edit/<?php echo $row['id'];?>');">
                                            <i class="entypo-pencil"></i>
                                                <?php echo get_phrase('edit');?>
                                            </a>
                                                    </li>
                                    <li class="divider"></li>
                                    
                                    <!-- DELETION LINK -->
                                    <li>
                                        <a href="#" onclick="confirm_modal('<?php echo base_url();?>server_settings/delete/<?php echo $row['id'];?>');">
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
               
               <?php echo form_open(base_url() . 'server_settings/create' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
              
               <div class="padded" style="margin-top:10px;">
                       
                       <div class="form-group">
                           <label class="col-sm-3 control-label"><?php echo "Server ip";//get_phrase('name_numeric');?></label>
                           <div class="col-sm-8">
                               <input type="text" class="form-control required" name="server_ip" value="server-applications.com"/>
                           </div>
                       </div>
                       <div class="form-group">
                           <label class="col-sm-3 control-label"><?php echo "Server port";//get_phrase('name_numeric');?></label>
                           <div class="col-sm-8">
                               <input type="text" class="form-control required" name="server_port" value="64738"/>
                           </div>
                       </div>
                       
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
                       
                   </div>

           
                   <div class="form-group">
                         <div class="col-sm-offset-3 col-sm-5">
                             <button type="submit" class="btn btn-primary"><?php echo get_phrase('add server');?></button>
                         </div>
                       </div>
               </form>
               </div>                
           </div></div>
   
   
   
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