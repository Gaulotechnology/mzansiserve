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
class m_services extends CI_Model {
    private $table_name = 'service_provider';
    private $table_descriptions = 'service_descriptions';
    private $table_images = 'service_images';
    private $table_users = 'users';
   

   

    function __construct() {
        parent::__construct();
        $this->load->library('email');
        $this->load->database('default');
    }


    public function addNew($data=null){
       
        $data['created']=time();
        $this->db->insert($this->table_name, $data);
        return $this->db->insert_id();
       
    }
    /**
     * @method addDescription
     */
    public function addDescription($data=null){
       if($this->check_description_exists($data['user_id'])){
      
        $this->db->update($this->table_descriptions, $data);
        return $this->db->affected_rows();
       }
       else{
        $data['created']=time();
        $this->db->insert($this->table_descriptions, $data);
        return $this->db->insert_id();
       
       }
        
    }
    function check_description_exists($user_id=null){
        $this->db->where('user_id', $user_id);
        $query=$this->db->get($this->table_descriptions);
        return $query->num_rows()>0;
    }
    /**
     * @method addImages
     */
    public function addImages($data=null){
       
        $data['created']=time();
        $this->db->insert($this->table_images, $data);
        return $this->db->insert_id();
       
    }
    function count_all(){
        $this->db->from($this->table_name);
        return $this->db->count_all_results();
      }
    function get_name_by_id($id=null){
       $this->db->where('id', $id);

        $query=$this->db->get($this->table_name);
        if($query->num_rows()>0){
            return $query->row();
        }
    }
    function account_approve($user_id=null){
        $this->db->where('user_id', $user_id);
        $data['approved']=1;
        $this->db->update($this->table_users, $data);
        $info['message']="Your user account has been reactivated, your can now login follow the link ".base_url();
        $info['subject']="Service Account Approval";
        $info['to']=$this->get_user_email($user_id);
        $this->send_email($info);
        return $this->db->affected_rows();

    }
    /**
     * @method account_ban
     */
    function account_ban($user_id=null){
        $this->db->where('user_id', $user_id);
        $data['approved']=2;
        $this->db->update($this->table_users, $data);
        $info['message']="Your user account has been Blocked, Please contact the administrators to get your issues resolved";
        $info['subject']="Service Account Blocked";
        $info['to']=$this->get_user_email($user_id);
        $this->send_email($info);
        return $this->db->affected_rows();

    }
    /**
     * @method account_unban
     */
    function account_unban($user_id=null){
        $this->db->where('user_id', $user_id);
        $data['approved']=1;
        $this->db->update($this->table_users, $data);
        $info['message']="Your user account has been reactivated, your can now login follow the link ".base_url();
        $info['subject']="Service Account Reactivated";
        $info['to']=$this->get_user_email($user_id);
        $this->send_email($info);
        return $this->db->affected_rows();

    }
     /**
     * @method get_user_email
     */
    function get_user_email($user_id=null){
        $this->db->select('email');
        $this->db->where('user_id', $user_id);
        $query=$this->db->get($this->table_users);
        return $query->row()->email;
    }
    /**
     * @method send_email
     */
    function send_email($data){
    $this->load->library('email');
   
    $config['mailtype']     = 'html';
    $config['useragent']    = 'Post Title';
    $config['protocol']     = 'smtp';
    $config['smtp_host']    = 'mail.mzansiserve.com';
    $config['smtp_user']    = 'test01@mzansiserve.com';
    $config['smtp_pass']    = 'Password@2019';
    $config['smtp_port']    = '587';
    $config['charset']      = 'UTF-8';
    $config['smtp_timeout'] = '300';
    $config['wordwrap']     = TRUE;
    $config['validation'] = FALSE;
    $config['newline']      = "\r\n"; 
    //send mail
    $this->email->initialize($config);
    $this->email->from('test01@mzansiserve.com', 'Mzansiserve Help Desk');
    $this->email->to($data['to']);
    $this->email->cc('test01@mzansiserve.com');
    //$this->email->bcc('gaulomail@gmail.com');
    $this->email->subject($data['subject']);
    $this->email->message($data['message']);
    
    //send message
    if($this->email->send()){
        $this->session->set_flashdata('flash_message' , 'Email Sent Success');
        
    }
    else 
    
    $this->session->set_flashdata('flash_message' , 'Email sending failed');
    }
    /**
     * @method get_all
     */
    function get_all($id=null, $approved=null){
        if(isset($id)){
            $this->db->where('C.id', $id);
        }
        if(isset($approved)){
            $this->db->where('A.approved', $approved);
        }
        $this->db->select('A.*, A.user_id userID, B.*, C.*, D.*, E.*');
         $this->db->join('service_descriptions B', 'B.user_id=A.user_id','LEFT');
         $this->db->join('service_images C', 'C.user_id=A.user_id','LEFT');
         $this->db->join('service_provider D', 'D.user_id=A.user_id','LEFT');
         $this->db->join('identity_docs E', 'E.user_id=A.user_id','LEFT');
         $this->db->where('A.level <>', '1');
         $query=$this->db->get($this->table_users." A");
        
         if($query->num_rows()>0){
             return $query->result();
         }
     }
    /**
     * @method get_all
     */
    function get_by_id($user_id=null){
        $this->db->where('user_id', $user_id);
        $query=$this->db->get($this->table_name);
        if($query->num_rows()>0){
            return $query->row();
        }
    }
     /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function serviceListingCount()
    {
        $this->db->select('A.*, B.*');
        $this->db->join('users B','B.user_id=A.user_id','LEFT');
        $query = $this->db->get($this->table_name." A");
        return count($query->result());
    }
     /**
     * @author Gaudencio Solivatore
     * @method add_card()
     */
    function add_service($posts=null){
		$this->db->insert($this->table_name, $posts);
		return $this->db->affected_rows();
	  }
    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function searchListingCount($card_type=null, $user_id=null)
    {
        $this->db->select('A.*, B.*');
            $this->db->join('users B','B.user_id=A.user_id','LEFT');
        if(isset($card_type)){
            $this->db->where('A.card_type', $card_type);
        }
        if(isset($product_category)){
            $this->db->where('A.user_id', $user_id);
        }
        $query = $this->db->get($this->table_name." A");
        return count($query->result());
    }
    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function serviceListing($page=null, $segment=null)
    {
        $this->db->select('A.*, B.*');
        $this->db->join('users B','B.user_id=A.user_id','LEFT');
            $this->db->limit($page, $segment);
            $query=$this->db->get($this->table_name." A");
            if($query && $query->num_rows()>0){
                return $query->result();
            }
    }
    

    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function delete_service($data){
        foreach ($data as $deb) {
            $this->db->where('id', $deb);
            $this->db->delete($this->table_name);
            return $this->db->affected_rows();
        }
    }
    
    
}
