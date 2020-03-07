    <script type="text/javascript">
	function showAjaxModal(url)
	{
		// SHOWING AJAX PRELOADER IMAGE
		jQuery('#modal_ajax .modal-body').html('<div style="text-align:center;margin-top:200px;"><img src="assets/images/preloader.gif" /></div>');
		
		// LOADING THE AJAX MODAL
		jQuery('#modal_ajax').modal('show', {backdrop: 'true'});
		
		// SHOW AJAX RESPONSE ON REQUEST SUCCESS
		$.ajax({
			url: url,
			success: function(response)
			{
				jQuery('#modal_ajax .modal-body').html(response);
			}
		});
	}
	</script>
    
    <!-- (Ajax Modal)-->
    <div class="modal fade" id="modal_ajax">
        <div class="modal-dialog">
            <div class="modal-content">
                
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><?php echo $system_name;?></h4>
                </div>
                <?php if($page_name=="activation_pending"){ ?>
                <form action="<?php echo base_url('page/activation_pending/activate') ?>" method="post">
                <div class="modal-body" style="overflow:auto;"> 
                </div>
                
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Activate Now</button>
                </form>
                <?php } 
                 elseif($page_name=="activated_accounts"){ ?>
                    <form action="<?php echo base_url('page/activated_accounts/deactivate') ?>" method="post">
                    <div class="modal-body" style="overflow:auto;"> 
                    </div>
                    
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Block Now</button>
                    </form>
                    <?php } 
                    elseif($page_name=="blocked_accounts"){ ?>
                        <form action="<?php echo base_url('page/blocked_accounts/reactivate') ?>" method="post">
                        <div class="modal-body" style="overflow:auto;"> 
                        </div>
                        
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger">Unblock Now</button>
                        </form>
                        <?php } 
                          elseif($page_name=="manage_cars"){ ?>
            
                            <div class="modal-body" style="overflow:auto;"> 
                            </div>
                            
                            <div class="modal-footer">
                            
                            <?php } 

                            elseif($page_name=="manage_cards"){ ?>
                    
                            <div class="modal-body" style="overflow:auto;"> 
                             </div>
    
                            <div class="modal-footer">
                            <?php } 
                     elseif($page_name=="manage_regions"){ ?>
                    
                        <div class="modal-body" style="overflow:auto;"> 
                         </div>

                        <div class="modal-footer">
                     

                <?php }  
                     elseif($page_name=="manage_cities"){ ?>
                    
                        <div class="modal-body" style="overflow:auto;"> 
                         </div>

                        <div class="modal-footer">
                     

                <?php } 
                
                else{ ?>
                <button type="button" class="btn btn-primary">Save changes</button>
                <?php } ?>
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    
    
    
    
    <script type="text/javascript">
	function confirm_modal(delete_url)
	{
		jQuery('#modal-4').modal('show', {backdrop: 'static'});
		document.getElementById('delete_link').setAttribute('href' , delete_url);
	}
	</script>
    
    <!-- (Normal Modal)-->
    <div class="modal fade" id="modal-4">
        <div class="modal-dialog">
            <div class="modal-content" style="margin-top:100px;">
                
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" style="text-align:center;">Are you sure to delete this information ?</h4>
                </div>
                
                
                <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
                    <a href="#" class="btn btn-danger" id="delete_link"><?php echo get_phrase('delete');?></a>
                    <button type="button" class="btn btn-info" data-dismiss="modal"><?php echo get_phrase('cancel');?></button>
                </div>
            </div>
        </div>
    </div>