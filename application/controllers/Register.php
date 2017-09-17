<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Register extends My_Controller {
	
    public function __construct() {
        parent::__construct();
		$this->load->model('Register_user_model','register_user');
		$this->load->library('encrypt');
    }

    public function index() {
		$data['currentPage']='9';  
		$data['content']=$this->content->get_content_by_page_id($data['currentPage']);
		
		$this->load->view('vwRegister',$data);
		
		
    }
	public function register_users() {
      	
		if($this->input->get_post('fullname')!="")
			{
					$tblName = "student_register";
					$filepath="";
					if(!empty($_FILES['user_profile']['name']))
						{
							$tmp = $_FILES['user_profile']['name'];
							$ext = explode('.',$tmp);
							$extension  = strtolower($ext[1]);
							
							$today = date('mdyHis');
							$pathMain = './uploads/RegisterStudentProfile/';
								if (!is_dir($pathMain))
									mkdir($pathMain, 0755);
							$configImage['upload_path'] = $pathMain;
							$configImage['max_size'] = "'".UPLOAD_IMAGE_MAX_SIZE."'";
							$configImage['allowed_types'] = 'gif|jpg|jpeg|png';
							$img_name =$today.'.'.$extension;
							$configImage['file_name'] = $img_name;
							$this->load->library('upload', $configImage,'student_img');
							$this->student_img->initialize($configImage);
							if (!$this->student_img->do_upload('user_profile')) 
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
					$otp = $this->common->generatePassword(4, 8);
					$data = array(
					
					'student_name' => $this->input->get_post('fullname'),
					'student_fathername' => $this->input->get_post('father_name'),
					'student_email' => $this->input->get_post('user_email'),
					'student_mobile' => $this->input->get_post('user_mobile'),
					'password' =>$this->encrypt->encode($this->input->get_post('user_password')),
					'student_image' => $filepath,
					'DOB' => date('Y-m-d', strtotime($this->input->get_post('dob'))),
					'age'=>$this->common->GetAge(date('Y-m-d', strtotime($this->input->get_post('dob')))),
					'caste_community' => $this->input->get_post('cast_name'),
					'gender' => $this->input->get_post('gender'),
					'student_address' => $this->input->get_post('user_address'),
					'student_state' => $this->input->get_post('user_state'),
					'student_district' => $this->input->get_post('user_district'),
					'student_city' => $this->input->get_post('user_city'),
					'student_zip' => $this->input->get_post('user_zip'),
					'student_country' => $this->input->get_post('country_name'),
					'OTP' => $otp,
					'register_date' => date('Y-m-d'),
					'is_active'=>'0'
					);
					//print_r($data);
					
					$this->common->insert_record($tblName,$data);
					$this->load->library('email');
					$this->email->set_newline("\r\n");
		
					$this->email->from($this->data['site_settings_value']->admin_mailing_address,$this->input->get('user_email'));
					$this->email->to($this->data['site_settings_value']->admin_mailing_address);
			
					$data = array(
					 'project_name'=> $this->data['site_settings_value']->site_project_name,
					 'site_url'=> base_url(),
					 'copyright'=> $this->data['site_settings_value']->site_copy_right,
					 'fullname'=> $this->input->get_post('fullname'),
					 'user_email'=> $this->input->get_post('user_email'),
					 'student_mobile'=> $this->input->get_post('user_mobile'),
					 'student_image' => $filepath,
					 'student_address' => $this->input->get_post('user_address'),
					 'student_state' => $this->input->get_post('user_state'),
					 'student_city' => $this->input->get_post('user_city'),
					 'student_zip' => $this->input->get_post('user_zip')
					);
					$body = $this->load->view('email_template/register_user_email',$data,TRUE);
					//print_r($body); exit();
					$this->email->subject($this->data['site_settings_value']->site_project_name.' New Student Register ');
					$this->email->message($body);
					
					if(MAIL_ENABLE)
					{
						$this->email->send();
					}
					$this->session->set_userdata(array('user_mobile' => $this->input->get_post('user_mobile')));
					$mobile=$this->input->get_post('user_mobile');
					$password=$this->input->get_post('user_password');
					// SMS Send start here
					//$messgae ="Kusum+Foundation+Account+OTP:+".$otp."+,UserID:+".$mobile."+,Password:".$password; 
					$messgae ="Kusum Foundation Account \n OTP: ".$otp."\n UserID: ".$mobile."\n Password:".$password;
					
					
					$this->common->sent_sms($messgae,$mobile);


					
					
					
					$this->session->set_flashdata('msg', 'You have successfully registered with us!! OTP has been sent to register mobile number.');
					redirect('otp-varfication','refresh');
					
			}
			

    }
	public function duplicat_mobile_validation()
		{
			$mobile=$this->input->get_post('mobile');
			echo $this->register_user->duplicate_mobile($mobile);
		}
	
}
?>