<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Change_password extends My_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->library('encrypt');
		$this->load->model('Student_model','student');
		$this->common->is_login_redirect();
        
	}

	public function index()
	{
		
		$data['currentPage']='14';
		$data['content']=$this->content->get_content_by_page_id($data['currentPage']);
		$data['student']=$this->student->student_by_id($this->session->userdata('student_id'));
		
		$this->load->view('controls/vwHeader',$data);
		$this->load->view('vwChangePassword',$data);
		$this->load->view('controls/vwFooter',$data);
	}
	public function update_password() {
        $data['page'] = 'Change Password';
		$data['currentPage']='14';
		$data['content']=$this->content->get_content_by_page_id($data['currentPage']);
		$data['student']=$this->student->student_by_id($this->session->userdata('student_id'));
		
		
			$formSubmit = $this->input->post('submit');
			if($formSubmit=="Change Password")
			{
				$tblName = "student_register";
				$fieldName = "student_id";
				$id=$this->session->userdata('student_id');
				
				$data = array(
					'password' =>$this->encrypt->encode($this->input->post('txtnewpass'))
				);
				
				$this->common->update_record($fieldName,$id,$tblName,$data);
				$this->session->set_flashdata('msg','Your password has been changed successfully.');
				redirect('myaccount','refresh'); //redirect in manage with msg
			}else{
			$this->load->view('controls/vwHeader',$data);
			$this->load->view('vwChangePassword',$data);
			$this->load->view('controls/vwFooter',$data);	
			}
    }
}
