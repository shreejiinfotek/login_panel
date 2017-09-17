<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forgot_password extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Forgot_password_model','forgot_password');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data['page'] = 'Change Password';
		$this->load->view('admin/controls/vwLoginHeader');
		$this->load->view('admin/vwForgotPassword',$data);
		$this->load->view('admin/controls/vwLoginFooter');

	}
	public function send_mail() {
		
		
		$id=$this->input->post('email');
		$UID=$this->common->random_string(10);
		$admin_user=$this->forgot_password->get_user_data($this->input->post('email'));
		
		$dup_email=$this->common->CountByTable('admin','WHERE email="'.$this->input->post('email').'"');
		if($dup_email>=1)
		{
			$tblName = "admin";
			$fieldName = "email";
			
			$data = array(
					'verification_code' => $UID
					);
			$this->common->update_record($fieldName,$id,$tblName,$data);
		
			$this->load->library('email');
			$this->email->set_newline("\r\n");
		
			$this->email->from($this->data['admin_site_settings']->admin_mailing_address,$this->data['admin_site_settings']->admin_mailing_address);
			$this->email->to($this->input->post('email'));
			
			$data = array(
					 'project_name'=> $this->data['admin_site_settings']->site_project_name,
					 'site_url'=> base_url(),
					 'websitelogo'=>$this->data['admin_site_settings']->website_logo,
					 'copyright'=> $this->data['admin_site_settings']->site_copy_right,
					 'username'=> $admin_user[0]['username'],
					 'uid'=> $UID
						 );
				$body = $this->load->view('admin/email_template/forgot_password',$data,TRUE);
				$this->email->subject($this->data['admin_site_settings']->site_project_name.' Forgot Password');
				$this->email->message($body);
				if(MAIL_ENABLE)
				{
					 $is_success=$this->email->send();
				}
				else
				{
					$is_success="";
				}
				if($is_success)
				{
					$this->session->set_flashdata('message', 'Email has been sent to your account.');
					redirect('admin/forgot_password','refresh');
				}
				else
				{
					$this->session->set_flashdata('error', 'Message delivery failed... Please try Again');
					redirect('admin/forgot_password','refresh');
				}
		}
		else
		{
			$this->session->set_flashdata('error', 'email address not registered with us.');
			redirect('admin/forgot_password','refresh');
		}
	
		
    }
}
