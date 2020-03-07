<?php

class Gmapscontact extends CI_Controller 
{
	public function index()
	{
		$this->load->library('GMap');

		// initialize maps
		$this->gmap->GoogleMapAPI();

		// set map type to map
		$this->gmap->setMapType('map');

		// set your company logo replacing default marker
		//$this->gmap->setMarkerIcon(base_url()."assets/images/company_logo.png");
		
		if($this->input->post()) 
		{			
			$val = $this->form_validation;
			$val->set_rules('from', 'Starting point', 'trim|required|xss_clean|strip_tags');
			$val->set_error_delimiters('<div class="error">','</div>');

			// set your address from DB or config file
			$company_city = '1055 Budapest';
			$company_address = 'Kossuth tér 1';
		
			if($val->run())
			{
				// calculate route information to your address and put it in 'dir_content' div
				$this->gmap->addDirections($val->set_value('from'), $company_city.' '.$company_address, "dir_content", FALSE);
			}
		}		

		// set your info from DB or config file
		$title = 'Title for infoWindow';
		$description = 'Description for infoWindow';
		$coord1 = '19.047062'; 
		$coord2 = '47.507055';

		// add info to the marker icon window
		$this->gmap->addMarkerByCoords($coord1, $coord2, $title, $title.'<br/>'.$description);

		// set map dimensions
		$this->gmap->setWidth('610px');
		$this->gmap->setHeight('300px');

		// set default zoom level of map
		$this->gmap->setZoomLevel(16);
	
		// render required javascript to show the map
		$data['headerjs'] = $this->gmap->getHeaderJS();
		$data['headermap'] = $this->gmap->getMapJS();
		$data['onload'] = $this->gmap->printOnLoad();
		$data['map'] = $this->gmap->printMap();

		$this->load->vars($data);
		$this->load->view('contact');
	}
}
