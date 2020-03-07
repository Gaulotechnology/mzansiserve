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
class m_payment_details extends CI_Model {
    private $table_name = 'payment_details';
   

   

    function __construct() {
        parent::__construct();
        $this->load->library('email');
        $this->load->database('default');
    }


    public function addNew($data=null){
       
        $data['created']=time();
        $this->db->insert($this->table_name, $data);
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
    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function cardsListingCount()
    {
        $this->db->select('A.*, B.name card_name');
        $this->db->join('card_types B','B.id=A.card_type','LEFT');
        $query = $this->db->get($this->table_name." A");
        return count($query->result());
    }
    /**
     * @author Gaudencio Solivatore
     * @method add_card()
     */
    function add_card($posts=null){
		$this->db->insert($this->table_name, $posts);
		return $this->db->affected_rows();
	  }
    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function searchListingCount($card_type=null, $user_id=null)
    {
        $this->db->select('A.*, B.name card_name');
            $this->db->join('card_types B','B.id=A.card_type','LEFT');
        if(isset($card_type)){
            $this->db->where('A.card_type', $card_type);
        }
        if(isset($product_category)){
            $this->db->where('A.user_id', $user_id);
        }
        $query = $this->db->get($this->table_name." A");
        return count($query->result());
    }
    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function cardsListing($page=null, $segment=null, $user_id=null)
    {
            $this->db->select('A.*, B.name card_name');
            $this->db->join('card_types B','B.id=A.card_type');
            if(isset($user_id)){
                $this->db->where('user_id',  $user_id);
            }
            $this->db->limit($page, $segment);
            $query=$this->db->get($this->table_name." A");
            if($query && $query->num_rows()>0){
                return $query->result();
            }
    }
    

    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function delete_cards($data){
        foreach ($data as $deb) {
            $this->db->where('id', $deb);
            $this->db->delete($this->table_name);
            return $this->db->affected_rows();
        }
    }
    
}
