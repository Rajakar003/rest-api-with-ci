<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';
class Users extends REST_Controller  {

	public function index_post()
	{
	  $data['email']= $this->input->post('email');
	  $data['password'] = $this->input->post('password');
	  $token =JWT::encode($data,$this->config->item('jwt_key'));
	  $responsedata =["stat"=>true,"msg"=>"document has been saved successfully",'token'=>$token];
	  $this->response($responsedata, REST_Controller::HTTP_OK);
	  
	}

}
