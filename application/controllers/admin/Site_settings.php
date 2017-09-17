<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site_Settings extends Admin_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Site_settings_model','site_settings');
		
	}

	public function index()
	{
		$data['page'] = 'Site Settings';
		$data['ckeditor']=false;
		$data['pagetitle']='Manage'.' Site Settings';
		$data['gridTable']=false;
	
		
		$formSubmit = $this->input->post('Submit');
		if ($formSubmit=="Save")
		{
			
		$tblName = "site_settings";
		$fieldName="site_settings_id";
		
		
		$data = array(
								'site_copy_right' => $this->input->post('site_copy_right'),
								'site_project_name' => $this->input->post('site_project_name'),
								'site_url' => $this->input->post('site_url'),
								'default_page_size' => $this->input->post('default_page_size'),
								'meta_title' => $this->input->post('meta_title'),
								'meta_keyword' => $this->input->post('meta_keyword'),
								'meta_description' => $this->input->post('meta_description'),
								'admin_mailing_address' => $this->input->post('admin_mailing_address'),
								'site_email' => $this->input->post('site_email'),
								'site_phone_number' => $this->input->post('site_phone_number'),
								'fax_number' => $this->input->post('fax_number'),
								'site_office_address' => $this->input->post('site_office_address')
								);
						
						$id=1;
						$fieldName = "site_settings_id";
						$this->common->update_record($fieldName,$id,$tblName,$data);
						$this->session->set_flashdata('msg', 'Site Settings has been updated successfully.');
						redirect('admin/site_settings/','refresh'); //redirect in manage with msg
		}
			
			$data['site_settings']=$this->site_settings->get_site_settings();
			$this->load->view('admin/controls/vwHeader');
			$this->load->view('admin/controls/vwLeft',$data);
			$this->load->view('admin/controls/vwFooterJavascript',$data);
			$this->load->view('admin/vwManageSiteSettings',$data);
			$this->load->view('admin/controls/vwFooter');
		
	}
	
}
