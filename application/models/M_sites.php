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
class m_sites extends CI_Model {
    private $table_name = 'sites';
    private $table_locations = 'locations';
   

   

    function __construct() {
        parent::__construct();
        $this->load->library('email');
        $this->load->database('default');
    }
/**
 * @method get_locations
 * @return return
 */
function get_locations(){

  return $this->db->get($this->table_locations)->result();
}
/**
 * @method addNew
 * @param data
 * @return array
 */   
function addNew($data=null){
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
    /**
     * @method get_name_by_id
     * @param userid
     */
    function get_name_by_id($userid=null){
       $this->db->where('user_id', $userid);

        $query=$this->db->get($this->table_name);
        if($query->num_rows()>0){
            return $query->row();
        }
    }

    /**
     * @method count_all
     * @return count
     */
    function count_all(){
        $this->db->from($this->table_name);
        return $this->db->count_all_results();
      }
        /**
         * @method  active_sites
         * @return count
         */
      function active_sites(){
        $this->db->where('active', 1);
        $this->db->from($this->table_name);
        return $this->db->count_all_results();
      }
      /**
       * @method inactive_sites
       * @return count
       */
      function inactive_sites(){
        $this->db->where('active', 0);
        $this->db->from($this->table_name);
        return $this->db->count_all_results();
      }

      /**
        * @method get_all_names
        * @return array
        */
    function get_all_names(){
        $this->db->select('id,name');
        $query=$this->db->get($this->table_name);
        return $query->result();
    }
    
}
