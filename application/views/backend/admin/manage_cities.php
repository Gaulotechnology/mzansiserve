
<a href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_cities_add/');" 
            	class="btn btn-primary pull-right">
                <i class="entypo-plus-circled"></i>
            	<?php echo "Add City ";//get_phrase('add_new_teacher');?>
                </a> 
                <br><br>

                
               <table class="table table-bordered datatable" id="table_export">
                    <thead>
                    
                        <tr>
					
                            <th><div><?php echo "#" ?></div></th>
                            <th><div><?php echo "City" ?></div></th>
                            <th><div><?php echo "Region" ?></div></th>
							<th><div><?php echo "Country" ?></div></th>
                            <th><div><?php echo "Created";//get_phrase('member code');?></div></th>
                            <th><div><?php echo get_phrase('options');?></div></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $this->db->select('cities.*, country.name, country.id c_id, regions.region regname');
                                $this->db->join('country', 'country.id=cities.country', FALSE);
								$this->db->join('regions', 'regions.id=cities.region', FALSE);
                                $cities	=	$this->db->get('cities' )->result_array();
                                $count=1;
                                foreach($cities as $row):?>
                        <tr>
                            <td><?php echo $count ?></td>
                            <td><?php echo $row['city'] ?></td>
                            <td><?php echo $row['regname'] ?></td>
							<td><?php echo $row['name'] ?></td>
                            <td><?php echo date("Y/m/d H:i:s", $row['created']) ?></td>
                    
                            <td>
                                
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                        Action <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-default pull-right" role="menu">
                                        
                                        <!-- familylist EDITING LINK -->
                                        <li>
                                        	<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_cities_edit/<?php echo $row['id'];?>');">
                                            	<i class="entypo-pencil"></i>
													<?php echo get_phrase('edit');?>
                                               	</a>
                                        				</li>
                                        <li class="divider"></li>
                                        
                                        <!-- familylist DELETION LINK -->
                                        <li>
                                        	<a href="#" onclick="confirm_modal('<?php echo base_url() ?>page/manage_cities/delete/<?php echo $row['id'];?>');">
                                            	<i class="entypo-trash"></i>
													<?php echo get_phrase('delete');?>
                                               	</a>
                                        				</li>
                                    </ul>
                                </div>
                                
                            </td>
                        </tr>
                        <?php 
                    $count ++;
                    endforeach;?>
                       
                    </tbody>

                </table>



<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->                      
<script type="text/javascript">

	jQuery(document).ready(function($)
	{
		

		var datatable = $("#table_export").dataTable({
			"sPaginationType": "bootstrap",
			"sDom": "<'row'<'col-xs-3 col-left'l><'col-xs-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-3 col-left'i><'col-xs-9 col-right'p>>",
			"oTableTools": {
				"aButtons": [
					
					{
						"sExtends": "xls",
						"mColumns": [1,2]
					},
					{
						"sExtends": "pdf",
						"mColumns": [1,2]
					},
					{
						"sExtends": "print",
						"fnSetText"	   : "Press 'esc' to return",
						"fnClick": function (nButton, oConfig) {
							datatable.fnSetColumnVis(0, false);
							datatable.fnSetColumnVis(3, false);
							
							this.fnPrint( true, oConfig );
							
							window.print();
							
							$(window).keyup(function(e) {
								  if (e.which == 27) {
									  datatable.fnSetColumnVis(0, true);
									  datatable.fnSetColumnVis(3, true);
								  }
							});
						},
						
					},
				]
			},
			
		});
		
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
	});
		
</script>

