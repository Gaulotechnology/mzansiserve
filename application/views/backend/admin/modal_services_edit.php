<?php 


function check_status($value){
if($value==1){
    echo "checked";
}
else{
    echo "unchecked";
}
}

$edit_data		=	$this->db->get_where('service_provider' , array('id' => $param2) )->result_array();
foreach ( $edit_data as $row):
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo "Edit Device";//get_phrase('edit_teacher');?>
            	</div>
            </div>
			<div class="panel-body">
                    <?php echo form_open(base_url() . 'devices/do_update/'.$row['id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top', 'enctype' => 'multipart/form-data'));?>
                        		
                                <div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label"><?php echo "qrcode"; //get_phrase('photo');?></label>
                                
                                <div class="col-sm-8">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                                            <img src="<?php echo $this->crud_model->get_image_url('qrcodes' , $row['device_id']);?>" alt="...">
                                        </div>
                                       
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('company logo');?></label>
                                
                                <div class="col-sm-8">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                                            <img src="<?php echo $qrcode.$this->crud_model->get_image_url('clients' , $row['client_id']);?>" alt="...">
                                        </div>
                                       
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('Username');?></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="username" value="<?php echo $row['username'];?>" readonly/>
                                </div>
                            </div>
                           
                            
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('clients');?></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control"  value="<?php echo $this->crud_model->get_clients_name_by_id($row['client_id']); ?>" readonly/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('phone');?></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="phone" value="<?php echo $row['phone'];?>" readonly/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('email');?></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="email" value="<?php echo $row['email'];?>" readonly/>
                                </div>
                            </div>
                            <!-- -->
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
                               <input type="checkbox" id="checkbox1" value="1"  name="ptt" <?php check_status($row['ptt']); ?>>
                               <label for="checkbox1" class="label-table"></label>
               </th>
               <td>Push to Talk</td>
               <td>Enabling of the Control allow a live surveilance of every device connected</td>

           </tr>

<tr>
<th scope="row">
<input type='hidden' value='0' name='advanced'>
<input type="checkbox" id="checkbox1" value="1"  name="advanced" <?php check_status($row['advanced_alert']); ?>>
<label for="checkbox1" class="label-table"></label>
</th>
<td>Advanced Alert</td>
<td>This module allows, fire, and other signals to be sent</td>

</tr>
<tr>
<th scope="row">
<input type='hidden' value='0' name='armed'>
<input type="checkbox" id="checkbox1" value="1"  name="armed" <?php check_status($row['armed']); ?>>
<label for="checkbox1" class="label-table"></label>
</th>
<td>Armed Response</td>
<td>This module allows emergency service to be contacted</td>

</tr>
<tr>
<th scope="row">
<input type='hidden' value='0' name='sms'>
<input type="checkbox" id="checkbox1" value="1"  name="sms" <?php check_status($row['sms']); ?>>
<label for="checkbox1" class="label-table"></label>
</th>
<td>SMS Alert</td>
<td>This module allows you to send customised sms to group member</td>

</tr>
<tr>
<th scope="row">
<input type='hidden' value='0' name='control'>
<input type="checkbox" id="checkbox1" value="1"  name="control" <?php check_status($row['control_room']); ?>>
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

                            <!-- -->
                            
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-5">
                                <button type="submit" class="btn btn-primary"><?php echo "update";//get_phrase('edit_teacher');?></button>
                            </div>
                        </div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>

<?php
endforeach;
?>