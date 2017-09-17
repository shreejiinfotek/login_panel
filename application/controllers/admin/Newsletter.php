<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Newsletter extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Newsletter_model','newsletter');
		
	}

	public function index()
	{
		$data['page'] = 'Newsletter';
		$data['path'] = ''.base_url().'admin/newsletter/delete_content/';
		$data['bulk_path'] = ''.base_url().'admin/newsletter/bulk_delete/';
		$data['ckeditor']=false;
		$data['soringCol']='"order": [[ 1, "asc" ]],';
		$data['manage_view_path']=''.base_url().'admin/newsletter/newsletter_view/';
		$data['is_status_path']=''.base_url().'admin/newsletter/is_status/';
		$data['pagetitle']='Manage'.' '.$data['page'].'s';
		$data['gridTable']=true;
		
		$this->load->view('admin/controls/vwHeader');
		$this->load->view('admin/controls/vwLeft',$data);
		$this->load->view('admin/controls/vwFooterJavascript',$data);
        $this->load->view('admin/vwManageNewsletter',$data);
		
		$this->load->view('admin/controls/vwFooter');
	}

	public function newsletter_view()
	{
		$data['page'] = 'Newsletter';
		$sql_details=$this->common->sql_detial();
		echo $list = $this->newsletter->get_datatables($sql_details);
	}
	public function add_newsletterform() { //this is use for redirect form in add section start
		$data['page'] = 'Newsletter';
		$data['pagetitle']='Manage'.' '.$data['page'].'s | Add '.$data['page'];

		$data['ckeditor']=true;
		$data['gridTable']=false;
		
		$formSubmit = $this->input->post('Submit');
		if($formSubmit=="Save")
		{
			$tblName = "newsletter";
			
			$data = array(
			'subject' => $this->input->post('subject'),
			'description' => $this->input->post('description'),
			'created_date' => date('Y-m-d')
			
			);
			$this->common->insert_record($tblName,$data);
	
			$this->session->set_flashdata('msg', 'Newsletter has been added successfully.');
			redirect('admin/newsletter/','refresh'); //redirect in manage with msg
		}
		
		$this->load->view('admin/controls/vwHeader');
		$this->load->view('admin/controls/vwLeft',$data);
		
		$this->load->view('admin/vwAddNewsletter',$data);    
		$this->load->view('admin/controls/vwFooter');
		$this->load->view('admin/controls/vwFooterJavascript',$data);
	} //this is use for redirect form in add section end
    public function edit_newsletter($id='') //this is use for edit records start
	{
        $data['page'] = 'Newsletter';
		$data['pagetitle']='Manage'.' '.$data['page'].'s | Edit '.$data['page'];
		$data['ckeditor']=true;
		$data['gridTable']=false;
		if($id!='')
		{
			$formSubmit = $this->input->post('Submit');
			if($formSubmit=="Save")
			{
				$tblName = "newsletter";
				$fieldName = "news_latter_id";
				
				
				$data = array(
				'subject' => $this->input->post('subject'),
				'description' => $this->input->post('description')
			
				);
				
				$this->common->update_record($fieldName,$id,$tblName,$data);
				$this->session->set_flashdata('msg', 'Newsletter has been updated successfully.');
				redirect('admin/newsletter/','refresh'); //redirect in manage with msg
			}
			
			$data['newsletter']=$this->newsletter->edit_newsletter_form($id);
			$this->load->view('admin/controls/vwHeader');
			$this->load->view('admin/controls/vwLeft',$data);
	        $this->load->view('admin/vwEditNewsletter',$data);
			$this->load->view('admin/controls/vwFooter');
			$this->load->view('admin/controls/vwFooterJavascript',$data);
		}
		else
		{
            redirect('admin/newsletter');
        }
    } //this is use for edit records end
	
	public function delete_content($id) {
		
		$arr['page'] = 'Newsletter';
		
		$this->newsletter->delete_record('news_latter_id',$id,'newsletter');
		echo "delete";			
    }
	public function bulk_delete() {
		$arr['page'] = 'Newsletter';
	
		$ids = ( explode( ',', $this->input->get_post('data_ids') ));
			$this->newsletter->delete_all($ids);
			echo 'delete';
			
    }
	public function is_status($val,$id)
	{
		$fieldName='is_status';
		$fieldId='news_latter_id';
		$tableName='newsletter';
		$this->common->update_is_status($val,$id,$fieldName,$fieldId,$tableName);
	}

}
