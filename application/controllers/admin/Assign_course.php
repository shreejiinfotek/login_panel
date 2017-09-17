<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Assign_course extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Assign_course_model','assigncourse');
		$this->load->model('Student_model','student');
		$this->load->model('Course_model','course');
	}

	public function index()
	{
		$data['page'] = 'Assign Course';
		$data['path'] = ''.base_url().'admin/assign_course/delete_assign_course/';
		$data['bulk_path'] = ''.base_url().'admin/assign_course/bulk_delete/';
		$data['ckeditor']=false;
		
		$data['soringCol']='"order": [[ 1, "asc" ]],';
	
		$data['manage_view_path']=''.base_url().'admin/assign_course/assign_course_view/';
		$data['pagetitle']='Manage'.' '.$data['page'].'s';
		$data['gridTable']=true;
		
		$this->load->view('admin/controls/vwHeader');
		$this->load->view('admin/controls/vwLeft',$data);
		$this->load->view('admin/controls/vwFooterJavascript',$data);
        $this->load->view('admin/vwManageAssignCourse',$data);
		
		$this->load->view('admin/controls/vwFooter');
	}

	public function assign_course_view()
	{
		$data['page'] = 'Assign Course';
		$sql_details=$this->common->sql_detial();
		echo $list = $this->assigncourse->get_datatables($sql_details);
	}
	
	public function add_assign_course() {
		
		$data['page'] = 'Assign Course';
		$data['pagetitle']='Manage'.' '.$data['page'].'s | Add '.$data['page'];
		$data['ckeditor']=false;
		$data['gridTable']=false;
		$formSubmit = $this->input->post('Submit');
		if($formSubmit=="Save")
		{
			//$team_ids="";
			$course_id_array=$this->input->post('course_id');
			
			
			$tblName = "assign_course_student";
			
		foreach($course_id_array as $nkey)
		 {	
			$data = array(
				'student_id'=>$this->input->post('student_id'),
				'course_id' =>$nkey,
				'created_date'=>date('Y-m-d')
		
			);
			$this->common->insert_record($tblName,$data);
		  }
			
			
			
			
			$this->session->set_flashdata('msg', 'Course has been assigned successfully.');
			redirect('admin/assign_course','refresh'); //redirect in manage with msg //redirect in manage with msg
						
			
			
	}
		$data['course']=$this->course->get_course_list();
		$data['student_list']=$this->student->get_student();
		$this->load->view('admin/controls/vwHeader');
		$this->load->view('admin/controls/vwLeft',$data);
		$this->load->view('admin/vwAddAssignCourse',$data);    
		$this->load->view('admin/controls/vwFooter');
		$this->load->view('admin/controls/vwFooterJavascript',$data);			
		
	} //this is use for redirect form in add section end 
	

	public function edit_assign_course($id='') //this is use for edit records start
	{
        $data['page'] = 'Assign Course';
		$data['pagetitle']='Manage'.' '.$data['page'].'s | Edit '.$data['page'];
		$data['ckeditor']=false;
		$data['gridTable']=false;
		
		if($id!='')
		{
			$formSubmit = $this->input->post('Submit');
			if($formSubmit=="Save")
			{
				//$tournament_group_id=$this->common->GetValue('assign_course_team','tournament_group_id','assign_course_team_id',''.$id.'');
				//$tournament_id=$this->common->GetValue('assign_course_team','tournament_id','assign_course_team_id',''.$id.'');
				
				 $tblName = "assign_course_student";
				 $fieldName = "assign_course_student_id";
				$course_id_array=$this->input->post('course_id');
				$tblName = "assign_course_student";
				$student_id=$this->input->post('hd_student_id');
			$this->assigncourse->delete_record('student_id',$student_id,$tblName);
				foreach($course_id_array as $nkey)
				 {	
					$data = array(
						'student_id'=>$student_id,
						'course_id' =>$nkey,
						'created_date'=>date('Y-m-d')
				
					);
					
					
					$this->common->insert_record($tblName,$data);
				  }	
				
				$this->session->set_flashdata('msg', 'Course has been assigned successfully.');
					redirect('admin/assign_course/','refresh'); //redirect in manage with msg
					
				
			}
			
		
			$data['course']=$this->course->get_course_list();
			$data['assigncourse']=$this->assigncourse->get_assign_course($id);
			$data['getassigncourse']=$this->assigncourse->get_assign_course_by_student_id($data['assigncourse']->student_id);
			$data['student_list']=$this->student->get_student();
			$this->load->view('admin/controls/vwHeader');
			$this->load->view('admin/controls/vwLeft',$data);
	        $this->load->view('admin/vwEditAssignGroup',$data);
			$this->load->view('admin/controls/vwFooter');
			$this->load->view('admin/controls/vwFooterJavascript',$data);
			
		}
		else
		{
            redirect('admin/assign_course');
        }
		
    } //this is use for edit records end

	public function delete_assign_course($id) {
		
		$arr['page'] = 'Assign Course';
		
		$this->assigncourse->delete_record('assign_course_student_id',$id,'assign_course_student');
		
		echo "delete";			
    }
	
		
	
	public function bulk_delete() {
		$arr['page'] = 'Assign Course';
	
		$ids = ( explode( ',', $this->input->get_post('data_ids') ));
			$this->assigncourse->delete_all($ids);
			echo 'delete';
			
    }
	

}