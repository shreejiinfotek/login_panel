<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Application_form extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Application_form_model','application_form');
	         
	}

	public function index()
	{
		$data['page'] = 'Application';
		$data['path'] = ''.base_url().'admin/application_form/delete_content/';
		$data['bulk_path'] = ''.base_url().'admin/application_form/bulk_delete/';
		$data['ckeditor']=false;
		$data['soringCol']='"order": [[ 1, "desc" ]],';
		$data['manage_view_path']=''.base_url().'admin/application_form/application_view/';
		$data['pagetitle']='Manage'.' Applications';
		$data['gridTable']=true;
		
		$this->load->view('admin/controls/vwHeader');
		$this->load->view('admin/controls/vwLeft',$data);
		$this->load->view('admin/controls/vwFooterJavascript',$data);
        $this->load->view('admin/vwManageApplication',$data);
		
		$this->load->view('admin/controls/vwFooter');
	}
	public function application_view()
	{
		$data['page'] = 'Application';
		$sql_details=$this->common->sql_detial();
		echo $list = $this->application_form->get_datatables($sql_details);
	}
	public function view_application_form($id='') //this is use for edit records start
	{
       		$data['page'] = 'Application';
			$data['ckeditor']=false;
			$data['gridTable']=false;
			$data['pagetitle']='Manage Applications';
			$data['application_form']=$this->application_form->get_application_form_by_id($id);
			$data['external_qualification_list']=$this->application_form->get_external_qualification($id);
			$this->load->view('admin/controls/vwHeader');
			$this->load->view('admin/controls/vwLeft',$data);
		
			$this->load->view('admin/vwViewApplication',$data);
			$this->load->view('admin/controls/vwFooter');
			$this->load->view('admin/controls/vwFooterJavascript');
		
    } //this is use for edit records end
	public function delete_content($id) {
		
		$arr['page'] = 'Application';
		$this->application_form->delete_record('applicant_id',$id,'external_qualification');
		$this->application_form->delete_record('applicant_id',$id,'applicant_enquiry');
		echo "delete";
			
    }
	public function bulk_delete() {
		$arr['page'] = 'Application';
	
		$ids = ( explode( ',', $this->input->get_post('data_ids') ));
		$this->application_form->delete_all($ids);
		echo 'delete';
			
    }
		
}
?>