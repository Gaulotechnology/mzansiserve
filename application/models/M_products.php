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
class m_products extends CI_Model {
    private $table_name = 'product';
    private $product_description="product_description";
    private $table_model="model";
    private $table_manufacturer="manufacturer";
   

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
    function get_all($product_id=null){
      if(isset($product_id)){
        $this->db->where('product_id', $category_id);
      }
        $this->db->select('des.*, cat.*, product.*, raw.name category');
        $this->db->join('product_description des','des.product_id=product.product_id','LEFT');
        $this->db->join('product_to_category cat','cat.product_id=product.product_id','LEFT');
        $this->db->join('category_description raw','raw.category_id=cat.category_id','LEFT');
        $query=$this->db->get($this->table_name);
        return $query->result();
    }

/**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function delete_products($data){
        foreach ($data as $deb) {
            $this->db->where('product_id', $deb);
            $this->db->delete('product');
            return $this->db->affected_rows();
        }
    }
    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function productListingCount()
    {
        $this->db->select('des.*, cat.*, product.*, raw.name category');
        $this->db->join('product_description des','des.product_id=product.product_id','LEFT');
        $this->db->join('product_to_category cat','cat.product_id=product.product_id','LEFT');
        $this->db->join('category_description raw','raw.category_id=cat.category_id','LEFT');
        $query = $this->db->get($this->table_name);
        return count($query->result());
    }
    /**
     * @author Gaudencio Solivatore
     * @method add_product()
     */
    function add_product($posts=null){
		$this->db->insert("product", $posts);
		return $this->db->affected_rows();
	  }
    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function searchListingCount($product_brand=null, $product_category=null)
    {
        $this->db->select('des.*, cat.*, product.*, raw.name category');
        $this->db->join('product_description des','des.product_id=product.product_id','LEFT');
        $this->db->join('product_to_category cat','cat.product_id=product.product_id','LEFT');
        $this->db->join('category_description raw','raw.category_id=cat.category_id','LEFT');
        if(isset($product_brand)){
            $this->db->where('B.name', $product_brand);
        }
        if(isset($product_category)){
            $this->db->where('C.name', $product_category);
        }
        $query = $this->db->get($this->table_name);
        return count($query->result());
    }
    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function productListing($page=null, $segment=null)
    {
      
            $this->db->select('des.*, cat.*, product.*, raw.name category');
            $this->db->join('product_description des','des.product_id=product.product_id','LEFT');
            $this->db->join('product_to_category cat','cat.product_id=product.product_id','LEFT');
            $this->db->join('category_description raw','raw.category_id=cat.category_id','LEFT');
            $this->db->limit($page, $segment);
            $query=$this->db->get($this->table_name);
            if($query && $query->num_rows()>0){
                return $query->result();
            }
    }
    /**
     * @author Gaudencio Solivatore
     * @method get_products()
     * @return array result
     */
    function get_products(){
        $query=$this->db->get($this->table_products);
        if($query && $query->num_rows()>0){
            return $query->result();
        }
    }
    /**
     * @author Gaudencio Solivatore
     * @method get_product_type()
     * @return array result
     */
    function get_product_type(){
        $query=$this->db->get($this->table_model);
        if($query && $query->num_rows()>0){
            return $query->result();
        }
    }
     /**
     * @author Gaudencio Solivatore
     * @method  get_manufacturerName()
     * @return array result
     */
    function get_manufacturerName($manufacturerID=null){
        $query=$this->db->query("SELECT name FROM manufacturer WHERE manufacturer_id='$manufacturerID'");
        return $query->row()->name;
    }
    /**
     * @author Gaudencio Solivatore
     * @method  get_brands()
     * @return array result
     */
    function get_brands(){
        $query=$this->db->query("SELECT name FROM manufacturer");
        return $query->result();
    }
     /**
     * @author Gaudencio Solivatore
     * @method  get_recent_products()
     * @return array result
     */
    function get_recent_products(){
        $query=$this->db->query("SELECT * FROM product order by product_id DESC LIMIT 4");
        if($query && $query->num_rows()>0){
            return $query->result();
        }
    }
     /**
     * @author Gaudencio Solivatore
     * @method  search_products()
     * @return array result
     */
    function search_products($product_brand=null, $product_type=null, $page=null, $segment=null){
        $this->db->select('des.*, cat.*, product.*, raw.name category');
        $this->db->join('product_description des','des.product_id=product.product_id','LEFT');
        $this->db->join('product_to_category cat','cat.product_id=product.product_id','LEFT');
        $this->db->join('category_description raw','raw.category_id=cat.category_id','LEFT');
        $this->db->limit($page, $segment);
        $query=$this->db->get($this->table_name);
        if($query && $query->num_rows()>0){
            return $query->result();
        }
    }
    /**
     * @author Gaudencio Solivatore
     * @method  counts_products()
     * @return array result
     */
    function counts_products(){
       return $this->db->count_all($this->table_name);
    }
    
}
