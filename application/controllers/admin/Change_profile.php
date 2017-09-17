<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Change_profile extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Change_profile_model','change_profile');
		
	}

	public function index()
	{
		$data['page'] = 'Profile';
		$data['ckeditor']=false;
		$data['pagetitle']='Change'.' '.$data['page'];
		$data['gridTable']=true;
		$data['admin']=$this->change_profile->edit_profile_form();
		$this->load->view('admin/controls/vwHeader');
		$this->load->view('admin/controls/vwLeft',$data);
		$this->load->view('admin/controls/vwFooterJavascript',$data);
        $this->load->view('admin/vwChangeProfile',$data);
		
		$this->load->view('admin/controls/vwFooter');
	}
	public function update_profile() {
        $data['page'] = 'Profile';
		$data['ckeditor']=false;
		$data['pagetitle']='Change'.' '.$data['page'];
		$data['gridTable']=true;
		$data['admin']=$this->change_profile->edit_profile_form();
		
        $tblName = "admin";
		$fieldName = "id";
		$this->form_validation->set_rules('username', 'name', 'required');
		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('admin/controls/vwHeader');
			$this->load->view('admin/controls/vwLeft',$data);
			$this->load->view('admin/controls/vwFooterJavascript',$data);
			$this->load->view('admin/vwChangeProfile',$data);
			
			$this->load->view('admin/controls/vwFooter');
		}
		else
		{
			$id=$this->session->userdata('id');
			$filepath=$this->common->GetValue("admin","profile_path","id",''.$id.'');
			if($_FILES['profile_path']['name']!="")
			{
				$tmp = $_FILES['profile_path']['name'];
				$ext = explode('.',$tmp);
				$extension  = strtolower($ext[1]);
				
					
					$today = date('mdyHis');
					$pathMain = './uploads/ProfilePicture/';
						if (!is_dir($pathMain))
							mkdir($pathMain, 0755);
					$configImage['upload_path'] = $pathMain;
					$configImage['max_size'] = "'".UPLOAD_IMAGE_MAX_SIZE."'";
					$configImage['allowed_types'] = 'gif|jpg|jpeg|png';
					$img_name =$today.'.'.$extension;
					$configImage['file_name'] = $img_name;
					$this->load->library('upload', $configImage);
					
					if (!$this->upload->do_upload('profile_path')) 
					{
						$this->session->set_flashdata('error', 'Please upload correct image( gif / jpeg / jpg / png)');
						redirect('admin/change_profile');
					}
					else
					{
						$this->load->library('image_lib');
						$configThumb = array();  
						$configThumb['image_library']   = 'gd2'; 
						$configThumb['source_image']  = $pathMain.$img_name; 
						$configThumb['create_thumb']    = TRUE;
						if($filepath!="" && file_exists("./".$filepath))
						{
							unlink("./".$filepath);
						}
					}
					$filepath = str_replace("./","",$pathMain.$img_name);
			}
			$data = array(
				'username' => $this->input->post('username'),
				'profile_path' => $filepath
				
			);
			
		$this->session->set_userdata('username',$this->input->post('username'));
		$this->common->update_record($fieldName,$id,$tblName,$data);
		
		$this->session->set_flashdata('change_profile','Your profile has been changed successfully.');
		redirect('admin/dashboard/','refresh'); //redirect in manage with msg
		}
    }
}
