<?php
$CI =& get_instance();
$CI ->load->model('m_car_type');
 $car_types = $CI ->m_car_type->get_all();
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	
			<div class="panel-body">
				
                <?php echo form_open(base_url() . 'page/manage_cars/create/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
	
					<div class="form-group">
					 <!-- CARD TYPES -->
					 <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo "Card type" ?></label>
                                <div class="col-sm-5">
                                <select class="form-control" name="vehicle_type" required >
                                <?php foreach($car_types as $car) : ?>
                                    <option value="<?php echo $car ?>"><?php echo $car; ?></option>
                                <?php endforeach; ?>
                                </select>
                                </div>
                            </div>  
                            <div class="form-group">
                         
                                <label class="col-sm-3 control-label"><?php echo "Car Model" ?></label>
                                <div class="col-sm-5">
                                <input type="text" class="form-control" name="vehicle_model"  required />
                                </div>
                            </div>  
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo "Vehicle Reg Number" ?></label>
                                <div class="col-sm-5">
                                <input type="text" class="form-control" name="vehicle_registration" placeholder="" required />
                                </div>
                            </div>  
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo "Car Documents" ?></label>
                                <div class="col-sm-5">
                                <input type="file" class="form-control"  name="vehicle_docs"  required />
                                </div>
                            </div>  
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo "Insurance Documents" ?></label>
                                <div class="col-sm-5">
                                <input type="file" class="form-control"  name="insurance_docs" required />
                                </div>
                            </div>  
                            <!-- CREDIR CARD -->
 
				
                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info"><?php echo "Add clients";//get_phrase('add_teacher');?></button>
						</div>
					</div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>