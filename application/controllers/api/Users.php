<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

// use namespace
use Restserver\Libraries\REST_Controller;

class Users extends REST_Controller {

    function __construct()
    {
        parent::__construct();

		// Load database
		$this->load->model('User_Model','user_model');
		
    }

    public function user_get()
    {

        $id = $this->get('id');
		$id = (int) $id;
		// Validate the id.
            if (empty($id))
            {
                $this->response([
                    'status' => FALSE,
                    'message' => 'invalid Id'
                ], REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
            }
			
			$users = $this->user_model->getUser($id);

            // Check if the users data store contains users (in case the database result returns NULL)
            if ($users)
            {
                // Set the response and exit
                $this->response([
                    'status' => TRUE,
                    'result' => $users
                ], REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }
            else
            {
                // Set the response and exit
                $this->response([
                    'status' => FALSE,
                    'message' => 'No user were found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        
    }
	
    public function logincheck_post()
    {
		$data=array(
				'emailId'=>$this->post('emailId'),
				'password'=>$this->post('password')
		);
		$users = $this->user_model->login($data);
         if(!empty($users)){
			  $message = [
					'name' => $this->post('name'),
					'email' => $this->post('email'),
					'message' => 'Added a user Successfully'
				];

				$this->set_response([
							'status' => TRUE,
							'message' => $message 
						], REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code */
		 } else {
			 $this->response([
                    'status' => FALSE,
                    'message' => 'Error while added user'
                ], REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
		 }
        
    }
    public function user_post()
    {
		$data=array(
				'name'=>$this->post('name'),
				'address'=>$this->post('address'),
				'pincode'=>$this->post('pincode'),
				'emailId'=>$this->post('emailId'),
				'password'=>$this->post('password'),
				'userType'=>$this->post('userType'),
				'createdOn'=> date('Y-m-d H:i:s'),
				'mobileNo'=>$this->post('mobileNo')
		);
         if($this->user_model->addUser($data){
			  $message = [
					'name' => $this->post('name'),
					'email' => $this->post('email'),
					'message' => 'Added a user Successfully'
				];

				$this->set_response([
							'status' => TRUE,
							'message' => $message 
						], REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code */
		 } else {
			 $this->response([
                    'status' => FALSE,
                    'message' => 'Error while added user'
                ], REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
		 }
        
    }

	
    public function user_put($id)
    {
		
        //$id = $this->get('id');
		$id = (int) $id;
		
        // Validate the id.
        if (empty($id))
        {
            // Set the response and exit
           $this->response([
                    'status' => FALSE,
                    'message' => 'invalid Id'
                ], REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }

		$data=array(
				'name'=>$this->put('name'),
				'address'=>$this->put('address'),
				'pincode'=>$this->put('pincode'),
				'emailId'=>$this->put('emailId'),
				'password'=>$this->put('password'),
				'userType'=>$this->put('userType'),
				'mobileNo'=>$this->put('mobileNo')
		);
         if($this->user_model->updateUser($id,$data)) {
				 $message = [
				'id' => $id, // Automatically generated by the model
				'name' => $this->put('name'),
				'email' => $this->put('email'),
				'message' => 'User Updated Successfully! '
			];

			$this->set_response([
                    'status' => TRUE,
                    'message' => $message
                ], REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code */
		 }  else {
			 $this->response([
                    'status' => FALSE,
                    'message' => 'Error while updating user'
                ], REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
		 }
         
    }
	
    public function user_delete($id)
    {
        $id = (int) $id;

        // Validate the id.
        if (empty($id))
        {
              $this->response([
                    'status' => FALSE,
                    'message' => 'invalid Id'
                ], REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }

       if( $this->user_model->deleteUser($id)) {
		    $message = [
				'id' => $id,
				'message' => 'Deleted User Successfully'
			];

			$this->set_response([
                    'status' => TRUE,
                    'message' => $message
                ], REST_Controller::HTTP_NO_CONTENT); // NO_CONTENT (204) being the HTTP response code */
	   } else {
		    $this->response([
                    'status' => FALSE,
                    'message' => 'Error while updating user'
                ], REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
	   }
       
    }
	
	

}