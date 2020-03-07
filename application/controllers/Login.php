<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* 	
 * 	@author : Gaudencio Solivatore
 * 	30th July, 2018
 * 	Creative Item
 * 	www.magtouch.co.za
 * 	
 */

class Login extends CI_Controller {
var $password="";
    function __construct() {
        parent::__construct();
        $this->load->model('crud_model');
        $this->load->model('email_model');
        $this->load->model('m_users');
        $this->load->database();
        $this->load->library('session');
        /* cache control */
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 2010 05:00:00 GMT");

    }

    //Default function, redirects to logged in user area
    public function index() {

        if ($this->session->userdata('admin_login') == 1)
            redirect(base_url() . 'page/dashboard', 'refresh');

        $this->load->view('backend/login');
    }

    //Ajax login function 
    function ajax_login() {
        $response = array();

        //Recieving post input of email, password from ajax request
        $email = $this->input->post('email');
        $checkbox=$this->input->post('radio');
            if($checkbox=="on"){
                if(isset($email) && $email!="Your Email"){
                   $deb['email']= $email;
                   $this->forgot_my_password($deb);
                    redirect(base_url('page/login/forgot_password'), 'refresh');
                }else{
                    redirect(base_url('page/login'), 'refresh'); 
                }
                
            }
      
        $password =$this->password= trim($this->input->post('password'));
        $response['submitted_data'] = $_POST;
        
        //Validating login
        $login_status = $this->validate_login($email, $this->password);
        $response['login_status'] = $login_status;
        if ($login_status == 'success') {
            $response['redirect_url'] = 'page/dashboard';
            redirect($response['redirect_url']);
        }
        if ($login_status == 'not_set') {
            redirect(base_url('page/login/not_set'), 'refresh'); 
        }
        else{
            redirect(base_url('page/login'), 'refresh'); 
        }

        //Replying ajax request with validation response
        //echo json_encode($response);
    }

    //Validating login from ajax request
    function validate_login($email = '', $password = '') {
        $credential = array('email' => $email);

        // Checking login credential for admin
        $query = $this->db->get_where('users', $credential);
       
        if ($query->num_rows() > 0) {
            $row = $query->row();
           
            if(verifyHashedPassword($password, $row->password)){
               
                $this->session->set_userdata('admin_login', '1');
                $this->session->set_userdata('admin_id', $row->user_id);
                $this->session->set_userdata('login_user_id', $row->user_id);
                $this->session->set_userdata('name', $row->fullname);
                $this->session->set_userdata('login_email', $email);
                $this->session->set_userdata('password', $row->password);
                $this->session->set_userdata('mypassword', $password);
                $this->session->set_userdata('role_id',  $row->level);
                $this->session->set_userdata('login_type', 'admin');
                $data['online_status']=1;
                $this->db->where('email', $email);
                $this->db->where('user_id', $row->user_id);
                $this->db->update('users', $data);
               if($row->activated!=1){
                $key=md5($row->user_id);
                $this->activation_key($key, $row->email);
                $this->send_email($row->email , $key);
                return "not_set";
               }
                return 'success';  
            }
            return 'invalid';
        }

        return 'invalid';
    }


    function send_email($to_email=null, $key=null){
       
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
        $this->email->from('test01@mzansiserve.com', 'Mzansiserve HelpDesk');
        $this->email->to($to_email);
        $this->email->cc('test01@mzansiserve.com');
        //$this->email->bcc('gaulomail@gmail.com');
        $this->email->subject('Account Setup');
        $link="<a href='".base_url('page/login/activate/'.$key)."'>Activate Login</a>";
        $this->email->message('Your account has been setup, follow the link to activate your account '.$link);
        
        //send message
        if($this->email->send()){
           $this->session->set_flashdata('flash_message','email sent');
            
        }
        else 
        
        $this->session->set_flashdata('flash_message','email not sent');
       
    }
    

    /*     * *DEFAULT NOR FOUND PAGE**** */

    function four_zero_four() {
        $this->load->view('four_zero_four');
    }
   
    /**
     * @author Gaudencio Solivatore
     */
    function register($param1=null) {
        if($param1=="create"){
            $data['terms']=$this->input->post('terms');
            $data['fullname']=$this->input->post('fullname');
            $data['level']=$this->input->post('level');
            $data['surname']=$this->input->post('surname');
            $data['country']=$this->input->post('country');
            $data['province']=$this->input->post('province');
            $data['password']=getHashedPassword($this->input->post('password'));
            $data['email']=$this->input->post('email');
            $data['cellphone']=$this->input->post('cellphone');
          
          
            if($data['terms']!="on"){
                $this->session->set_userdata('userdata',$data);
                $this->session->set_flashdata('accept_terms', 'Please read and accepts terms to be registered');
                redirect(base_url() . 'page/register', 'refresh'); 
            }
            if ($data['terms']=="on") {
                if ($id=$this->m_users->addNew($data)>0) {
                    $key=md5($id);
                    $this->activation_key($key, $data['email']);
                    $this->send_email($data['email'] , $key);
                    $this->session->set_flashdata('email_verify', 'Successfully registered visit your email to activate login');
                    redirect(base_url('page/login'), 'refresh');
                }
            }
        }

        $this->load->view('backend/register');
    }

    /**
     * @method activation_key
     */
    function activation_key($key=null, $email=null){
    $data['authentication_key']=$key;
    $this->db->where('email', $email);
    $this->db->update('users',$data);
    return $this->db->affected_rows();
    }


    /**
     * @method lockscreen
     */
    function lockscreen($userid=null){
       
        $this->session->set_userdata('admin_login', '1');
                $items['admin_id']=null;
                $items['login_user_id']=null;
                $items['login_email']=null;
                $items['password']=null;
                $items['mypassword']=null;
                $items['role_id']=null;
                $items['client_id']=null;
                $items['login_type']=null;
        $this->session->unset_userdata($items);
        $this->session->sess_destroy();
        if(isset($userid)){
            $data['fullname']=$this->m_users->get_name_by_id($userid)->fullname;
            $data['email']=$this->m_users->get_name_by_id($userid)->email;
        }
        else{
            $this->session->sess_destroy();
            redirect(base_url() . 'index.php?login', 'refresh'); 
        }
        $this->load->view('backend/lockscreen', $data);
    }
    /**
     * Checks if the registation code entered exists
     * @method regCode_exists
     */
    function regCode_exists($registration_code=null){
        if(isset($registration_code)){
         if($registration_code=="123456"){
             $data['result']=1;
           echo json_encode($data['result']);
         }
         else{
            $data['result']=0;
           echo json_encode($data['result']);
         }
        }
       
    }
     /**
     * Checks if the registation code entered exists
     * @method regCode_exists
     */
    function Email_exists($email=null){
        if(isset($email)){
         if($email=="gaulomail@gmail.com"){
             $data['result']=1;
           echo json_encode($data['result']);
         }
         else{
            $data['result']=0;
           echo json_encode($data['result']);
         }
        }
       
    }
    /**
     * Checks if the registation code entered exists
     * @method regCode_exists
     */
    function unitCode_exists($unitCode=null){
        if(isset($unitCode)){
         if($unitCode=="gaulomail@gmail.com"){
            
           $data['result']=0;
           echo json_encode($data['result']);
         }
         else{
            $data['result']=1;
            echo json_encode($data['result']);
         }
        }
       
    }
    function forgot_my_password($data=null){
        $email=$data['email'];
        $password_set=$this->password_setup();
        $this->email_model->password_reset_email($email, $password_set); 
       
        
    }
    //function to encrypt passwords
    function password_setup(){
        $password= md5(rand(10,200000));
        return $password;
    }

    // PASSWORD RESET BY EMAIL
    function forgot_password($message='')
    {
        $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
        $this->load->view('backend/forgot_password',$data);
    }
// ACCOUNT ACTIVATION
function account_activate($message='')
{
    global $themessage;
    $data['themessage']=$message;
    $this->load->view('backend/account_activate',$data);
}

    function ajax_forgot_password()
    {
        $resp                   = array();
        $resp['status']         = 'false';
        $email                  = $_POST["email"];
        $reset_account_type     = '';
        //resetting user password here
        $new_password           =   getHashedPassword("admin");

        // Checking credential for admin
        $query = $this->db->get_where('users' , array('email' => $email));
        if ($query->num_rows() > 0) 
        {
            $reset_account_type     =   'admin';
            $this->db->where('email' , $email);
            $this->db->update('users' , array('password' => $new_password));
            $resp['status']         = 'true';
        }
        
       // send new password to user email  
        $this->email_model->password_reset_email($new_password , $reset_account_type , $email);

        $resp['submitted_data'] = $_POST;

        echo json_encode($resp);
    }

    function ajax_account_activate()
    { 
        header("Location:gaulo.com");
        $resp                   = array();
        $resp['status']         = 'false';
        $email                  = $_POST["password"];
        $reset_account_type     = '';
        //resetting user password here
        $new_password           =   getHashedPassword("admin");

        // Checking credential for admin
        $query = $this->db->get_where('users' , array('email' => $email));
        if ($query->num_rows() > 0) 
        {
            $reset_account_type     =   'admin';
            $this->db->where('email' , $email);
            $this->db->update('users' , array('password' => $new_password));
            $resp['status']         = 'true';
        }
        
       // send new password to user email  
        $this->email_model->password_reset_email($new_password , $reset_account_type , $email);

        $resp['submitted_data'] = $_POST;

        echo json_encode($resp);
    }


    /*     * *****LOGOUT FUNCTION ****** */

    function logout() {
        $data['online_status']=0;
        $user_id=$this->session->userdata('admin_id');
        $this->db->where('user_id', $user_id);
        $this->db->update('users', $data);
        $this->session->sess_destroy();
        $this->session->set_flashdata('logout_notification', 'logged_out');
        redirect(base_url('page/homepage'), 'refresh');
    }

}
