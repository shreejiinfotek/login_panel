<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Our_course extends Admin_Controller {

public function __construct()
	{
		parent::__construct();
		$this->load->model('Our_course_model','our_course');
		$this->load->model('Our_program_model','our_program');
	}

	public function index()
	{
		$data['page'] = 'Course';
		$data['path'] = ''.base_url().'admin/our_course/delete_content/';
		$data['bulk_path'] = ''.base_url().'admin/our_course/bulk_delete/';
		$data['ckeditor']=false;
		$data['soringCol']='"order": [[ 1, "asc" ]],';
		$data['manage_view_path']=''.base_url().'admin/our_course/our_course_view/';
		$data['pagetitle']='Manage '.$data['page'].'s';
		$data['is_active_path']=''.base_url().'admin/our_course/is_active/';
		$data['gridTable']=true;
		
		$this->load->view('admin/controls/vwHeader');
		$this->load->view('admin/controls/vwLeft',$data);
		$this->load->view('admin/controls/vwFooterJavascript',$data);
        $this->load->view('admin/vwManageOurCourse',$data);
		
		$this->load->view('admin/controls/vwFooter');
	}

	public function our_course_view()
	{
		$data['page'] = 'Course';
		$sql_details=$this->common->sql_detial();
		echo $list = $this->our_course->get_datatables($sql_details);
	}
	public function add_our_course() { //this is use for redirect form in add section start
		$data['page'] = 'Course';
		$data['pagetitle']='Manage '.$data['page'].'s | Add '.$data['page'];
		$data['ckeditor']=true;
		$data['gridTable']=false;
		$this->form_validation->set_rules('our_course_description', 'description', 'required');
		$formSubmit = $this->input->post('Submit');
		if($formSubmit=="Save")
		{
			$tblName = "our_course";
			
				$data = array(
							'school_id'=>$this->input->post('school_id'),
							'our_program_id'=>$this->input->post('our_program_id'),
							'our_course_title' =>$this->input->post('our_course_title'),
							'our_course_description' =>$this->input->post('description'),
							'redirect_link' =>$this->input->post('redirect_link'),
							'display_order' => $this->input->post('display_order'),
							'created_date'=>date('Y-m-d'),
							);
				$this->common->insert_record($tblName,$data);
			$this->session->set_flashdata('msg', 'Course has been added successfully.');
			redirect('admin/our_course/','refresh'); //redirect in manage with msg			
		
		}
		$data['school'] = $this->our_program->get_school_id();
		$this->load->view('admin/controls/vwHeader');
		$this->load->view('admin/controls/vwLeft',$data);
		$this->load->view('admin/vwAddOurCourse',$data);    
		$this->load->view('admin/controls/vwFooter');
		$this->load->view('admin/controls/vwFooterJavascript',$data);
	} //this is use for redirect form in add section end
    public function edit_our_course($id='') //this is use for edit records start
	{
        $data['page'] = 'Course';
		$data['pagetitle']='Manage '.$data['page'].'s | Edit '.$data['page'];
		$data['ckeditor']=true;
		$data['gridTable']=false;
		
		$this->form_validation->set_rules('our_course_description', 'description', 'required');
		if($id!='')
		{
			$formSubmit = $this->input->post('Submit');
			if($formSubmit=="Save")
			{
				$tblName = "our_course";
				$fieldName = "our_course_id";
						$data = array(
							'our_course_title' =>$this->input->post('our_course_title'),
							'our_course_description' =>$this->input->post('description'),
							'redirect_link' =>$this->input->post('redirect_link'),
							'display_order' => $this->input->post('display_order'),
						);
				
						$this->common->update_record($fieldName,$id,$tblName,$data);
						$this->session->set_flashdata('msg', 'Course has been updated successfully.');
						redirect('admin/our_course/','refresh'); //redirect in manage with msg
			}
			$data['school'] = $this->our_program->get_school_id();
			$data['our_program']=$this->our_course->get_our_program();
			$data['our_course']=$this->our_course->get_our_course_by_id($id);
			$this->load->view('admin/controls/vwHeader');
			$this->load->view('admin/controls/vwLeft',$data);
	        $this->load->view('admin/vwEditOurCourse',$data);
			$this->load->view('admin/controls/vwFooter');
			$this->load->view('admin/controls/vwFooterJavascript',$data);
		}
		else
		{
            redirect('admin/our_course');
        }
    } //this is use for edit records end
	
	public function delete_content($id) {
		$arr['page'] = 'Course';
		$this->our_course->delete_record('our_course_id',$id,'our_course');
		echo "delete";
    }
	public function bulk_delete() {
		$arr['page'] = 'Course';
		$ids = ( explode( ',', $this->input->get_post('data_ids') ));
			$this->our_course->delete_all($ids);
			echo 'delete';
    }
	public function is_active($val,$id)
	{
		$fieldName='is_active';
		$fieldId='our_course_id';
		$tableName='our_course';
		$this->common->update_is_active($val,$id,$fieldName,$fieldId,$tableName);
	}
	public function get_our_program()
	{
		
		$this->our_course->our_program_show($this->input->get_post('id'));
		
	}
}
?>