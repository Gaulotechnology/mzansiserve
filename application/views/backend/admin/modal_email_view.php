<?php 


function check_status($value){
if($value==1){
    echo "checked";
}
else{
    echo "";
}
}

$edit_data		=	$this->db->get_where('email_sent' , array('sent_id' => $param2) )->result_array();
foreach ( $edit_data as $row):
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo "View Email";//get_phrase('edit_teacher');?>
            	</div>
            </div>
			<div class="panel-body">
                    <?php echo form_open(base_url() . 'devices/do_update/'.$row['id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top', 'enctype' => 'multipart/form-data'));?>
                        		
                                <div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label"><?php echo "Title"; //get_phrase('photo');?></label>
                                
                                <div class="col-sm-8">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <label for="field-1" class="control-label">
                                            <?php echo $row['title']; ?>
                                        </label>
                                       
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('To');?></label>
                                
                                <div class="col-sm-8">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <label for="field-1" class="control-label">
                                            <?php echo $row['to']; ?>
                                        </label>
                                       
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('From');?></label>
                                <div class="col-sm-8">
                                <label for="field-1" class="control-label">
                                            <?php echo $row['from']; ?>
                                </label>
                                </div>
                            </div>
                           
                            
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('Message');?></label>
                                <div class="col-sm-8">
                                <label  align="left">
                                            <?php echo $row['body']; ?>
                                </label>
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