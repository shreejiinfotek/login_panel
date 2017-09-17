<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Google_Analytics extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Google_analytics_model','google_analytics');
		
	}

	public function index()
	{
		$data['page'] = 'Google Analytics';
		$data['ckeditor']=false;
		$data['pagetitle']='Manage'.' Google Analytics';
		$data['gridTable']=false;
		$formSubmit = $this->input->post('Submit');
		if ($formSubmit=="Save")
		{
		$tblName = "google_analytics";
		$fieldName="";
						$data = array(
								'google_analytics_code' => $this->input->post('google_analytics_code')
								);
						$id=1;
						$fieldName = "google_analytics_id";
						$this->common->update_record($fieldName,$id,$tblName,$data);
						$this->session->set_flashdata('msg', 'Google Analytics has been updated successfully.');
						redirect('admin/google_analytics/','refresh'); //redirect in manage with msg
		}
		$data['google_analytics']=$this->google_analytics->get_google_analytics();
			$this->load->view('admin/controls/vwHeader');
			$this->load->view('admin/controls/vwLeft',$data);
			$this->load->view('admin/controls/vwFooterJavascript',$data);
			$this->load->view('admin/vwManageGoogleAnalytics',$data);
			
			$this->load->view('admin/controls/vwFooter');
		
	}
}
