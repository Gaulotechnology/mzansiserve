
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo "add user";//get_phrase('add_teacher');?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open(base_url() . 'users/create/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
	
				<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo "user type";//get_phrase('name');?></label>
                        
						<div class="col-sm-5">
						<select class="form-control" name="level">
						<option value="1">super</option>
						<option value="2">clients</option>
						</select>
						</div>
					</div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="" autofocus>
						</div>
					</div>
					
				
					
					<?php 
        if($role==ROLE_ADMIN){
            ?>
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo "clients";//get_phrase('address');?></label>
                        
						<div class="col-sm-5">
							<select class="form-control" name="client_id">
							<option><?php echo get_phrase('select');?></option>
							  <?php 
							  		 $this->db->where('isDeleted', 0);
									$clients = $this->db->get('clients')->result_array();
									foreach($clients as $row):
										?>
                                		<option value="<?php echo $row['client_id'];?>"
                                        	<?php if($row['client_id'] == $row['client_id'])echo 'selected';?>>
													<?php echo $row['clients_name'];?>
                                                </option>
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
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('phone');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control required" name="phone" value="" >
						</div> 
					</div>
                    
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('email');?></label>
						<div class="col-sm-5">
							<input type="text" class="form-control required" name="email" value="">
						</div>
					</div>
					
					
	
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('photo');?></label>
                        
						<div class="col-sm-5">
							<div class="fileinput fileinput-new" data-provides="fileinput">
								<div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
									<img src="http://placehold.it/200x200" alt="...">
								</div>
								<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
								<div>
									<span class="btn btn-white btn-file">
										<span class="fileinput-new">Select image</span>
										<span class="fileinput-exists">Change</span>
										<input type="file" name="userfile" accept="image/*">
									</span>
									<a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
								</div>
							</div>
						</div>
					</div>
                    
                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-primary"><?php echo "Add User";//get_phrase('add_teacher');?></button>
						</div>
					</div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>
