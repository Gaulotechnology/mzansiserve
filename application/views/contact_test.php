<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
		<meta http-equiv="content-Language" content="en-En" />
		<style>
			#map {
				width:610px;
				height:300px;						
			}

			#map img {
				max-width:none;
			}
		</style>
	</head>

	<body>	
	<h4>Plan your route to our company!</h4><br/>

	<?php 
	echo form_open('gmapscontact');
	echo form_label('Starting Point <i>(Eg.: Budapest, Andrássy út 1)</i>', 'from').'<br/>';
	echo form_input(array('name' => 'from'));
	echo form_submit(array('name' => 'submit', 'value' => 'Get direction'));
	echo form_error('from');
	echo form_close();
	?>

	<div id="map">
		<?php echo $headerjs;?>
		<?php echo $headermap;?>
		<?php echo $onload; ?>
		<?php echo $map; ?>    
	</div>

	<div id="dir_content"></div>

	 </body>
</html>