<?
if( !defined('BASEPATH'))
exit('No direct script access allowed');

class Change_profile extends My_Controller
{
	public function __construct()
	{
		parent::__construct(); 
		$this->load->library('session');
		$this->load->model('Student_model','student');
		$this->common->is_login_redirect();
	}
	public function index(){
		$data['currentPage']='13';
		$data['content']=$this->content->get_content_by_page_id($data['currentPage']);
		$data['student']=$this->student->student_by_id($this->session->userdata('student_id'));
		$this->load->view('controls/vwHeader',$data);
		$this->load->view('vwChangeProfile',$data);
		$this->load->view('controls/vwFooter',$data);
		
	}
	public function update_profile() {
        
		$data['currentPage']='13';
		$data['content']=$this->content->get_content_by_page_id($data['currentPage']);
		$data['student']=$this->student->student_by_id($this->session->userdata('student_id'));
		
        $tblName = "student_register";
		$fieldName = "student_id";
		$id=$this->session->userdata('student_id');
		if (isset($_FILES['student_image']) && !empty($_FILES['student_image']['name']))
		{
			$tmp = $_FILES['student_image']['name'];
			$ext = explode('.',$tmp);
			$extension  = strtolower($ext[1]);
			if(($extension =="gif" || $extension =="jpeg" || $extension =="jpg" || $extension =="png")==false)
			{
				$data['error']="Please upload correct file( gif / jpeg / jpg / png).";
			}
		}
		if($id!="")
		{
			$formSubmit = $this->input->post('submit');
			if($formSubmit=="Change Profile")
			{
			
			$filepath=$data['student']->student_image;
			
			if(!empty($_FILES['student_image']['name']))
			{
				$tmp = $_FILES['student_image']['name'];
				$ext = explode('.',$tmp);
				$extension  = strtolower($ext[1]);
				
				$today = date('mdyHis');
				$pathMain = './uploads/RegisterUserProfile/';
					if (!is_dir($pathMain))
						mkdir($pathMain, 0755);
				$configImage['upload_path'] = $pathMain;
				$configImage['max_size'] = "'".UPLOAD_IMAGE_MAX_SIZE."'";
				$configImage['allowed_types'] = 'gif|jpg|jpeg|png';
				$img_name =$today.'.'.$extension;
				$configImage['file_name'] = $img_name;
				$this->load->library('upload', $configImage,'user_img');
				$this->user_img->initialize($configImage);
				if (!$this->user_img->do_upload('student_image')) 
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
					if($filepath!="" && file_exists("./".$filepath))
					{
						unlink("./".$filepath);
					}
					$filepath = str_replace("./","",$pathMain.$img_name);
				}
			}
				
			$data = array(
					
					'student_name' => $this->input->get_post('student_name'),
					'student_fathername' => $this->input->get_post('student_fathername'),
					'student_email' => $this->input->get_post('student_email'),
					'student_image' => $filepath,
					'DOB' => date('Y-m-d', strtotime($this->input->get_post('dob'))),
					'caste_community' => $this->input->post('caste_community'),
					'gender' => $this->input->get_post('gender'),
					'student_address' => $this->input->get_post('student_address'),
					'student_state' => $this->input->get_post('state'),
					'student_district' => $this->input->get_post('student_district'),
					'student_city' => $this->input->get_post('city'),
					'student_zip' => $this->input->get_post('zip'),
					'Updated_at' => date('Y-m-d'),
					'is_active'=>'1',
					'student_country' => $this->input->post('student_country')
					);
			
		$this->session->set_userdata('student_name',$this->input->post('student_name'));
		$this->common->update_record($fieldName,$id,$tblName,$data);
		
		$this->session->set_flashdata('msg','Your profile has been changed successfully.');
		redirect('myaccount','refresh'); //redirect in manage with msg	
				
				
				
			}
		}
		
		
			
			
			
			
		}
	
}


?>