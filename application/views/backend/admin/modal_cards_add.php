<?php
$CI =& get_instance();
$CI ->load->model('m_card_type');
 $card_types = $CI ->m_card_type->get_all();
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	
			<div class="panel-body">
				
                <?php echo form_open(base_url() . 'page/manage_cards/create/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
	
					<div class="form-group">
					 <!-- CREDIR CARD -->
					 <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo "Card type" ?></label>
                                <div class="col-sm-5">
                                <select class="form-control" name="card_type" required >
                                <?php foreach($card_types as $card) : ?>
                                    <option value="<?php echo $card->id; ?>"><?php echo $card->name; ?></option>
                                <?php endforeach; ?>
                                </select>
                                </div>
                            </div>  
                            <div class="form-group">
                         
                                <label class="col-sm-3 control-label"><?php echo "Card Name" ?></label>
                                <div class="col-sm-5">
                                <input type="text" class="form-control" name="card_holder" value=" <?php echo $payment_details->card_holder; ?>" placeholder="" required />
                                </div>
                            </div>  
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo "Card Number" ?></label>
                                <div class="col-sm-5">
                                <input type="text" class="form-control" name="card_number" value="<?php echo $payment_details->card_number; ?>" min="16" maxlength="16" placeholder="" required />
                                </div>
                            </div>  
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo "Card Expiry" ?></label>
                                <div class="col-sm-3">
                                <select type="text" class="form-control  col-md-1" name="expiry_month" placeholder="YYYY" style="width:200px;" value="<?php echo $payment_details->card_expiration; ?>" required >
                                        <?php 
                                        $start=1;
                                        $end=12;
                                        echo "<option>Select Month</option>";
                                        for($i=$start; $i<=$end; $i++ ){
                                            echo "<option>".$i."</option>";
                                        }
                                        
                                        ?>
                                        </select> 
                              
                           
                                <select type="text" class="form-control col-md-1" name="expiry_year" placeholder="YYYY" style="width:200px;" required >
                                        <?php 
                                        $start=date("Y");
                                        $end=$start+10;
                                        echo "<option>Select Year</option>";
                                        for($i=$start; $i<=$end; $i++ ){
                                            echo "<option>".$i."</option>";
                                        }
                                        
                                        ?>
                                </select>  
                               
                                </div>
                            </div>  
                   
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo "Card CVV Number" ?></label>
                                <div class="col-sm-5">
                                <input type="text" class="form-control"  name="cvv_number" placeholder="" value="<?php echo $payment_details->cvv; ?>" min="3" maxlength="3" required />
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