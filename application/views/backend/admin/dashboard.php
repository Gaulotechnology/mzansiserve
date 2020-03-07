

<?php if ($role>1) {?>
<!-- Left col -->
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/elephant.minf9e3.css">

<section class="col-lg-12 connectedSortable" style="margin-top:50px;">
<div class="row">
<a href="<?php echo base_url() ?>page/multistep_registration">
<div class="col-md-5 col-sm-6 col-xs-12">
          <div class="info-box bg-green">
            <span class="info-box-icon"><i class="fa fa-bookmark-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Registration</span>
              <span class="info-box-number">70%</span>

              <div class="progress">
                <div class="progress-bar" style="width: 70%"></div>
              </div>
                  <span class="progress-description">
                    70% complete, please click here finish registration
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        </a>
<?php } ?>
        <?php if ($role==ROLE_EMPLOYEE) {?>
        <!-- /.col -->
        <a href="<?php echo base_url() ?>page/manage_cars">
         <!-- ./col -->
         <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-danger"><i class="fa fa-clock-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">My Cars</span>
              <span class="info-box-number">20</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        </a>
        <div class="col-md-4 col-xs-12">
        <a href="<?php echo base_url() ?>addfund/member" class="btn btn-primary btn-block btn-lg"> 
        <i class="fa fa-plus fa-5x"></i><i class="fa fa-dollar fa-5x"></i><br> Add Fund</a>
      </div>

	
      <div class="col-md-4 col-xs-12">
      <a href="<?php echo base_url() ?>fundwithdraw/member" class="btn btn-primary btn-block btn-lg"> 
      <i class="fa fa-repeat fa-5x"></i><i class="fa fa-dollar fa-5x"></i><br> Withdraw Fund</a>
      </div>

	
      <div class="col-md-4 col-xs-12">
        <a href="<?php echo base_url() ?>fundtransfer/member" class="btn btn-primary btn-block btn-lg"> 
        <i class="fa fa-share-alt fa-5x"></i><i class="fa fa-dollar fa-5x"></i><br> Transfer Fund</a>
      </div>

</div>

<?php } ?>
<!-- /.nav-tabs-custom -->
<?php if ($role==ROLE_EMPLOYEE) {?>


<div style="margin-top:30px;"></div>

<div class="row">
	
<div class="col-md-4 col-xs-12">
<a href="<?php echo base_url() ?>addfund/member" class="btn btn-primary btn-block btn-lg"> <i class="fa fa-plus fa-5x"></i><i class="fa fa-dollar fa-5x"></i><br> Add Fund</a>
</div>

	
<div class="col-md-4 col-xs-12">
<a href="<?php echo base_url() ?>fundwithdraw/member" class="btn btn-primary btn-block btn-lg"> <i class="fa fa-repeat fa-5x"></i><i class="fa fa-dollar fa-5x"></i><br> Withdraw Fund</a>
</div>

	
<div class="col-md-4 col-xs-12">
<a href="<?php echo base_url() ?>fundtransfer/member" class="btn btn-primary btn-block btn-lg"> <i class="fa fa-share-alt fa-5x"></i><i class="fa fa-dollar fa-5x"></i><br> Transfer Fund</a>
</div>

</div>

</section>
<?php } 


?>

<?php if ($role==ROLE_PROFESSIONAL) {?>
 
<?php } ?>

<?php if ($role==ROLE_ADMIN) {?>
   <!-- Main content -->
   <section class="content" >
      <!-- Small boxes (Stat box) -->
      <div class="row" style="margin-top:30px;">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3 style="color:#FFFFFF;">14</h3>

              <p>Total Users</p>
            </div>
            <div class="icon">
              <i class="fa fa-users" style="margin-top:30px;"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3 style="color:#FFFFFF;">6</h3>

              <p>Total cash users</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars" style="margin-top:30px;"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3 style="color:#FFFFFF;">8</h3>

              <p>Total card users</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add" style="margin-top:30px;"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3 style="color:#FFFFFF;">R10095.65 </h3>

              <p>ZAR </p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph" style="margin-top:30px;"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
     
      <div class="row">
       
        <!-- ./col -->
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-clock-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Approved Drivers</span>
              <span class="info-box-number">2</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- ./col -->
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-ticket"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Unapproved Drivers</span>
              <span class="info-box-number">2000</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- ./col -->
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-reply"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Free Drivers</span>
              <span class="info-box-number">1</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div> 
        <!-- ./col -->

        <!-- ./col -->
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-danger"><i class="fa fa-clock-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Approved Service Providers</span>
              <span class="info-box-number">20</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- ./col -->
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-blue"><i class="fa fa-ticket"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Unapproved Service Providers</span>
              <span class="info-box-number">24</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- ./col -->
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-purple"><i class="fa fa-reply"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Feedback</span>
              <span class="info-box-number">78</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div> 
        <!-- ./col -->
      
<?php } ?>
</div>

      <!-- /.row -->
      <!-- Main row -->
</section>
<script>

  var txt;
  var r = 0;//confirm("It appears as if your registration is not complete, the page will redirect you to complete the form");
  if (r == true) {
   // window.location.href="http://www.mzansiserve.com/page/manage_profile";
  } else {
    txt = "You pressed Cancel!";
  }
  document.getElementById("demo").innerHTML = txt;

</script>

<div style="margin-top:50px;"></div>

    <script>
  $(document).ready(function() {
      
      var calendar = $('#notice_calendar');
                
                $('#notice_calendar').fullCalendar({
                    header: {
                        left: 'title',
                        right: 'today prev,next'
                    },
                    
                    //defaultView: 'basicWeek',
                    
                    editable: false,
                    firstDay: 1,
                    height: 530,
                    droppable: false,
                    
                    events: [
                        <?php 
                        $notices    =   $this->db->get('noticeboard')->result_array();
                        foreach($notices as $row):
                        ?>
                        {
                            title: "<?php echo $row['notice_title'];?>",
                            start: new Date(<?php echo date('Y',$row['create_timestamp']);?>, <?php echo date('m',$row['create_timestamp'])-1;?>, <?php echo date('d',$row['create_timestamp']);?>),
                            end:    new Date(<?php echo date('Y',$row['create_timestamp']);?>, <?php echo date('m',$row['create_timestamp'])-1;?>, <?php echo date('d',$row['create_timestamp']);?>) 
                        },
                        <?php 
                        endforeach
                        ?>
                        
                    ]
                });
    });
  </script>

  
