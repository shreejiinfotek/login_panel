<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends Admin_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Student_model','student');
		$this->load->model('Common_function_model','common');
		$this->load->library('encrypt');
		$this->load->library('form_validation');
		
		
		
         if (!$this->session->userdata('is_admin_login')) {
            redirect('admin/home');
        }
	}

	public function index()
	{
		$data['table_count']=$this->common->CountByTable('admin','');
		$data['page'] = 'Student';
		$data['path'] = ''.base_url().'admin/student/delete_content/';
		$data['bulk_path'] = ''.base_url().'admin/student/bulk_delete/';
		$data['ckeditor']=false;
		$data['soringCol']='"order": [[ 1, "asc" ]],';
		//$data['is_approve_path']=''.base_url().'admin/student/is_appvove/';
		$data['is_active_path']=''.base_url().'admin/student/is_active/';
		$data['manage_view_path']=''.base_url().'admin/student/student_view/';
		
		$data['pagetitle']='Manage'.' '.$data['page'].'s';
		$data['gridTable']=true;
		
		$this->load->view('admin/controls/vwHeader');
		$this->load->view('admin/controls/vwLeft',$data);
		$this->load->view('admin/controls/vwFooterJavascript',$data);
        $this->load->view('admin/vwManageStudent',$data);
		
		$this->load->view('admin/controls/vwFooter');
	}
	
	public function student_view()
	{
		$data['page'] = 'Student';
		$sql_details=$this->common->sql_detial();
		echo $list = $this->student->get_datatables($sql_details);
	}
	
	public function add_user() //this is use for edit records start
	{
        $data['page'] = 'User';
		$data['pagetitle']='Manage'.' '.$data['page'].'s | Add '.$data['page'];
		
		$data['ckeditor']=false;
		$data['gridTable']=false;
		$this->form_validation->set_rules('email', 'email', 'required');
		$this->form_validation->set_rules('username', 'username', 'required');
		
	
	//	$this->form_validation->set_rules('meta_title', 'meta title', 'required');
		
			$formSubmit = $this->input->post('Submit');
			if($formSubmit=="Save")
			{
					$filepath="";			
					$tblName = "admin";
					if (!empty($_FILES['profile_path']['name']))
					{
						if(!empty($_FILES['profile_path']['name']))
						{
							$tmp = $_FILES['profile_path']['name'];
							$ext = explode('.',$tmp);
							$extension  = strtolower($ext[1]);
							
							$today = date('mdyHis');
							$pathMain = './uploads/User Profile/';
								if (!is_dir($pathMain))
									mkdir($pathMain, 0755);
							$configImage['upload_path'] = $pathMain;
							$configImage['max_size'] = "'".UPLOAD_IMAGE_MAX_SIZE."'";
							$configImage['allowed_types'] = 'gif|jpg|jpeg|png';
							$img_name =$today.'.'.$extension;
							$configImage['file_name'] = $img_name;
							$this->load->library('upload', $configImage,'profile_img');
							$this->profile_img->initialize($configImage);
							if (!$this->profile_img->do_upload('profile_path')) 
							{
								$data['error']='Please upload correct image( gif / jpeg / jpg / png).';
							}
							else
							{
								$this->load->library('image_lib');
								$configThumb = array();  
								$configThumb['image_library']   = 'gd2'; 
								$configThumb['source_image']  = $pathMain.$img_name; 
								$configThumb['create_thumb']    = TRUE;
								
								$filepath = str_replace("./","",$pathMain.$img_name);
							}
						}
							$data = array(
							'email'=>$this->input->post('email'),
							'username'=>$this->input->post('username'),
							'phone_number' => $this->input->post('phone_number'),
							'address' => $this->input->post('address'),
							'ip_address' => $this->input->ip_address(),
							'profile_path' => $filepath,
							'user_type'=>'A',
							'is_approve'=>0,
							'created_date'=>date('Y-m-d'),
							);
							$this->common->insert_record($tblName,$data);
							$this->session->set_flashdata('msg', 'New User has been added successfully and now approve user.');
							redirect('admin/user/','refresh'); //redirect in manage with msg
				}
			}
			else
			{
				$this->form_validation->set_rules('profile_path', 'profile_path', 'required');
				$this->form_validation->set_message('required', 'Please upload profile picture.');
				if ($this->form_validation->run() === FALSE)
				{
					$this->load->view('admin/controls/vwHeader');
					$this->load->view('admin/controls/vwLeft',$data);
					$this->load->view('admin/vwAddUser',$data);    
					$this->load->view('admin/controls/vwFooter');
					$this->load->view('admin/controls/vwFooterJavascript',$data);
				}
			}
			
		
		
    }
	public function view_student($id='') //this is use for edit records start
	{
       		$data['page'] = 'Student';
			$data['ckeditor']=false;
			$data['gridTable']=false;
			$data['pagetitle']='Manage'.' '.$data['page'].'s';
			$arr['student']=$this->student->get_student_by_id($id);
			$this->load->view('admin/controls/vwHeader');
			$this->load->view('admin/controls/vwLeft',$data);
		
			$this->load->view('admin/vwViewStudent',$arr);
			$this->load->view('admin/controls/vwFooter');
			$this->load->view('admin/controls/vwFooterJavascript');
		
    } //this is use for edit records end
    public function edit_student($id='') //this is use for edit records start
	{
        $data['page'] = 'Student';
		$data['pagetitle']='Manage'.' '.$data['page'].'s | Edit '.$data['page'];
		
		$data['ckeditor']=false;
		$data['gridTable']=false;
		$this->form_validation->set_rules('student_name', 'student_name', 'required');
		//$this->form_validation->set_rules('meta_title', 'meta title', 'required');
		if($id!='')
		{
			$formSubmit = $this->input->post('Submit');
			if($formSubmit=="Save")
			{
				 $tblName = "student_register";
				 $fieldName = "student_id";
				
				
				if ($this->form_validation->run() === TRUE)
					{
						
						
						$data = array(
								'student_name' => $this->input->post('student_name'),
								'student_fathername' => $this->input->post('student_fathername'),
								'student_email' => $this->input->post('student_email'),
								'password'=>$this->encrypt->encode($this->input->post('password')),
								'DOB' => date('Y-m-d', strtotime($this->input->get_post('dob'))),
								'caste_community' => $this->input->post('caste_community'),
								'gender' => $this->input->get_post('gender'),
								'student_address' => $this->input->post('student_address'),
								'student_state' => $this->input->post('student_state'),
								'student_district' => $this->input->post('student_district'),
								'student_city' => $this->input->post('student_city'),
								'student_zip' => $this->input->post('student_zip'),
								'student_country' => $this->input->post('student_country')
								
							);
					
					$this->common->update_record($fieldName,$id,$tblName,$data);
					$this->session->set_flashdata('msg', 'Student Details has been updated successfully.');
					redirect('admin/student/','refresh'); //redirect in manage with msg
					}
			}
			
			$data['student']=$this->student->get_student_by_id($id);
			$this->load->view('admin/controls/vwHeader');
			$this->load->view('admin/controls/vwLeft',$data);
	        $this->load->view('admin/vwEditStudent',$data);
			$this->load->view('admin/controls/vwFooter');
			$this->load->view('admin/controls/vwFooterJavascript',$data);
			
		}
		else
		{
            redirect('admin/student');
        }
		
    } //this is use for edit records end

	public function delete_content($id) {
		
		$arr['page'] = 'Student';
		$this->student->delete_record('student_id',$id,'student_register');
		echo "delete";			
    }
	public function bulk_delete() {
		$arr['page'] = 'Student';
	
		$ids = ( explode( ',', $this->input->get_post('data_ids') ));
			$this->student->delete_all($ids);
			echo 'delete';
			
    }
	public function is_active($val,$id)
	{
		$fieldName='is_active';
		$fieldId='student_id';
		$tableName='student_register';
		$this->common->update_is_active($val,$id,$fieldName,$fieldId,$tableName);
	}
	
}
