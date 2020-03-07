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
class m_users extends CI_Model {
    private $table_name = 'users';
   

   

    function __construct() {
        parent::__construct();
        $this->load->library('email');
        $this->load->database('default');
    }

    /**
     * @method addNew
     * @param data
     * @return array
     */
    public function addNew($data=null){
        $terms['terms']=$data['terms'];
        //To user creation
        $addNew['fullname']= $data['fullname'];
        $addNew['surname']= $data['surname'];
        $addNew['password']= $data['password'];
        $addNew['level']= $data['level'];
        $addNew['email']=$data['email'];
        $addNew['country']= $data['country'];
        $addNew['cellphone']= $data['cellphone'];
        $addNew['province']= $data['province'];
          
        $this->db->insert($this->table_name, $addNew);
        return $this->db->insert_id();
       
    }

    /**
     * @method activate_by_key
     * @param key
     * @return array
     */
    function activate_by_key($key=null){
     
        $data['activated']=1;
        $this->db->where('authentication_key', $key);
        $this->db->update($this->table_name, $data);
        return $this->db->affected_rows();

    }
    /**
     * @method count_all
     * @return count
     * 
    */
    function count_all(){
        $this->db->from($this->table_name);
        return $this->db->count_all_results();
      }

    /**
     * @method get_name_by_id
     * @param user_id
     */
    function get_name_by_id($userid=null){
       $this->db->where('user_id', $userid);

        $query=$this->db->get($this->table_name);
        if($query->num_rows()>0){
            return $query->row();
        }
    }
    
}
