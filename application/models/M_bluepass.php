<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
* m_Client_Email
*
* Automated client emails.
*
* @uses     CI_Model
*
* @category Site
* @package  OnlineGuarding
* @author    Elsabe Lessing (http://www.lessink.co.za)
*/
class m_bluepass extends CI_Model
{
    private $table_name = 'employees';
    
    //id    client_id report_id   email   last_sent   frequency (1 daily, 2 weekly, 3 monthly)    time    day_of_week day_of_month    user_id

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('email');
       
    }
    /**
     * @method get_bluepass_list
     * @return all active blue pass devices
     */
    function get_bluepass_list(){
   
      $last = $this->uri->total_segments();
       $client_id= $this->uri->segment($last);
       $this->db->where('client_id', $client_id);
       $this->db->where('magcell_code <>','');
      $query=$this->db->get($this->table_name);
      return $query->result();
    }

    /**
     * Edited by Gaudencio Solivatore
     * @method get_bluepass_pending
     * @return list of all pending activations
     */
    function get_bluepass_pending(){
   
        $last = $this->uri->total_segments();
         $client_id= $this->uri->segment($last);
         $this->db->where('client_id', $client_id);
         $this->db->where('magcell_code',null);
         $this->db->or_where('magcell_code =',"");
         
        $query=$this->db->get($this->table_name);
        return $query->result();
      }
    /**
     * @param client_id
     * @param magcell_code
     * @method get_list()
     * @return array employees
     */
    function get_list($client_id='', $device_id='', $magcell_code='' ){
        if($client_id!=''){
         $this->db->where('client_id',$client_id);
        
        }
        if($magcell_code!='' ){
            $this->db->where('magcell_code',$magcell_code);
           }
        if($device_id!=''){
         $this->db->where('id',$device_id);
        }
         
           $query=$this->db->get($this->table_name);
           return $query->result();
         }

/**
 * 
* @method authenticate 
*/
    function device_authenticate($qrcode="", $imei_key=""){
       
  
        if($qrcode=="" && $imei_key==""){
            echo '[{ "message":"no" }]';
        }else{
            $this->db->where('qrcode', $qrcode);
            $this->db->where('activation', 0);
            $query = $this->db->get('employees');
            if ($query->num_rows() > 0) {
                $this->db->query("UPDATE employees  SET imei_key='$imei_key', activation=1 WHERE qrcode='$qrcode'");
                echo '[{ "message":"yes"}]';
            } else {
                $this->db->where('qrcode', $qrcode);
                $this->db->where('imei_key', $imei_key);
                $this->db->where('activation', 1);
                $query2 = $this->db->get('employees');
                if ($query2->num_rows() > 0) {
                    echo '[{ "message":"wel"}]';
                } else {
                    echo '[{ "message":"no" }]';
                }
            }
        }
    }

 function insert_client_magcells($magcell_code="", $client_id="", $last_signal="") {
    $data['magcell_code']=$magcell_code;
    $data['client_id']=$client_id;
    $data['last_signal_received']=$last_signal;
   
    try {
       
        $query=$this->db->insert('client_magcell_codes', $data);
        if($query){
return 1;
        }
        else{
return 0;
        }
       }catch(Exception $ex){
        
    }
 }  
/**
 * This function is called when the application loads, it checks if the user is registered, if details match it return settings
 *@method check_connectivity
 *@return json employees settings 
 */
function check_connectivity($qrcode="", $imei_key="", $magcell_code=""){

    
 
    $this->db->where('qrcode', $qrcode);
   
    $myquery = $this->db->get($this->table_name);
    if( $myquery->num_rows()>0){
        
    if($qrcode!=''){
       $this->db->join('clients as c', 'c.client_id = BaseTbl.client_id');
       $this->db->join('employees_servers as server', 'server.client_id = c.client_id'); 
       $this->db->where('BaseTbl.qrcode', $qrcode);
       $this->db->limit('1');
       
        $query = $this->db->get('employees as BaseTbl');
       if($query->num_rows()>0){
           $deb=array();
           $deb['magcell_code']=$magcell_code;
           $this->db->where('qrcode', $qrcode);
           $this->db->where('imei_key', $imei_key);
           $this->db->update('employees', $deb);
        //$this->db->query("UPDATE employees SET magcell_code='$magcell_code' WHERE qrcode='$qrcode' AND imei_key='$imei_key'");
      
     
           //$this->insert_client_magcells($magcell_code, $this->get_client_id($qrcode), time());
      
        
        echo json_encode($query->result_array());
}
    }else{
        echo "You didnt submit any code";
    }
    }
}

/**
 * Edited by Gaudencio Solivatore
 * @method device_register_email
 * @param  $username, $image_url, $to_email
 */
function device_register_email($username="",$image_url="", $email=""){
   
    $subject='Device Registration success';
    $message=' <div style="padding:10px; display:block; background:#2a9fff; width:60%; color:white;">'.$username.' your device settings has been registered and scan qrcode below to get activated</div> <br><img src='.$image_url.'><p><br>';
    if( sendMail($email, $subject, $message, $alt_message)){
        echo "sent";
       }
       else{
        echo "failed";
       }

    

}
/**
 * Editor Gaudencio Solivatore
 * @method bluepass_edit
 * @return results from the database
 */
function bluepass_edit($client_id="", $device_id="", $magcell_code=""){
    $redirect_url= base_url()."clients/bluepass_edit/".$client_id."/".$device_id ;
$data['firstname']=$this->input->post('firstname');
$data['surname']=$this->input->post('surname');
$data['cellnumber']=$this->input->post('cellnumber');
$data['email']=$this->input->post('email');
$data['address']=$this->input->post('address');
$data['sms']=$this->input->post('sms');
$data['ptt']=$this->input->post('ptt');
$data['alerts']=$this->input->post('alerts');
$this->db->where('id', $device_id);
if($this->db->update('employees', $data)){
    $this->session->set_flashdata('device_saved', 'success');
    redirect($redirect_url,'refresh');
}
else{
    $this->session->set_flashdata('device_not_saved', 'failed');
}


}
/**
 * @method get servers
 * @return all servers 
 */
function get_servers(){
    $query=$this->db->get('employees_servers');
    echo json_encode($query->result_array());
}
/**
 * @return checked
 */
function get_check_status($check_value=""){
    if ($check_value==1){
    echo "checked";
    }
    else{
        echo "";
    }

}
/**
 * @method get_client_id
 * Finds  client_id for the given
 */

 function get_client_id($qrcode){
     if ($qrcode!=null) {
         $this->db->select('client_id');
         $this->db->where('qrcode', $qrcode);
         $query=$this->db->get('employees');
         return $query->row()->client_id;
     }
     else{
         return null;
     }
 }

/**
 * @method get_days_left
 * 
 * @return days left for activation
 */
function get_days_left($expiry_date){
   $today_date=time();
   $days=$expiry_date-$today_date;
   $days=$days/86400;
   $days=round($days,0);

if($days>0) return $days." days left";
else{
    return "<font color='red>'expired</font>";
}

}
/**
 * @author Gaudencio Solivatore
 * @param int date
 * @return json array
 */
function api_get_stafflist($date=null){
if($date!=null){
    $this->db->where('reg_date', $date);   
}
$result=$this->db->get("staff")->result_array();
echo json_encode($result);
    }
 /**
  * @author Gaudencio Solivatore
  * @param int date
  * @return json array
   */
 function api_put_stafflist(){
  $data=array();
  $query="";
  $data['usertype']=$this->input->post('usertype');
  $data['pincode']=$this->input->post('pincode');
  $data['firstname']=$this->input->post('firstname');
  $data['surname']=$this->input->post('surname');
  $data['cellnumber']=$this->input->post('cellnumber');
  $data['email']=$this->input->post('email');
  $data['rfid']=$this->input->post('rfid');
  $data['qrcode']=$this->input->post('qrcode');
  $data['fp1']=$this->input->post('fp1');
  $data['reg_date']=$this->input->post('reg_date');
  if($data['firstname']!=null){
    $query=$this->db->insert("staff", $data);
  if($query){
    echo $this->db->insert_id();
}
  }
  else{
      print_r($data);
}
  
  //var_dump($data);

    }
}
