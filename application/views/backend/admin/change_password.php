
<!--password-->
<div class="row">
    <div class="col-md-12">
    
        <!------CONTROL TABS START------->
        <ul class="nav nav-tabs bordered">

            <li class="active">
                <a href="#list" data-toggle="tab"><i class="entypo-lock"></i> 
                    <?php echo get_phrase('change_password');?>
                        </a></li>
        </ul>
        <!------CONTROL TABS END------->
        
    
        <div class="tab-content">
            <!----EDITING FORM STARTS---->
            <div class="tab-pane box active" id="list" style="padding: 5px">
                <div class="box-content padded">
                    <?php 
                    foreach($edit_data as $row):
                        ?>
                        <?php echo form_open(base_url() . 'change_password/change' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('current_password');?></label>
                                <div class="col-sm-5">
                                    <input type="password" class="form-control" name="password" value=""/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('new_password');?></label>
                                <div class="col-sm-5">
                                    <input type="password" class="form-control" name="new_password" value=""/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('confirm_new_password');?></label>
                                <div class="col-sm-5">
                                    <input type="password" class="form-control" name="confirm_new_password" value=""/>
                                </div>
                            </div>
                            <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-primary"><?php echo " change password" ?></button>
                              </div>
                                </div>
                        </form>
                        <?php
                    endforeach;
                    ?>
                </div>
            </div>
            <!----EDITING FORM ENDS--->
            
        </div>
    </div>
</div>