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
class m_documents extends CI_Model {
    private $table_name = 'identity_docs';
    private $table_users = 'identity_docs';
   

   

    function __construct() {
        parent::__construct();
        $this->load->library('email');
        $this->load->database('default');
    }

    /**
    * @method addNew
    */
    public function addNew($data=null){
      
       if (isset($data['user_id'])) {
           if ($this->check_record_exists($data['user_id'])) {
               $data['updated'] = time();
               $this->db->where('user_id', $data['user_id']);
               $this->db->update($this->table_name, $data);
               
               return $this->db->affected_rows();
           } else {
               $data['created']=time();
               $this->db->insert($this->table_name, $data);
               return $this->db->insert_id();
           }
       }
       return null;
    }
    
    /**
     * @method check_record_exists
     */
    function check_record_exists($user_id=null){
        $this->db->where('user_id', $user_id);
        $query=$this->db->get($this->table_name);

        return $query->num_rows()>0;
    }

    /**
     * @method count_all
     */
    function count_all(){
        $this->db->from($this->table_name);
        return $this->db->count_all_results();
      }

    /**
     * @method get_name_by_id
     */
    function get_name_by_id($id=null){
       $this->db->where('id', $id);

        $query=$this->db->get($this->table_name);
        if($query->num_rows()>0){
            return $query->row();
        }
    }
    /**
     * @method get_all
     */
    function get_all(){
         $query=$this->db->get($this->table_name);
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
    
}
