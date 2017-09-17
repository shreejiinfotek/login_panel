<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Security_question extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Security_question_model','security_question');
		
	}

	public function index()
	{
		$data['page'] = 'Security Question';
		$data['pagetitle']='Manage'.' '.$data['page'].'s';
		$data['path'] = ''.base_url().'admin/security_question/delete_content/';
		$data['bulk_path'] = ''.base_url().'admin/security_question/bulk_delete/';
		$data['ckeditor']=false;
		$data['soringCol']='"order": [[ 1, "asc" ]],';
		$data['manage_view_path']=''.base_url().'admin/security_question/content_view/';
		$data['pagetitle']='Manage'.' '.$data['page'].'s';
		$data['is_active_path']=''.base_url().'admin/security_question/is_active/';
		$data['gridTable']=true;
		
		$this->load->view('admin/controls/vwHeader');
		$this->load->view('admin/controls/vwLeft',$data);
        $this->load->view('admin/vwManageSecurityQuestion',$data);
		$this->load->view('admin/controls/vwFooterJavascript',$data);
		$this->load->view('admin/controls/vwFooter');
	}

	public function content_view()
	{
		$data['page'] = 'Security Question';
		$sql_details=$this->common->sql_detial();
		echo $list = $this->security_question->get_datatables($sql_details);
	}
	public function add_security_question() { //this is use for redirect form in add section start
		$data['page'] = 'Security Question';
		$data['pagetitle']='Manage'.' '.$data['page'].'s | Add '.$data['page'];
		$data['gridTable']=false;
		$data['ckeditor']=true;
		

		$this->form_validation->set_rules('security_questions', 'security question', 'required');
		
		$formSubmit = $this->input->post('Submit');
		if($formSubmit=="Save")
		{
			
			
						$tblName = "security_question";
						
							$data = array(
							'security_questions' => $this->input->post('security_questions'),
							'created_date' => date('Y-m-d')
							);
						
							$this->common->insert_record($tblName,$data);
							
						
						$this->session->set_flashdata('msg', 'Security Question has been added successfully.');
						redirect('admin/security_question/','refresh'); //redirect in manage with msg
		
		}
		//	$data['i']=1;
			
			$this->load->view('admin/controls/vwHeader');
			$this->load->view('admin/controls/vwLeft',$data);
			
			$this->load->view('admin/vwAddSecurityQuestion',$data); 
			$this->load->view('admin/controls/vwFooterJavascript',$data);
			$this->load->view('admin/controls/vwFooter');
			
		
	} //this is use for redirect form in add section end

    public function edit_security_question($id='') //this is use for edit records start
	{
        $data['page'] = 'Security Question';
		$data['pagetitle']='Manage'.' '.$data['page'].'s | Edit '.$data['page'];
		$data['ckeditor']=false;
		$data['gridTable']=false;
		
		$data['security_question']=$this->security_question->get_security_question_by_id($id);
		
		$this->form_validation->set_rules('security_questions', 'security question', 'required');
		
		if($id!='')
		{
			$formSubmit = $this->input->post('Submit');
			if($formSubmit=="Save")
			{
			
							$tblName = "security_question";
							$fieldName="security_question_id";
							
								$data = array(
								'security_questions' => $this->input->post('security_questions'),
								);
								
							$this->common->update_record($fieldName,$id,$tblName,$data);
							
							$this->session->set_flashdata('msg', 'Security Question has been updated successfully.');
							redirect('admin/security_question/','refresh'); //redirect in manage with msg
			
			}
			//$data['security_question']=$this->security_question->get_security_question_by_id($id);
			$this->load->view('admin/controls/vwHeader');
			$this->load->view('admin/controls/vwLeft',$data);
	        $this->load->view('admin/vwEditSecurityQuestion',$data);
			$this->load->view('admin/controls/vwFooter');
			$this->load->view('admin/controls/vwFooterJavascript',$data);
		}
		else
		{
            redirect('admin/security_question');
        }
    } //this is use for edit records end

	public function delete_content($id) {
		
		$arr['page'] = 'Security Question';
		
		$this->security_question->delete_record('security_question_id',$id,'security_question');
		echo "delete";			
    }
	public function bulk_delete() {
		$arr['page'] = 'Security Question';
	
		$ids = ( explode( ',', $this->input->get_post('data_ids') ));
			$this->security_question->delete_all($ids);
			echo 'delete';
			
    }
	
	public function is_active($val,$id)
	{
		$fieldName='is_active';
		$fieldId='security_question_id';
		$tableName='security_question';
		$this->common->update_is_active($val,$id,$fieldName,$fieldId,$tableName);
	}

	
}