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
class m_card_type extends CI_Model {
    private $table_name = 'card_types';
   

   

    function __construct() {
        parent::__construct();
        $this->load->library('email');
        $this->load->database('default');
    }


    public function addNew($data=null){
       
        $addNew['name']= $data['name'];
          
        $this->db->insert($this->table_name, $addNew);
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
    /**
     * @method get_all
     */
    function get_all(){
         $query=$this->db->get($this->table_name);
         if($query->num_rows()>0){
             return $query->result();
         }
     }
    
}
