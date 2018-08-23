<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . '/libraries/REST_Controller.php';

// use namespace
use Restserver\Libraries\REST_Controller;

class User extends REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();

		// Load database
		$this->load->model('User_Model','user_model');
    }

    public function categoryList_get()
    {

    }
    public function validateAdmin_post()
    {
        $request_body = file_get_contents('php://input');
        $data = json_decode($request_body);
        if($data->email == "tej")
        {
            $message = [

            'valid_user' => true,
            'isAdmin' => true
             ];

        }
        else
        {
            $message = [

                'valid_user' => false,
                'isAdmin' => false
            ];

        }
        $this->set_response($message, REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code */
    }


}
