<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
class Documents extends REST_Controller  {
   
	public function extentions_get(){
		try{
			$data = $this->Common->getExtentions("extention","id,name");
			$this->response($data, REST_Controller::HTTP_OK);
		}
		catch(Exception $exc){
			$this->response($data,REST_Controller::HTTP_BAD_REQUEST);
		}
	
	}
	public function index_post(){
		$error=[];
		try{
			if($this->input->post('name')!=''){
				$data['name']= $this->input->post('name');
			}
			else{
				$error['name']="name field is required";
			}
			if($this->input->post('type')!=''){
				$data['type'] = $this->input->post('type');
			}else{
				$error['type']="type field is required";
			}
			if($this->input->post('extenstion_id')!=''){
				$data['extenstion_id'] =$this->input->post('extenstion_id');
			}else{
                $error['extenstion_id']='extenstion_id is reqired';
			}
			if(!empty($error)){
				$responsedata =["stat"=>false,"errors"=>$error,"data"=>(object)[]];
				$this->response($responsedata, REST_Controller::HTTP_BAD_REQUEST);
			}else{
				$data['file'] = $this->do_upload('files','assets/uploads/files');
				$data['create_at']=date('Y-m-d h:m:s');
				$data = $this->Common->save('document',$data);

				$responsedata =["stat"=>true,"msg"=>"document has been saved successfully",'data'=>$data];
				$this->response($responsedata, REST_Controller::HTTP_OK);
			}
			
			
		}
		catch(Exception $ex)
		{
			$this->response($ex,REST_Controller::HTTP_BAD_REQUEST);
		}
	
	}
	public function do_upload($image, $path)
    {

        $config['upload_path']          = $path;
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 1024;
        $config['max_width']            = 1024;
        $config['max_height']           = 768;
        $config['encrypt_name']         = TRUE;

        $new_name = time();
        $config['file_name'] = $new_name;


        $this->load->library('upload', $config);

        if ($this->upload->do_upload($image)) {
            $data = array($this->upload->data());
            $file_name = $data[0]['file_name'];
            return  $file_name;
        }
	}
	

}
