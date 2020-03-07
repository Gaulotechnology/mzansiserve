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
class m_categories extends CI_Model {
    private $table_name = 'sub_category';
   

   

    function __construct() {
        parent::__construct();
        $this->load->library('email');
        $this->load->database('default');
    }


    public function add_new($data=null){  
        $this->db->insert($this->table_name, $data);
        return $this->db->insert_id();
       
    }
    function get_name_by_id($userid=null){
       $this->db->where('user_id', $userid);

        $query=$this->db->get($this->table_name);
        if($query->num_rows()>0){
            return $query->row();
        }
    }
      function count_all(){
        $this->db->from($this->table_name);
        return $this->db->count_all_results();
      }
      /**
       * Fetch all names
       */
    function get_all_names(){
        $this->db->select('id,name');
        $query=$this->db->get($this->table_name);
        return $query->result();
    }

    /**
     * Fetch all records
     */
    function get_all($category_id=null){
      if(isset($category_id)){
        $this->db->where('category_id', $category_id);
      }
        $query=$this->db->get($this->table_name);
        return $query->result();
    }
    
}
