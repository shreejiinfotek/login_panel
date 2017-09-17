<?
if( !defined('BASEPATH'))
exit('No direct script access allowed');

class Login extends My_Controller
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
		$data['currentPage']='10';
		$data['content']=$this->content->get_content_by_page_id($data['currentPage']);
		if($this->session->userdata('is_student_login')) 
		{
			redirect('myaccount');
		}
		else
		{
			
			
			
			$this->load->view('vwLogin',$data);
			
		}
		
	}
	public function user_login()
	{
		//$data['currentPage']='10';
		//$data['content']=$this->content->get_content_by_page_id($data['currentPage']);
		
			 
			$formSubmit = $this->input->post('Submit');
			if($formSubmit=="Login")
			{
						$data['student_user']=$this->login->login_student($this->input->post('user_mobile'));
						
						$student_count=count($data['student_user']);
						
						if ($student_count>=1 && ($this->encrypt->decode($data['student_user']->password)==$this->input->post('user_password')))
					
						 { 
							// print_r($data['client_user']->register_user_password);exit;
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
					 		$this->session->set_flashdata('error', 'Invalid mobile number or password.');
						 	redirect('login','refresh');
						 }
			} 
			else
			{
						
						$this->load->view('vwLogin');
						
			}
	}
	public function logout() {

	 	$this->session->unset_userdata('student_id');
        $this->session->unset_userdata('student_name');
        $this->session->unset_userdata('student_mobile');
		$this->session->unset_userdata('is_student_login');  
		$this->session->unset_userdata('is_otp_varification');  
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
		$data['message_display'] = 'Successfully Logout';
		
		redirect('login','refresh');
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