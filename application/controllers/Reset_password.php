<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reset_password extends My_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Reset_password_model','reset_password');
		$this->load->library('encrypt');
	}

	public function index($id='')
	{
		$data['currentPage']='11';
		$data['content']=$this->content->get_content_by_page_id($data['currentPage']);
		
		$data['reset_password']=$this->reset_password->client_reset_password($id);
		if(empty($data['reset_password']))
		{
			redirect('home');
		}
		$this->load->view('controls/vwHeader',$data);
		$this->load->view('vwResetPassword',$data);
		$this->load->view('controls/vwFooter',$data);
		
		
	}
	public function update_password($id) {
        
		$data['reset_password']=$this->reset_password->client_reset_password($id);
		if($id!="")
		{
			$user_count=$this->common->CountByTable('register_user','WHERE verification_code="'.$id.'"');
			if($user_count==1)
			{
			
				$tblName = "register_user";
				$fieldName = "verification_code";
				
				$data = array(
				'verification_code' => '',
				'register_user_password' => $this->encrypt->encode($this->input->post('password'))
			
				);
				
				$this->common->update_record($fieldName,$id,$tblName,$data);
				
				$data['chk'] = 'Password reset sucessfully. Please proceed to <a class="link" href="'.base_url().'login">Login</a> page.';
				
				$data['currentPage']='11';
				$data['content']=$this->content->get_content_by_page_id($data['currentPage']);
				$this->load->view('controls/vwHeader',$data);
				$this->load->view('vwResetPassword',$data);
				$this->load->view('controls/vwFooter',$data);
			}
			else
			{
				redirect('home');
			}
		}
		else
		{
			redirect('home');
		}
				
    }
}
