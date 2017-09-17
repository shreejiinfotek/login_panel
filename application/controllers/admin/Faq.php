<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Faq extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Faq_model','faq');
		
	}

	public function index()
	{
		$data['page'] = 'FAQ';
		$data['pagetitle']='Manage'.' '.$data['page'].'s';
		$data['path'] = ''.base_url().'admin/faq/delete_content/';
		$data['bulk_path'] = ''.base_url().'admin/faq/bulk_delete/';
		$data['ckeditor']=false;
		$data['soringCol']='"order": [[ 1, "asc" ]],';
		$data['manage_view_path']=''.base_url().'admin/faq/content_view/';
		$data['pagetitle']='Manage'.' '.$data['page'].'s';
		$data['is_active_path']=''.base_url().'admin/faq/is_active/';
		$data['gridTable']=true;
		
		$this->load->view('admin/controls/vwHeader');
		$this->load->view('admin/controls/vwLeft',$data);
        $this->load->view('admin/vwManageFaq',$data);
		$this->load->view('admin/controls/vwFooterJavascript',$data);
		$this->load->view('admin/controls/vwFooter');
	}

	public function content_view()
	{
		$data['page'] = 'FAQ';
		$sql_details=$this->common->sql_detial();
		echo $list = $this->faq->get_datatables($sql_details);
	}
	public function add_faq() { //this is use for redirect form in add section start
		$data['page'] = 'FAQ';
		$data['pagetitle']='Manage'.' '.$data['page'].'s | Add '.$data['page'];
		$data['gridTable']=false;
		$data['ckeditor']=true;
		

		$this->form_validation->set_rules('faq_question', 'faq question', 'required');
		$this->form_validation->set_rules('faq_answer', 'faq answer', 'required');
		
		$formSubmit = $this->input->post('Submit');
		if($formSubmit=="Save")
		{
			
			
						$tblName = "faq";
						
							$url_value=strtolower(preg_replace('/-+/', '-', preg_replace('/[^\wáéíóú]/', '-', $this->input->post('faq_question'))));
							$data = array(
							'faq_question' => $this->input->post('faq_question'),
							'faq_answer' => $this->input->post('description'),
							'display_order' => $this->input->post('display_order'),
							'url_path'=>$url_value,
							);
						
							$this->common->insert_record($tblName,$data);
							
						
						$this->session->set_flashdata('msg', 'Faq has been added successfully.');
						redirect('admin/faq/','refresh'); //redirect in manage with msg
		
		}
		//	$data['i']=1;
			
			$this->load->view('admin/controls/vwHeader');
			$this->load->view('admin/controls/vwLeft',$data);
			
			$this->load->view('admin/vwAddFaq',$data); 
			$this->load->view('admin/controls/vwFooterJavascript',$data);
			$this->load->view('admin/controls/vwFooter');
			
		
	} //this is use for redirect form in add section end

    public function edit_faq($id='') //this is use for edit records start
	{
        $data['page'] = 'FAQ';
		$data['pagetitle']='Manage'.' '.$data['page'].'s | Edit '.$data['page'];
		$data['ckeditor']=true;
		$data['gridTable']=false;
		
		$data['faq']=$this->faq->get_faq_by_id($id);
		
		$this->form_validation->set_rules('faq_question', 'faq question', 'required');
		$this->form_validation->set_rules('faq_answer', 'faq answer', 'required');
		
		if($id!='')
		{
			$formSubmit = $this->input->post('Submit');
			if($formSubmit=="Save")
			{
			
							$tblName = "faq";
							$fieldName="faq_id";
							
							$url_value=strtolower(preg_replace('/-+/', '-', preg_replace('/[^\wáéíóú]/', '-', $this->input->post('faq_question'))));
							
								$data = array(
								'faq_question' => $this->input->post('faq_question'),
								'faq_answer' => $this->input->post('description'),
								'display_order' => $this->input->post('display_order'),
							 	'url_path'=>$url_value,
								);
								
							$this->common->update_record($fieldName,$id,$tblName,$data);
							
							$this->session->set_flashdata('msg', 'Faq has been updated successfully.');
							redirect('admin/faq/','refresh'); //redirect in manage with msg
			
			}
			$data['faq']=$this->faq->get_faq_by_id($id);
			$this->load->view('admin/controls/vwHeader');
			$this->load->view('admin/controls/vwLeft',$data);
	        $this->load->view('admin/vwEditFaq',$data);
			$this->load->view('admin/controls/vwFooter');
			$this->load->view('admin/controls/vwFooterJavascript',$data);
		}
		else
		{
            redirect('admin/faq');
        }
    } //this is use for edit records end

	public function delete_content($id) {
		
		$arr['page'] = 'Faq';
		
		$this->faq->delete_record('faq_id',$id,'faq');
		echo "delete";			
    }
	public function bulk_delete() {
		$arr['page'] = 'Faq';
	
		$ids = ( explode( ',', $this->input->get_post('data_ids') ));
			$this->faq->delete_all($ids);
			echo 'delete';
			
    }
	
	public function is_active($val,$id)
	{
		$fieldName='is_active';
		$fieldId='faq_id';
		$tableName='faq';
		$this->common->update_is_active($val,$id,$fieldName,$fieldId,$tableName);
	}

	
}