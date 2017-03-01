<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
defined('BASEPATH') OR exit('No direct script access allowed');
// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */

class Student extends REST_Controller{
    
           function __construct() {
             parent::__construct();

		if (isset($_SERVER['HTTP_ORIGIN']))
		 {
			
			header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
 		    header('Access-Control-Allow-Credentials: true');
  		    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
  		    header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding,X-Custom-Header");   
   			header('Access-Control-Max-Age: 86400');    // cache for 1 day

   		if ( "OPTIONS" === $_SERVER['REQUEST_METHOD'] )
			 {
    			die();
   			 }
		}

		//$this->load->library('session');				
		$this->load->database();
                $this->load->helper('url'); 		
		$this->load->model('Student_model');		
	}

        function StudentData_get($id=0)
	{
		$types = $this->Student_model->getStudentData($id);
		//echo $types;
		return $this->set_response(array("status"=>"success","message"=>"List of all  Data ","result"=>$types));
		
	}
}