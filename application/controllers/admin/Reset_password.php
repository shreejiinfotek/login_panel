<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reset_password extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Reset_password_model','reset_password');
		$this->load->library('encrypt');
	}

	public function index($id='')
	{
		$data['page'] = 'Reset Password';
		$data['admin_user']=$this->reset_password->edit_reset_password_form($id);
		$this->load->view('admin/controls/vwLoginHeader');
		$this->load->view('admin/vwResetPassword',$data);
		$this->load->view('admin/controls/vwLoginFooter');
		
		
	}
	public function update_password($id) {
        $arr['page'] = 'Reset Password';
		if($id!="")
		{
			$user_count=$this->common->CountByTable('admin','WHERE verification_code="'.$id.'"');
			if($user_count==1)
			{
			
				$tblName = "admin";
				$fieldName = "verification_code";
				
				$data = array(
				'verification_code' => '',
				'password' => $this->encrypt->encode($this->input->post('txtnewpassword'))
			
				);
				
				$this->common->update_record($fieldName,$id,$tblName,$data);
				$err['chk'] = 'Password reset sucessful. Please proceed to <a class="link" href="'.base_url().'admin/home"> Login </a> page.';
				
				$this->load->view('admin/controls/vwLoginHeader');
				$this->load->view('admin/vwResetPassword',$err);
				$this->load->view('admin/controls/vwLoginFooter');
			}
			else
			{
				redirect('admin/home');
			}
		}
		else
		{
			redirect('admin/home');
		}
				
    }
}
