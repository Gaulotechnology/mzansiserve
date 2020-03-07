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
class m_service_provider extends CI_Model {
    private $table_name = 'service_provider';
    private $table_descriptions = 'service_descriptions';
    private $table_images = 'service_images';
    private $table_users = 'users';
    private $table_category = 'category';
   

   

    function __construct() {
        parent::__construct();
        $this->load->library('email');
        $this->load->database('default');
    }

    /**
     * Fetch all records
     */
    function get_provider($searchText = '', $page, $segment){
        $this->db->select('A.*, B.*, C.*, D.*');
        $this->db->from($this->table_name.' as A');
        $this->db->join('service_descriptions as B', 'B.provider_id=A.id');
        $this->db->join('users as C', 'C.user_id=A.user_id');
        $this->db->join('identity_docs as D', 'D.user_id=B.user_id' );
        if(!empty($searchText)) {
            if(isset($searchText['anything'])){
                echo $searchText['anything'];
                $likeCriteria = "(A.service_name  LIKE '%".$searchText['anything']."%'
                                OR  B.title  LIKE '%".$searchText['anything']."%')";
                $this->db->where($likeCriteria);
            }
           
        }

        $this->db->limit($page, $segment);
        $query = $this->db->get();
        //echo $this->db->last_query();
      
        $result = $query->result();
        return $result;
      }

      function get_category(){
          $this->db->where('id', '3');
          return $this->db->get($this->table_category)->row();
      }
      /**
     * Fetch all records
     */
    function get_providerCount($searchText = ''){
        $this->db->select('A.*, C.province, C.country');
        $this->db->from($this->table_name.' as A');
        $this->db->join('service_descriptions as B', 'B.provider_id=A.id','LEFT');
        $this->db->join('users as C', 'C.user_id=B.user_id' );
        if(!empty($searchText)) {
            $likeCriteria = "(A.service_name  LIKE '%".$searchText."%'
                            OR  B.title  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $query = $this->db->get();
        $result = $query->num_rows();
        return $result;
      }


    public function addNew($data=null){
        if ($this->check_record_exists($data['user_id'])) {
            $this->db->where('user_id', $data['user_id']);
            $this->db->update($this->table_name, $data);
            return $this->db->affected_rows();
        }else{
            $data['created']=time();
            $this->db->insert($this->table_name, $data);
            return $this->db->insert_id();
        }
       
    }

    function check_record_exists($user_id=null){
        $this->db->where('user_id', $user_id);
        $query=$this->db->get($this->table_name);
        return $query->num_rows()>0;
    }
    /**
     * @method addDescription
     */
    public function addDescription($data=null, $pID=null){
       if($this->check_description_exists($data['user_id'])){
        $this->db->where('id',  $pID);
        $this->db->update($this->table_descriptions, $data);
        return $this->db->affected_rows();
       }
       else{
        $data['created']=time();
        $this->db->insert($this->table_descriptions, $data);
        return $this->db->insert_id();
       
       }
        
    }
    function check_description_exists($user_id=null){
        $this->db->where('user_id', $user_id);
        $query=$this->db->get($this->table_descriptions);
        return $query->num_rows()>0;
    }
    /**
     * @method addImages
     */
    public function addImages($data=null){
       
        $data['created']=time();
        $this->db->insert($this->table_images, $data);
        return $this->db->insert_id();
       
    }
    /**
     * @method count_all
     * @return array
     */
    function count_all(){
        $this->db->from($this->table_name);
        return $this->db->count_all_results();
      }
      /**
       * @method get_name_by_id
       * @param id
       * @return array
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
     * @param id
     * @param activated
     * @return array
     */
    function get_all($id=null, $activated=null){
        if(isset($id)){
            $this->db->where('B.provider_id', $id);
            $this->db->limit(1);
        }
        if(isset($activated)){
            $this->db->where('A.activated', $activated);
        }
        $this->db->select('A.*, B.*, C.*, D.*, E.*, B.created ad_date');
         $this->db->join('service_descriptions B', 'B.user_id=A.user_id');
         $this->db->join('service_images C', 'C.user_id=A.user_id');
         $this->db->join('service_provider D', 'D.user_id=A.user_id','LEFT');
         $this->db->join('identity_docs E', 'E.user_id=A.user_id','LEFT');
         $query=$this->db->get($this->table_users." A");
        
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
    function serviceListingCount()
    {
        $this->db->select('A.*, B.*');
        $this->db->join('users B','B.user_id=A.user_id','LEFT');
        $query = $this->db->get($this->table_name." A");
        return count($query->result());
    }
     /**
     * @author Gaudencio Solivatore
     * @method add_card()
     */
    function add_service($posts=null){
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
        $this->db->select('A.*, B.*');
            $this->db->join('users B','B.user_id=A.user_id','LEFT');
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
    function serviceListing($page=null, $segment=null,$user_id=null)
    {
       
        $this->db->select('A.*, B.*, C.*, D.*, E.*, B.id pID , D.id prod');
        $this->db->join('service_descriptions B', 'B.user_id=A.user_id','LEFT');
        $this->db->join('service_images C', 'C.user_id=A.user_id','LEFT');
        $this->db->join('service_provider D', 'D.user_id=A.user_id','LEFT');
        $this->db->join('identity_docs E', 'E.user_id=A.user_id','LEFT');
        if(isset($user_id)){
            $this->db->where('A.user_id', $user_id);
            $this->db->limit(1);
        }else{
            $this->db->limit($page, $segment);
        }
       
       
          
            $query=$this->db->get($this->table_users." A");
            if($query && $query->num_rows()>0){
                return $query->result();
            }
    }
    

    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function delete_service($data){
        foreach ($data as $deb) {
            $this->db->where('id', $deb);
            $this->db->delete($this->table_name);
            return $this->db->affected_rows();
        }
    }
    
    
}
