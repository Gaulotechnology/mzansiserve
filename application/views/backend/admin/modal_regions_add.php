
<?php 

$countries=$this->db->get('country')->result_array();
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('add learner');?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open(base_url() . 'page/manage_regions/create/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
                <div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo "Country" ?></label>
                        
						<div class="col-sm-5">
						<select class="form-control" name="country">
                               
                                    <?php foreach($countries as $country) :
                                        
                                        ?>
                                    <option value="<?php echo $country['id'] ?>" ><?php echo $country['name'] ?></option>
                                   
                                    <?php endforeach; ?>
                                    </select>

						</div> 
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo "region" ?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="region" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="" autofocus>
						</div>
					</div>
					
		
                    
                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info"><?php echo "Add Region";//get_phrase('add_teacher');?></button>
						</div>
					</div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>