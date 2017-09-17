<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mis_reports extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mis_model','mis_model');
		$this->load->model('Course_model','course');
	}

	public function index()
	{
		$data['page'] = 'MIS Report';
		$data['path'] = ''.base_url().'admin/mis_reports/delete_content/';
		$data['bulk_path'] = ''.base_url().'admin/mis_reports/bulk_delete/';
		$data['ckeditor']=false;
		$data['soringCol']='"order": [[ 0, "asc" ]],';
		$data['manage_view_path']=''.base_url().'admin/mis_reports/content_view/';
		$data['pagetitle']='Manage'.' '.$data['page'].'s';
		$data['is_active_path']=''.base_url().'admin/mis_reports/is_active/';
		$data['gridTable']=true;
		$data['course']=$this->course->get_course_list();
		$this->load->view('admin/controls/vwMISReportHeader');
		$this->load->view('admin/controls/vwLeft',$data);
		$this->load->view('admin/controls/vwMISReportFooterJavascript',$data);
        $this->load->view('admin/vwManageMisReport',$data);
		
		$this->load->view('admin/controls/vwFooter');
	}

	public function content_view()
	{
		$data['page'] = 'MIS Report';
		$sql_details=$this->common->sql_detial();
		$course_name = $_GET['course_name'];
		$cast_name = $_GET['cast_name'];
		$gender = $_GET['gender'];
		$age_from = $_GET['age_from'];
		$age_to = $_GET['age_to'];
		echo $list = $this->mis_model->get_datatables($sql_details,$course_name,$cast_name,$gender,$age_from,$age_to);
	}
	
}
