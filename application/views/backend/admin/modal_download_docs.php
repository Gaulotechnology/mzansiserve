<?php

//$this->db->join('vehicles', 'vehicles.user_id=identity_docs.user_id','LEFT');
$docs=$this->db->query('SELECT * FROM `identity_docs` 
LEFT JOIN `vehicles` ON identity_docs.user_id=vehicles.user_id WHERE identity_docs.user_id='.$param2.'')->row();


if(!empty($docs) && isset($docs) ){
?>
<div class="panel-body">
        <form action="" method="post" enctype="multipart/form-data" id="form-category">
          <div class="table-respo;nsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                     <td class="text-left"><a href="" class="asc">Document name</a>
                    </td>
                  <td class="text-right">Action</td>
                </tr>
              </thead>
              <tbody>
              <?php if(isset($docs->residency_proof)){ ?>
                    <tr>
                  <td class="text-left">Proof of Residency</td>
                  <td class="text-right"><a href="<?php echo base_url().$docs->residency_proof ?>" class="btn btn-danger" title="Activate Now">Download Now</button></a>
                </tr>
                <?php } ?>
                <?php if(isset($docs->id_copy)){ ?>
                <tr>
                  <td class="text-left">Identifiction Copy </td>
                  <td class="text-right"><a href="<?php echo base_url().$docs->id_copy ?>" class="btn btn-danger" title="Activate Now" download>Download Now</button></a>
                </tr>
                <?php } ?>
                <?php if(isset($docs->passport_copy)){ ?>
                <tr>
                  <td class="text-left">Passport Copy </td>
                  <td class="text-right"><a href="<?php echo base_url().$docs->passport_copy ?>" class="btn btn-danger" title="Activate Now" download>Download Now</button></a>
                </tr>
                <?php } ?>
                <?php if(isset($docs->licence_copy)){ ?>
                <tr>
                  <td class="text-left">Driver Licence Copy</td>
                  <td class="text-right"><a href="<?php echo base_url().$docs->licence_copy ?>" class="btn btn-danger" title="Activate Now">Download Now</button></a>
                </tr>
                <?php } ?>
                <?php if(isset($docs->vehicle_docs)){ ?>
                <tr>
                  <td class="text-left">Vehicle Docs Copy</td>
                  <td class="text-right"><a href="<?php echo base_url().$docs->vehicle_docs ?>" class="btn btn-danger" title="Activate Now">Download Now</button></a>
                </tr>
                <?php } ?>   
                <?php if(isset($docs->insurance_docs)){ ?>
                <tr>
                  <td class="text-left">Insurance Docs Copy</td>
                  <td class="text-right"><a href="<?php echo base_url().$docs->insurance_docs ?>" class="btn btn-danger" title="Activate Now">Download Now</button></a>
                </tr>
                <?php } ?>   
            </tbody>
            </table>
          </div>
         
        </form>
        
      </div>
      </div>
<?php } 
else{
  echo "<h3>No documents have been submitted for this user</h3>";
}

?>