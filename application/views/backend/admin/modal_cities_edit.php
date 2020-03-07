<?php 
$countries=$this->db->get('country')->result_array();
$regions=$this->db->get('regions')->result_array();
$this->db->select('cities.*, country.name, country.id c_id, regions.region regname');
$this->db->join('country', 'country.id=cities.country', FALSE);
$this->db->join('regions', 'regions.id=cities.region', FALSE);
$edit_data		=	$this->db->get_where('cities' , array('cities.id' => $param2) )->result_array();
foreach ( $edit_data as $row):
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('Edit Cities');?>
            	</div>
            </div>
			<div class="panel-body">
                    <?php echo form_open(base_url() . 'page/manage_cities/do_update/'.$row['id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top', 'enctype' => 'multipart/form-data'));?>
                        		
                    <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo "Country" ?></label>
                                <div class="col-sm-5">
                                    <select class="form-control" name="country">
                               
                                    <option value="<?php echo $row['c_id'] ?>" selected="selected"><?php echo $row['name'] ?></option>
                                    <?php foreach($countries as $country) :?>
                                    <option value="<?php echo $country['id'] ?>" ><?php echo $country['name'] ?></option>
                                   
                                    <?php endforeach; ?>
                                    </select>

                                </div>
                            </div>
                                		
                    <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo "Region" ?></label>
                                <div class="col-sm-5">
                                    <select class="form-control" name="region">
                               
                                    <option value="<?php echo $row['c_id'] ?>" selected="selected"><?php echo $row['regname'] ?></option>
                                    <?php foreach($regions as $region) :?>
                                    <option value="<?php echo $region['id'] ?>" ><?php echo $region['region'] ?></option>
                                   
                                    <?php endforeach; ?>
                                    </select>

                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo "City" ?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="city" value="<?php echo $row['city'];?>"/>
                                </div>
                            </div>
                            
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-5">
                                <button type="submit" class="btn btn-info"><?php echo "Update";//get_phrase('edit_teacher');?></button>
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