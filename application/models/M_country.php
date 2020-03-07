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
class m_country extends CI_Model {
    private $table_name = 'country';
   

   

    function __construct() {
        parent::__construct();
        $this->load->library('email');
        $this->load->database('default');
    }


    public function addNew($data=null){
        $terms['terms']=$data['terms'];
        $dist['distributor_code']=$data['distributor_code'];
        $site['site_name']= $data['site_name'];
        $sitecode['unitcode']= $data['unitcode'];
        $automated['automated_email']= $data['automated_email'];
        $client['company_name']= $data['company_name'];

        $addNew['fullname']= $data['fullname'];
        $addNew['password']= $data['password'];
        $addNew['level']= ROW_EMPLOYEE;
        $addNew['email']=$data['email'];
        $addNew['cellphone']= $data['cellphone'];
       
        $this->db->insert($this->table_name, $addNew);
        return $this->db->insert_id();
       
    }
    function get_all_names(){
        $this->db->select('country_id,name, iso_code_2');
        $query=$this->db->get($this->table_name);
        return $query->result();
    }
    function count_all(){
        $this->db->from($this->table_name);
        return $this->db->count_all_results();
      }
    function get_name_by_id($userid=null){
       $this->db->where('user_id', $userid);

        $query=$this->db->get($this->table_name);
        if($query->num_rows()>0){
            return $query->row();
        }
    }
    
}
