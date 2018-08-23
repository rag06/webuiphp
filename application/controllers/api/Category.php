<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . '/libraries/REST_Controller.php';

// use namespace
use Restserver\Libraries\REST_Controller;

class Category extends REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();

		// Load database
		$this->load->model('Category_Model','category_model');
    }

    public function categoryList_get()
    {

    }
    public function addCategory_post()
    {
        $cat_arr = array(
            "cat_id" => uniqid(),
            "cat_name" =>  $this->post('cat_name')
        );
        $this->category_model->addCategory($cat_arr);
        $message = [
            'cat_name' =>  $this->post('cat_name'),
            'message' => 'Category Added'
        ];
        $this->set_response($message, REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code */
    }


}
