	
    
    

<script src="<?php echo base_url() ?>assets/js/register.js"></script>
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/js/datatables/responsive/css/datatables.responsive.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/js/select2/select2-bootstrap.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/js/select2/select2.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/js/selectboxit/jquery.selectBoxIt.css">

<!-- BOWER COMPONENTS -->
<script src="<?php echo base_url() ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?php echo base_url() ?>assets/bower_components/jquery-ui/jquery-ui.min.js"></script>
<script>$.widget.bridge('uibutton', $.ui.button);</script>
<script src="<?php echo base_url() ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?php echo base_url() ?>assets/bower_components/raphael/raphael.min.js"></script>
<script src="<?php echo base_url() ?>assets/bower_components/morris.js/morris.min.js"></script>
<script src="<?php echo base_url() ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?php echo base_url() ?>assets/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="<?php echo base_url() ?>assets/bower_components/moment/min/moment.min.js"></script>
<script src="<?php echo base_url() ?>assets/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<script src="<?php echo base_url() ?>assets/bower_components/moment/min/moment.min.js"></script>
<script src="<?php echo base_url() ?>assets/bower_components/raphael/raphael.min.js"></script>
<script src="<?php echo base_url() ?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="<?php echo base_url() ?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script src="<?php echo base_url() ?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?php echo base_url() ?>assets/bower_components/fastclick/lib/fastclick.js"></script>
<!-- BOWER COMPONENTS -->
<!-- InputMask -->
<script src="<?php echo base_url() ?>assets/plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
   	<!-- Bottom Scripts -->
	<script src="<?php echo base_url() ?>assets/js/gsap/main-gsap.js"></script>
	<script src="<?php echo base_url() ?>assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/bootstrap.js"></script>
	<script src="<?php echo base_url() ?>assets/js/joinable.js"></script>
	<script src="<?php echo base_url() ?>assets/js/resizeable.js"></script>
	<script src="<?php echo base_url() ?>assets/js/neon-api.js"></script>
	<script src="<?php echo base_url() ?>assets/js/toastr.js"></script>
    <script src="<?php echo base_url() ?>assets/js/jquery.validate.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/fullcalendar/fullcalendar.min.js"></script>
    <script src="<?php echo base_url() ?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.js"></script>
    <script src="<?php echo base_url() ?>assets/js/fileinput.js"></script>
    
    <script src="<?php echo base_url() ?>assets/js/jquery.dataTables.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/datatables/TableTools.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/dataTables.bootstrap.js"></script>
	<script src="<?php echo base_url() ?>assets/js/datatables/jquery.dataTables.columnFilter.js"></script>
	<script src="<?php echo base_url() ?>assets/js/datatables/lodash.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/datatables/responsive/js/datatables.responsive.js"></script>
    <script src="<?php echo base_url() ?>assets/js/select2/select2.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/selectboxit/jquery.selectBoxIt.min.js"></script>

    
	<script src="<?php echo base_url() ?>assets/js/neon-calendar.js"></script>
	<script src="<?php echo base_url() ?>assets/js/neon-chat.js"></script>
	<script src="<?php echo base_url() ?>assets/js/neon-custom.js"></script>
	<script src="<?php echo base_url() ?>assets/js/neon-demo.js"></script>
	<!-- AdminLTE App -->
<script src="<?php echo base_url() ?>assets/js/adminlte.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/pages/dashboard.js"></script>

<script src="<?php echo base_url() ?>assets/js/demo.js"></script>


<!-- SHOW TOASTR NOTIFIVATION -->
<?php if ($this->session->flashdata('flash_message') != ""):?>

<script type="text/javascript">
	toastr.success('<?php echo $this->session->flashdata("flash_message");?>');
</script>

<?php endif;?>


<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->                      
<script type="text/javascript">

	jQuery(document).ready(function($)
	{

		var datatable = $("#table_export").dataTable();
		
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
	});
		
  <script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  })
</script>
