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
class m_car_type extends CI_Model {
    private $table_name = 'vehicles';
   

   

    function __construct() {
        parent::__construct();
        $this->load->library('email');
        $this->load->database('default');
    }
    /**
     * @method getUserNamePhoneQuery
     * @param user_id
     */
    function getUserNamePhoneQuery($user_id=null){
        $this->db->select('user_name, phone');
        $this->db->where('user_id', $user_id);
        $query=$this->db->get('users');

        return $query->row();
    }

    /**
     * @method getNearbyCabs
     */
    function getNearbyCabs($src_lat=null, $src_lng=null){
        $this->db->select('cabs.*, drivers.*, users.*');
        $this->db->order_by("(cab_lat-$src_lat)*(cab_lat-$src_lat) + (cab_lng-$src_lng)*(cab_lng-$src_lng)");
        $this->db->where('on_trip', 0);
        $this->db->where('on_duty', 1);
        $this->db->join('cabs','cabs.cab_no=drivers.cab_no');
        $this->db->join('users','users.user_id=drivers.driver_id');
        $this->db->limit(1);
        $query=$this->db->get('drivers');
        
        return $query->row();
    }
    /**
     * @method updateCabLocationQuery
     * @param cad_lat
     * @param cab_lng
     * @param cab_bearing
     * @param cab_no
     */
    function updateCabLocationQuery($cab_lat=null, $cab_lng=null, $cab_bearing=null, $cab_no=null){
        $query=$this->db->query("UPDATE cabs SET cab_lat='$cab_lat', cab_lng='$cab_lng', cab_bearing='$cab_bearing' WHERE cab_no='$cab_no'");
        return $this->db->affected_rows();
    }

    /**
     * @method startRideQuery
     * @param ride_id
     */
    function startRideQuery($ride_id=null){
        $query=$this->db->query("UPDATE rides SET status=1 WHERE ride_id='$ride_id'");

        return $this->db->affected_rows();
    }

    /**
     * @method book_ride_query
     * @param array
     */
    function book_ride_query($data=null){
        $this->db->insert('rides', $data);
        return $this->db->insert_id();

    }
    /**
     * @method getcurrentPosition
     */
    function getCurrentPosition($cab_id=null){

        $query=$this->db->query("SELECT cab_lat, cab_lng, cab_bearing FROM cabs WHERE cab_id='$cab_id'");

        return $query->row();
    } 
    /**
     * @method getCurrentRide
     * @param driver_id
     */
    function getCurrentRide($driver_id=null){
        $query=$this->db->query("SELECT 
        ride_id, 
        cab_id, 
        src_lat, 
        src_lng, 
        dest_lat, 
        dest_lng, 
        fare, 
        otp, 
        user_name, 
        users.cellphone customer_phone 
        from rides, users, cabs, drivers 
        WHERE rides.driver_id='$driver_id' and rides.user_id=users.user_id 
        and cabs.cab_no=drivers.cab_no and rides.status=1 LIMIT 1");

        return $query->row();


    }
    /**
     * @method endRideQuery
     * @param ride_id
     */
    function endRideQuery($ride_id=null){
        $this->db->query("UPDATE rides SET status=2 WHERE ride_id='$ride_id'");
        return $this->db->affected_rows();
    }
    /**
     * @method endRideQuery2
     * @param cab_id
     */
    function endRideQuery2($cab_id=null){
        $this->db->query("UPDATE cabs SET on_trip=0 WHERE cab_id='$cab_id'");
        return $this->db->affected_rows();
    }

    /**
     * @method setOneSignalId
     * @param one_signal_id
     * @param driver_id
     */
    function setOneSignalId($one_signal_id=null, $driver_id=null){
    $this->db->query("UPDATE drivers SET one_signal_id='$one_signal_id' WHERE driver_id='$driver_id'");
    return $this->db->affected_rows();
    }
    /**
     * @method cancel_ride
     * @param ride_id
     */
    function cancel_ride($ride_id=null){
        $data['status']=4;
        $this->db->where('ride_id', $ride_id);
        $this->db->update('rides', $data);
        return $this->db->affected_rows();
    }
    /**
     * @method cancel_cab
     * @param cab_id
     */
    function cancel_cab($cab_id=null){
        $data['on_trip']=0;
        $this->db->where('cab_id', $cab_id);
        $this->db->update('cabs', $data);
        return $this->db->affected_rows();
    }
    /**
     * @method getRideStatus
     * @param ride_id
     */
    function getRideStatus($ride_id=null){
        $this->db->select('status');
        $this->db->where('ride_id', $ride_id);
        $this->db->where('(status=1 or status=2)');
        $query=$this->db->get('rides');
        return $query->num_rows();
    }
    /**
     * @method change_on_trip_query
     */
    function change_on_trip_query($cab_id=null){
        $data['on_trip']=1;
        $this->db->where('cab_id', $cab_id);
        $this->db->update('cabs', $data);
        return $this->db->affected_rows();

    }
    /**
    * @method addNew
    * @param array
    */
    function addNew($data=null){
       
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
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function carsListing($page=null, $segment=null, $user_id=null)
    {
            $this->db->select('A.*, B.*');
            $this->db->join('users B','B.user_id=A.user_id');
            if(isset($user_id)){
                $this->db->where('B.user_id',  $user_id);
            }
            $this->db->limit($page, $segment);
            $query=$this->db->get($this->table_name." A");
            if($query && $query->num_rows()>0){
                return $query->result();
            }
    }
    

    /**
     * @method get_all
     */
    function get_all(){
        $cars[]="MAZDA";
        $cars[]="NISSAN";
        $cars[]="BMW";
        $cars[]="MERCEDES";
        $cars[]="VW";
        $cars[]="OPEL";
        $cars[]="JEEP";
        $cars[]="MAHiNDRA";
        $cars[]="TOYOTA";
        $cars[]="FORD";
        $cars[]="CHRYSTLER";
        $cars[]="FERRARI";
        $cars[]="AUDI";
        $cars[]="BENTELY";
return $cars;
     }
     /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function delete_cars($data){
        foreach ($data as $deb) {
            $this->db->where('id', $deb);
            $this->db->delete($this->table_name);
            return $this->db->affected_rows();
        }
    }
    
}
