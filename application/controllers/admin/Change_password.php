<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Change_password extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Change_password_model','change_password');
		$this->load->library('encrypt');
		
	}

	public function index()
	{
		$data['page'] = 'Change Password';
		$data['ckeditor']=false;
		$data['pagetitle']=$data['page'];
		$data['gridTable']=true;
		$data['admin']=$this->change_password->change_password_form();
		$this->load->view('admin/controls/vwHeader');
		$this->load->view('admin/controls/vwLeft',$data);
		$this->load->view('admin/controls/vwFooterJavascript',$data);
        $this->load->view('admin/vwChangePassword',$data);
		
		$this->load->view('admin/controls/vwFooter');
	}
	public function update_password() {
        $data['page'] = 'Change Password';
		$data['ckeditor']=false;
		$data['pagetitle']=$data['page'];
		$data['gridTable']=true;
		$data['admin']=$this->change_password->change_password_form();
		
		$this->form_validation->set_rules('txtoldpassword', 'old password', 'required|callback_old_password_check');
		$this->form_validation->set_rules('txtnewpassword', 'new password', 'required|min_length[5]|matches[txtconfirmpassword]');
		$this->form_validation->set_rules('txtconfirmpassword', 'confirm password', 'required|min_length[5]');
		$this->form_validation->set_message('matches', 'Password and confirm password should be same.');
		
		if ($this->form_validation->run() === FALSE)
		{
			
			$this->load->view('admin/controls/vwHeader');
			$this->load->view('admin/controls/vwLeft',$data);
			$this->load->view('admin/controls/vwFooterJavascript',$data);
			$this->load->view('admin/vwChangePassword',$data);
			
			$this->load->view('admin/controls/vwFooter');
		}
		else
		{
			$tblName = "admin";
			$fieldName = "id";
			$id=$this->session->userdata('id');
			$data = array(
				'password' => $this->encrypt->encode($this->input->post('txtnewpassword'))
			);
			
			$this->common->update_record($fieldName,$id,$tblName,$data);
			$this->session->set_flashdata('change_password','Your password has been changed successfully.');
			redirect('admin/dashboard/','refresh'); //redirect in manage with msg
		}
    }
	public function old_password_check()//use for form validation message
    {
            if ($this->input->post('txtoldpassword')===$this->input->post('txtold'))  {
				
            return TRUE;
        }
        else {
           
			 $this->form_validation->set_message('old_password_check', 'Please enter correct old password.');
            return FALSE;
        }
    }
}
