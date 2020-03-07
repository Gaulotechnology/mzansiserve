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

class Install extends CI_Controller
{
    
    
    /***default functin, redirects to login page if no admin logged in yet***/
    public function index()
    {
        $this->load->view('backend/install');
    }
    
    
    
}
