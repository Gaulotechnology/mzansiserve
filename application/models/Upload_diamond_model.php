<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    class Upload_diamond_model extends CI_Model
    {
        public function __construct()
        {
            parent::__construct();
        }
    
    
        public function postDiamond($result)
        {
        
            $this->db->insert('staff', $result);
        
            return true;
        }
    }