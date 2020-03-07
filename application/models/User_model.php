<?php
class User_model extends CI_Model
{	

	function __construct() {
        parent::__construct();
        $this->load->library('email');
        $this->load->database('default');
      
    }
	function verify_login($where)
	{
		return $this->db->select('user_id,email,name')->from('users')->where($where)->get()->row();
	}
	
	function register($data)
	{
		return $this->db->insert('users',$data);
	}
	function elearning_signup($data)
	{
		$record['name']=$data['name'];
        $data['roll']=$this->input->post('roll');
        $record['phone']= $data['phone'];
		$record['email']=  $data['email'];
		$record['level']=  $data['level']; 
		$record['client_id']=  $data['client_id'];
		$record['password']= $data['password'];
		if($record['email']=="" || $record['email']==null){
			return null;
		}
		 $this->db->insert('users',$record);
		 return $this->db->insert_id();
	}
	function general_signup($data)
	{
		
		$record['name']=$data['name'];
        $record['phone']= $data['phone'];
		$record['email']=  $data['email'];
		$record['level']=  $data['level']; 
		$record['client_id']=  $data['client_id'];
		$record['referal_code']=  $data['referal_code'];
		$record['password']= $data['password'];
		if($record['email']=="" || $record['email']==null){
			return null;
		}
		 $this->db->insert('users',$record);
		 return $this->db->insert_id();
	}
	
	/**
	 * @author Gaudencio Solivatore
	 */
	function get_users($email=null){
		$data['email']=$email;
        $query=$this->db->get_where("users", $data);
		return $query->row();
	}
	function check_email($email)
	{
		return $this->db->from('users')->where('email',$email)->get()->num_rows();
	}
}
?>