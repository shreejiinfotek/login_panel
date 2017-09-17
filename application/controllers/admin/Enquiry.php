<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Enquiry extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Enquiry_model','enquiry');
		
	}

	public function index()
	{
		$data['page'] = 'Enquiry';
		$data['path'] = ''.base_url().'admin/enquiry/delete_content/';
		$data['bulk_path'] = ''.base_url().'admin/enquiry/bulk_delete/';
		$data['ckeditor']=false;
		$data['soringCol']='"order": [[ 4, "desc" ]],';
		$data['manage_view_path']=''.base_url().'admin/enquiry/enquiry_view/';
		$data['pagetitle']='Manage'.' Enquiry';
		$data['gridTable']=true;
		
		$this->load->view('admin/controls/vwHeader');
		$this->load->view('admin/controls/vwLeft',$data);
		$this->load->view('admin/controls/vwFooterJavascript',$data);
        $this->load->view('admin/vwManageEnquiry',$data);
		
		$this->load->view('admin/controls/vwFooter');
	}
	public function enquiry_view()
	{
		$data['page'] = 'Enquiry';
		$sql_details=$this->common->sql_detial();
		echo $list = $this->enquiry->get_datatables($sql_details);
	}
	public function view_enquiry($id='') //this is use for edit records start
	{
       		$data['page'] = 'Enquiry';
			$data['ckeditor']=false;
			$data['gridTable']=false;
			$data['pagetitle']='Manage Enquiry';
			$data['enquiry']=$this->enquiry->get_enquiry_by_id($id);
			$this->load->view('admin/controls/vwHeader');
			$this->load->view('admin/controls/vwLeft',$data);
			$this->load->view('admin/vwViewEnquiry',$data);
			$this->load->view('admin/controls/vwFooter');
			$this->load->view('admin/controls/vwFooterJavascript');
		
    } //this is use for edit records end
	public function delete_content($id) {
		
		$arr['page'] = 'Enquiry';
		$this->enquiry->delete_record('enquiry_id',$id,'enquiry');
		echo "delete";
			
    }
	public function bulk_delete() {
		$arr['page'] = 'Enquiry';
	
		$ids = ( explode( ',', $this->input->get_post('data_ids') ));
		$this->enquiry->delete_all($ids);
		echo 'delete';
			
    }

}
