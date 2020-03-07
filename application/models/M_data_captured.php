<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
* m_data_captured
*
*
* @uses     CI_Model
*
* @category Site
* @package  OnlineGuarding
* @author    Elsabe Lessing (http://www.lessink.co.za)
*/
class m_data_captured extends CI_Model {
    private $table_name = 'data_capture';
    private $group_table_name = 'groups';
    private $distributor_table_name = 'company';
    private $users_table_name = 'users';
    private $device_table_name = 'devices';

    private $link_table_name = 'group_numbers';

    function __construct() {
        parent::__construct();
        $this->load->library('email');
        $this->load->database('default');
    }
    /**
     * This function used to get user information by id
     * @param number $userId : This is user id
     * @return array $result : This is user information
     */
    function getUserInfo($userId)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->join('company', 'company.id =users.client_id');
       // $this->db->where('users.isDeleted', 0);
        $this->db->where('users.id', $userId);
        $query = $this->db->get();
        return $query->result();
    }
    /**
     * This function used to get user information by id
     * @param number $userId : This is user id
     * @return array $result : This is user information
     */
    function update_distributor($delid)
    {
        $userInfo = array('isDeleted'=>1);
        $this->db->where('id', $delid);
        $this->db->update('company', $userInfo);
        return $this->db->affected_rows();
    }
    /**
     * This function used to u
     *
     * @return array $result : This number of users online
     */
    function get_online_users(){
        $this->db->select('count(*) as total ');
        $this->db->from('users');
        $this->db->where('online_status',1);
        $query=$this->db->get();
     return $query->row()->total;
    }

    /**
     * This function used to u
     * @param number $userId : This is user id
     * @return array $result : This is user information
     */
    function update_devices($id, $encrypt)
    {
      
        $this->db->set('encrypt', $encrypt); //value that used to update column
        $this->db->where('id', $id); //which row want to upgrade
        $this->db->update('devices');
    }
    /**
     * This function used to u
     * @param number $userId : This is user id
     * @return array $result : This is user information
     */
    function update_my_devices($id, $encrypt)
    {
        if(isset($_POST['submit'])){
        $check=array($_POST['ptt'], $_POST['advanced'], $_POST['armed'],$_POST['sms'], $_POST['control'] );
        $phone=$_POST['phone'];
        $fname=$_POST['fname'];
        $this->db->set('phone',$phone);
        $this->db->set('name',$fname);
        $this->db->set('encrypt', $encrypt); //value that used to update column
        $this->db->where('account_id', $id); //which row want to upgrade
        $this->db->update('devices');
        $sql="UPDATE accounts SET PTT='$check[0]', ADVANCED_ALERT='$check[1]', ARMED='$check[2]', SMS='$check[3]', CONTROL_ROOM='$check[4]' WHERE account_id='$id'";
        $query = $this->db->query($sql);
        if($query){
            redirect('editInfo?id='.$id.'&success');
        }
        }
    }

    /**
     * This function used to get user information by id
     * @param number $userId : This is user id
     * @return array $result : This is user information
     */
    function getUserInfoById($userId)
    {
        $this->db->select('userId, name, email, mobile, roleId');
        $this->db->from('tbl_users');
        $this->db->where('isDeleted', 0);
        $this->db->where('userId', $userId);
        $query = $this->db->get();

        return $query->row();
    }
    /**
     * This function is used to get user login history
     * @param number $userId : This is user id
     */
    function loginHistoryCount($userId, $searchText, $fromDate, $toDate)
    {
        $this->db->select('BaseTbl.userId, BaseTbl.sessionData, BaseTbl.machineIp, BaseTbl.userAgent, BaseTbl.agentString, BaseTbl.platform, BaseTbl.createdDtm');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.email  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($fromDate)) {
            $likeCriteria = "DATE_FORMAT(BaseTbl.createdDtm, '%Y-%m-%d' ) >= '".date('Y-m-d', strtotime($fromDate))."'";
            $this->db->where($likeCriteria);
        }
        if(!empty($toDate)) {
            $likeCriteria = "DATE_FORMAT(BaseTbl.createdDtm, '%Y-%m-%d' ) <= '".date('Y-m-d', strtotime($toDate))."'";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.userId', $userId);
        $this->db->from('tbl_last_login as BaseTbl');
        $query = $this->db->get();

        return $query->num_rows();
    }

    /**
     * This function is used to get user login history
     * @param number $userId : This is user id
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function loginHistory($userId, $searchText, $fromDate, $toDate, $page, $segment)
    {
        $this->db->select('BaseTbl.userId, BaseTbl.sessionData, BaseTbl.machineIp, BaseTbl.userAgent, BaseTbl.agentString, BaseTbl.platform, BaseTbl.createdDtm');
        $this->db->from('tbl_last_login as BaseTbl');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.email  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($fromDate)) {
            $likeCriteria = "DATE_FORMAT(BaseTbl.createdDtm, '%Y-%m-%d' ) >= '".date('Y-m-d', strtotime($fromDate))."'";
            $this->db->where($likeCriteria);
        }
        if(!empty($toDate)) {
            $likeCriteria = "DATE_FORMAT(BaseTbl.createdDtm, '%Y-%m-%d' ) <= '".date('Y-m-d', strtotime($toDate))."'";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.userId', $userId);
        $this->db->order_by('BaseTbl.id', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }

    /**
     * This function used to get user information by id
     * @param number $userId : This is user id
     * @return array $result : This is user information
     */
    function getDistInfo($userId)
    {
        $this->db->select('*');
        $this->db->from('company');
        $this->db->where('isDeleted', 0);
        //$this->db->where('roleId !=', 1);
        $this->db->where('id', $userId);
        $query = $this->db->get();

        return $query->result();
    }

    /**
     * This function used to get image name using encryption key
     * @param encrypt $encrypt 
     * 
     */
    function imageRequest($encrypt){
        if($encrypt==null){
            echo "http://liveguarding.co.za/fa/assets/images/MAG101798burn.png";
        }
        else{
            $this->db->select('logo');
            $this->db->from('company');
            //$this->db->join('company', 'company.company_name = devices.company', 'left');
            //$this->db->where('roleId !=', 1);
            $this->db->where('id', $encrypt);
            $query = $this->db->get();
            return $query->result();
        }
    }

    function get_count() {
        $this->db->select('Count(*) as total');
        $query = $this->db->get($this->table_name);
        if ($query && $query->num_rows() > 0) {
            return $query->row()->total;
        }
        return 0;
    }
    function get_distributor_count($searchText = '') {
        $this->db->select('Count(*) as total');
        if(!empty($searchText)) {
            $likeCriteria = "(company_email  LIKE '%".$searchText."%'
                            OR  company_name  LIKE '%".$searchText."%'
                            OR  company_phone  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $query = $this->db->get($this->distributor_table_name);
        if ($query && $query->num_rows() > 0) {
            return $query->row()->total;
        }
        return 0;
    }
    /**
     * Function to get the last stored id
     */
    function get_distributor_last() {
        $this->db->select('*');
        $this->db->order_by("id","desc");
        $this->db->limit(1);
        $query = $this->db->get($this->distributor_table_name);
       
        return $query->row()->id;
       
    }
    function get_user_count($searchText = '') {
        $this->db->select('Count(*) as total');
        if(!empty($searchText)) {
            $likeCriteria = "(email  LIKE '%".$searchText."%'
                            OR  username  LIKE '%".$searchText."%'
                            OR  cellphone  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $query = $this->db->get($this->users_table_name);
        if ($query && $query->num_rows() > 0) {
            return $query->row()->total;
        }
        return 0;
    }

    function get_devices_count($searchText = '') {
        $this->db->select('Count(*) as total');
        if(!empty($searchText)) {
            $likeCriteria = "(email  LIKE '%".$searchText."%'
                            OR  name  LIKE '%".$searchText."%'
                            OR  phone  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $query = $this->db->get($this->device_table_name);
        if ($query && $query->num_rows() > 0) {
            return $query->row()->total;
        }
        return 0;
    }



    
/**
 * Find number of users
 */
    function get_users_count($searchText = '') {
        $this->db->select('Count(*) as total');
        if(!empty($searchText)) {
            $likeCriteria = "(email  LIKE '%".$searchText."%'
                            OR  name  LIKE '%".$searchText."%'
                            OR  phone  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $query = $this->db->get($this->device_table_users);
        if ($query && $query->num_rows() > 0) {
            return $query->row()->total;
        }
        return 0;
    }

    function get_data() {
        $query = $this->db->get($this->table_name);
        if ($query && $query->num_rows() > 0) {
            return $query->result_array();
        }
        return 0;
    }
    function get_group_count() {
        $this->db->select('Count(*) as total');
        $query = $this->db->get($this->group_table_name);
        if ($query && $query->num_rows() > 0) {
            return $query->row()->total;
        }
        return 0;
    }

     function get_group_data() {

        $sql = "select g.group_name,
                m.memberName,
                g.groupType,
                g.date
                from groups g
                left join members m on m.memberID = g.originatingMemberID";

        $query = $this->db->query($sql);
        if ($query && $query->num_rows() > 0) {
            return $query->result_array();
        }
        return 0;
    }
    function get_distributor_data() {

        $sql = "select company_name, company_email, company_phone
                from company";

        $query = $this->db->query($sql);
        if ($query && $query->num_rows() > 0) {
            return $query->result_array();
        }
        return 0;
    }


    /**
     * @return mixed
     * function to search and find a device
     */
function get_devices_find() {
        $id=$_GET['id'];
        $this->db->select('*');
        $this->db->from('devices as BaseTbl');
        $this->db->join('accounts as acc', 'acc.account_id = BaseTbl.account_id');
        $this->db->join('company', 'company.id = BaseTbl.client_id');
        $this->db->where('BaseTbl.account_id', $id);
        $query = $this->db->get();
        
        return $query->result();
    }
/**
     * @return mixed
     * function to search and find a device
     */
    function get_account_details($id) {
        
               $this->db->select('*');
                $this->db->from('accounts');
                $this->db->where('account_id =', $id);
                $query = $this->db->get();
                
                return $query->result();
            }
    /**
     * @return int
     * function to get device data
     */
    function get_devices_data() {

        $sql = "select imei,
                name, 
                phone,
                email,
                encrypt
                from devices";

        $query = $this->db->query($sql);
        if ($query && $query->num_rows() > 0) {
            return $query->result_array();
        }
        return 0;
    }


/**
     * @return int
     * function to count the numbers
     */
    function device_delete($id) {
        
        $this->db->set('isDeleted', 1); //value that used to update column
        $this->db->where('id', $id); //which row want to upgrade
        $this->db->update('devices');
    }

/**
     * @return int
     * function to count the numbers
     */
    function users_delete($id) {
        
        $this->db->set('isDeleted', 1); //value that used to update column
        $this->db->where('id', $id); //which row want to upgrade
        $this->db->update('users');
    }

    /**
     * @return int
     * function to count the numbers
     */
    function get_number_count() {
        $this->db->select('Count(*) as total');
        $query = $this->db->get($this->link_table_name);
        if ($query && $query->num_rows() > 0) {
            return $query->row()->total;
        }
        return 0;
    }
 /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function userListingCount($searchText = '')
    {
        $this->db->select('*');
        $this->db->from('users as BaseTbl');
       // $this->db->join('tbl_roles as Role', 'Role.roleId = BaseTbl.roleId','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.email  LIKE '%".$searchText."%'
                            OR  BaseTbl.username  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $role=$this->session->userdata("role");
        $dis_id=$this->session->userdata("client_id");
        if($role==ROLE_DISTRIBUTOR){
            $this->db->where('BaseTbl.client_id', $dis_id);
                                  }
        $this->db->where('BaseTbl.isDeleted', 0);
        //$this->db->where('BaseTbl.roleId !=', 1);
        $query = $this->db->get();
        
        return $query->num_rows();
    }
    /**
     * This function is used to delete the user information
     * @param number $userId : This is user id
     * @return boolean $result : TRUE / FALSE
     */
    function deleteUser($userId, $userInfo)
    {
        $this->db->where('id', $userId);
        $this->db->update('users', $userInfo);

        return $this->db->affected_rows();
    }

    /**
     * This function is used to get the distributor listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function distributorListingCount($searchText = '')
    {
        $this->db->select('*');
        $this->db->from('company as BaseTbl');
        // $this->db->join('tbl_roles as Role', 'Role.roleId = BaseTbl.roleId','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.company_email  LIKE '%".$searchText."%'
                            OR  BaseTbl.company_name  LIKE '%".$searchText."%'
                            OR  BaseTbl.company_phone  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        //$this->db->where('BaseTbl.roleId !=', 1);
        $query = $this->db->get();

        return $query->num_rows();
    }
    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function distributorListing($searchText = '', $page, $segment)
    {
        $this->db->select('*');
        $this->db->from('company as BaseTbl');
        //$this->db->join('tbl_roles as Role', 'Role.roleId = BaseTbl.roleId','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.company_email  LIKE '%".$searchText."%'
                            OR  BaseTbl.company_name  LIKE '%".$searchText."%'
                            OR  BaseTbl.company_phone  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        //$this->db->where('BaseTbl.roleId !=', 1);
        $this->db->limit($page, $segment);
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }
    


    /**
     * The folowing function lists the available user roles
     */
     function getUserRoles()
    {
        $this->db->select('role');
        $this->db->distinct('role');
        $this->db->from('users');
        //$this->db->limit(2);
        //$this->db->where('roleId !=', 1);
        $query = $this->db->get();
        
        return $query->result();
    }
   /**
     * The folowing function lists the available companynames
     */
    function getCompanyNames(){
        $this->db->select('*');
        $this->db->distinct('company_name');
        $this->db->from('company');
        //$this->db->limit(2);
        //$this->db->where('roleId !=', 1);
        $query = $this->db->get();
        return $query->result();
   }
 /**
     * The folowing function lists the available companynames
     */
    function getCompanyDetails(){
        $username = $this->session->userdata('username');
        $this->db->select('*');
        $this->db->from('company');
        $this->db->join('users', 'company.id = users.client_id','left');
        $this->db->where('users.username', $username);
        $query = $this->db->get();
        return $query->result();
   }


    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function deviceListingCount($searchText = '')
    {
        $this->db->select('*');
        $this->db->from('devices as BaseTbl');
        //$this->db->join('tbl_roles as Role', 'Role.roleId = BaseTbl.roleId','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.email  LIKE '%".$searchText."%'
                            OR  BaseTbl.name  LIKE '%".$searchText."%'
                            OR  BaseTbl.phone  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $role=$this->session->userdata("role");
        $dis_id=$this->session->userdata("client_id");
        if($role==ROLE_DISTRIBUTOR){
            $this->db->where('BaseTbl.client_id', $dis_id);
                                  }
        $this->db->where('BaseTbl.isDeleted', 0);
        //$this->db->where('BaseTbl.roleId !=', 1);
        $query = $this->db->get();
        //echo $query->num_rows();
        return $query->num_rows();
    }
     /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function accountsListingCount($searchText = '')
    {
        $this->db->select('*');
        $this->db->from('accounts as acc');
        $this->db->join('devices as BaseTbl', 'acc.account_id = BaseTbl.account_id','left');
        $this->db->distinct('BaseTbl.account_id');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.email  LIKE '%".$searchText."%'
                            OR  BaseTbl.name  LIKE '%".$searchText."%'
                            OR  BaseTbl.phone  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $role=$this->session->userdata("role");
        $dis_id=$this->session->userdata("client_id");
        if($role==ROLE_DISTRIBUTOR){
            $this->db->where('BaseTbl.client_id', $dis_id);
                                  }
        $this->db->where('BaseTbl.isDeleted', 0);
        //$this->db->where('BaseTbl.roleId !=', 1);
        $query = $this->db->get();
        //echo $query->num_rows();
        return $query->num_rows();
    }
/**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function accountsListing($searchText = '', $page, $segment)
    {
        $this->db->select('*');
        $this->db->from('accounts as acc');
        $this->db->distinct('BaseTbl.account_id');
       
        $this->db->join('devices as BaseTbl', 'acc.account_id = BaseTbl.account_id','left');
        //$this->db->query('SELECT * FROM devices');
        $this->db->distinct('acc.account_id');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.email  LIKE '%".$searchText."%'
                            OR  BaseTbl.name  LIKE '%".$searchText."%'
                            OR  acc.account_id  LIKE '%".$searchText."%'
                            OR  BaseTbl.phone  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $role=$this->session->userdata("role");
        $dis_id=$this->session->userdata("client_id");
        if($role==ROLE_DISTRIBUTOR){
            $this->db->where('BaseTbl.client_id', $dis_id);
                                  }
        $this->db->where('BaseTbl.isDeleted', 0);
        //$this->db->where('BaseTbl.roleId !=', 1);
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

/**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function modulesListingCount($searchText = '')
    {
        $this->db->select('*');
        $this->db->from('modules');
        $query = $this->db->get(); 
        return $query->num_rows();
      
    }
 /**
     * This function is used to get the modules listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function modulesListing($searchText = '', $page, $segment)
    {
        $this->db->select('*');
        $this->db->from('modules');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }





    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function userListing($searchText = '', $page, $segment)
    {
        $this->db->select('*');
        $this->db->from('users as BaseTbl');
      
        //$this->db->join('tbl_roles as Role', 'Role.roleId = BaseTbl.roleId','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.email  LIKE '%".$searchText."%'
                            OR  BaseTbl.username  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $role=$this->session->userdata("role");
        $dis_id=$this->session->userdata("client_id");
        if($role==ROLE_DISTRIBUTOR){
        $this->db->where('BaseTbl.client_id', $dis_id);}
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        $result = $query->result();        
        return $result;
    }

    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function deviceListing($searchText = '', $page, $segment)
    {
        $this->db->select('*');
        $this->db->from('devices as BaseTbl');
        //$this->db->query('SELECT * FROM devices');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.email  LIKE '%".$searchText."%'
                            OR  BaseTbl.name  LIKE '%".$searchText."%'
                            OR  BaseTbl.phone  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $role=$this->session->userdata("role");
        $dis_id=$this->session->userdata("client_id");
        if($role==ROLE_DISTRIBUTOR){
            $this->db->where('BaseTbl.client_id', $dis_id);
                                  }
        $this->db->where('BaseTbl.isDeleted', 0);
        //$this->db->where('BaseTbl.roleId !=', 1);
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
function hasher($value){
    $hasher = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);
    $hashed =$hasher->HashPassword($value);
    return $hashed;
}
    /**
     *Add new user
     */
    function addNewUser(){
        if(isset($_POST['submit'])){
            $count=$this->get_user_count();
            $key=md5($count+1);
            $hasher = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);
            $name = $_POST['fname'];

            $email = $_POST['email'];
            $client_id = $_POST['client_id'];
            $password = $hasher->HashPassword(trim($_POST['password']));
            $phone = $_POST['phone'];
            $role=$_POST['role'];
            $created=1;
            $this->email->initialize($config);
            $this->email->from(ADMIN_EMAIL, 'Gaudencio Solivatore');
            $this->email->to($email);
            $this->email->cc(ADMIN_EMAIL);
            $this->email->bcc(ADMIN_EMAIL);   
            $this->email->subject('Registration success');
            $this->email->message($name.' To activate your account click the following link http://www.liveguarding.co.za/fa/newUser?new_password_key='.$key);
        //$this->email->attach($path . 'yourfile.pdf');
        

             $this->email->send();
         $this->db->query("INSERT INTO users(username, email,password, cellphone, role, created, client_id, new_password)
         VALUES('$name','$email','$password', '$phone','$role','$created','$client_id','$key')");
          redirect('addNew?success');
        }
    }
/**
     *
     */
    function addNewDistributor($new_name,$last_dist){
        $registration_code=$_POST['registration_code'];
        $companyname = $_POST['company_name'];
        $companyemail = $_POST['company_email'];
        $companyphone = $_POST['company_phone'];
        $logo=  $new_name;
        $companyaddress = $_POST['company_address'];
        $companyweb = $_POST['company_web'];
        $companyfax = $_POST['company_fax'];
        $serverip = $_POST['server_ip'];
        $serverport = $_POST['server_port'];
    
        $this->db->query("INSERT INTO company(company_name, company_email,company_phone
        , company_address, company_web, company_fax,
        registration_code, isDeleted, logo) 
        VALUES('$companyname','$companyemail','$companyphone', '$companyaddress', '$companyweb','$companyfax','$registration_code', 0, '$logo')");
        //The function also inserts data into the server settings table
        $this->db->query("INSERT INTO server_settings(server_ip, server_port,server_name, company
        , connection) 
        VALUES('$serverip','$serverport','$companyname', '$companyname', '$last_dist')");
        
         
         //redirect('addNewDistributor?success');
    }

/**
 * Function to find the id of a distributor
 */
function lastAdded($registration_code){
   
   $this->db->select('*');
    $this->db->from('company');
    $this->db->order_by("id","desc");
    $this->db->limit(1);
    $query = $this->db->get();
    $row = $query->row(); 
    return $row->id;
}


    /**
     *
     */
    function modifyDistributor($userid,$page){
        if(isset($_POST['submit'])){
        $companyname = $_POST['company_name'];
        $companyemail = $_POST['company_email'];
        $companyphone = $_POST['company_phone'];
        $companyaddress = $_POST['company_address'];
        $companyweb = $_POST['company_web'];
        $companyfax = $_POST['company_fax'];
    
        $this->db->query("UPDATE company SET company_name='$companyname',
        company_email='$companyemail',
        company_phone='$companyphone',
        company_address='$companyaddress',
        company_web='$companyweb',
        company_fax=' $companyfax' WHERE id='$userid'");
        if($page=="company_details"){
            redirect('company_details?success');
        }
        else{
            redirect('editDist/'.$userid.'?success');

        }
        
        }
    }
    /**
     * modify distributor logo
     */
    function editDistLogo($companylogo, $userId){
        $this->db->query("UPDATE company SET logo='$companylogo'");
        $this->db->where('id', $userId);
    }

    /**
     * @param $encrypt
     * The function joins two tables devices and server settings and returns  server settings
     */
function get_server_details($imei,$encrypt){
    $this->db->select('*');
    $this->db->from('devices');
    $this->db->join('server_settings', 'devices.company =server_settings.company ');
    //$this->db->where('devices.encrypt', $encrypt);
    $this->db->where('server_settings.id', 1);
   
    $query = $this->db->get();
    return $query;

}
function get_server_settings($id){
    $query = $this->db->get_where('server_settings', array('id' => $id));
    echo json_encode( $query->result_array());
   

}

    /**
     * Device initial registration, function to register a new device from a mobile app
     */
function mobile_registration(){
    $imei = $_POST['imei'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['user_email'];
    $company = $_POST['company'];
    if($this->db->query("INSERT INTO devices(imei, name, phone, email, company, geolocation, provider, encrypt) VALUES('$imei', '$name' , '$phone', ' $email', '$company', '', '' , '')")){
        echo "record saved";
    }
else{
        echo "record not saved";
}
}


/**
     * Whenever app is loaded this function is called, to setup the device for the first time 
     */
    function device_connect($encrypt="", $imei=""){
      
        
            $this->db->query("UPDATE devices SET imei='$imei' WHERE encrypt='$encrypt'");
            $this->db->select('*');
            $this->db->from('server_settings');
            $this->db->where('id', 1);
            $this->db->limit(1);
            $query2 = $this->db->get();
          
           
        }
    

    


    /**
     * @authenticate functo
     */
function device_authenticate( $encrypt="", $imei=""){
  
    if($imei=="" && $encrypt==""){
        echo '[{ "message":"no" }]';
    }else{
        $this->db->where('encrypt', $encrypt);
        $this->db->where('activation', 0);
        $query = $this->db->get('devices');
        if ($query->num_rows() > 0) {
            $this->db->query("UPDATE devices  SET imei='$imei', activation=1 WHERE encrypt='$encrypt'");
            echo '[{ "message":"yes"}]';
        } else {
            $this->db->where('encrypt', $encrypt);
            $this->db->where('imei', $imei);
            $this->db->where('activation', 1);
            $query2 = $this->db->get('devices');
            if ($query2->num_rows() > 0) {
                echo '[{ "message":"wel"}]';
            } else {
                echo '[{ "message":"no" }]';
            }
        }
    }
}

function registered_user($imei,$encrypt){
   
    
}
/**
 * This function is called when the application loads, it checks if the user is registered, if details match it return settings
 */
function check_connectivity($encrypt="", $imei=""){
    $this->db->select('*');
    $this->db->where('encrypt', $encrypt);
    $this->db->where('activation', 1);
    $myquery = $this->db->get($this->device_table_name);
    if( $myquery->num_rows()>0){
    if(!$encrypt==null){
       $this->db->select('*');
       $this->db->from('devices as BaseTbl');
       $this->db->join('distributor as comp', 'comp.client_id = BaseTbl.client_id');
       $this->db->join('server_settings as server', 'server.client_id = BaseTbl.client_id','right'); 
       //$this->db->where('BaseTbl.imei', $imei);
       //
       $this->db->where('BaseTbl.encrypt', $encrypt);
       $this->db->limit('1');

        $query = $this->db->get();
       if($query->num_rows()>0){
        //$connectivity= $this->get_server_details();
        echo json_encode($query->result_array());
//echo $query->row()->email;
}
    }else{
        echo "You didnt submit any code";
    }
    }
}


function get_familylist($date=''){
if($date!=null){
    $this->db->where('created >', $date);
}
$query=$this->db->get('FamilyList');
return json_encode($query->result_array());
}
/**
 * Gets learnerlist
 */
function get_learnerlist($date=''){
    if($date!=null){
        $this->db->where('created >', $date);
    }
    $query=$this->db->get('LearnerList');
    return json_encode($query->result_array());
    }

function access_granted($family_code="", $access_status="", $access_date=""){
$data['family_code']=$family_code;
$data['access_status']=$access_status;
$data['access_date']=time();
if($this->db->insert('access_granted', $data)){
echo "working";

}


}

 /**
  * Web initial registration, function to register a new device from a by the supervisor 
  */
  function device_registration($encrypted){
       
        $check=array($_POST['ptt'],$_POST['sms'], $_POST['advanced'], $_POST['control'], $_POST['armed'] );
        $name = $_POST['name'];
        $name=preg_replace('/\s+/', '_', $name);
        $name = str_replace(' ', '_', $name);
        $phone = $_POST['phone'];
        $email = $_POST['user_email'];
        $company = $_POST['company'];
        $encrypt = $encrypted;//$_POST['encrypt'];
        $account_id = $_POST['account_id'];
        $client_id = $_POST['client_id'];
        if($this->db->query("INSERT INTO devices(account_id,imei,name, phone, email, company, geolocation, provider, encrypt, client_id) 
        VALUES('$account_id','', '$name' , '$phone', ' $email', '$company', '', '' , '$encrypt', '$client_id')")){
        $this->db->query("INSERT INTO accounts(account_id,email, client_id, PTT, SMS, ADVANCED_ALERT, CONTROL_ROOM, ARMED) 
        VALUES('$account_id','$email', '$client_id', '$check[0]', '$check[1]', '$check[2]', '$check[3]', '$check[4]' )");
            
            echo "record saved";
        }
    else{
            echo "record not saved";
    }
    
}
function passwordUpdate(){
   
    $key=$_GET['new_password_key'];
    if(isset($_POST['submit'])){
       $hasher = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);
       $password =trim($hasher->HashPassword($_POST['password']));
       $query="UPDATE users SET password='$password', verified=1 WHERE new_password='$key'";
       $this->db->query($query);
        //$this->db->set('password', $password);
       // $this->db->where('new_password_key', $key);
       // $this->db->update('users');
   header("Location:auth/login");
}
//$hasher = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);
//$password2 = $hasher->HashPassword($password);
}
/**
     * store
     *
     * @param mixed  $imei       Description.
     * @param string $real_email Description.
     * @param string $user_email Description.
     * @param string $name       Description.
     * @param string $number     Description.
     * @param string $contacts   Description.
     * @param string $gps        Description.
     *
     * @access public
     *
     * @return mixed Value.
     */
    function store($imei, $real_email='', $user_email='', $name='', $number='', $contacts='', $gps='') {
        if ($contacts) {
            $contacts = json_encode($contacts);
        }
        $db_data = array(
            'imei'=>$imei,
            'real_email'=>$real_email,
            'user_email'=>$user_email,
            'name'=>$name,
            'number'=>$number,
            'contacts'=>$contacts,
            'gps'=>$gps,
            'date'=>date('Y-m-d H:i:s')
            );

         $this->db->insert($this->table_name, $db_data);
         return $this->db->insert_id();
    }

    function add_member($name = null, $number = null,$imei = null, $real_email = null, $user_email = null, $gps = null,$markAsInstalled = false){
        $sql = "insert into members(
                    memberName,memberNumber,created, imei, realEmail,userEmail,gps,hasInstalled
                )values(
                '$name','$number',current_time(),'$imei','$real_email','$user_email','$gps'";

        if($markAsInstalled){
            $sql .= ",1)";
        }else{
            $sql .= ",0)";
        };


        if($this->db->query($sql)){
            return $this->db->insert_id();
        }else{
            return false;
        }
        
    }

    function update_member_info($isMember,$imei, $real_email, $user_email, $name, $number, $gps,$isInstalled = null){
        $sql = "update members set 
                imei = '$imei',
                realEmail = '$real_email',
                userEmail = '$user_email',
                memberName = '$name',
                gps = '$gps',";
                if($isInstalled){
                    $sql .= "hasInstalled = 1 ";
                }
                $sql .= "where memberID = $isMember";

        if($this->db->query($sql)){
            return true;
        }else{
            return false;
        }
    }

    function get_member_info($memberID = null){
        $sql = "select * from members where memberID = $memberID";
        $result = $this->db->query($sql);
        if($result && $result->num_rows() > 0){
            return $result->row();
        }else{
            return false;
        }
    }

    function check_member_status($number = null){

            $sql = "select * from members where memberNumber = $number";
       

        $result = $this->db->query($sql);

        if($result && $result->num_rows() > 0){
            return $result->row()->memberID;
        }else{
            return false;
        }
    }

    function check_home_group($memberID = null){

        $sql = "select * from groups where OriginatingMemberID = $memberID";

        $result = $this->db->query($sql);

        if($result && $result->num_rows() > 0){
            return $result->row()->group_id;
        }else{
            return false;
        }
    }


    function check_group($number) {
        $group = false;
        $this->db->where('number', $number);
        $query = $this->db->get($this->link_table_name);


        if ($query && $query->num_rows() > 0) {
            return $query->row()->group_id;
        }
        return $group;
    }

    function get_group_numbers($group_id) {
        $this->db->select('number');
        $this->db->where('group_id', $group_id);
        $this->db->order_by('number', 'asc');
        $query = $this->db->get($this->link_table_name);
        if ($query && $query->num_rows() > 0) {
            $data = array();
            foreach($query->result() as $row) {
                if ($row->number == 'noone') { continue; }
                $data[] = $row->number;
            }
            return $data;
        }
        return false;
    }

    function get_group_numbers_installs($group_id) {

        $sqlSelect = "SELECT gn.* ,
                        if(dc.data_capture_id,\"Yes\",\"No\")as isInstalled
                        FROM fa.group_numbers gn
                        left join data_capture as dc on dc.number = gn.number
                        where gn.group_id = $group_id";

        $query = $this->db->query($sqlSelect);
        if ($query && $query->num_rows() > 0) {
            $data = array();
            foreach($query->result() as $row) {
                if ($row->number == 'noone') { continue; }
                $data[] = array("Name" =>$row->name,"Number"=>$row->number,"Installed"=>$row->isInstalled);
            }
            return $data;
        }
        return false;
    }


    function get_group_names_numbers($group_id) {

        $sql = "SELECT gl.groupID,
                g.group_name,
                m.memberName,
                m.memberNumber,
                if(m.hasInstalled is true,'Y','N') as installed
                 FROM fa.groupLinks gl
                join members as m on m.memberID = gl.memberID
                join groups as g on g.group_id = gl.groupID
                where gl.groupID = $group_id";
        $query = $this->db->query($sql);
        if ($query && $query->num_rows() > 0) {
            $data = array();
            foreach($query->result() as $row) {
                if ($row->memberNumber == 'noone') { continue; }
                $data[] = array('Name'=>$row->memberName,'Number'=>$row->memberNumber,'GroupID'=>$row->groupID,'GroupName'=>$row->group_name,"Installed"=>$row->installed);
            }
            return $data;
        }
        return false;
    }
    
    
    function add_group_number($group_id, $number,$name) {
        // if ($number == 'noone') { return; }
        // $this->db->where('group_id', $group_id);
        // $this->db->where('number', $number);
        // $query = $this->db->get($this->link_table_name);
        // if (!$query || $query->num_rows() == 0) {
        //     $db_data = array(
        //         'group_id'=>$group_id,
        //         'number'=>$number,
        //         'name' => $name,
        //         'date'=>date('Y-m-d H:i:s')
        //     );
        //     $this->db->insert($this->link_table_name, $db_data);
        //     return $this->db->insert_id();
        // }
    }


    function remove_group_links($groupID = null,$adminID = null,$keepAdmin = true){
        $sql = "delete from groupLinks where groupID = $groupID";
        if($keepAdmin == true){
            $sql .= " and memberID != $adminID";
        }

        if($this->db->query($sql)){
            return true;
        }else{
            return false;
        }

    }


    function add_group_name_number($groupID, $details){

        $number = preg_replace("/[^0-9]/", "", str_replace("+27", "0", $details[1]));

        if($memberID = $this->check_member_status($number)){
            //membership found so just add groupLink
            $this->add_group_link($groupID, $memberID);
            return true;
        }else{

            //membership not found so create membership then add to groupLink
            if($memberID = $this->add_member($details[0],$number)){
                $this->add_group_link($groupID, $memberID);
                return true;               
            };


        }

      
    }

    /*
        @$interval is the record id returned from the initial record post save function
        @$memberID of admin for group
        @$groupType Home or Community

    */
    function create_home_group($interval=null,$memberID = null,$groupType = 'COMMUNITY') {
        if ($interval == null) { $interval = time(); }

        //generates a generic name like GP1 etc
        $group_name = $this->generate_group_name($interval);

        //add human readable portion to name  GP1_TomHarding
        $friendlyName = $this->db->query("select memberName from members where memberID = $memberID")->row()->memberName;

        $db_data = array(
            'group_name'=>$group_name.'_'.$friendlyName,
            'date'=>date('Y-m-d H:i:s'),
            'OriginatingMemberID'=>$memberID,
            'groupType'=>strtoupper($groupType)
            );
        $this->db->insert($this->group_table_name, $db_data);
        return $this->db->insert_id();
    }


    function add_group_link($groupID,$memberID){
        $sql = "insert into groupLinks(
                groupID,memberID,created
                )values(
                $groupID,$memberID,current_time())";

        if($this->db->query($sql)){
            return true;
        }else{
            return false;
        }
    }


    function create_group($interval=null,$memberID = null) {
        if ($interval == null) { $interval = time(); }

        $group_name = $this->generate_group_name($interval);
        $db_data = array(
            'group_name'=>$group_name,
            'date'=>date('Y-m-d H:i:s'),
            'OriginatingMemberID'=>$memberID
            );
        $this->db->insert($this->group_table_name, $db_data);
        return $this->db->insert_id();
    }

    function generate_group_name($interval) {
        $group_name_offset = $this->m_settings->get_by_key('group_name_offset')->value;
        do {
            $str = 'GP'.($group_name_offset+$interval);
            $interval++;
        } while ($this->check_group_name_exists($str));

        return $str;
    }

    function check_group_name_exists($group_name) {
        $this->db->where('group_name', $group_name);
        $query = $this->db->get($this->group_table_name);
        return ($query && $query->num_rows() > 0);
    }

    function get_memberGroups($groupList = null){
        //$sql = "select * from groups where group_id in ($groupList)";
        $sql = "select g.group_id,
                count(*) as memberCount,
                g.group_name 
                from groupLinks
                left join groups as g on g.group_id = groupLinks.groupID
                where groupID in ($groupList)
                group by groupID";
        $query = $this->db->query($sql);

        if ($query && $query->num_rows() > 0) {
            $data = array();
            foreach($query->result() as $row) {

                $data[] = array('group_name'=>$row->group_name,'group_id'=>$row->group_id,'memberCount'=>$row->memberCount);
            }
            return $data;
        }else{
            return false;
        }
    }

    function get_groupMembers($getType = null,$value = null){

        switch($getType){
            case 'byID':
                $groupID = $value;

                //groupID exists and returns info
                if($groupInfo = $this->db->query("select * from groups where group_id = $value")->row()){
                    if($members = $this->get_group_names_numbers($groupID)){

                        $data['groupID'] = $groupID;
                        $data['members'] = $members;
                        return $data;
                    }else{
                        return false;
                    };

                };

            break;
            case 'byName':


                if($groupInfo = $this->db->query("select * from groups where group_name = '$value'")->row()){

                    if($members = $this->get_group_names_numbers($groupInfo->group_id)){

                        $data['groupID'] = $groupInfo->group_id;
                        $data['members'] = $members;
                        return $data;
                    }else{
                        return false;
                    };
                }

            break;
            case 'byNumber':
                if($groupInfo = $this->db->query("SELECT * FROM fa.members
                                                    left join groups as g on g.OriginatingMemberID = members.memberID 
                                                    where hasInstalled is true and memberNumber =  '$value'")->row()){


                    if($members = $this->get_group_names_numbers($groupInfo->group_id)){

                        $data['groupID'] = $groupInfo->group_id;
                        $data['members'] = $members;
                        return $data;
                    }else{
                        return false;
                    };
                }
            break;
        }
    }
//looool

    function get_group_by_assoc($getType = null,$value = null){

        $groupFetch = "select 
                       gl.groupID,
                       g.group_name,
                       g.OriginatingMemberID,
                       m.memberName,
                       g.groupType
                       from groupLinks gl
                       join groups as g on g.group_id = gl.groupID
                       join members as m on m.memberID = g.originatingMemberID ";

        $groupMemberFetch = "select gl.groupID, gl.memberID,
                            if(m.memberName != '',m.memberName,'Name Not Provided On Setup') memberName,
                            if(m.hasInstalled is true,'Y','N')hasInstalled
                            from groupLinks gl
                            left join members as m on m.memberID = gl.memberID
                            left join groups as g on g.group_id = gl.groupID
                            where gl.groupID in (
                            select gl.groupID from groupLinks gl
                            join groups as g on g.group_id = gl.groupID ";      


        switch($getType){
            case 'byID':
                $memberID = $value;

                $groupFetch .= "where gl.memberID = $memberID and g.originatingMemberId <> $memberID
                                group by gl.groupID";


                $groupMemberFetch .= "where gl.memberID = $memberID and g.originatingMemberId <> $memberID)";


 
                if($groupfetchresult = $this->db->query($groupFetch)){
                    $data['groups'] = $groupfetchresult->result();
                };

                if($groupmemberfetchresult = $this->db->query($groupMemberFetch)){
                    $data['groupMembers'] = $groupmemberfetchresult->result();
                };

                return $data;
            break;

            case 'byName':


                $memberName = $value;

                $groupFetch .= "where gl.memberID = (select memberID from members where membername = '$memberName') 
                                and g.originatingMemberId <> (select memberID from members where membername = '$memberName')
                                group by gl.groupID";


                $groupMemberFetch .= "where gl.memberID = (select memberID from members where membername = '$memberName') 
                                    and g.originatingMemberId <> (select memberID from members where membername = '$memberName'))";


 
                if($groupfetchresult = $this->db->query($groupFetch)){
                    $data['groups'] = $groupfetchresult->result();
                };

                if($groupmemberfetchresult = $this->db->query($groupMemberFetch)){
                    $data['groupMembers'] = $groupmemberfetchresult->result();
                };

                return $data;

            break;
            case 'byNumber':


                $memberNumber = $value;

                $groupFetch .= "where gl.memberID = (select memberID from members where memberNumber = '$memberNumber') 
                                and g.originatingMemberId <> (select memberID from members where memberNumber = '$memberNumber')
                                group by gl.groupID";


                $groupMemberFetch .= "where gl.memberID = (select memberID from members where memberNumber = '$memberNumber') 
                                    and g.originatingMemberId <> (select memberID from members where memberNumber = '$memberNumber'))";


 
                if($groupfetchresult = $this->db->query($groupFetch)){
                    $data['groups'] = $groupfetchresult->result();
                };

                if($groupmemberfetchresult = $this->db->query($groupMemberFetch)){
                    $data['groupMembers'] = $groupmemberfetchresult->result();
                };

                return $data;
            break;
        }
    }  




    function get_groups($getType = null,$value = null){

        switch($getType){
            case 'byID':
                $memberID = $value;

                //groupID exists and returns info
                if($groupInfo = $this->db->query("select distinct(groupID)as groups from groupLinks where memberID = $value")->result()){
                   
                    foreach($groupInfo as $item){
                        $array[] = $item->groups;
                    }


                    if($groups = $this->get_memberGroups(implode(',',$array))){

                        $data['groups'] = $groups;
                        return $data;
                    }else{
                        return false;
                    };

                };

            break;
            case 'byName':


                if($groupInfo = $this->db->query("select distinct(groupID)as groups from groupLinks 
                                                    left join members as m on m.memberID = groupLinks.memberID
                                                    where m.memberName = '$value'")->result()){

                    foreach($groupInfo as $item){
                        $array[] = $item->groups;
                    }


                    if($groups = $this->get_memberGroups(implode(',',$array))){

                        $data['groups'] = $groups;
                        return $data;
                    }else{
                        return false;
                    };
                }

            break;
            case 'byNumber':

                if($groupInfo = $this->db->query("select distinct(groupID)as groups from groupLinks 
                                                    left join members as m on m.memberID = groupLinks.memberID
                                                    where m.memberNumber = '$value'")->result()){

                    foreach($groupInfo as $item){
                        $array[] = $item->groups;
                    }


                    if($groups = $this->get_memberGroups(implode(',',$array))){

                        $data['groups'] = $groups;
                        return $data;
                    }else{
                        return false;
                    };
                }
            break;
        }
    }    

    function get_communityGroups($status = null){
        $sql = "SELECT g.group_id,
                g.group_name,
                gm.memberCount
                FROM fa.groups g
                left join (select count(*) as memberCount, groupID from groupLinks group by groupID) as gm on gm.groupID = g.group_id
                where g.groupType = 'COMMUNITY' and g.status = '$status'";

        $result = $this->db->query($sql);

        if($result && $result->num_rows() > 0){
            foreach($result->result() as $row){
               $data[] = array('group_name'=>$row->group_name,'group_id'=>$row->group_id,'memberCount'=>$row->memberCount);
            };
            return $data;

        }else{
            return false;
        }
    }

    function changeGroupName($data = null){
        $sql = "update groups set group_name = '{$data['new_group_name']}'
                where OriginatingMemberID = {$data['memberID']}
                and groups.group_id = {$data['groupID']}";
        $result = $this->db->query($sql);

        if($result){
            return true;
        }else{
            return false;
        }
    }
/**
     * This function is used to match users password for change password
     * @param number $userId : This is user id
     */
    function matchOldPassword($userId, $oldPassword)
    {
        $this->db->select('id, password');
        $this->db->where('id', $userId);        
        $this->db->where('isDeleted', 0);
        $query = $this->db->get('users');
        
        $user = $query->result();

        if(!empty($user)){
            if(verifyHashedPassword($oldPassword, $user[0]->password)){
                return $user;
            } else {
                return array();
            }
        } else {
            return array();
        }
    }
    
    /**
     * This function is used to change users password
     * @param number $userId : This is user id
     * @param array $userInfo : This is user updation info
     */
    function changePassword($userId, $userInfo)
    {
        $this->db->where('id', $userId);
        $this->db->where('isDeleted', 0);
        $this->db->update('users', $userInfo);
        
        return $this->db->affected_rows();
    }

    

}
