<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Email_model extends CI_Model {
	private $table_contact="contact_us";
	function __construct()
    {
        parent::__construct();
    }


	function device_register_email($username='' ,$image='', $email=''){
		$email_sub='Account Registration';
		$image="<img src=".$image.">";
		$app_link=base_url()."assets/app/pttblue.apk";
		$email_msg=' <div style="padding:10px; display:block; background:#2a9fff; width:60%; color:white;">'.$username.' your device settings has been registered and scan qrcode below to get activated</div> <br>'.$image.'<br>To download the android app follow this <a href='.$app_link.' >link</a>';
		$this->load->library('email');
        $this->email->initialize($config);
        $this->email->from(ADMIN_EMAIL, 'Gaudencio Solivatore');
        $this->email->to($email);
        $this->email->cc(ADMIN_EMAIL);
        $this->email->bcc(ADMIN_EMAIL);   
		$this->email->subject($email_sub);
		$this->email->message($email_msg);
    //$this->email->attach($myqrimage.$myfile);

		$page['from']   = ADMIN_EMAIL;
		$page['to']=$email;
		$page['body']=$email_msg;
		$page['title']=$email_sub;
		$this->db->insert('email_sent', $page);

      $this->email->send();
        
       
      
        //echo $this->email->print_debugger();
       
	   //changed few files
	}


	/**
	 * @method contact_us
	 * @return true or false
	 * @param name
	 * @param email
	 * @param cell_number
	 * @param message
	 * @param attachment_upload
	 */
	function contact_us($name=null, $email=null, $cell_number=null, $message=null, $attachment_upload=null){

		$data_1['name']=$name;
		$data_1['email']=$email;
		$data_1['cell_number']=$cell_number;
		$data_1['message']=$message;
		$data_1['attachment']=$attachment_upload;
		$data_1['created']=time();

		$this->db->insert($this->table_contact, $data_1);
			$email_msg		= $message;
			$email_sub	=	"Contact us";
			$email_to	=  ADMIN_EMAIL;
			$data['from'] =$from= $email;
			$data['to']=ADMIN_EMAIL;
			$data['body']=$email_msg;
			$data['title']=$email_sub;
	
			$this->do_email($email_msg , $email_sub , $email_to, $from);
		return $this->db->insert_id();

	}

	function account_opening_email($account_type = '' , $email = '', $password_set='')
	{
		$system_name	=	$this->db->get_where('settings' , array('type' => 'system_name'))->row()->description;
		
		$email_msg		=	"Welcome to ".$system_name."<br />";
		$email_msg		.=	"Your account type : ".$account_type."<br />";
		$email_msg		.=	"Account activate here : <a href='".base_url()."index.php?login/account_activate/".$password_set."'>click here</a><br />";
		
		$email_sub		=	"Account opening email";
		$email_to		=	$email;
        $data['from'] =$from  = "gautest@magtouch.co.za";
		$data['to']=$email_to;
		$data['body']=$email_msg;
		$data['title']=$email_sub;
		$this->db->insert('email_sent', $data);
		
		$this->do_email($email_msg , $email_sub , $email_to, $from);

		
	}
	
	function password_reset_email($email = '',$password_set='')
	{
		$query=	$this->db->get_where('users' , array('email' => $email));
		if($query->num_rows() > 0)
		{
			
			$email_msg	.=	"Setup password : <a href='".base_url()."page/reset_password/".$password_set."'>click here</a><br />";
		
			
			$email_sub	=	"Password setup request";
			$email_to	=	$email;
			$data['from']=$from  = "test01@mzansiserve.com";
			$data['to']=$email;
			$data['body']=$email_msg;
			$data['title']=$email_sub;
			$page['password_set']=$password_set;
			$this->db->insert('email_sent', $data);
			$this->db->where('email',$email);
			$this->db->update('users', $page);
		
			$this->do_email($email_msg , $email_sub , $email_to, $from);
			
			return true;
		}
		
	}
	

	function account_activate($password='', $password_set='')
	{
		$query=	$this->db->get_where('users' , array('password_set' => $password_set));
		if($query->num_rows() > 0)
		{
			
			$email_msg		.=	"password has been reset successfully";
		
			
			$email_sub	=	"Password reset success";
			$email_to	=	$email;
			$data['from'] =$from= "gautest@magtouch.co.za";
			$data['to']=$email;
			$data['body']=$email_msg;
			$data['title']=$email_sub;
			$page['password']= getHashedPassword(trim($password));
			$this->db->where('password_set',$password_set);
			$this->db->update('users', $page);
			$email_to="gautest@magtouch.co.za";
			$this->do_email($email_msg , $email_sub , $email_to, $from);
			$this->session->set_flashdata('password_set', 'success');
				header("Location:".base_url()."page/login");
			return true;
		}
		else
		{	
			$this->session->set_flashdata('password_set', 'failed');	
			header("Location:".base_url()."page/login");
			return false;
		}
	}
	

	/***custom email sender****/
	function do_email($msg=NULL, $sub=NULL, $to=NULL, $from=NULL)
	{
		if($from=NULL){
			$from="gautest@magtouch.co.za";
		}
		$msg	=	$msg."<br /><br /><br /><br /><br /><br /><br /><hr /><center><a href=\"http://liveguarding.co.za/fav2/\">&copy; 2018 Android Device Management Prp</a></center>";
		
		$this->load->library('email');
        $this->email->initialize($config);
        $this->email->from(ADMIN_EMAIL, 'Gaudencio Solivatore');
        $this->email->to($to);
        $this->email->cc(ADMIN_EMAIL);
        $this->email->bcc(ADMIN_EMAIL);   
		$this->email->subject($sub);
		$this->email->message($msg);
    //$this->email->attach($myqrimage.$myfile);

		
		//$msg	=	$msg."<br /><br /><br /><br /><br /><br /><br /><hr /><center><a href=\"http://liveguarding.co.za/fav2/\">&copy; 2018 Android Device Management Prp</a></center>";
		//$this->email->message($msg);
		
		$this->email->send();
		
		//echo $this->email->print_debugger();
	}
}

