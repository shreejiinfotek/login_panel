<?
if( !defined('BASEPATH'))
exit('No direct script access allowed');

class Otp_varfication extends My_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('session');
		$this->load->library('encrypt');
		$this->load->model('Login_model','login');
	}
	public function index()
	{
		if($this->session->userdata('is_student_login')) 
		{
			redirect('home');
		}
		else
		{
			//$data['currentPage']='10';
			//$data['content']=$this->content->get_content_by_page_id($data['currentPage']);
			
			
			$this->load->view('vwOtpVarification');
			
		}
		
	}
	public function student_varification_update()
	{
		
		
			 
			$formSubmit = $this->input->post('Submit');
			if($formSubmit=="OTP Varification")
			{
						$data['student_user']=$this->login->otp_student($this->input->post('user_mobile'));
						
						$student_count=count($data['student_user']);
						
						if ($student_count>=1 && $data['student_user']->OTP==$this->input->post('user_otp') )
						{ 
						
							$tblName = "student_register";
							$fieldName = "student_id";
							$student_id=$data['student_user']->student_id;
								$student_data = array(
								'OTP_verification' => '1',
								'is_active'=>'1'
								);
			
		
							$this->common->update_record($fieldName,$student_id,$tblName,$student_data);
							
							
							$this->session->set_userdata(
								array(
								'student_id' => $data['student_user']->student_id,
								'student_name' => $data['student_user']->student_name,
								'student_mobile' => $data['student_user']->student_mobile,
								'is_student_login' => true,
								'is_otp_varification'=>$data['student_user']->OTP_verification
								)
							);
							 redirect('myaccount','refresh');
						 }
						 else
						 {
							//print_r($this->input->post('password'));exit;
					 		$this->session->set_flashdata('error', 'Invalid mobile number or OTP.');
						 	redirect('otp_varfication','refresh');
						 }
			} 
			else
			{
						
						$this->load->view('vwOtpVarification');
						
			}
	}
	
	public function check_client_session(){
	  $id = $this->session->userdata('student_id');
	   if($id!="" ){
			 echo '1';
	   }else{
			 echo '0';
	   
	   }
	
	 }
 }

?>