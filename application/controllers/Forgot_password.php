<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Forgot_password extends My_Controller {
	
	public function __construct() {
	parent::__construct();
	$this->load->model('Forgot_password_model','forgot_password');
	$this->load->library('encrypt');
	}


	public function index() {
		
		$this->load->view('vwForgotPassword');
	
	}	
	public function send_mail() {
		
		
		$id=$this->input->post('user_mobile');
		$UID=$this->common->random_string(10);
		$client_user=$this->forgot_password->get_student_data($this->input->post('user_mobile'));
		
		$dup_email=$this->common->CountByTable('student_register','WHERE student_mobile="'.$this->input->post('user_mobile').'" AND is_active=1');
		if($dup_email>=1)
		{
			$password=$this->encrypt->decode($client_user->password);
			$mobile=$this->input->get_post('user_mobile');
			$messgae ="Kusum Foundation Account \n UserID: ".$mobile."\n Password:".$password;	
			
			
			$this->common->sent_sms($messgae,$mobile);
			$this->session->set_flashdata('message', 'Password has been sent to your mobile number.');
					redirect('forgot_password','refresh');
				
		}
		else
		{
			$this->session->set_flashdata('error', 'Mobile number address not registered with us.');
			redirect('forgot_password','refresh');
		}
	
		
    }

}
	



?>