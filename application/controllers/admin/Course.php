<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Course extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Course_model','course');
		
	}

	public function index()
	{
		$data['page'] = 'Course';
		$data['path'] = ''.base_url().'admin/course/delete_content/';
		$data['bulk_path'] = ''.base_url().'admin/course/bulk_delete/';
		$data['ckeditor']=false;
		$data['manage_view_path']=''.base_url().'admin/course/course_view/';
		$data['soringCol']='"order": [[ 1, "asc" ]],';
		$data['is_active_path']=''.base_url().'admin/course/is_active/';
		$data['pagetitle']='Manage Course';
		$data['gridTable']=true;
		$this->load->view('admin/controls/vwHeader');
		$this->load->view('admin/controls/vwLeft',$data);
		$this->load->view('admin/controls/vwFooterJavascript',$data);
        $this->load->view('admin/vwManageCourse',$data);
		
		$this->load->view('admin/controls/vwFooter');
	}

	public function course_view()
	{
		$data['page'] = 'Course';
		$sql_details=$this->common->sql_detial();
		echo $results = $this->course->get_datatables($sql_details);
	}
	
	public function add_course() { //this is use for redirect form in add section start
		$data['page'] = 'Course';
	
		$data['pagetitle']='Manage Course | Add  '.$data['page'];
		$data['ckeditor']=true;
		$data['gridTable']=false;

		
			$formSubmit = $this->input->post('Submit');
			if($formSubmit=="Save")
			{
				$duplicate_course=$this->common->CountByTable('course','WHERE course_name="'.$this->input->post('course_name').'"');
				if($duplicate_course>=1)
				{
					$data['error']='Please enter other course name. This course name already exists.';
				}
				else
				{
					$filepath="";			
					$tblName = "course";
						
						
							$url_value=strtolower(preg_replace('/-+/', '-', preg_replace('/[^\wáéíóú]/', '-', $this->input->post('course_name'))));
							$data = array(
							'course_name'=>$this->input->post('course_name'),
							'course_subject'=>$this->input->post('course_subject'),
							'course_details'=>$this->input->post('description'),
							'course_duration'=>$this->input->post('course_duration'),
							'created_at' => date('Y-m-d'),
							'url_path'=>$url_value,
							'created_by'=>$this->session->userdata('id')
							);
							$this->common->insert_record($tblName,$data);
					
							$this->session->set_flashdata('msg', 'course has been added successfully.');
							redirect('admin/course/','refresh'); //redirect in manage with msg
				}
					
				
			}
			else
			{
				$this->form_validation->set_rules('course_image', 'course', 'required');
				$this->form_validation->set_message('required', 'Please upload course/event.');
				if ($this->form_validation->run() === FALSE)
				{
					
					$this->load->view('admin/controls/vwHeader');
					$this->load->view('admin/controls/vwLeft',$data);
					
					$this->load->view('admin/vwAddCourse',$data);    
					$this->load->view('admin/controls/vwFooter');
					$this->load->view('admin/controls/vwFooterJavascript',$data);
				}
			}
		
	} //this is use for redirect form in add section end */
	
	
    public function edit_course($id='') //this is use for edit records start
	{
		
        $data['page'] = 'Course';
		$data['pagetitle']='Manage Course | Edit '.$data['page'];
		$data['ckeditor']=true;
		$data['gridTable']=false;
		if($id!='')
		{	
		
			$formSubmit = $this->input->post('Submit');
			if($formSubmit=="Save")
			{
				 $tblName = "course";
				 $fieldName = "course_id";
				
				$data['error']='';
				 $duplicate_course=$this->common->CountByTable('course','WHERE course_id!="'.$id.'" AND course_name="'.$this->input->post('course_name').'"' );
				if($duplicate_course>=1)
				{
					$data['error']='Please enter other course name. This course name already exists.';
				}
				if($data['error']=="")
				{

					$url_value=strtolower(preg_replace('/-+/', '-', preg_replace('/[^\wáéíóú]/', '-', $this->input->post('course_name'))));
					
					$data = array(
					'course_name'=>$this->input->post('course_name'),
					'course_subject'=>$this->input->post('course_subject'),
					'course_details'=>$this->input->post('description'),
					'course_duration'=>$this->input->post('course_duration'),
					'updated_at' => date('Y-m-d'),
					'url_path'=>$url_value,
					'created_by'=>$this->session->userdata('id')
					);
					
					$this->common->update_record($fieldName,$id,$tblName,$data);
					$this->session->set_flashdata('msg', 'Course has been updated successfully.');
					redirect('admin/course/','refresh'); //redirect in manage with msg
				}
			}
			
			
			$data['course']=$this->course->get_course_by_id($id);
			$this->load->view('admin/controls/vwHeader');
			$this->load->view('admin/controls/vwLeft',$data);
	        $this->load->view('admin/vwEditCourse',$data);
			$this->load->view('admin/controls/vwFooter');
			$this->load->view('admin/controls/vwFooterJavascript',$data);
		}
		else
		{
            redirect('admin/course');
        }
    } //this is use for edit records end
	public function view_course($id='') //this is use for edit records start
	{
       		$data['page'] = 'Course';
			$data['ckeditor']=false;
			$data['gridTable']=false;
			$data['pagetitle']='Manage Course';
			$data['course']=$this->course->get_course_by_id($id);
			$this->load->view('admin/controls/vwHeader');
			$this->load->view('admin/controls/vwLeft',$data);
			$this->load->view('admin/vwViewCourse',$data);
			$this->load->view('admin/controls/vwFooter');
			$this->load->view('admin/controls/vwFooterJavascript');
		
    }
	public function delete_content($id) {
		$arr['page'] = 'Course';
		$this->course->delete_record('course_id',$id,'course');
		echo "delete";			
    }
	public function bulk_delete() {
		$arr['page'] = 'Course';
		$ids = ( explode( ',', $this->input->get_post('data_ids') ));
			$this->course->delete_all($ids);
			echo 'delete';
    }
		
	public function is_active($val,$id)
	{
		$fieldName='is_active';
		$fieldId='course_id';
		$tableName='course';
		$this->common->update_is_active($val,$id,$fieldName,$fieldId,$tableName);
	}

} 