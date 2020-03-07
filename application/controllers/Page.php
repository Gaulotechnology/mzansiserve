<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    require APPPATH . '/libraries/BaseController.php';
/*  
 *  @author     : Gaudencio Solivatore
 *  date        : 27 september, 2014
 *  Android Device Management Prp
 *  
 *  gaulomail@gmail.com
 */

class Page extends BaseController
{
    
    var $array_data;
    var $header;

    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->library('Excel');
        $this->load->library('ciqrcode');
        $this->load->model('user_model');
        $this->load->model('email_model');
        $this->load->model('m_users');
        $this->load->model('m_sites');
        $this->load->model('m_categories');
        $this->load->model('m_products');
        $this->load->model('m_data_captured');
        $this->load->model('m_country');
        $this->load->model('m_card_type');
        $this->load->model('m_car_type');
        $this->load->model('m_documents');
        $this->load->model('m_vehicles');
        $this->load->model('m_service_provider');
        $this->load->model('m_services');
        $this->load->model('m_professional_services');
        $this->load->model('m_company_directors');
        $this->load->model('m_payment_details');
        $this->load->model('m_emergency_contact');
        $this->load->model('m_reference_details');
        $this->load->library('pagination');
        $this->load->model('upload_diamond_model');
        $this->load->helper('gaulo');
    
    
       /*cache control*/
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
     
        
    }
    
    /***default functin, redirects to login page if no admin logged in yet***/
    public function index()
    {
     
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url('page/homepage')  , 'refresh');
        if ($this->session->userdata('admin_login') == 1)
            redirect(base_url() . 'page/dashboard', 'refresh');
    }
    
    /***ADMIN DASHBOARD***/
    function dashboard()
    {
       
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['page_name']  = 'dashboard';
        $page_data['users_online']  =$this->m_data_captured->get_online_users();
        $page_data['page_title'] = get_phrase('admin_dashboard');
        $page_data['role']=$this->session->userdata('role_id');

       
        $this->load->view('backend/index', $page_data);
    }
    
   
    
    
/****MANAGE clients*****/
function clients($param1 = '', $param2 = '', $param3 = '')
{
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
    if ($param1 == 'create') {
        $data['clients_name']        = $this->input->post('clients_name');
        $data['clients_web']    = $this->input->post('clients_web');
        $data['clients_address']     = $this->input->post('clients_address');
        $data['clients_phone']       = $this->input->post('clients_phone');
        $data['email']       = $this->input->post('email');
        $this->db->insert('clients', $data);

        $client_id = $this->db->insert_id();
        $dater['server_ip']=$this->input->post('server_ip');
        $dater['server_port']=$this->input->post('server_port');
        $dater['server_name']=$this->input->post('clients_name');
        $dater['client_id']=$this->server_id();
        $this->db->insert('server_settings', $dater);
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/clients_image/' . $client_id . '.jpg');
        $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
        //$this->email_model->account_opening_email('clients', $data['clients_email']); //SEND EMAIL ACCOUNT OPENING EMAIL
        redirect(base_url() . 'clients', 'refresh');
    }
    if ($param1 == 'do_update') {
        $data['clients_name']        = $this->input->post('clients_name');
        $data['clients_web']    = $this->input->post('clients_web');
        $data['clients_address']     = $this->input->post('clients_address');
        $data['clients_phone']       = $this->input->post('clients_phone');
        $data['email']       = $this->input->post('email');
        
        $this->db->where('client_id', $param2);
        $this->db->update('clients', $data);
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/clients_image/' . $param2 . '.jpg');
        $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
        redirect(base_url() . 'clients', 'refresh');
    } else if ($param1 == 'personal_profile') {
        $page_data['personal_profile']   = true;
        $page_data['current_client_id'] = $param2;
    } else if ($param1 == 'edit') {
        $page_data['edit_data'] = $this->db->get_where('clients', array(
            'client_id' => $param2
        ))->result_array();
    }
    if ($param1 == 'delete') {
        $this->db->where('client_id', $param2);
        $data['isDeleted'] = '1';
        $this->db->update('clients', $data);
        $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
        redirect(base_url() . 'clients', 'refresh');
    }
    $page_data['clients']   = $this->db->get('clients')->result_array();
    $page_data['role']=$this->session->userdata('role_id');
    $page_data['page_name']  = 'clients';
    $page_data['page_title'] = "Manage clients";//get_phrase('manage_teacher');
    $this->load->view('backend/index', $page_data);
}

/****MANAGE CITIES LIST*****/
function manage_cities($param1 = '', $param2 = '', $param3 = '')
{
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
    if ($param1 == 'create') {
        $data['country']        = $this->input->post('country');
        $data['region']    = $this->input->post('region');
        $data['city']     = $this->input->post('city');
        $data['created']       = time();
        $this->db->insert('cities', $data);
        $familylist_id = $this->db->insert_id();

      
        $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
        //$this->email_model->account_opening_email('clients', $data['clients_email']); //SEND EMAIL ACCOUNT OPENING EMAIL
        redirect(base_url() . 'page/manage_cities', 'refresh');
    }
    if ($param1 == 'do_update') {
        $data['country']        = $this->input->post('country');
        $data['region']    = $this->input->post('region');
        $data['city']     = $this->input->post('city');
        $this->db->where('id', $param2);
        $this->db->update('cities', $data);
       
        $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
        redirect(base_url() . 'page/manage_cities', 'refresh');
    } else if ($param1 == 'edit') {
        $page_data['edit_data'] = $this->db->get_where('cities', array(
            'id' => $param2
        ))->result_array();
    }
    if ($param1 == 'delete') {
        $this->db->where('id', $param2);
        $this->db->delete('cities');
        $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
        redirect(base_url() . 'page/manage_cities', 'refresh');
    }
    $page_data['cities']   = $this->db->get('cities')->result_array();
    $page_data['role']=$this->session->userdata('role_id');
    $page_data['page_name']  = 'manage_cities';
    $page_data['page_title'] = "Manage Cities";//get_phrase('manage_teacher');
    $this->load->view('backend/index', $page_data);
}
/****MANAGE REGIONS LIST*****/
function manage_regions($param1 = '', $param2 = '', $param3 = '')
{
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
    if ($param1 == 'create') {
        $data['country']        = $this->input->post('country');
        $data['region']    = $this->input->post('region');
        $data['created']       = time();
        $this->db->insert('regions', $data);
        $familylist_id = $this->db->insert_id();

      
        $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
        //$this->email_model->account_opening_email('clients', $data['clients_email']); //SEND EMAIL ACCOUNT OPENING EMAIL
        redirect(base_url() . 'page/manage_regions', 'refresh');
    }
    if ($param1 == 'do_update') {
        $data['country']        = $this->input->post('country');
        $data['region']    = $this->input->post('region');
        $this->db->where('id', $param2);
        $this->db->update('regions', $data);
       
        $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
        redirect(base_url() . 'page/manage_regions', 'refresh');
    } else if ($param1 == 'edit') {
        $page_data['edit_data'] = $this->db->get_where('regions', array(
            'id' => $param2
        ))->result_array();
    }
    if ($param1 == 'delete') {
        $this->db->where('id', $param2);
        $this->db->delete('regions');
        $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
        redirect(base_url() . 'page/manage_regions', 'refresh');
    }
    $page_data['cities']   = $this->db->get('regions')->result_array();
    $page_data['role']=$this->session->userdata('role_id');
    $page_data['page_name']  = 'manage_regions';
    $page_data['page_title'] = "Manage Regions";//get_phrase('manage_teacher');
    $this->load->view('backend/index', $page_data);
}

/**
 * @method test_curl
 */
function address_curl($address=null){
  
   $url='https://maps.googleapis.com/maps/api/geocode/json?address='.$address.'&key=AIzaSyA2fZA6EQJe-qaGwnWFmEfI9ytECYC-BNY';

    //  Calling cURL Library
    $this->load->library('curl');

    //  Setting URL To Fetch Data From
    $this->curl->create($url);

    //  To Temporarily Store Data Received From Server
    $this->curl->option('buffersize', 10);

    //  To support Different Browsers
    $this->curl->option('useragent', 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.8) Gecko/20100722 Firefox/3.6.8 (.NET CLR 3.5.30729)');

    //  To Receive Data Returned From Server
    $this->curl->option('returntransfer', 1);

    //  To follow The URL Provided For Website
    $this->curl->option('followlocation', 1);

    //  To Retrieve Server Related Data
    $this->curl->option('HEADER', false);

    //  To Set Time For Process Timeout
    $this->curl->option('connecttimeout', 600);

    //  To Execute 'option' Array Into cURL Library & Store Returned Data Into $data
    $data = json_decode($this->curl->execute());

    $res['lat']=$data->results[0]->geometry->bounds->northeast->lat ;
    $res['lng']=$data->results[0]->geometry->bounds->northeast->lng ; 
   
    //  To Display Returned Data
    return $res;


   
}

/****MANAGE LEARNER LIST*****/
function learnerlist($param1 = '', $param2 = '', $param3 = '')
{
    if ($param1=='upload') {
        $this->load->library('Excel');
        try {
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/student_bulk_add.xlsx');
            $file_type	= PHPExcel_IOFactory::identify(UPLOAD_PATH."student_bulk_add.xlsx");
            $objReader	= PHPExcel_IOFactory::createReader($file_type);
           
           try{
               $objPHPExcel = $objReader->load(UPLOAD_PATH."student_bulk_add.xlsx");
           }catch(Exception $e){ $e->getMessage();}
            //$objPHPExcel= $objReader->load(base_url()."uploads/student_bulk_add.xlsx");
          
            $sheet_data	= $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
            foreach($sheet_data as $data)
            {
                $result = array(
                        'internal_id' => $data['A'],
                        'learner_name' => $data['B'],
                        'learner_surname' => $data['C'],
                        'admission_number' => $data['D'],
                        'id_number' => $data['E'],
                        'learner_email' => $data['F'],
                        'learner_cellphone' => $data['G'],
                        'learner_grade' => $data['H'],
                        'register_class' => $data['I'],
                        'gender' => $data['J'],
                        'nationality' => $data['K'],
                        'preferred_language' => $data['L'],
                        'tuition_language' => $data['Y'],
                        'learner_status' => $data['M'],
                        'family_code' => $data['N'],
                        'parent_id' => $data['Z'],
                        'parent_title' => $data['AA'],
                        'parent_name' => $data['AB'],
                        'parent_id_number' => $data['AD'],
                        'parent_email' => $data['AG'],
                        'parent_cellphone' => $data['AF'],
                        'parent_relationship' => $data['AG'],
                        'parent_gender' => $data['AH'],
                        'parent_nationality' => $data['AI'],
                        'parent_language' => $data['AJ'],
                        'created' => time()
                     
                );
               //print_r($result);
               // exit()m
                $this->upload_diamond_model->postDiamond($result);
            }
        } catch (Exception $e) {
            print_r($e->getMessage());
        }

       
        
       
      
      /* 
        $file= UPLOAD_PATH."student_bulk_add.xlsx";//base_url()."uploads/student_bulk_add.xlsx";
        $obj=PHPExcel_IOFactory::load($file);
        
        $cell=$obj->getActiveSheet()->getCellCollection();
   
        foreach ($cell as $c1) {
            $column=$obj->getActiveSheet()->getCell($c1)->getColumn();
            $row=$obj->getActiveSheet()->getCell($c1)->getRow();
            $data_value=$obj->getActiveSheet()->getCell($c1)->getValue();
       
            if ($row==1) {
                $header[$row][$column]=$data_value;
            } else {
                $arr_data[$row][$column]=$data_value;
            }
        }
    */
        redirect(base_url() . 'learnerlist');
    }
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
    if ($param1 == 'create') {
        $data['internal_id']        = $this->input->post('internal_id');
        $data['learner_name']        = $this->input->post('learner_name');
        $data['learner_surname']        = $this->input->post('learner_surname');
        $data['parent_cellphone']    = $this->input->post('parent_cellphone');
        $data['learner_email']     = $this->input->post('learner_email');
        $data['parent_email']     = $this->input->post('parent_email');
        $data['family_code']       = $this->input->post('family_code');
        $data['created']       = time();
        $data['modified']       = time();
        $this->db->insert('LearnerList', $data);
        $familylist_id = $this->db->insert_id();

        move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/family_image/'. $familylist_id .'.jpg');
        $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
        //$this->email_model->account_opening_email('clients', $data['clients_email']); //SEND EMAIL ACCOUNT OPENING EMAIL
        redirect(base_url() . 'learnerlist', 'refresh');
    }
    if ($param1 == 'do_update') {
        $data['internal_id']        = $this->input->post('internal_id');
        $data['learner_name']        = $this->input->post('learner_name');
        $data['learner_surname']        = $this->input->post('learner_surname');
        $data['parent_cellphone']    = $this->input->post('parent_cellphone');
        $data['learner_email']     = $this->input->post('learner_email');
        $data['parent_email']     = $this->input->post('parent_email');
        $data['family_code']       = $this->input->post('family_code');
        $data['modified']       = time();
        $this->db->where('learner_id', $param2);
        $this->db->update('LearnerList', $data);
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/family_image/' .$param2 .'.jpg');
        $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
        redirect(base_url() . 'learnerlist', 'refresh');
    } else if ($param1 == 'personal_profile') {
        $page_data['personal_profile']   = true;
        $page_data['current_learnerlist_id'] = $param2;
    } else if ($param1 == 'edit') {
        $page_data['edit_data'] = $this->db->get_where('FamilyList', array(
            'member_id' => $param2
        ))->result_array();
    }
    if ($param1 == 'delete') {
        $this->db->where('learner_id', $param2);
        $data['isDeleted'] = '1';
        $data['modified']       = time();
        $this->db->update('LearnerList', $data);
        $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
        redirect(base_url() . 'learnerlist', 'refresh');
    }
    $page_data['learnerlist']   = $this->db->get('users')->result_array();
    $page_data['role']=$this->session->userdata('role_id');
    $page_data['page_name']  = 'learnerlist';
    $page_data['page_title'] = "Manage Learner List";//get_phrase('manage_teacher');
    $page_data['header']=$header;
    $page_data['values']=$arr_data;
    $this->load->view('backend/index', $page_data);
}
/****MANAGE LEARNER LIST*****/

/****MANAGE PARENT LIST*****/
function parentlist($param1 = '', $param2 = '', $param3 = '')
{
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
    if ($param1 == 'create') {
        $data['internal_id']        = $this->input->post('internal_id');
        $data['learner_name']        = $this->input->post('learner_name');
        $data['learner_surname']        = $this->input->post('learner_surname');
        $data['parent_cellphone']    = $this->input->post('parent_cellphone');
        $data['learner_email']     = $this->input->post('learner_email');
        $data['parent_email']     = $this->input->post('parent_email');
        $data['family_code']       = $this->input->post('family_code');
        $data['created']       = time();
        $data['modified']       = time();
        $this->db->insert('LearnerList', $data);
        $familylist_id = $this->db->insert_id();

        move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/family_image/'. $familylist_id .'.jpg');
        $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
        //$this->email_model->account_opening_email('clients', $data['clients_email']); //SEND EMAIL ACCOUNT OPENING EMAIL
        redirect(base_url() . 'parentlist', 'refresh');
    }
    if ($param1 == 'do_update') {
        $data['internal_id']        = $this->input->post('internal_id');
        $data['learner_name']        = $this->input->post('learner_name');
        $data['learner_surname']        = $this->input->post('learner_surname');
        $data['parent_cellphone']    = $this->input->post('parent_cellphone');
        $data['learner_email']     = $this->input->post('learner_email');
        $data['parent_email']     = $this->input->post('parent_email');
        $data['family_code']       = $this->input->post('family_code');
        $data['modified']       = time();
        $this->db->where('learner_id', $param2);
        $this->db->update('LearnerList', $data);
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/family_image/' .$param2 .'.jpg');
        $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
        redirect(base_url() . 'parentlist', 'refresh');
    } else if ($param1 == 'personal_profile') {
        $page_data['personal_profile']   = true;
        $page_data['current_learnerlist_id'] = $param2;
    } else if ($param1 == 'edit') {
        $page_data['edit_data'] = $this->db->get_where('LearnerList', array(
            'member_id' => $param2
        ))->result_array();
    }
    if ($param1 == 'delete') {
        $this->db->where('learner_id', $param2);
        $data['isDeleted'] = '1';
        $data['modified']       = time();
        $this->db->update('LearnerList', $data);
        $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
        redirect(base_url() . 'parentlist', 'refresh');
    }
    $page_data['learnerlist']   = $this->db->get('LearnerList')->result_array();
    $page_data['role']=$this->session->userdata('role_id');
    $page_data['page_name']  = 'parentlist';
    $page_data['page_title'] = "Manage parent List";//get_phrase('manage_teacher');
    $this->load->view('backend/index', $page_data);
}

function email(){
    $fromname="Android Developer";
    $mailfrom=ADMIN_EMAIL;
    $tomail="gaulomail@gmail.com";
    $this->load->library('email');
    $this->email->initialize();
    $this->email->from($mailfrom, $fromname);
    $this->email->to($tomail);
    $this->email->reply_to($mailfrom, $fromname);
    $this->email->subject('Email Test');
    $this->email->message('Testing the email class.');
    $this->email->send();
    echo $this->email->print_debugger();
   }
   
   function contactus($param1="")
   {
       if (isset($_POST['send'])) {
       $contactno=$this->input->post('contactno');
       $message=$this->input->post('message');
       $fromname= $this->input->post('fullname');
       $mailfrom=$this->input->post('email');
       $subject=$this->input->post('subject');
       $tomail=ADMIN_EMAIL;
       $this->load->library('email');
       $this->email->initialize();
       $this->email->from($mailfrom, $fromname);
       $this->email->to($tomail);
       $this->email->reply_to($mailfrom, $fromname);
       $this->email->subject($subject);
       $this->email->message($fromname." with mobile number ".$contactno." is saying ".$message);
       if ($this->email->send()) {
           //echo "sent";
       } else {
          // echo $this->email->print_debugger();
       }
   }
       if($param1=="download"){
       
           $current_timestamp = strtotime("now");
           $data['created']= $current_timestamp;
           $this->db->insert('downloads',$data);
       redirect(base_url() . 'frontend/contactus');

       }
       $this->loadViewss('frontend/contact');
   
   }

/****MANAGE LEARNER LIST*****/

    /****MANAGE USERS*****/
    function users($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {
            $password="admin";
            $data['name']         = $this->input->post('name');
            $data['email'] = $this->input->post('email');
            $data['level']   = $this->input->post('level');
            $data['phone']   = $this->input->post('phone');
            $data['client_id']   = $this->input->post('client_id');
            $data['password']=getHashedPassword($password);
            $data['password_set']=$this->password_setup();
            $this->db->insert('users', $data);
            $user_id = $this->db->insert_id();
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/users_image/' . $user_id . '.jpg');
            $this->email_model->account_opening_email('users', $data['email'], $data['password_set']); //SEND EMAIL ACCOUNT OPENING EMAIL
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
           
            redirect(base_url() . 'users', 'refresh');
           
        }
        if ($param1 == 'do_update') {
            $password="admin";
            $data['name']         = $this->input->post('name');
            $data['email'] = $this->input->post('email');
            $data['level']   = $this->input->post('level');
            $data['phone']   = $this->input->post('phone');
            $data['client_id']   = $this->input->post('client_id');
            $data['password']=getHashedPassword($password);
            $this->db->where('user_id', $param2);
            $this->db->update('users', $data);
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/users_image/' . $param2 . '.jpg');
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'users', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('users', array(
                'user_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
           
            $this->db->where('user_id', $param2);
            $data['isDeleted'] = '1';
            $this->db->update('users', $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'users', 'refresh');
        }
        $page_data['users']    = $this->db->get('users')->result_array();
        $page_data['page_name']  = 'users';
        $page_data['role']=$this->session->userdata('role_id');
        $page_data['page_title'] = "manage users";//get_phrase('manage_class');
        $this->load->view('backend/index', $page_data);
    }
/***UNIQUE CODE GENERATOR */
function device_id(){
    $starter_id=167772161;
    $this->db->select('*');
    $this->db->from('devices');
    $this->db->order_by("id", "desc");
    $this->db->limit(1);
    $query = $this->db->get();
    if($query->num_rows()>0){
        foreach ($query->result() as $row)
        {
           $new_value=$row->id;
           $starter_id=  $starter_id + $new_value;
          
        }
    } 
    $device_id= strtoupper(dechex ($starter_id));
    return $device_id;
}


/***UNIQUE CODE GENERATOR */


/***ADD ALERT MESSAGE*/
function add_alert(){
    $data['device_id']= $this->input->post('device_id');
    $data['message']    = $this->input->post('message');
    $data['date']    = time();
    $this->db->insert('alert_messages', $data);
}
/***ADD ALERT MESSAGE*/

/***IMPORT FUNCTION*/
function import($param=''){
   if($param='save'){
        
    if ($this->input->post('importfile')) {
        //$path = ROOT_UPLOAD_IMPORT_PATH;
        $path = base_url()."uploads/";
        $config['upload_path'] = $path;
        $config['allowed_types'] = 'xlsx|xls|jpg|png';
        $config['remove_spaces'] = TRUE;
        $this->upload->initialize($config);
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('userfile')) {
            $error = array('error' => $this->upload->display_errors());
        } else {
            $data = array('upload_data' => $this->upload->data());
        }
        
        if (!empty($data['upload_data']['file_name'])) {
            $import_xls_file = $data['upload_data']['file_name'];
        } else {
            $import_xls_file = 0;
        }
        $inputFileName = $path . $import_xls_file;
        try {
            $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($inputFileName);
        } catch (Exception $e) {
            die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
                    . '": ' . $e->getMessage());
        }
        $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
        
        $arrayCount = count($allDataInSheet);
        $flag = 0;
        $createArray = array('First_Name', 'Last_Name', 'Email', 'DOB', 'Contact_NO');
        $makeArray = array('First_Name' => 'First_Name', 'Last_Name' => 'Last_Name', 'Email' => 'Email', 'DOB' => 'DOB', 'Contact_NO' => 'Contact_NO');
        $SheetDataKey = array();
        foreach ($allDataInSheet as $dataInSheet) {
            foreach ($dataInSheet as $key => $value) {
                if (in_array(trim($value), $createArray)) {
                    $value = preg_replace('/\s+/', '', $value);
                    $SheetDataKey[trim($value)] = $key;
                } else {
                    
                }
            }
        }
        $data = array_diff_key($makeArray, $SheetDataKey);
       
        if (empty($data)) {
            $flag = 1;
        }
        if ($flag == 1) {
            for ($i = 2; $i <= $arrayCount; $i++) {
                $addresses = array();
                $firstName = $SheetDataKey['First_Name'];
                $lastName = $SheetDataKey['Last_Name'];
                $email = $SheetDataKey['Email'];
                $dob = $SheetDataKey['DOB'];
                $contactNo = $SheetDataKey['Contact_NO'];
                $firstName = filter_var(trim($allDataInSheet[$i][$firstName]), FILTER_SANITIZE_STRING);
                $lastName = filter_var(trim($allDataInSheet[$i][$lastName]), FILTER_SANITIZE_STRING);
                $email = filter_var(trim($allDataInSheet[$i][$email]), FILTER_SANITIZE_EMAIL);
                $dob = filter_var(trim($allDataInSheet[$i][$dob]), FILTER_SANITIZE_STRING);
                $contactNo = filter_var(trim($allDataInSheet[$i][$contactNo]), FILTER_SANITIZE_STRING);
                $fetchData[] = array('first_name' => $firstName, 'last_name' => $lastName, 'email' => $email, 'dob' => $dob, 'contact_no' => $contactNo);
            }              
            $data['employeeInfo'] = $fetchData;
            $this->import->setBatchImport($fetchData);
            $this->import->importData();
        } else {
            echo "Please import correct file";
        }
    }
    $this->load->view('import/display', $data);
   }
}
/***IMPORT FUNCTION*/


/***ADD CURRENT LOCATION*/
function add_gps_location(){
    $data['device_id']  = $this->input->post('device_id');
    $data['long']    = $this->input->post('long');
    $data['lati']    = $this->input->post('lati');
    $data['date']    = time();
    $this->db->insert('gps_location', $data);
}
/***ADD CURRENT LOCATION*/


/***SHOW CURRENT LOCATION*/
function locate($imei=''){
   $this->db->where('device_id', $imei);
   $this->db->limit(1);
   $this->db->order_by("date", "desc");
   $query=$this->db->get("gps_location");
   if($query->num_rows()>0){
      // echo '<iframe style="width:100%; height:100%" frameBorder="0" src="http://maps.google.com/maps?q=-26.0810224,27.9218617&z=15&output=embed"></iframe>
        //';
        foreach ($query->result() as $row)
{
    echo '<iframe style="width:100%; height:100%" frameBorder="0" src="http://maps.google.com/maps?q='.$row->lati.','.$row->long.'&z=15&output=embed"></iframe>
        '; 
}
       
   }
    else{
        echo "<h1 align=center>Last location not known</h1>";
    }

  
}
/***SHOW CURRENT LOCATION*/


function email_sent($param=''){
    echo $param;
    echo "gaulo";
}

/***LAST SERVER SETTING GENERATOR */
function server_id(){
    $starter_id=0;
    $this->db->select('*');
    $this->db->from('clients');
    $this->db->order_by("client_id", "desc");
    $this->db->limit(1);
    $query = $this->db->get();
    if($query->num_rows()>0){
        foreach ($query->result() as $row)
        {
           $new_value=$row->client_id;
           $starter_id=  $new_value ;
          
        }
    } 
  
    return $starter_id;
}
/***LAST SERVER SETTING GENERATOR */

/****MANAGE DEVICES*****/
function devices($param1 = '', $param2 = '')
{
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
        if($param1=='bulk_add'){
            $file_info = pathinfo($_FILES["result_file"]["name"]);
            $file_directory = "uploads/";
            $new_file_name = date("d-m-Y ") . rand(000000, 999999) .".". $file_info["extension"];
            
            if(move_uploaded_file($_FILES["result_file"]["tmp_name"], $file_directory . $new_file_name))
            {   
                $file_type	= PHPExcel_IOFactory::identify($file_directory . $new_file_name);
                $objReader	= PHPExcel_IOFactory::createReader($file_type);
               
               $objPHPExcel = $objReader->load(UPLOAD_PATH. $new_file_name);
                //$objPHPExcel= $objReader->load(base_url()."uploads/student_import.xlsx");
                $sheet_data	= $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
               
                foreach($sheet_data as $data)
                {
                    $result = array(
                            'name' => $data['A'],
                            
                    );
                    $this->Uploaddiamond_Model->postDiamond($result);
                }
            }
        }
    if ($param1 == 'create') {
        $image=$this->input->post('qrcode');;
        $data['ptt']         = $this->input->post('ptt');
        $data['sms']         = $this->input->post('sms');
        $data['armed']         = $this->input->post('armed');
        $data['advanced_alert']         = $this->input->post('advanced');
        $data['control_room']         = $this->input->post('control');
        $username=$data['username']         = $this->input->post('username');
        $data['phone'] = $this->input->post('phone');
        $email= $data['email']   = $this->input->post('email');
        $data['device_id'] =  $device_id  = $this->input->post('device_id');
        $data['encrypt']=md5($device_id);
        $data['client_id']   = $this->input->post('client_id');
        $this->db->insert('devices', $data);
        $this->email_model->device_register_email($username,$image, $email); 
        $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
        redirect(base_url() . 'devices', 'refresh');
    }
    if ($param1 == 'do_update') {
        $data['ptt']         = $this->input->post('ptt');
        $data['sms']         = $this->input->post('sms');
        $data['armed']         = $this->input->post('armed');
        $data['advanced_alert']         = $this->input->post('advanced');
        $data['control_room']         = $this->input->post('control');
        $data['username']         = $this->input->post('username');
        $data['phone'] = $this->input->post('phone');
        $data['email']   = $this->input->post('email');
       
       
        $this->db->where('id', $param2);
        $this->db->update('devices', $data);
        $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
        redirect(base_url() . 'devices', 'refresh');
    } else if ($param1 == 'edit') {
        $page_data['edit_data'] = $this->db->get_where('devices', array(
            'id' => $param2
        ))->result_array();
    }
    if ($param1 == 'delete') {
        $this->db->where('id', $param2);
        $data['isDeleted'] = '1';
        $this->db->update('devices', $data);;
        $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
        redirect(base_url() . 'devices', 'refresh');
    }
   
    $page_data['role']=$this->session->userdata('role_id');
    $page_data['page_name']  = 'devices';
    $page_data['device_id']  = $this->device_id();
    $page_data['page_title'] = "manage devices";//get_phrase('manage_class');
    $params['data'] = md5($this->device_id());
    $params['level'] = 'H';
    $params['size'] = 5;
    $params['savename'] = FCPATH.'uploads/qrcodes_image/'. $this->device_id().'.jpg';
    $this->ciqrcode->generate($params);
    $page_data['qrcode'] ='<img src="'.base_url().'uploads/qrcodes_image/'. $this->device_id().'.jpg" />';
    $this->load->view('backend/index', $page_data);
}
/****MANAGE DEVICES*****/
function all_emails_sent($param1 = '', $param2 = '')
{
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
    if ($param1 == 'create') {
        $image=$this->input->post('qrcode');;
        $data['ptt']         = $this->input->post('ptt');
        $data['sms']         = $this->input->post('sms');
        $data['armed']         = $this->input->post('armed');
        $data['advanced_alert']         = $this->input->post('advanced');
        $data['control_room']         = $this->input->post('control');
        $username=$data['username']         = $this->input->post('username');
        $data['phone'] = $this->input->post('phone');
        $data['email']   = $this->input->post('email');
        $data['device_id'] = $email= $device_id  = $this->input->post('device_id');
        $data['encrypt']=md5($device_id);
        $data['client_id']   = $this->input->post('client_id');
        $this->db->insert('devices', $data);
        $this->email_model->device_register_email($username,$image, $email); 
        $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
        redirect(base_url() . 'devices', 'refresh');
    }
    if ($param1 == 'do_update') {
        $data['ptt']         = $this->input->post('ptt');
        $data['sms']         = $this->input->post('sms');
        $data['armed']         = $this->input->post('armed');
        $data['advanced_alert']         = $this->input->post('advanced');
        $data['control_room']         = $this->input->post('control');
        $data['username']         = $this->input->post('username');
        $data['phone'] = $this->input->post('phone');
        $data['email']   = $this->input->post('email');
       
       
        $this->db->where('id', $param2);
        $this->db->update('devices', $data);
        $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
        redirect(base_url() . 'devices', 'refresh');
    } else if ($param1 == 'edit') {
        $page_data['edit_data'] = $this->db->get_where('devices', array(
            'id' => $param2
        ))->result_array();
    }
    if ($param1 == 'delete') {
        $this->db->where('id', $param2);
        $data['isDeleted'] = '1';
        $this->db->update('devices', $data);;
        $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
        redirect(base_url() . 'devices', 'refresh');
    }
   
    $page_data['role']=$this->session->userdata('role_id');
    $page_data['page_name']  = 'all_emails_sent';
    $page_data['device_id']  = $this->device_id();
    $page_data['page_title'] = "view sent emails";//get_phrase('manage_class');
    $params['data'] = md5($this->device_id());
    $params['level'] = 'H';
    $params['size'] = 5;
    $params['savename'] = FCPATH.'uploads/qrcodes_image/'. $this->device_id().'.jpg';
    $this->ciqrcode->generate($params);
    $page_data['qrcode'] ='<img src="'.base_url().'uploads/qrcodes_image/'. $this->device_id().'.jpg" />';
    $this->load->view('backend/index', $page_data);
}
function account_activate(){
    $password=$this->input->post('password');
    $password_set=$this->input->post('password_set');
    
    $this->email_model->account_activate($password, $password_set); 
   // header("Location:".base_url()."index.php?login/account_activate");
}
function forgot_password(){
    $email=$this->input->post('email');
    $password_set=$this->password_setup();
    $this->email_model->password_reset_email($email, $password_set); 
   
    
}



function send_email(){
       
    //$this->load->library('email');
   
    //Email config test settings tes
    /*$config['mailtype']     = 'html';
    $config['useragent']    = 'Post Title';
    $config['protocol']     = 'smtp';
    $config['smtp_host']    = 'mail.mzansiserve.com';
    $config['smtp_user']    = 'test01@mzansiserve.com';
    $config['smtp_pass']    = 'Password@2019';
    $config['smtp_port']    = '465';
    $config['charset']      = 'UTF-8';
    $config['smtp_timeout'] = '300';
    $config['wordwrap']     = TRUE;
    $config['validation'] = FALSE;
    $config['newline']      = "\r\n";  
    */
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
    $this->email->to('test01@mzansiserve.com');
    $this->email->cc('test01@mzansiserve.com');
    //$this->email->bcc('gaulomail@gmail.com');
    $this->email->subject('Email Test');
    $this->email->message('Testing the email class.');
    
    //send message
    if($this->email->send()){
        echo "email sent";
        
    }
    else 
    
    echo $this->email->print_debugger();
   
}

/****MANAGE server_settings*****/
function server_settings($param1 = '', $param2 = '')
{
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
    if ($param1 == 'create') {
        $dist_id=$data['client_id']   = $this->input->post('client_id');
        $data['server_ip']         = $this->input->post('server_ip');
        $data['server_port'] = $this->input->post('server_port');
        $data['server_name']   = $this->crud_model->get_clients_name_by_id( $dist_id);
       
        $this->db->insert('server_settings', $data);
        $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
        redirect(base_url() . 'server_settings', 'refresh');
    }
    if ($param1 == 'do_update') {
        $data['server_ip']         = $this->input->post('server_ip');
        $data['server_port'] = $this->input->post('server_port');
        $this->db->where('id', $param2);
        $this->db->update('server_settings', $data);
        $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
        redirect(base_url() . 'server_settings', 'refresh');
    } else if ($param1 == 'edit') {
        $page_data['edit_data'] = $this->db->get_where('server_settings', array(
            'id' => $param2
        ))->result_array();
    }
    if ($param1 == 'delete') {
        $this->db->where('id', $param2);
        $data['isDeleted'] = '1';
        $this->db->update('server_settings', $data);;
        $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
        redirect(base_url() . 'server_settings', 'refresh');
    }
   
    $page_data['role']=$this->session->userdata('role_id');
    $page_data['page_name']  = 'server_settings';
    $page_data['device_id']  = $this->device_id();
    $page_data['page_title'] = get_phrase('manage servers');
    $this->load->view('backend/index', $page_data);
}


    /****MANAGE SECTIONS*****/
    function section($class_id = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        // detect the first class
        if ($class_id == '')
            $class_id           =   $this->db->get('class')->first_row()->class_id;

        $page_data['page_name']  = 'section';
        $page_data['page_title'] = get_phrase('manage_sections');
        $page_data['class_id']   = $class_id;
        $this->load->view('backend/index', $page_data);    
    }

    function sections($param1 = '' , $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {
            $data['name']       =   $this->input->post('name');
            $data['nick_name']  =   $this->input->post('nick_name');
            $data['class_id']   =   $this->input->post('class_id');
            $data['teacher_id'] =   $this->input->post('teacher_id');
            $this->db->insert('section' , $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'section' . $data['class_id'] , 'refresh');
        }

        if ($param1 == 'edit') {
            $data['name']       =   $this->input->post('name');
            $data['nick_name']  =   $this->input->post('nick_name');
            $data['class_id']   =   $this->input->post('class_id');
            $data['teacher_id'] =   $this->input->post('teacher_id');
            $this->db->where('section_id' , $param2);
            $this->db->update('section' , $data);
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'section' . $data['class_id'] , 'refresh');
        }

        if ($param1 == 'delete') {
            $this->db->where('section_id' , $param2);
            $this->db->delete('section');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'section' , 'refresh');
        }
    }

    function get_class_section($class_id)
    {
        $sections = $this->db->get_where('section' , array(
            'class_id' => $class_id
        ))->result_array();
        foreach ($sections as $row) {
            echo '<option value="' . $row['section_id'] . '">' . $row['name'] . '</option>';
        }
    }

    /***MANAGE EVENT / NOTICEBOARD, WILL BE SEEN BY ALL ACCOUNTS DASHBOARD**/
    function noticeboard($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        
        if ($param1 == 'create') {
            $data['notice_title']     = $this->input->post('notice_title');
            $data['notice']           = $this->input->post('notice');
            $data['create_timestamp'] = strtotime($this->input->post('create_timestamp'));
            $this->db->insert('noticeboard', $data);

            $check_sms_send = $this->input->post('check_sms');

            if ($check_sms_send == 1) {
                // sms sending configurations

                $parents  = $this->db->get('parent')->result_array();
                $students = $this->db->get('student')->result_array();
                $teachers = $this->db->get('teacher')->result_array();
                $date     = $this->input->post('create_timestamp');
                $message  = $data['notice_title'] . ' ';
                $message .= get_phrase('on') . ' ' . $date;
                foreach($parents as $row) {
                    $reciever_phone = $row['phone'];
                    $this->sms_model->send_sms($message , $reciever_phone);
                }
                foreach($students as $row) {
                    $reciever_phone = $row['phone'];
                    $this->sms_model->send_sms($message , $reciever_phone);
                }
                foreach($teachers as $row) {
                    $reciever_phone = $row['phone'];
                    $this->sms_model->send_sms($message , $reciever_phone);
                }
            }

            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'noticeboard', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['notice_title']     = $this->input->post('notice_title');
            $data['notice']           = $this->input->post('notice');
            $data['create_timestamp'] = strtotime($this->input->post('create_timestamp'));
            $this->db->where('notice_id', $param2);
            $this->db->update('noticeboard', $data);

            $check_sms_send = $this->input->post('check_sms');

            if ($check_sms_send == 1) {
                // sms sending configurations

                $parents  = $this->db->get('parent')->result_array();
                $students = $this->db->get('student')->result_array();
                $teachers = $this->db->get('teacher')->result_array();
                $date     = $this->input->post('create_timestamp');
                $message  = $data['notice_title'] . ' ';
                $message .= get_phrase('on') . ' ' . $date;
                foreach($parents as $row) {
                    $reciever_phone = $row['phone'];
                    $this->sms_model->send_sms($message , $reciever_phone);
                }
                foreach($students as $row) {
                    $reciever_phone = $row['phone'];
                    $this->sms_model->send_sms($message , $reciever_phone);
                }
                foreach($teachers as $row) {
                    $reciever_phone = $row['phone'];
                    $this->sms_model->send_sms($message , $reciever_phone);
                }
            }

            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'noticeboard', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('noticeboard', array(
                'notice_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('notice_id', $param2);
            $this->db->delete('noticeboard');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'noticeboard', 'refresh');
        }
        $page_data['page_name']  = 'noticeboard';
        $page_data['role']=$this->session->userdata('role_id');
        $page_data['page_title'] = get_phrase('manage_noticeboard');
        $page_data['notices']    = $this->db->get('noticeboard')->result_array();
        $this->load->view('backend/index', $page_data);
    }
    /***MANAGE EVENT / NOTICEBOARD, WILL BE SEEN BY ALL ACCOUNTS DASHBOARD**/
    function transaction_history($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        
        if ($param1 == 'create') {
            $data['notice_title']     = $this->input->post('notice_title');
            $data['notice']           = $this->input->post('notice');
            $data['create_timestamp'] = strtotime($this->input->post('create_timestamp'));
            $this->db->insert('noticeboard', $data);

            $check_sms_send = $this->input->post('check_sms');

            if ($check_sms_send == 1) {
                // sms sending configurations

                $parents  = $this->db->get('parent')->result_array();
                $students = $this->db->get('student')->result_array();
                $teachers = $this->db->get('teacher')->result_array();
                $date     = $this->input->post('create_timestamp');
                $message  = $data['notice_title'] . ' ';
                $message .= get_phrase('on') . ' ' . $date;
                foreach($parents as $row) {
                    $reciever_phone = $row['phone'];
                    $this->sms_model->send_sms($message , $reciever_phone);
                }
                foreach($students as $row) {
                    $reciever_phone = $row['phone'];
                    $this->sms_model->send_sms($message , $reciever_phone);
                }
                foreach($teachers as $row) {
                    $reciever_phone = $row['phone'];
                    $this->sms_model->send_sms($message , $reciever_phone);
                }
            }

            $this->session->set_flashdata('flash_message' , get_phrase('data_added_successfully'));
            redirect(base_url() . 'transaction_history', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['notice_title']     = $this->input->post('notice_title');
            $data['notice']           = $this->input->post('notice');
            $data['create_timestamp'] = strtotime($this->input->post('create_timestamp'));
            $this->db->where('notice_id', $param2);
            $this->db->update('noticeboard', $data);

            $check_sms_send = $this->input->post('check_sms');

            if ($check_sms_send == 1) {
                // sms sending configurations

                $parents  = $this->db->get('parent')->result_array();
                $students = $this->db->get('student')->result_array();
                $teachers = $this->db->get('teacher')->result_array();
                $date     = $this->input->post('create_timestamp');
                $message  = $data['notice_title'] . ' ';
                $message .= get_phrase('on') . ' ' . $date;
                foreach($parents as $row) {
                    $reciever_phone = $row['phone'];
                    $this->sms_model->send_sms($message , $reciever_phone);
                }
                foreach($students as $row) {
                    $reciever_phone = $row['phone'];
                    $this->sms_model->send_sms($message , $reciever_phone);
                }
                foreach($teachers as $row) {
                    $reciever_phone = $row['phone'];
                    $this->sms_model->send_sms($message , $reciever_phone);
                }
            }

            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'transaction_history', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('noticeboard', array(
                'notice_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('notice_id', $param2);
            $this->db->delete('transaction_history');
            $this->session->set_flashdata('flash_message' , get_phrase('data_deleted'));
            redirect(base_url() . 'transaction_history', 'refresh');
        }
        $page_data['page_name']  = 'transaction_history';
        $page_data['role']=$this->session->userdata('role_id');
        $page_data['page_title'] = 'Transaction History';
        $page_data['notices']    = $this->db->get('noticeboard')->result_array();
        $this->load->view('backend/index', $page_data);
    }
    
    
    /* private messaging */

    function message($param1 = 'message_home', $param2 = '', $param3 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        if ($param1 == 'send_new') {
            $message_thread_code = $this->crud_model->send_new_private_message();
            $this->session->set_flashdata('flash_message', get_phrase('message_sent!'));
            redirect(base_url() . 'message/message_read/' . $message_thread_code, 'refresh');
        }

        if ($param1 == 'send_reply') {
            $this->crud_model->send_reply_message($param2);  //$param2 = message_thread_code
            $this->session->set_flashdata('flash_message', get_phrase('message_sent!'));
            redirect(base_url() . 'message/message_read/' . $param2, 'refresh');
        }

        if ($param1 == 'message_read') {
            $page_data['current_message_thread_code'] = $param2;  // $param2 = message_thread_code
            $this->crud_model->mark_thread_messages_read($param2);
        }

        $page_data['message_inner_page_name']   = $param1;
        $page_data['role']=$this->session->userdata('role_id');
        $page_data['page_name']                 = 'message';
        $page_data['page_title']                = get_phrase('private_messaging');
        $this->load->view('backend/index', $page_data);
    }
    
    /*****SITE/SYSTEM SETTINGS*********/
    function system_settings($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        
        if ($param1 == 'do_update') {
             
            $data['description'] = $this->input->post('system_name');
            $this->db->where('type' , 'system_name');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('system_title');
            $this->db->where('type' , 'system_title');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('address');
            $this->db->where('type' , 'address');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('phone');
            $this->db->where('type' , 'phone');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('paypal_email');
            $this->db->where('type' , 'paypal_email');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('currency');
            $this->db->where('type' , 'currency');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('system_email');
            $this->db->where('type' , 'system_email');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('system_name');
            $this->db->where('type' , 'system_name');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('language');
            $this->db->where('type' , 'language');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('text_align');
            $this->db->where('type' , 'text_align');
            $this->db->update('settings' , $data);
            
            $this->session->set_flashdata('flash_message' , get_phrase('data_updated')); 
            redirect(base_url() . 'system_settings', 'refresh');
        }
        if ($param1 == 'upload_logo') {
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/logo.png');
            $this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
            redirect(base_url() . 'system_settings', 'refresh');
        }
        if ($param1 == 'change_skin') {
            $data['description'] = $param2;
            $this->db->where('type' , 'skin_colour');
            $this->db->update('settings' , $data);
            $this->session->set_flashdata('flash_message' , get_phrase('theme_selected')); 
            redirect(base_url() . 'system_settings/', 'refresh'); 
        }
        $page_data['page_name']  = 'system_settings';
        $page_data['role']=$this->session->userdata('role_id');
        $page_data['page_title'] = get_phrase('system_settings');
        $page_data['settings']   = $this->db->get('settings')->result_array();
        $this->load->view('backend/index', $page_data);
    }
    
    /***** UPDATE PRODUCT *****/
    
    function update( $task = '', $purchase_code = '' ) {
        
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
            
        // Create update directory.
        $dir    = 'update';
        if ( !is_dir($dir) )
            mkdir($dir, 0777, true);
        
        $zipped_file_name   = $_FILES["file_name"]["name"];
        $path               = 'update/' . $zipped_file_name;
        
        move_uploaded_file($_FILES["file_name"]["tmp_name"], $path);
        
        // Unzip uploaded update file and remove zip file.
        $zip = new ZipArchive;
        $res = $zip->open($path);
        if ($res === TRUE) {
            $zip->extractTo('update');
            $zip->close();
            unlink($path);
        }
        
        $unzipped_file_name = substr($zipped_file_name, 0, -4);
        $str                = file_get_contents('./update/' . $unzipped_file_name . '/update_config.json');
        $json               = json_decode($str, true);
        

            
        // Run php modifications
        require './update/' . $unzipped_file_name . '/update_script.php';
        
        // Create new directories.
        if(!empty($json['directory'])) {
            foreach($json['directory'] as $directory) {
                if ( !is_dir( $directory['name']) )
                    mkdir( $directory['name'], 0777, true );
            }
        }
        
        // Create/Replace new files.
        if(!empty($json['files'])) {
            foreach($json['files'] as $file)
                copy($file['root_directory'], $file['update_directory']);
        }
        
        $this->session->set_flashdata('flash_message' , get_phrase('product_updated_successfully'));
        redirect(base_url() . 'system_settings');
    }

    /*****SMS SETTINGS*********/
    function sms_settings($param1 = '' , $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        if ($param1 == 'clickatell') {

            $data['description'] = $this->input->post('clickatell_user');
            $this->db->where('type' , 'clickatell_user');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('clickatell_password');
            $this->db->where('type' , 'clickatell_password');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('clickatell_api_id');
            $this->db->where('type' , 'clickatell_api_id');
            $this->db->update('settings' , $data);

            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'sms_settings/', 'refresh');
        }

        if ($param1 == 'twilio') {

            $data['description'] = $this->input->post('twilio_account_sid');
            $this->db->where('type' , 'twilio_account_sid');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('twilio_auth_token');
            $this->db->where('type' , 'twilio_auth_token');
            $this->db->update('settings' , $data);

            $data['description'] = $this->input->post('twilio_sender_phone_number');
            $this->db->where('type' , 'twilio_sender_phone_number');
            $this->db->update('settings' , $data);

            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'sms_settings', 'refresh');
        }

        if ($param1 == 'active_service') {

            $data['description'] = $this->input->post('active_sms_service');
            $this->db->where('type' , 'active_sms_service');
            $this->db->update('settings' , $data);

            $this->session->set_flashdata('flash_message' , get_phrase('data_updated'));
            redirect(base_url() . 'sms_settings', 'refresh');
        }

        $page_data['page_name']  = 'sms_settings';
        $page_data['page_title'] = get_phrase('sms_settings');
        $page_data['role']=$this->session->userdata('role_id');
        $page_data['settings']   = $this->db->get('settings')->result_array();
        $this->load->view('backend/index', $page_data);
    }
    
    /*****LANGUAGE SETTINGS*********/
    function manage_language($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        
        if ($param1 == 'edit_phrase') {
            $page_data['edit_profile']  = $param2;  
        }
        if ($param1 == 'update_phrase') {
            $language   =   $param2;
            $total_phrase   =   $this->input->post('total_phrase');
            for($i = 1 ; $i < $total_phrase ; $i++)
            {
                //$data[$language]  =   $this->input->post('phrase').$i;
                $this->db->where('phrase_id' , $i);
                $this->db->update('language' , array($language => $this->input->post('phrase'.$i)));
            }
            redirect(base_url() . 'manage_language/edit_phrase/'.$language, 'refresh');
        }
        if ($param1 == 'do_update') {
            $language        = $this->input->post('language');
            $data[$language] = $this->input->post('phrase');
            $this->db->where('phrase_id', $param2);
            $this->db->update('language', $data);
            $this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
            redirect(base_url() . 'manage_language', 'refresh');
        }
        if ($param1 == 'add_phrase') {
            $data['phrase'] = $this->input->post('phrase');
            $this->db->insert('language', $data);
            $this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
            redirect(base_url() . 'manage_language', 'refresh');
        }
        if ($param1 == 'add_language') {
            $language = $this->input->post('language');
            $this->load->dbforge();
            $fields = array(
                $language => array(
                    'type' => 'LONGTEXT'
                )
            );
            $this->dbforge->add_column('language', $fields);
            
            $this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
            redirect(base_url() . 'manage_language', 'refresh');
        }
        if ($param1 == 'delete_language') {
            $language = $param2;
            $this->load->dbforge();
            $this->dbforge->drop_column('language', $language);
            $this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
            
            redirect(base_url() . 'manage_language', 'refresh');
        }
        $page_data['page_name']        = 'manage_language';
        $page_data['page_title']       = get_phrase('manage_language');
        $page_data['role']=$this->session->userdata('role_id');
        //$page_data['language_phrases'] = $this->db->get('language')->result_array();
        $this->load->view('backend/index', $page_data); 
    }
    
    /*****BACKUP / RESTORE / DELETE DATA PAGE**********/
    function backup_restore($operation = '', $type = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        
        if ($operation == 'create') {
            $this->crud_model->create_backup($type);
        }
        if ($operation == 'restore') {
            $this->crud_model->restore_backup();
            $this->session->set_flashdata('backup_message', 'Backup Restored');
            redirect(base_url() . 'backup_restore', 'refresh');
        }
        if ($operation == 'delete') {
            $this->crud_model->truncate($type);
            $this->session->set_flashdata('backup_message', 'Data removed');
            redirect(base_url() . 'backup_restore', 'refresh');
        }
        
        $page_data['page_info']  = 'Create backup / restore from backup';
        $page_data['page_name']  = 'backup_restore';
        $page_data['page_title'] = get_phrase('manage_backup_restore');
        $this->load->view('backend/index', $page_data);
    }
    
    /******MANAGE OWN PROFILE AND CHANGE PASSWORD***/
    function manage_profile($param1 = '', $param2 = '', $param3 = '')
    {
        $user_id=$this->session->userdata('admin_id');
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        if ($param1 == 'update_profile_info') {

          
            $residence_proof="uploads/residence_proofs/".$user_id."_";
            $passport_copies="uploads/passport_copies/".$user_id."_";
            $id_copies="uploads/id_copies/".$user_id."_";
            $insurance_docs="uploads/insurance_docs/".$user_id."_";
            $vehicle_docs="uploads/vehicle_docs/".$user_id."_";
            $licence_copy="uploads/licence_copy/".$user_id."_";

           
            //table users
            $users['fullname']  = $this->input->post('name');
            $users['email'] = $this->input->post('email');
            $users['country']  = $this->input->post('country');
            $users['userfile'] = 'uploads/users_image/' . $this->session->userdata('admin_id') . '.jpg';

            //docs
            $docs['user_id']=$this->session->userdata('admin_id');
            $docs['dob'] = strtotime($this->input->post('dob'));
            $docs['id_number'] = $this->input->post('id_number');
            $docs['id_copy'] =   $id_copies.$_FILES['id_copy']['name'];
            if(isset($_FILES['id_copy']['name'])){
                $docs['id_copy'] =  $residence_proof.$_FILES['id_copy']['name'];
            }
            $docs['passport_issuer'] = $this->input->post('passport_issuer');
            $docs['passport_number'] = $this->input->post('passport_number');
            $docs['passport_expiration'] = $this->input->post('passport_expiry');
            if(isset($_FILES['passport_copy']['name'])){
                $docs['passport_copy'] =  $passport_copies.$_FILES['passport_copy']['name'];
            }
           
            $docs['driver_licence'] = $this->input->post('driver_licence');
            if(isset($_FILES['licence_copy']['name'])){
                $docs['licence_copy'] =  $licence_copy.$_FILES['licence_copy']['name'];
            }
           
            $docs['physical_address'] = $this->input->post('physical_address');

            if(isset($_FILES['residence_proof']['name'])){
                $docs['residence_proof'] =  $residence_proof.$_FILES['residence_proof']['name'];
            }
           
            $docs['work_address'] = $this->input->post('work_address');
            $docs['company_fax'] = $this->input->post('company_fax');
            $docs['company_phone'] = $this->input->post('company_phone');
            $this->m_documents->addNew($docs);

            //vehicle details
            //if ($this->input->post('vehicle_number')) {
                $veh['user_id'] = $user_id;
                $veh['vehicle_model'] = $this->input->post('vehicle_model');
                $veh['vehicle_registration'] = $this->input->post('vehicle_number');
                if(isset($_FILES['vehicle_docs']['name'])){
                    $veh['vehicle_docs'] =  $vehicle_docs.$_FILES['vehicle_docs']['name'];
                }
                if(isset($_FILES['insurance_docs']['name'])){
                    $veh['insurance_docs'] =  $insurance_docs.$_FILES['insurance_docs']['name'];
                }
                
               
                $this->m_vehicles->addNew($veh);
            //}
           
            //company directors
            $cd['user_id'] = $user_id;
            $cd['director_name'] = $this->input->post('director_name');
            $cd['director_number'] = $this->input->post('director_number');
            
            $this->m_company_directors->addNew($cd);

        
            $data['card_type'] = $this->input->post('card_type');
            $data['user_id'] = $user_id;
            $data['card_holder'] = $this->input->post('card_holder');
            $data['card_number'] = $this->input->post('card_number');
            $data['card_expiry'] = $this->input->post('expiry_month')."/".$this->input->post('expiry_year');
            $data['cvv'] = $this->input->post('cvv_number');
            $this->m_payment_details->addNew($data);

            //profession
            if ($this->input->post('profession_name')) {
                $profession['user_id'] = $user_id;
                $profession['qualification'] = $this->input->post('qualification');
                $profession['year_completion'] = $this->input->post('year_completion');
                $profession['institution'] = $this->input->post('institution');
                $profession['professional_body'] = $this->input->post('professional_body');
                $profession['practice_number'] = $this->input->post('practice_number');
                $profession['profession_name'] = $this->input->post('profession_name');
                $profession['subject_specialty'] = $this->input->post('subject_specialty');
                $this->m_professional_services->addNew($profession);
            }

            //service
            if ($this->input->post('service_name')) {
                $provider['user_id'] = $user_id;
                $provider['service_name'] = $this->input->post('service_name');
                $this->m_service_provider->addNew($provider);
            }

            //emergency numbers
            $em['user_id'] = $user_id;
            $em['contact_name'] = $this->input->post('em_name');
            $em['contact_number'] = $this->input->post('em_number');
          
            $this->m_emergency_contact->addNew($em);

            //referral numbers
            $ref['user_id'] = $user_id;
            $ref['referral_name'] = $this->input->post('referral_name');
            $ref['referral_number'] = $this->input->post('referral_number');
            $this->m_reference_details->addNew($ref);

          
            //passport copy
            move_uploaded_file($_FILES['passport_copy']['tmp_name'], $passport_copies.$_FILES['passport_copy']['name']);
           
            //residence proof
            move_uploaded_file($_FILES['residence_proof']['tmp_name'], $residence_proof.$_FILES['residence_proof']['name']);
           
            //id_copy
           move_uploaded_file($_FILES['id_copy']['tmp_name'], $id_copies.$_FILES['id_copy']['name']);

            //insurance docs
            move_uploaded_file($_FILES['insurance_docs']['tmp_name'], $insurance_docs.$_FILES['insurance_docs']['name']);
           
            //vehicle docs
           move_uploaded_file($_FILES['vehicle_docs']['tmp_name'], $vehicle_docs.$_FILES['vehicle_docs']['name']);
           
           //licence copies
           move_uploaded_file($_FILES['licence_copy']['tmp_name'], $licence_copy.$_FILES['licence_copy']['name']);
           
            
            $this->db->where('user_id', $user_id);
            $this->db->update('users', $users);

            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/users_image/' . $this->session->userdata('admin_id') . '.jpg');
            $this->session->set_flashdata('flash_message', get_phrase('account_updated'));
            redirect(base_url() . 'page/manage_profile', 'refresh');
        }
        if ($param1 == 'update_company_info') {
            $data['clients_name']  = $this->input->post('clients_name');
            $data['email'] = $this->input->post('email');
            
            $this->db->where('client_id', $this->session->userdata('client_id'));
            $this->db->update('clients', $data);
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/clients_image/' . $this->session->userdata('client_id') . '.jpg');
            $this->session->set_flashdata('flash_message', get_phrase('account_updated'));
            redirect(base_url() . 'page/manage_profile', 'refresh');
        }
        if ($param1 == 'update_server_info') {
            $data['server_ip']  = $this->input->post('server_ip');
            $data['server_port'] = $this->input->post('server_port');
            
            $this->db->where('client_id', $this->session->userdata('client_id'));
            $this->db->update('server_settings', $data);
            $this->session->set_flashdata('flash_message', get_phrase('account_updated'));
            redirect(base_url() . 'page/manage_profile', 'refresh');
        }
        if ($param1 == 'change_password') {
            $data['password']             = $this->input->post('password');
            $data['new_password']         = $this->input->post('new_password');
            $data['confirm_new_password'] = $this->input->post('confirm_new_password');
            
            $current_password = $this->db->get_where('users', array(
                'user_id' => $this->session->userdata('admin_id')
            ))->row()->password;
           
            if ((verifyHashedPassword($data['password'], $current_password)) && $data['new_password'] == $data['confirm_new_password']) {
                $this->db->where('user_id', $this->session->userdata('admin_id'));
                $this->db->update('users', array(
                    'password' =>    getHashedPassword($data['new_password'])
                ));
             
        

                $this->session->set_flashdata('flash_message', get_phrase('password_updated'));
            } else {
                $this->session->set_flashdata('flash_message', get_phrase('password_mismatch'));
            }
            redirect(base_url() . 'page/manage_profile', 'refresh');
        }
        $page_data['page_name']  = 'manage_profile';
        $page_data['role']=$this->session->userdata('role_id');
        $page_data['page_title'] = get_phrase('manage_profile');
        $this->db->limit(1);
        $page_data['edit_data']  = $this->db->get_where('users', array(
            'user_id' => $this->session->userdata('admin_id')
        ))->result_array();
       
        $page_data['nationality']=$this->m_country->get_all_names();
        $page_data['passport_issuer']=$this->m_country->get_all_names();
        $page_data['card_types']  = $this->m_card_type->get_all();
        $page_data['docs']  = $this->m_documents->get_by_id($user_id);
        $page_data['payment_details']  = $this->m_payment_details->get_by_id($user_id);
        $this->load->view('backend/index', $page_data);
    }

    function homepage($param1=""){
        if($param1=="download"){
        
            $current_timestamp = strtotime("now");
            $data['created']= $current_timestamp;
            $this->db->insert('downloads',$data);
        redirect(base_url() . 'homepage');

        }
    $this->loadViews('frontend/homepage', $page_data);
    }
        /**
        * @author Gaudencio Solivatore
        * @method register
        * @param param1
        */
        function register($param1=""){
            if($param1=="create"){
                $data['name']=$this->input->post("firstname")." ".$this->input->post("surname");;
                $data['country']=$this->input->post("country");
                $data['password']=getHashedPassword($this->input->post("password"));
                $data['phone']=$this->input->post("phone");
                $data['dob']=$this->input->post("dob");
                $data['email']=$this->input->post("email");
                $data['referal_code']=$this->input->post("referBy");
                $data['level']=  $this->input->post("level");
                $data['client_id']=  $this->input->post("client_id");
                $data['created_at']=time();
                $data['updated_at']=time();
                $data['password_set']=$this->last_user_id();
                if($this->db->insert('users', $data)){
                    redirect(base_url() .'page/verify_email/generated/'.$data['password_set']);
                }
                else{
                    redirect(base_url() .'register');
                }
            
                }
                $page_data['countries']=$this->m_country->get_all_names();
                $this->loadViews('frontend/register', $page_data);
        }

    /**
     * @author Gaudencio Solivatore
     * @method register
     * @param param1
     */
    function last_user_id(){
       $user_id=1;
       $this->db->select('user_id');
       $this->db->order_by('user_id', 'desc');
       $this->db->limit(1);
       $query=$this->db->get('users');
       if($query->num_rows()){
           $user_id=$query->row()->user_id;
       }
       return md5(++$user_id);
    }

        /**
         * @method map_locations
         */
        function map_locations(){
         
            $this->load->view('frontend/map_locations'); 
        }   
        /**
         * @method get_locations
         */
        function get_locations(){

           echo json_encode($this->m_sites->get_locations());
        }


    /**
    * @author Gaudencio Solivatore
    * @method login
    * @param param1
    */
    function login($param1=null, $param2=null){
    if($param1=="not_set"){
        $page_data['not_set']="Please Visit your email to verify your account";
    }
    if($param1=="forgot_password"){
       
        $page_data['forgot_password']=TRUE;
    }
    if($param1=="activate"){
        
        if(($this->m_users->activate_by_key($param2))>0){
            $this->session->set_flashdata('flash_message' ,"Your account is now verified you may login" );
        }
    }
    $this->loadViews('frontend/login', $page_data);
}

function reset_password($param1=null, $param2=null){
    if ($param1=="set"){
     $data['password']=$this->input->post('password');
     $cpass=$this->input->post('cpassword');
     $key=$this->input->post('key');
    if($data['password']!=$cpass){
        $this->session->set_flashdata('flash_message' ,"passwords dont match" );
       
    }
    else{
        $data['password']=getHashedPassword(  $data['password']);
        $this->db->where('password_set', $key);
        $this->db->update('users', $data);
        $this->session->set_flashdata('flash_message' ,"password changed succefully, you can login" );
    }

    }
    if(isset($param1) && $param1!="set"){
        $page_data['key']=$param1;
    }
   
    $this->loadViews('frontend/reset_password', $page_data);
}

/**
 * @author Gaudencio Solivatore
 * @method privacy
 * @param param1
 */
function privacy($param1=""){
    
    $this->loadViews('frontend/privacy', $page_data);
}
/***ADMIN PRODUCTS ***/
function product($param=null)
{
 if($param=="delete"){
$data=$this->input->post('selected');
if($this->m_products->delete_products($data)>0){
    $this->session->set_flashdata('flash_message' , "delete successful");
   
}
else{
    $this->session->set_flashdata('flash_message' , 'delete failed');
    
}  

 }
    if ($this->session->userdata('admin_login') != 1)
    redirect(base_url(), 'refresh');
    $data['page_name']  = 'product';
    $data['users_online']  =$this->m_data_captured->get_online_users();
    $count = $this->m_products->productListingCount();
    $returns = $this->paginationCompress ( "page/product/", $count, 4 );
    $data['products'] = $this->m_products->productListing($returns["page"], $returns["segment"]);
    $data['role']=$this->session->userdata('role_id');
    $this->load->view('backend/index', $data);
}
/***ADMIN MANAGE SERVICES ***/
function manage_service($param=null)
{
    if($param=="update"){
        $user_id=$this->session->userdata('admin_login');
        $service_img_dir="uploads/service_images/".$user_id."_";
        //adding  service description
        $description['provider_id']=$this->input->post('provider');
        $description['user_id']=$this->input->post('user_id');
        $description['description']=$this->input->post('description');
        $description['title']=$this->input->post('title');
        $this->m_service_provider->addDescription($description);
        //service images
        $images['provider_id']=$this->input->post('provider');
        $images['user_id']=$this->input->post('user_id');
        if(isset($_FILES['service_image']['name'])){
            $i=0;
            
          
            foreach($_FILES['service_image']['name'] as $test){
                $my[]=$service_img_dir.$test;
                move_uploaded_file($_FILES['service_image']['tmp_name'][$i],  $service_img_dir.$test).".jpg";
                $i++;
               }
        }else{
            unset($my);
        }
        //upload
       $images['service_images']=json_encode( $my);
        $this->m_service_provider->addImages($images);

        
             
    }
 if($param=="delete"){
    $data=$this->input->post('selected');
    if($this->m_products->delete_service($data)>0){
    $this->session->set_flashdata('flash_message' , "delete successful");
        
    }
    else{
    $this->session->set_flashdata('flash_message' , 'delete failed');
    }  

    }
    if ($this->session->userdata('admin_login') != 1)
    redirect(base_url(), 'refresh');
    $user_id=$this->session->userdata('login_user_id');

    $data['page_name']  = 'manage_service';
    $data['users_online']  =$this->m_data_captured->get_online_users();
    $count = $this->m_service_provider->serviceListingCount();
    $returns = $this->paginationCompress ( "page/manage_service/", $count, 4 );
    $data['services'] = $this->m_service_provider->serviceListing($returns["page"], $returns["segment"],$user_id);
    $data['role']=$this->session->userdata('role_id');
    $this->load->view('backend/index', $data);
}


/***ADMIN MANAGE SERVICE PROVIDER ***/
function manage_service_provider($param=null)
{
    if($param=="update"){
        $user_id=$this->session->userdata('admin_login');
        $service_img_dir="uploads/service_images/".$user_id."_";
        //adding  service description
        $description['provider_id']=$this->input->post('provider');
        $pID=$this->input->post('pID');
        $description['user_id']=$this->input->post('user_id');
        $description['description']=$this->input->post('description');
        $description['title']=$this->input->post('title');
        $this->m_service_provider->addDescription($description, $pID);
        //service images
        $images['provider_id']=$this->input->post('provider');
        $images['user_id']=$this->input->post('user_id');
        if(isset($_FILES['service_image']['name'])){
            $i=0;
            
          
            foreach($_FILES['service_image']['name'] as $test){
                $my[]=$service_img_dir.$test;
                move_uploaded_file($_FILES['service_image']['tmp_name'][$i],  $service_img_dir.$test).".jpg";
                $i++;
               }
        }else{
            unset($my);
        }
        //upload
       $images['service_images']=json_encode( $my);
        $this->m_service_provider->addImages($images);

        
             
    }
 if($param=="delete"){
    $data=$this->input->post('selected');
    if($this->m_products->delete_service($data)>0){
    $this->session->set_flashdata('flash_message' , "delete successful");
        
    }
    else{
    $this->session->set_flashdata('flash_message' , 'delete failed');
    }  

    }
    if ($this->session->userdata('admin_login') != 1)
    redirect(base_url(), 'refresh');
    $user_id=$this->session->userdata('login_user_id');

    $data['page_name']  = 'manage_service_provider';
    $data['users_online']  =$this->m_data_captured->get_online_users();
    $count = $this->m_service_provider->serviceListingCount();
    $returns = $this->paginationCompress ( "page/manage_service_provider/", $count, 4 );
    $data['services'] = $this->m_service_provider->serviceListing($returns["page"], $returns["segment"],$user_id);
    $data['role']=$this->session->userdata('role_id');
    $this->load->view('backend/index', $data);
}


/***ADMIN MANAGE PROFESSION ***/
function manage_profession($param=null)
{
    if($param=="update"){
        $user_id=$this->session->userdata('admin_login');
        $service_img_dir="uploads/service_images/".$user_id."_";
        //adding  service description
        $description['profession_id']=$this->input->post('profession_id');
        $description['user_id']=$this->input->post('user_id');
        $pID=$this->input->post('pID');
        $description['description']=$this->input->post('description');
        $description['title']=$this->input->post('title');
        $description['skills']=$this->input->post('skills');
        $this->m_professional_services->addDescription($description, $pID);
        //service images
        $images['profession_id']=$this->input->post('profession_id');
        $images['user_id']=$this->input->post('user_id');
        if(isset($_FILES['profession_image']['name'])){
            $i=0;
            
          
            foreach($_FILES['profession_image']['name'] as $test){
                $my[]=$service_img_dir.$test;
                move_uploaded_file($_FILES['profession_image']['tmp_name'][$i],  $service_img_dir.$test).".jpg";
                $i++;
               }
        }else{
            unset($my);
        }
        //upload
       $images['profession_images']=json_encode( $my);
        $this->m_professional_services->addImages($images);

        
             
    }
 if($param=="delete"){
    $data=$this->input->post('selected');
    if($this->m_professional_services->delete_profession($data)>0){
    $this->session->set_flashdata('flash_message' , "delete successful");
        
    }
    else{
    $this->session->set_flashdata('flash_message' , 'delete failed');
    }  

    }
    if ($this->session->userdata('admin_login') != 1)
    redirect(base_url(), 'refresh');
    $user_id=$this->session->userdata('login_user_id');
    $data['page_name']  = 'manage_profession';
    $data['users_online']  =$this->m_data_captured->get_online_users();
    $count = $this->m_professional_services->serviceListingCount();
    $returns = $this->paginationCompress ( "page/manage_profession/", $count, 4 );
    $data['services'] = $this->m_professional_services->serviceListing($returns["page"], $returns["segment"],$user_id);
    $data['role']=$this->session->userdata('role_id');
    $this->load->view('backend/index', $data);
}


/***ADMIN MANAGE SERVICES ***/
function manage_cards($param=null)
{
 if($param=="delete"){
    $data=$this->input->post('cards');
  

if($this->m_payment_details->delete_cards($data)>0){
    $this->session->set_flashdata('flash_message' , "delete successful"); 
    redirect(base_url('page/manage_cards'), 'refresh');
}
else{
    $this->session->set_flashdata('flash_message' , 'delete failed');  
    redirect(base_url('page/manage_cards'), 'refresh');
}  
 }
 if($param=="create"){

    $data['card_type'] = $this->input->post('card_type');
    $data['card_holder'] = $this->input->post('card_holder');
    $data['card_number'] = $this->input->post('card_number');
    $data['card_expiry'] = $this->input->post('expiry_month')."/".$this->input->post('expiry_year');
    $data['cvv'] = $this->input->post('cvv_number');
    $data['user_id']=$this->session->userdata('admin_id');
    $this->m_payment_details->addNew($data);
    $this->session->set_flashdata('flash_message' , "saved successful"); 
    redirect(base_url('manage_cards'), 'refresh');

 }
    if ($this->session->userdata('admin_login') != 1)
    redirect(base_url(), 'refresh');
    $data['page_name']  = 'manage_cards';
    $data['users_online']  =$this->m_data_captured->get_online_users();
    $count = $this->m_payment_details->cardsListingCount();
    $returns = $this->paginationCompress ( "page/manage_cards/", $count, 4 );
    $data['cards'] = $this->m_payment_details->cardsListing($returns["page"], $returns["segment"], $this->session->userdata('admin_id'));
    $data['card_types']  = $this->m_card_type->get_all();
    $data['role']=$this->session->userdata('role_id');
    $this->load->view('backend/index', $data);
}



/***ADMIN MULTIPLE REGISTRATION ***/
function multistep_registration($param1 = '', $param2 = '', $param3 = '')
{
    $user_id=$this->session->userdata('admin_id');
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url() . 'index.php?login', 'refresh');
    if ($param1 == 'update_profile_info') {

       
        $geocodez = trim($this->input->post('geocodez'), '()');
        $residence_proof="uploads/residence_proofs/".$user_id."_";
        $passport_copies="uploads/passport_copies/".$user_id."_";
        $id_copies="uploads/id_copies/".$user_id."_";
        $insurance_docs="uploads/insurance_docs/".$user_id."_";
        $vehicle_docs="uploads/vehicle_docs/".$user_id."_";
        $licence_copy="uploads/licence_copy/".$user_id."_";

       
        //table users
        $users['fullname']  = $this->input->post('name');
        $users['email'] = $this->input->post('email');
        $users['country']  = $this->input->post('country');
        $users['userfile'] = 'uploads/users_image/' . $this->session->userdata('admin_id') . '.jpg';

        //docs
        $docs['user_id']=$this->session->userdata('admin_id');
        $docs['dob'] = strtotime($this->input->post('dob'));
        $docs['id_number'] = $this->input->post('id_number');
        $docs['id_copy'] =   $id_copies.$_FILES['id_copy']['name'];
        if(isset($_FILES['id_copy']['name'])){
            $docs['id_copy'] =  $residence_proof.$_FILES['id_copy']['name'];
        }
        $docs['passport_issuer'] = $this->input->post('passport_issuer');
        $docs['passport_number'] = $this->input->post('passport_number');
        $docs['passport_expiration'] = $this->input->post('passport_expiry');
        if(isset($_FILES['passport_copy']['name'])){
            $docs['passport_copy'] =  $passport_copies.$_FILES['passport_copy']['name'];
        }
       
        $docs['driver_licence'] = $this->input->post('driver_licence');
        if(isset($_FILES['licence_copy']['name'])){
            $docs['licence_copy'] =  $licence_copy.$_FILES['licence_copy']['name'];
        }
       
        $docs['physical_address'] = $this->input->post('physical_address');
        if(isset($_FILES['residence_proof']['name'])){
            $docs['residence_proof'] =  $residence_proof.$_FILES['residence_proof']['name'];
        }
       
        $docs['work_address'] = $this->input->post('address');
        $fixed_address=str_replace(",", "+", $docs['work_address']);
        $geocodes=$this->address_curl(str_replace("  ", "+", urlencode($fixed_address)));
        $docs['lat']= $geocodes['lat'];
        $docs['lng']= $geocodes['lng'];
        $docs['company_fax'] = $this->input->post('company_fax');
        $docs['company_phone'] = $this->input->post('company_phone');
      
        $this->m_documents->addNew($docs);

        //vehicle details
        //if ($this->input->post('vehicle_number')) {
            $veh['user_id'] = $user_id;
            $veh['vehicle_model'] = $this->input->post('vehicle_model');
            $veh['vehicle_registration'] = $this->input->post('vehicle_number');
            if(isset($_FILES['vehicle_docs']['name'])){
                $veh['vehicle_docs'] =  $vehicle_docs.$_FILES['vehicle_docs']['name'];
            }
            if(isset($_FILES['insurance_docs']['name'])){
                $veh['insurance_docs'] =  $insurance_docs.$_FILES['insurance_docs']['name'];
            }
            
           
            $this->m_vehicles->addNew($veh);
        //}
       
        //company directors
        $cd['user_id'] = $user_id;
        $cd['director_name'] = $this->input->post('director_name');
        $cd['director_number'] = $this->input->post('director_number');
        
        $this->m_company_directors->addNew($cd);

    
        $data['card_type'] = $this->input->post('card_type');
        $data['user_id'] = $user_id;
        $data['card_holder'] = $this->input->post('card_holder');
        $data['card_number'] = $this->input->post('card_number');
        $data['card_expiry'] = $this->input->post('expiry_month')."/".$this->input->post('expiry_year');
        $data['cvv'] = $this->input->post('cvv_number');
        $this->m_payment_details->addNew($data);

        //profession
        if ($this->input->post('profession_name')) {
            $profession['user_id'] = $user_id;
            $profession['qualification'] = $this->input->post('qualification');
            $profession['year_completion'] = $this->input->post('year_completion');
            $profession['institution'] = $this->input->post('institution');
            $profession['professional_body'] = $this->input->post('professional_body');
            $profession['practice_number'] = $this->input->post('practice_number');
            $profession['profession_name'] = $this->input->post('profession_name');
            $profession['subject_specialty'] = $this->input->post('subject_specialty');
            $profession['geocodez'] = $geocodez;
            $this->m_professional_services->addNew($profession);
        }
   
        //service
        if ($this->input->post('service_name')) {
            $provider['user_id'] = $user_id;
            $provider['service_name'] = $this->input->post('service_name');
            $provider['geocodez'] = $geocodez;
            $this->m_service_provider->addNew($provider);
        }
  
        //emergency numbers
        $em['user_id'] = $user_id;
        $em['contact_name'] = $this->input->post('em_name');
        $em['contact_number'] = $this->input->post('em_number');
      
        $this->m_emergency_contact->addNew($em);
      
        //referral numbers
        $ref['user_id'] = $user_id;
        $ref['referral_name'] = $this->input->post('referral_name');
        $ref['referral_number'] = $this->input->post('referral_number');
        $this->m_reference_details->addNew($ref);

       
        //passport copy
        move_uploaded_file($_FILES['passport_copy']['tmp_name'], $passport_copies.$_FILES['passport_copy']['name']);
       
        //residence proof
        move_uploaded_file($_FILES['residence_proof']['tmp_name'], $residence_proof.$_FILES['residence_proof']['name']);
       
        //id_copy
       move_uploaded_file($_FILES['id_copy']['tmp_name'], $id_copies.$_FILES['id_copy']['name']);

        //insurance docs
        move_uploaded_file($_FILES['insurance_docs']['tmp_name'], $insurance_docs.$_FILES['insurance_docs']['name']);
       
        //vehicle docs
       move_uploaded_file($_FILES['vehicle_docs']['tmp_name'], $vehicle_docs.$_FILES['vehicle_docs']['name']);
       
       //licence copies
       move_uploaded_file($_FILES['licence_copy']['tmp_name'], $licence_copy.$_FILES['licence_copy']['name']);
       
        
        $this->db->where('user_id', $user_id);
        $this->db->update('users', $users);

        move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/users_image/' . $this->session->userdata('admin_id') . '.jpg');
        $this->session->set_flashdata('flash_message', get_phrase('account_updated'));
        redirect(base_url() . 'page/multistep_registration', 'refresh');
    }
    if ($param1 == 'update_company_info') {
        $data['clients_name']  = $this->input->post('clients_name');
        $data['email'] = $this->input->post('email');
        
        $this->db->where('client_id', $this->session->userdata('client_id'));
        $this->db->update('clients', $data);
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/clients_image/' . $this->session->userdata('client_id') . '.jpg');
        $this->session->set_flashdata('flash_message', get_phrase('account_updated'));
        redirect(base_url() . 'page/multistep_registration', 'refresh');
    }
    
    if ($param1 == 'change_password') {
        $data['password']             = $this->input->post('password');
        $data['new_password']         = $this->input->post('new_password');
        $data['confirm_new_password'] = $this->input->post('confirm_new_password');
        
        $current_password = $this->db->get_where('users', array(
            'user_id' => $this->session->userdata('admin_id')
        ))->row()->password;
       
        if ((verifyHashedPassword($data['password'], $current_password)) && $data['new_password'] == $data['confirm_new_password']) {
            $this->db->where('user_id', $this->session->userdata('admin_id'));
            $this->db->update('users', array(
                'password' =>    getHashedPassword($data['new_password'])
            ));
         
    

            $this->session->set_flashdata('flash_message', get_phrase('password_updated'));
        } else {
            $this->session->set_flashdata('flash_message', get_phrase('password_mismatch'));
        }
        redirect(base_url() . 'page/multistep_registration', 'refresh');
    }
    $page_data['page_name']  = 'multistep_registration';
    $page_data['role']=$this->session->userdata('role_id');
    $page_data['page_title'] = "Registration Form";
    $this->db->limit(1);
    $page_data['edit_data']  = $this->db->get_where('users', array(
        'user_id' => $this->session->userdata('admin_id')
    ))->result_array();
   
    $page_data['nationality']=$this->m_country->get_all_names();
    $page_data['passport_issuer']=$this->m_country->get_all_names();
    $page_data['card_types']  = $this->m_card_type->get_all();
    $page_data['docs']  = $this->m_documents->get_by_id($user_id);
    $page_data['payment_details']  = $this->m_payment_details->get_by_id($user_id);
  
    $this->load->view('backend/index', $page_data);
}
/***ADMIN MANAGE SERVICES ***/
function manage_cars($param=null)
{
 if($param=="delete"){
$data=$this->input->post('cars');

if($this->m_car_type->delete_cars($data)>0){
    $this->session->set_flashdata('flash_message' , "delete successful"); 
}
else{
    $this->session->set_flashdata('flash_message' , 'delete failed');  
}  
 }

 $user_id=$this->session->userdata('admin_id');
    if($param=="create"){
       
        $insurance_docs="uploads/insurance_docs/".$user_id."_";
        $vehicle_docs="uploads/vehicle_docs/".$user_id."_";
        $veh['user_id'] = $user_id;
        $veh['vehicle_model'] = $this->input->post('vehicle_model');
        $veh['vehicle_type'] = $this->input->post('vehicle_type');
        $veh['vehicle_registration'] = $this->input->post('vehicle_registration');
       
        if(isset($_FILES['vehicle_docs']['name'])){
            $veh['vehicle_docs'] =  $vehicle_docs.$_FILES['vehicle_docs']['name'].time();
        }
        if(isset($_FILES['insurance_docs']['name'])){
            $veh['insurance_docs'] =  $insurance_docs.$_FILES['insurance_docs']['name'].time();
        }
         //insurance docs
         move_uploaded_file($_FILES['insurance_docs']['tmp_name'], $insurance_docs.$_FILES['insurance_docs']['name']);
       
         //vehicle docs
        move_uploaded_file($_FILES['vehicle_docs']['tmp_name'], $vehicle_docs.$_FILES['vehicle_docs']['name']);
        $this->m_vehicles->addNew($veh);
        $this->session->set_flashdata('flash_message' , "added successful"); 
        redirect(base_url() . 'page/manage_cars', 'refresh');
        
    }
    if ($this->session->userdata('admin_login') != 1)
    redirect(base_url(), 'refresh');
    $data['page_name']  = 'manage_cars';
    $data['users_online']  =$this->m_data_captured->get_online_users();
    $count = $this->m_payment_details->cardsListingCount();
    $returns = $this->paginationCompress ( "page/manage_cars/", $count, 4 );
    $data['cars'] = $this->m_car_type->carsListing($returns["page"], $returns["segment"], $user_id);
    $data['role']=$this->session->userdata('role_id');
    $this->load->view('backend/index', $data);
}

/**
 * @author Gaudencio Solivatore
 * @method products
 * @param param1
 */
function products($param1=""){
    $this->pagination->initialize($config);
    if ($this->input->post('category')) {
        $this->load->library('pagination');
        $product_brand= $this->input->post('brand');
        $product_category= $this->input->post('productCat');
        $count = $this->m_products->searchListingCount($product_brand, $product_category);
        $returns = $this->paginationCompress("page/products", $count, 4);
        $page_data['products']=$this->m_products->search_products($product_brand, $product_category, $returns["page"], $returns["segment"]);
    }
    else{
        //$data['products']=$this->product_model->get_products();
        $count = $this->m_products->productListingCount();
        $returns = $this->paginationCompress ( "page/products", $count, 4 );
        $page_data['products'] = $this->m_products->productListing($returns["page"], $returns["segment"]);
        }
        $page_data['count']=$this->m_products->productListingCount();
    $this->loadViews('frontend/products', $page_data);
}
/**
 * @author Gaudencio Solivatore
 * @method real_estate
 * @param param1
 */
function real_estate($param1=""){
    
    $this->loadViews('frontend/real_estate', $page_data);
}
/**
 * @author Gaudencio Solivatore
 * @method jobs
 * @param param1
 */
function jobs($param1=""){
    
    $this->loadViews('frontend/jobs', $page_data);
}
/**
 * @author Gaudencio Solivatore
 * @method book_sports_hobbies
 * @param param1
 */
function books_sports_hobbies($param1=""){
    
    $this->loadViews('frontend/books_sports_hobbies', $page_data);
}
/**
 * @author Gaudencio Solivatore
 * @method furnitures
 * @param param1
 */
function furnitures($param1=""){
    
    $this->loadViews('frontend/furnitures', $page_data);
}
/**
 * @author Gaudencio Solivatore
 * @method privacy
 * @param param1
 */
function kids($param1=""){
    
    $this->loadViews('frontend/kids', $page_data);
}
/**
 * @author Gaudencio Solivatore
 * @method bikes
 * @param param1
 */
function bikes($param1=""){
    
    $this->loadViews('frontend/bikes', $page_data);
}
/**
 * @author Gaudencio Solivatore
 * @method cars
 * @param param1
 */
function cars($param1=""){
    
    $this->loadViews('frontend/cars', $page_data);
}
/**
 * @author Gaudencio Solivatore
 * @method mobiles
 * @param param1
 */
function mobiles($param1=""){
    
    $this->loadViews('frontend/mobiles', $page_data);
}
/**
 * @author Gaudencio Solivatore
 * @method electronics_appliances
 * @param param1
 */
function electronics_appliances($param1=""){
    
    $this->loadViews('frontend/electronics_appliances', $page_data);
}
/**
 * @author Gaudencio Solivatore
 * @method fashion
 * @param param1
 */
function fashion($param1=""){
    
    $this->loadViews('frontend/fashion', $page_data);
}
/**
 * @author Gaudencio Solivatore
 * @method services
 * @param param1
 */
function services($param1=""){
    $page_data['services']=$this->m_categories->get_all(3);
    $this->loadViews('frontend/services', $page_data);
}
/**
 * @author Gaudencio Solivatore
 * @method book_trip
 * @param param1
 */
function book_trip($param1=""){
    
    $this->loadViews('frontend/book_trip', $page_data);
}
/**
 * @author Gaudencio Solivatore
 * @method book_trip
 * @param param1
 */
function book_trips($param1=""){
    
    $this->load->view('frontend/book_trips', $page_data);
}
/**
 * @author Gaudencio Solivatore
 * @method book_trip
 * @param param1
 */
function single($param1=null){
   
    if(isset($param1)){
       
        $page_data['provider']=$this->m_service_provider->get_all($param1);
    }
   
    $this->loadViews('frontend/single', $page_data);
}

/**
 * @author Gaudencio Solivatore
 * @method single_provider
 * @param param1
 */
function single_provider($param1=null){
   
    if(isset($param1)){
       
        $page_data['provider']=$this->m_service_provider->get_all($param1);
    }
   
    $this->loadViews('frontend/single_provider', $page_data);
}
/**
 * @author Gaudencio Solivatore
 * @method single_profession
 * @param param1
 */
function single_profession($param1=null){
   
    if(isset($param1)){
       
        $page_data['profession']=$this->m_professional_services->get_all($param1);
    }
   
    $this->loadViews('frontend/single_profession', $page_data);
}


/**
 * @author Gaudencio Solivatore
 * @method contact2
 * @param param1
 */
function contact_test($param1=""){
    
    $this->loadViews('contact_test', $page_data);
}
function maps(){
    $this->load->view('maps');
}


function service_option(){
    $param=$this->input->post('choice');
    if($param==1){
        redirect(base_url('page/book_trip'));
    }
    if($param==2){
        redirect(base_url('page/professional'));
    }
    if($param==3){
        redirect(base_url('page/services'));
    }

}
/**
 * @author Gaudencio Solivatore
 * @method professional
 * @param param1
 */
function professional($param1="", $param2=null, $param3=null){

    if($param1=="search"){
       $data['profession_name'] = $this->input->post('profession_name');
       $data['city'] = $this->input->post('city');
       $data['company_name'] = $this->input->post('company_name');
     
    }
    $count = $this->m_professional_services->get_professionCount();
    $returns = $this->paginationCompress ( "page/professional/", $count, 4 );
    $page_data['professions'] = $this->m_professional_services->get_profession("", $returns["page"], $returns["segment"]);
    $page_data['cities']=$this->db->get('cities')->result_array();
    $page_data['category']=$this->m_professional_services->get_category();
    $this->loadViews('frontend/professional', $page_data);
}
/**
 * @method directions
 */
public function directions()
    {
        $this->load->view('frontend/directions');
    }
/**
 * @author Gaudencio Solivatore
 * @method professional
 * @param param1
 * Limpopo
 * North west
 * Eastern Cape
 * Gauteng
 * Kwazulu Natal
 * Western Cape
 * Mpumalanga
 */
function service_provider($param1=""){
    if($param1=="search"){
        $data['service_name'] = $this->input->post('service_name');
        $data['city'] = $this->input->post('city');
        $data['anything'] = $this->input->post('anything');
        $page_data['services'] = $this->m_service_provider->get_provider($data, $returns["page"], $returns["segment"]);
     
     }else{
        $page_data['services'] = $this->m_service_provider->get_provider("", $returns["page"], $returns["segment"]);
    
     }
     $count = $this->m_service_provider->get_providerCount();
     $returns = $this->paginationCompress ( "page/service_provider/", $count, 4 );
     $page_data['cities']=$this->db->get('cities')->result_array();
     $page_data['category']=$this->m_service_provider->get_category();
     $this->loadViews('frontend/service_provider', $page_data);
}
/**
 * @author Gaudencio Solivatore
 * @method register
 * @param param1
 */
function verify_email($param1="", $param2=""){
    if($param1=="generated"){
      $page_data['password_set']=$param2;
    }
    if($param1=="submit"){
       $code=$this->input->post("code");
       $reset['email_verify']=1;
       $this->db->where('password_set',  $code);
       $this->db->update('users', $reset);
        //echo $this->email->print_debugger();
    }
    if($param1=="resend"){
        $fromname="Android Developer";
        $mailfrom=ADMIN_EMAIL;
        $tomail="gaulomail@gmail.com";
        $this->load->library('email');
        $this->email->initialize();
        $this->email->from($mailfrom, $fromname);
        $this->email->to($tomail);
        $this->email->reply_to($mailfrom, $fromname);
        $this->email->subject('Email Test');
        $this->email->message('Your Activation key is '. $param2);
        $this->email->send();
    }
    
    $this->loadViews('frontend/verify_email', $page_data);
}

    function signup($param1=""){

        if($param1=="create"){
            $data['name']=$this->input->post('fname')." ".$this->input->post('sname');
            $data['phone']=$this->input->post('phone');
            $data['email']=$this->input->post('email');
            $data['referal_code']=$this->input->post('referal_code');
            $data['level']=$this->input->post('level');
            $data['password']=getHashedPassword($this->input->post('password'));
            $data['client_id']=$this->input->post('client_id');
            if($this->user_model->general_signup($data)>0){
                $this->session->set_flashdata('flash_message' , 'added successfully');
            }
           else{
            $this->session->set_flashdata('flash_message' , 'added successfully');
           }
        }
        if($param1=="download"){
        
            $current_timestamp = strtotime("now");
            $data['created']= $current_timestamp;
            $this->db->insert('downloads',$data);
        redirect(base_url() . 'signup');

        }
    $this->loadViews('frontend/signup', $page_data);
    }


/**
 * @author Gaudencio Solivatore
 * @method Transfer Fund
 */
function fundtransfer($usertype=null){
    $page_data['page_name']  = 'fundtransfer';
    $page_data['page_title'] = "TransferFund";
    $page_data['role']=$this->session->userdata('role_id');
if ($usertype=="member"){
    $this->load->view('backend/index', $page_data);
}
if ($usertype=="admin"){
    $this->load->view('backend/index', $page_data);
}
}

/**
 * @author Gaudencio Solivatore
 * @method Transfer Fund
 */
function change_password($param1=null){
    if ($param1 == 'change') {
        $data['password']             = $this->input->post('password');
        $data['new_password']         = $this->input->post('new_password');
        $data['confirm_new_password'] = $this->input->post('confirm_new_password');
        
        $current_password = $this->db->get_where('users', array(
            'user_id' => $this->session->userdata('admin_id')
        ))->row()->password;
       
        if ((verifyHashedPassword($data['password'], $current_password)) && $data['new_password'] == $data['confirm_new_password']) {
            $this->db->where('user_id', $this->session->userdata('admin_id'));
            $this->db->update('users', array(
                'password' =>    getHashedPassword($data['new_password'])
            ));
         
    

            $this->session->set_flashdata('flash_message', get_phrase('password_updated'));
        } else {
            $this->session->set_flashdata('flash_message', get_phrase('password_mismatch'));
        }
        redirect(base_url() . 'page/change_password', 'refresh');
    }
    $page_data['page_name']  = 'change_password';
    $page_data['page_title'] = "ChangePassword";
    $page_data['role']=$this->session->userdata('role_id');
    $this->db->limit(1);
    $page_data['edit_data']  = $this->db->get_where('users', array(
        'user_id' => $this->session->userdata('admin_id')
    ))->result_array();
    $this->load->view('backend/index', $page_data);


}

/**
 * @author Gaudencio Solivatore
 * @method Transfer Fund
 */
function referralcom($usertype=null){
    $page_data['page_name']  = 'referralcom';
    $page_data['page_title'] = "ReferralCommision";
    $page_data['role']=$this->session->userdata('role_id');
if ($usertype=="member"){
    $this->load->view('backend/index', $page_data);
}
if ($usertype=="admin"){
    $this->load->view('backend/index', $page_data);
}
}
/**
 * @author Gaudencio Solivatore
 * @method Transfer Fund
 */
function binarytree($usertype=null){
    $page_data['page_name']  = 'binarytree';
    $page_data['page_title'] = "BinaryTree";
    $page_data['role']=$this->session->userdata('role_id');
if ($usertype=="member"){
    $this->load->view('backend/index', $page_data);
}
if ($usertype=="admin"){
    $this->load->view('backend/index', $page_data);
}
}
/**
 * @author Gaudencio Solivatore
 * @method Transfer Fund
 */
function binarybonus($usertype=null){
    $page_data['page_name']  = 'binarybonus';
    $page_data['page_title'] = "BinaryBonus";
    $page_data['role']=$this->session->userdata('role_id');
if ($usertype=="member"){
    $this->load->view('backend/index', $page_data);
}
if ($usertype=="admin"){
    $this->load->view('backend/index', $page_data);
}
}
/**
 * @author Gaudencio Solivatore
 * @method Transfer Fund
 */
function binarysummary($usertype=null){
    $page_data['page_name']  = 'binarysummary';
    $page_data['page_title'] = "BinarySummary";
    $page_data['role']=$this->session->userdata('role_id');
if ($usertype=="member"){
    $this->load->view('backend/index', $page_data);
}
if ($usertype=="admin"){
    $this->load->view('backend/index', $page_data);
}
}
/**
 * @author Gaudencio Solivatore
 * @method Transfer Fund
 */
function service_categories($param=null){
    $page_data['page_name']  = 'service_categories';
    $page_data['page_title'] = "Service Category";
    $page_data['role']=$this->session->userdata('role_id');

if($param=="create"){ 
    $data['name']=$this->input->post('name');
    $data['description']=$this->input->post('description');
    $data['category_id']=$this->input->post('category_id');
    $this->m_categories->add_new($data);
    $page_data['results']=$this->m_categories->get_all();
}
if ($param==2) {
    $page_data['results']=$this->m_categories->get_all(2);
}
if ($param==3){
    $page_data['results']=$this->m_categories->get_all(3);
}
$this->load->view('backend/index', $page_data);
}
/**
 * @author Gaudencio Solivatore
 * @method Transfer Fund
 */
function transactionHistory($usertype=null){
    $page_data['page_name']  = 'transactionHistory';
    $page_data['page_title'] = "TransactionHistory";
    $page_data['role']=$this->session->userdata('role_id');
if ($usertype=="member"){
    $this->load->view('backend/index', $page_data);
}
if ($usertype=="admin"){
    $this->load->view('backend/index', $page_data);
}
}
/**
 * @author Gaudencio Solivatore
 * @method Transfer Fund
 */
function fundwithdraw($usertype=null){
    $page_data['page_name']  = 'fundwithdraw';
    $page_data['page_title'] = "WithdrawFund";
    $page_data['role']=$this->session->userdata('role_id');
if ($usertype=="member"){
    $this->load->view('backend/index', $page_data);
}
if ($usertype=="admin"){
    $this->load->view('backend/index', $page_data);
}
}


     /**
      * @author Gaudencio Solivatore
      * @method faq
      */
    function faq($param1=""){
        if($param1=="download"){
        
            $current_timestamp = strtotime("now");
            $data['created']= $current_timestamp;
            $this->db->insert('downloads',$data);
        redirect(base_url() . 'faq');

        }
    $this->loadViews('frontend/faq', $page_data);
    }

     /**
      * @author Gaudencio Solivatore
      * @method post_ad
      */
    function post_ad($param1=""){
    $this->loadViews('frontend/post_ad', $page_data);
    }
    /***ADMIN ADD PRODUCT ***/
function addproduct()
{
 
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
     if($this->input->post('model')){
      $file_info = pathinfo($_FILES["result_file"]["name"]);
      $file_directory = "assets/lorekom/images/";
      $new_file_name = date("d-m-Y ") . rand(000000, 999999) .".". $file_info["extension"];
      move_uploaded_file($_FILES["result_file"]["tmp_name"], $file_directory . $new_file_name);
      $post['model']= $this->input->post('model');
      $post['sku']= $this->input->post('sku');
      $post['upc']= $this->input->post('upc');
      $post['ean']= $this->input->post('ean');
      $post['jan']= $this->input->post('jan');
      $post['isbn']= $this->input->post('isbn');
      $post['mpn']= $this->input->post('mpn');
      $post['location']= $this->input->post('location');
      $post['quantity']= $this->input->post('quantity');
      $post['price']= $this->input->post('price');
      $post['minimum']= $this->input->post('minimum');
      $post['shipping']= $this->input->post('shipping');
      $post['weight']= $this->input->post('weight');
      $post['status']= $this->input->post('status');
      $post['date_available']= $this->input->post('date_available');
      $post['manufacturer_id']= $this->input->post('manufacturer');
      $post['image']= $new_file_name;
      $this->m_products->add_product($post);
     }
    $data['page_name']  = 'addproduct';
    $data['product_type']=$this->m_products->get_product_type();
    $data['users_online']  =$this->m_data_captured->get_online_users();
    $data['page_title'] = get_phrase('admin_dashboard');
    $data['role']=$this->session->userdata('role_id');
    $this->load->view('backend/index', $data);
}

    /**
      * @author Gaudencio Solivatore
      * @method categories
      */
      function categories($param1=""){
        $this->loadViews('frontend/categories', $page_data);
        }

        /***ADMIN RECURRING ***/
        function recurring()
            {
            if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
            $page_data['page_name']  = 'recurring';
            $page_data['users_online']  =$this->m_data_captured->get_online_users();
            $page_data['page_title'] = get_phrase('admin_dashboard');
            $page_data['role']=$this->session->userdata('role_id');
            $this->load->view('backend/index', $page_data);
            }
        /***ADMIN INFORMATION ***/
        function information()
            {
            if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
            $page_data['page_name']  = 'information';
            $page_data['users_online']  =$this->m_data_captured->get_online_users();
            $page_data['page_title'] = get_phrase('admin_dashboard');
            $page_data['role']=$this->session->userdata('role_id');
            $this->load->view('backend/index', $page_data);
            }


            /***ADMIN DOWNLOADS ***/
function downloads()
{
 
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
    
    $page_data['page_name']  = 'downloads';
    $page_data['users_online']  =$this->m_data_captured->get_online_users();
    $page_data['page_title'] = get_phrase('admin_dashboard');
    $page_data['role']=$this->session->userdata('role_id');
    $this->load->view('backend/index', $page_data);
}
/***ADMIN REVIEWS ***/
function reviews()
{
 
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
    
    $page_data['page_name']  = 'reviews';
    $page_data['users_online']  =$this->m_data_captured->get_online_users();
    $page_data['page_title'] = get_phrase('admin_dashboard');
    $page_data['role']=$this->session->userdata('role_id');
    $this->load->view('backend/index', $page_data);
}


        /***ADMIN attributes ***/
        function attributes()
        {
        if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
        $page_data['page_name']  = 'attributes';
        $page_data['users_online']  =$this->m_data_captured->get_online_users();
        $page_data['page_title'] = get_phrase('admin_dashboard');
        $page_data['role']=$this->session->userdata('role_id');
        $this->load->view('backend/index', $page_data);
        }
        /***ADMIN MANUFACTURERS ***/
function manufacturers()
{
 
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
    
    $page_data['page_name']  = 'manufacturers';
    $page_data['users_online']  =$this->m_data_captured->get_online_users();
    $page_data['page_title'] = get_phrase('admin_dashboard');
    $page_data['role']=$this->session->userdata('role_id');
    $this->load->view('backend/index', $page_data);
}
        /***ADMIN OPTIONS ***/
function options()
{
 
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
    
    $page_data['page_name']  = 'options';
    $page_data['users_online']  =$this->m_data_captured->get_online_users();
    $page_data['page_title'] = get_phrase('admin_dashboard');
    $page_data['role']=$this->session->userdata('role_id');
    $this->load->view('backend/index', $page_data);
}

        /***ADMIN ATTRIBUTE GROUPS ***/
        function attribute_groups()
        {
        if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
        $page_data['page_name']  = 'attribute_groups';
        $page_data['users_online']  =$this->m_data_captured->get_online_users();
        $page_data['page_title'] = get_phrase('admin_dashboard');
        $page_data['role']=$this->session->userdata('role_id');
        $this->load->view('backend/index', $page_data);
        }

        /***ADMIN FILTERS ***/
        function filters()
            {
            if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
            $page_data['page_name']  = 'filters';
            $page_data['users_online']  =$this->m_data_captured->get_online_users();
            $page_data['page_title'] = get_phrase('admin_dashboard');
            $page_data['role']=$this->session->userdata('role_id');
            $this->load->view('backend/index', $page_data);
            }



    /**
      * @author Gaudencio Solivatore
      * @method categories
      */
      function category($param1=""){
        if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
    
    $page_data['page_name']  = 'category';
    $page_data['users_online']  =$this->m_data_captured->get_online_users();
    $page_data['page_title'] = get_phrase('admin_dashboard');
    $page_data['role']=$this->session->userdata('role_id');
    $this->load->view('backend/index', $page_data);
     }

     /**
      * @author Gaudencio Solivatore
      * @method categories
      */
      function activation_pending($param1=""){
        if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
        if($param1=="activate"){
            $user_id=$this->input->post('user_id');
            if($this->m_services->account_approve($user_id)>0){
                $this->session->set_flashdata('flash_message' , 'Account activated');
            }
            
        }
       
    
    $page_data['page_name']  = 'activation_pending';
    $page_data['pending_activations']  =$this->m_services->get_all(null, $activated=0);
    $page_data['page_title'] = get_phrase('admin_dashboard');
    $page_data['role']=$this->session->userdata('role_id');
    $this->load->view('backend/index', $page_data);
     }

     /**
      * @author Gaudencio Solivatore
      * @method categories
      */
      function activated_accounts($param1=""){
        if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
    
        if($param1=="deactivate"){
            $user_id=$this->input->post('user_id');
            if($this->m_services->account_ban($user_id)>0){
                $this->session->set_flashdata('flash_message' , 'Account deactivated');
            }
           
        }
    $page_data['page_name']  = 'activated_accounts';
    $page_data['pending_activations']  =$this->m_services->get_all(null, $approved=1);
    $page_data['page_title'] = get_phrase('admin_dashboard');
    $page_data['role']=$this->session->userdata('role_id');
    $this->load->view('backend/index', $page_data);
     }
/**
      * @author Gaudencio Solivatore
      * @method categories
      */
      function blocked_accounts($param1=""){
        if ($this->session->userdata('admin_login') != 1)
        redirect(base_url(), 'refresh');
    
        if($param1=="reactivate"){
            $user_id=$this->input->post('user_id');
            if($this->m_services->account_unban($user_id)>0){
                $this->session->set_flashdata('flash_message' , 'Account unblocked');
            }
           
        }
    $page_data['page_name']  = 'blocked_accounts';
    $page_data['pending_activations']  =$this->m_services->get_all(null, $approved=2);
    $page_data['page_title'] = get_phrase('admin_dashboard');
    $page_data['role']=$this->session->userdata('role_id');
    $this->load->view('backend/index', $page_data);
     }
   /**
      * @author Gaudencio Solivatore
      * @method terms
      */
      function terms($param1=""){
        $this->loadViews('frontend/terms', $page_data);
        }

    /**
      * @author Gaudencio Solivatore
      * @method popular_search
      */
      function popular_search($param1=""){
        $this->loadViews('frontend/popular_search', $page_data);
        }
        
    /**
      * @author Gaudencio Solivatore
      * @method feedback
      */
      function feedback($param1=""){
        $this->loadViews('frontend/feedback', $page_data);
        }
        /**
      * @author Gaudencio Solivatore
      * @method feedback
      */
      function regions($param1=""){
        $this->loadViews('frontend/regions', $page_data);
        }
        
     /**
      * @author Gaudencio Solivatore
      * @method contact
      */
    function contact($param1=""){
        
        if($param1=="send"){
           
            $name=$this->input->post('name');
            $email=$this->input->post('email');
            $cell_number=$this->input->post('cell_number');
            $message=$this->input->post('message');
            $upload=$this->input->post('upload');
            $attachment_upload="uploads/contactus/".rand(1,1000).time().$_FILES["upload"]["name"];
            move_uploaded_file($_FILES['upload']['tmp_name'], $attachment_upload.$_FILES["upload"]["name"]);
           
           $this->email_model->contact_us($name, $email, $cell_number, $message, $attachment_upload);
        }

        if($param1=="download"){
            $current_timestamp = strtotime("now");
            $data['created']= $current_timestamp;
            $this->db->insert('downloads',$data);
        redirect(base_url() . 'contact');

        }
    $this->loadViews('frontend/contact', $page_data);
    }

     /**
      * @author Gaudencio Solivatore
      * @method equity
      */
    function equity($param1=""){
        if($param1=="download"){
        
            $current_timestamp = strtotime("now");
            $data['created']= $current_timestamp;
            $this->db->insert('downloads',$data);
        redirect(base_url() . 'equity');

        }
    $this->loadViews('frontend/equity', $page_data);
    }

     /**
      * @author Gaudencio Solivatore
      * @method commodities
      */
    function commodities($param1=""){
        if($param1=="download"){
        
            $current_timestamp = strtotime("now");
            $data['created']= $current_timestamp;
            $this->db->insert('downloads',$data);
        redirect(base_url() . 'commodities');

        }
    $this->loadViews('frontend/commodities', $page_data);
    }

     /**
      * @author Gaudencio Solivatore
      * @method news
      */
    function news($param1=""){
        if($param1=="download"){
        
            $current_timestamp = strtotime("now");
            $data['created']= $current_timestamp;
            $this->db->insert('downloads',$data);
        redirect(base_url() . 'news');

        }
    $this->loadViews('frontend/news', $page_data);
    }

     /**
      * @author Gaudencio Solivatore
      * @method classified
      */
    function classified($param1=""){
        if($param1=="download"){
        
            $current_timestamp = strtotime("now");
            $data['created']= $current_timestamp;
            $this->db->insert('downloads',$data);
        redirect(base_url() . 'classified');

        }
    $this->loadViews('frontend/classified', $page_data);
    }

     /**
      * @author Gaudencio Solivatore
      * @method funds
      */
    function funds($param1=""){
        if($param1=="download"){
        
            $current_timestamp = strtotime("now");
            $data['created']= $current_timestamp;
            $this->db->insert('downloads',$data);
        redirect(base_url() . 'funds');

        }
    $this->loadViews('frontend/funds', $page_data);
    }

     /**
      * @author Gaudencio Solivatore
      * @method service
      */
    function service($param1=""){
        if($param1=="download"){
        
            $current_timestamp = strtotime("now");
            $data['created']= $current_timestamp;
            $this->db->insert('downloads',$data);
        redirect(base_url() . 'service');

        }
    $this->loadViews('frontend/service', $page_data);
    }
    
     /**
      * @author Gaudencio Solivatore
      * @method testimonials
      */
    function testimonials($param1=""){
        if($param1=="download"){
        
            $current_timestamp = strtotime("now");
            $data['created']= $current_timestamp;
            $this->db->insert('downloads',$data);
        redirect(base_url() . 'testimonials');

        }
    $this->loadViews('frontend/testimonials', $page_data);
    }
    /**
      * @author Gaudencio Solivatore
      * @method icons
      */
    function icons($param1=""){
        if($param1=="download"){
        
            $current_timestamp = strtotime("now");
            $data['created']= $current_timestamp;
            $this->db->insert('downloads',$data);
        redirect(base_url() . 'icons');

        }
    $this->loadViews('frontend/icons', $page_data);
    }
    function typography($param1=""){
        if($param1=="download"){
        
            $current_timestamp = strtotime("now");
            $data['created']= $current_timestamp;
            $this->db->insert('downloads',$data);
        redirect(base_url() . 'typhography');

        }
    $this->loadViews('frontend/typography', $page_data);
    }
    function about($param1=""){
        if($param1=="download"){
        
            $current_timestamp = strtotime("now");
            $data['created']= $current_timestamp;
            $this->db->insert('downloads',$data);
        redirect(base_url() . 'about');

        }
    $this->loadViews('frontend/about', $page_data);
    }
    function how_it_works($param1=""){
        if($param1=="download"){
        
            $current_timestamp = strtotime("now");
            $data['created']= $current_timestamp;
            $this->db->insert('downloads',$data);
        redirect(base_url() . 'how_it_works');

        }
    $this->loadViews('frontend/how_it_works', $page_data);
    }

    function ipo($param1=""){
        if($param1=="download"){
        
            $current_timestamp = strtotime("now");
            $data['created']= $current_timestamp;
            $this->db->insert('downloads',$data);
        redirect(base_url() . 'ipo');

        }
    $this->loadViews('frontend/ipo', $page_data);
    }
    function sitemap($param1=""){
        if($param1=="download"){
        
            $current_timestamp = strtotime("now");
            $data['created']= $current_timestamp;
            $this->db->insert('downloads',$data);
        redirect(base_url() . 'sitemap');

        }
    $this->loadViews('frontend/sitemap', $page_data);
    }
    /**
     * The following function updates the devices table
     */
    function device_connect($encrypt="", $imei=""){
        $this->load->model('m_data_captured');
       
            try {
               
                $this->m_data_captured->device_authenticate($encrypt, $imei);
            } catch (Exception $e) {
                echo 'Caught exception: ',  $e->getMessage(), "\n"; 
            }   
    }
     /**
     * The following function updates the devices table
     */
    function check_connectivity($encrypt="", $imei=""){
        $this->load->model('m_data_captured');
       
            try {
               
                $this->m_data_captured->check_connectivity($encrypt, $imei);
            } catch (Exception $e) {
                echo 'Caught exception: ',  $e->getMessage(), "\n"; 
            }   
    }


 /**
     * The following function updates the devices table
     */
    function get_familylist($date=''){
        $this->load->model('m_data_captured');
       
            try {
               
               echo $this->m_data_captured->get_familylist($date);
            } catch (Exception $e) {
                echo 'Caught exception: ',  $e->getMessage(), "\n"; 
            }   
    }
    
/**
     * The following function updates the devices table
     */
    function get_learnerlist($date=''){
        $this->load->model('m_data_captured');
       
            try {
               
               echo $this->m_data_captured->get_learnerlist($date);
            } catch (Exception $e) {
                echo 'Caught exception: ',  $e->getMessage(), "\n"; 
            }   
    }
    


    //function to encrypt passwords
    function password_setup(){
        $password= md5(rand(10,200000));
        return $password;
    }
    //function to compare passwords
    function compare_password(){
        if (verifyHashedPassword('password', '$2y$10$/NMtmepPdwGAKfhTG.5Uker.osBQUI3OgVsnmp92dZpIfp.Q3wCWq')) {
            echo "yes";
        }
        else{
            echo "no";
        };
    }
    //function that returns company logo
    function imageRequest($client_id=''){
        if (($client_id)==null){
            echo base_url()."uploads/clients_image/logo.png";
        }else{
            echo base_url()."uploads/clients_image/".$client_id.".jpg"; 
        }
    }
}

