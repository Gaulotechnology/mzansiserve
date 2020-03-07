<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*	
 *	@author 	: Gaudencio Solivatore
 *	date		: 27 september, 2014
 *	Android Device Management Prp
 *	
 *	gaulomail@gmail.com
 */

class Api extends CI_Controller
{
     private $src_lat;
     private $src_lng;
     private $dest_lat;
     private $dest_lng;
     private $user_id;
 
     private $customer_name;
     private $customer_phone;
     private $one_signal_id;
     private $fare;
     private $otp;
     private $ride_id;
     private $driver_id;
     private $cab_id;

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    /***default functin, redirects to login page if no admin logged in yet***/
    public function index()
    {
        $this->load->view('backend/install');
    }
    
    function login(){
        {
            $email=$this->input->post('email');
            $password=$this->input->post('password');
            $this->db->where('email',urldecode($email));
            $query=$this->db->get('users');
            
            if ($query->num_rows()>0) {
                $r=$query->row_array();
    
                if (verifyHashedPassword(urldecode($password), $r['password'])) {
                    $response=array(
                    "status"=>"1",
                    "data"=>array(
                        "id"=>$r['user_id'],
                        "fullname"=>$r['fullname'],
                        "surname"=>$r['surname'],
                        "email"=>$r['email'],
                        "country"=>$r['country'],
                        "province"=>$r['province'],
                        "level"=>$r['level'],
                        "cellphone"=>$r['cellphone']
                        )
                    );
                    echo(json_encode($response));
                }
            }
            else{
                $response=array(
                    "status"=>"0",
                    "data"=>"Wrong Email/Password"
                    );
                echo(json_encode($response));
            }
        }
    }

    /**
     * @method book_cab
     */
    function book_cab(){
    $this->src_lat=$this->input->post('src_lat');
	$this->src_lng=$this->input->post('src_lng');
	$this->dest_lat=$this->input->post('dest_lat');
	$this->dest_lng=$this->input->post('dest_lng');
    $this->user_id=$this->input->post('user_id');
    $customer=$this->m_car_type->getUserNamePhoneQuery($this->user_id);
    $this->customer_name=$customer->user_name;
    $this->customer_phone=$customer->phone;
    $getNearbyCabs=$this->m_car_type->getNearbyCabs($this->src_lat, $this->src_lng);
    if(isset($getNearbyCabs)){

		$this->driver_id=$book['driver_id']=$getNearbyCabs->driver_id;
        $this->cab_id=$getNearbyCabs->cab_id;
        $book['src_lat']=$this->src_lat;
        $book['src_lng']=$this->src_lng;
        $book['dest_lat']=$this->dest_lat;
        $book['dest_lng']=$this->dest_lng;
        $book['user_id']=$this->user_id;
        $this->one_signal_id=$getNearbyCabs->one_signal_id;
		// echo($one_signal_id);
        $this->otp=$book['otp']=rand(1000, 9999);
		$book['fare']=sqrt(($this->dest_lat-$this->src_lat)*($this->dest_lat-$this->src_lat)+($this->dest_lng-$this->src_lng)*($this->dest_lng-$this->src_lng))*111*20;
        $this->fare=$book['fare']=(int) $book['fare'];
       
		// echo($fare);
		// echo('<br>'.$otp);
        $book['booked_at']=time();

        $this->ride_id=$this->m_car_type->book_ride_query($book);
        $change_on_trip_result=$this->m_car_type->change_on_trip_query($this->cab_id);
        if( $this->ride_id>0 && $change_on_trip_result){
            $response = $this->sendMessage();
            $response=array(
                "status"=>"1",
                "data"=>array(
                        "ride_id"=>$this->ride_id,
                        "cab_lat"=>$getNearbyCabs->cab_lat,
                        "cab_lng"=>$getNearbyCabs->cab_lng,
                        "cab_id"=>$getNearbyCabs->cab_id,
                        "driver_name"=>$getNearbyCabs->fullname,
                        "driver_phone"=>$getNearbyCabs->cellphone,
                        "cab_no"=>$getNearbyCabs->cab_no,
                        "fare"=>$this->fare,
                        "otp"=>$this->otp
                        )
                );
            die(json_encode($response));
 
        }else{
            $response=array(
                "status"=>"0",
                "data"=>"Unable to book ride"
                );
            die(json_encode($response));
        }
        
    }
    else
		{
			$response=array(
				"status"=>"0",
				"data"=>"Unable to book ride"
				);
			die(json_encode($response));	
		}

    }


    /**
     * @method sendMessgae
     */
    function sendMessage(){

        $heading=array(
            "en" => 'Near Cabs Booking'
            );

        $content = array(
            "en" => 'You have got a new ride booking.'
            );
        

             $fields = array(
              'app_id' => "cac81f77-8e1f-4589-a434-87a83f186f65",
              'include_player_ids' => array($this->one_signal_id),
              'data' => array("customerName" => $this->customer_name, "customerPhone"=>$this->customer_phone, "src_lat" => $this->src_lat, "src_lng" => $this->src_lng, "dest_lat"=>$this->dest_lat, "dest_lng" => $this->dest_lng, "fare" => $this->fare, "otp" => $this->otp, "ride_id" => $this->ride_id, "cab_id" => $this->cab_id),
              'small_icon' => 'https://lh3.googleusercontent.com/TzYz9McRVy8fD_WnpKiCK5anw20So6eyPR9ti-LwTd_QIer8BpAg8cMkRoO4sUv2xCDw=w300-rw',
              'large_icon' => 'https://lh3.googleusercontent.com/TzYz9McRVy8fD_WnpKiCK5anw20So6eyPR9ti-LwTd_QIer8BpAg8cMkRoO4sUv2xCDw',

                    'headings' => $heading,
                    'contents' => $content
                );
        
        $fields = json_encode($fields);
    // print("\nJSON sent:\n");
    // print($fields);
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
                                                   'Authorization: Basic OGIzOGE3MjgtYTQ4Ni00ODI1LWI5NjktMjRkZWM0ZjFhMjZl'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);
        curl_close($ch);
        
        return $response;
    }

    /**
     * @method cancel_book_cab
     * @param post array
     */
    function cancel_book_cab(){

    $this->ride_id=$this->input->post('ride_id');
	$this->cab_id=$this->input->post('cab_id');

	$getRideStatus=$this->m_car_type->getRideStatus($this->ride_id);

	if ($getRideStatus==0) {
		$cancelCabQuery=$this->m_car_type->cancel_ride($this->ride_id);
		$cancelCabQuery2=$this->m_car_type->cancel_cab($this->cab_id);
		
		
		if ($cancelCabQuery>0 && $cancelCabQuery2>0) {
				$response=array(
					"status"=>"1",
					"data"=>"Booking Cancelled"
					);
				die(json_encode($response));	
		}
		else
		{
			$response=array(
				"status"=>"0",
				"data"=>"Unable to cancel ride"
				);
			die(json_encode($response));	
		}

	}
	else
	{
		$response=array(
			"status"=>"0",
			"data"=>"Unable to cancel ride"
			);
		die(json_encode($response));	
	}

    }
    /**
     * @method check_current_booking
     * @param post array
     */
    function check_current_booking(){
        $this->driver_id=$this->input->post('driver_id');
        $getCurrentRide=$this->m_car_type->getCurrentRide($this->driver_id);
       
        if (isset($getCurrentRide)) {
            
            $response=array(
                "status"=>"1",
                "data"=> array("customerName" =>  $getCurrentRide->user_name,
                "customerPhone"=> $getCurrentRide->customer_phone,
                "src_lat" =>  $getCurrentRide->src_lat,
                "src_lng" =>  $getCurrentRide->src_lng, 
                "dest_lat"=> $getCurrentRide->dest_lat, 
                "dest_lng" =>  $getCurrentRide->dest_lng, 
                "fare" =>  $getCurrentRide->fare, 
                "otp" =>  $getCurrentRide->otp, 
                "ride_id" =>  $getCurrentRide->ride_id, 
                "cab_id" =>  $getCurrentRide->cab_id)
                );
            die(json_encode($response));	
        }
        else
        {
            $response=array(
                "status"=>"0",
                "data"=>"No active booking"
                );
            die(json_encode($response));	
        }
    }
    /**
     * @method driver_set_one_signal_id
     */
    function driver_set_one_signal_id(){
        $this->driver_id=$this->input->post('driver_id');
        $this->one_signal_id=$this->input->post('one_signal_id');
        $setOneSignalId=$this->m_car_type->setOneSignalId($this->one_signal_id,  $this->driver_id);

		if ($setOneSignalId>0) {
				$response=array(
					"status"=>"1",
					"data"=>"Driver registered for notificatons"
					);
				die(json_encode($response));	
		}
		else
		{
			$response=array(
				"status"=>"0",
				"data"=>"Unable to register driver for notifications"
				);
			die(json_encode($response));	
		}

    }
    /**
     * @method endRide
     */
    function endRide(){
        $this->ride_id=$this->input->post('ride_id');
        $this->cab_id=$this->input->post('cab_id');

        $endRideQuery=$this->m_car_type->endRideQuery($this->ride_id);
        $endRideQuery2=$this->m_car_type->endRideQuery2($this->cab_id);
		

		if ($endRideQuery>0 && $endRideQuery2>0) {
				$response=array(
					"status"=>"1",
					"data"=>"End of Ride!"
					);
				die(json_encode($response));	
		}
		else
		{
			$response=array(
				"status"=>"0",
				"data"=>"Unable to end ride"
				);
			die(json_encode($response));	
		}
    
    }
    /**
     * @method get_cab_location
     */
    function get_cab_location(){

	$this->cab_id=$this->input->post('cab_id');
	$this->ride_id=$this->input->post('ride_id');



	$getRideStatus=$this->m_car_type->getRideStatus($this->ride_id);

	if (isset($getRideStatus)) {


		if ($getRideStatus->status==0) {

			$getCurrentPosition=$this->m_car_type->getCurrentPosition($this->ride_id);


			if (isset($getCurrentPosition)) {

				$response=array(

					"status"=>"1",

					"data"=>array(

                    "cab_lat"=>$getCurrentPosition->cab_lat,
                    "cab_lng"=>$getCurrentPositioncab_lng,
                    "cab_bearing"=>$getCurrentPosition->cab_bearing

							)

					);

				die(json_encode($response));

			}

		}

		else{

			$response=array(

				"status"=>"2",

				"data"=>"Trip started"

				);

			die(json_encode($response));

		}

	}

	$response=array(

		"status"=>"0",

		"data"=>"Unable to fetch location"

		);

	die(json_encode($response));




    }

    function get_near_cabs(){
        
        $user_lat=$this->input->post('user_lat');
        $user_lng=$this->input->post('user_lng');
    
        $getNearbyCabs=$this->m_car_type->getNearbyCabs($this->src_lat, $this->src_lng);
    
 
    
        if (isset($getNearbyCabs)) {
    
           
            $response=array(
    
                "status"=>"1",
    
                "data"=>array(
    
                        "cab_lat"=>$getNearbyCabs->cab_lat,
    
                        "cab_lng"=>$getNearbyCabscab_lng,
    
                        "cab_id"=>$getNearbyCabs->cab_id,
    
                        "driver_name"=>$getNearbyCabs->fullname,
    
                        "driver_phone"=>$getNearbyCabs->cellphone,
    
                        "cab_no"=>$getNearbyCabs->cab_no
    
                        )
    
                );
    
            echo(json_encode($response));
    
        }
    
    
    

    }

    /**
     * @method cab_location
     */
    function cab_location(){

	$cab_no=$this->input->post('cab_id');
	$cab_lat=$this->input->post('lat');
	$cab_lng=$this->input->post('lng');
	$cab_bearing=$this->input->post('bearing');

	$updateCabLocationQuery=$this->m_car_type->updateCabLocationQuery($cab_lat, $cab_lng, $cab_bearing, $cab_no);
	

		if (isset($updateCabLocationQuery)) {
				$response=array(
					"status"=>"1",
					"data"=>"Location updated"
					);
				die(json_encode($response));	
		}
		else
		{
			$response=array(
				"status"=>"0",
				"data"=>"Unable to update location"
				);
			die(json_encode($response));	
		}
    }


    /**
     * @method start_ride
     */
    function start_ride(){
        $ride_id=$this->input->type->post('ride_id');

            $startRideQuery=$this->m_car_type->startRideQuery();

            if (isset($startRideQuery)) {
                    $response=array(
                        "status"=>"1",
                        "data"=>"Ride started!"
                        );
                    die(json_encode($response));	
            }
            else
            {
                $response=array(
                    "status"=>"0",
                    "data"=>"Unable to start ride"
                    );
                die(json_encode($response));	
            }  
    }
    
}
