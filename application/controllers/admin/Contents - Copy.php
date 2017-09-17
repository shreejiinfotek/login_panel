<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Contents_model','content');
		
	}

	public function index()
	{
		$data['page'] = 'Page';
		$data['path'] = ''.base_url().'admin/pages/delete_content/';
		$data['bulk_path'] = ''.base_url().'admin/pages/bulk_delete/';
		$data['ckeditor']=false;
		$data['soringCol']='"order": [[ 1, "asc" ]],';
		$data['manage_view_path']=''.base_url().'admin/pages/content_view/';
		$data['pagetitle']='Manage'.' '.$data['page'].'s';
		$data['is_active_path']=''.base_url().'admin/pages/is_active/';
		$data['gridTable']=true;
		
		$this->load->view('admin/controls/vwHeader');
		$this->load->view('admin/controls/vwLeft',$data);
		$this->load->view('admin/controls/vwFooterJavascript',$data);
        $this->load->view('admin/vwManageContent',$data);
		
		$this->load->view('admin/controls/vwFooter');
	}

	public function content_view()
	{
		$data['page'] = 'Page';
		$sql_details=$this->common->sql_detial();
		echo $list = $this->content->get_datatables($sql_details);
	}
	public function add_page() { //this is use for redirect form in add section start
		$data['page'] = 'Page';
		$data['pagetitle']='Manage'.' '.$data['page'].'s | Add '.$data['page'];
		$data['gridTable']=false;
		$data['ckeditor']=true;
		
		$this->form_validation->set_rules('page_name', 'page name', 'required');
    	$this->form_validation->set_rules('page_title', 'page title', 'required');
		$this->form_validation->set_rules('description', 'page description', 'required');
		$this->form_validation->set_rules('meta_title', 'meta title', 'required');
		
		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('admin/controls/vwHeader');
			$this->load->view('admin/controls/vwLeft',$data);
			
			$this->load->view('admin/controls/vwMessage');
			
			$this->load->view('admin/vwAddContent',$data);    
			$this->load->view('admin/controls/vwFooter');
			$this->load->view('admin/controls/vwFooterJavascript',$data);
		}
		else
		{
		
		$formSubmit = $this->input->post('Submit');
		if($formSubmit=="Save")
		{
			$tblName = "content";
			if($this->input->post('page_name') != '')
			{
				$data = array(
				'page_name' => $this->input->post('page_name'),
				'page_title' => $this->input->post('page_title'),
				'page_description' => $this->input->post('description'),
				'meta_title' => $this->input->post('meta_title'),
				'meta_keyword' => $this->input->post('meta_keyword'),
				'meta_description' => $this->input->post('meta_description'),
				'display_order' => $this->input->post('display_order'),
				'is_banner'=>$this->input->post('is_banner')
				);
			}
			if(isset($_POST['page_name']) && !empty($_POST['page_name']))
			{
				$this->common->insert_record($tblName,$data);
			}
			$this->session->set_flashdata('msg', 'Page has been added successfully.');
			redirect('admin/pages/','refresh'); //redirect in manage with msg
		}
		}
		
	} //this is use for redirect form in add section end
	
	public function view_page($id='') //this is use for edit records start
	{
       		$data['page'] = 'Page';
			$data['ckeditor']=false;
			$data['gridTable']=false;
			$data['pagetitle']='Manage'.' '.$data['page'].'s';
			$arr['contents']=$this->content->view_content($id);
			$this->load->view('admin/controls/vwHeader');
			$this->load->view('admin/controls/vwLeft',$data);
		
			$this->load->view('admin/vwViewContent',$arr);
			$this->load->view('admin/controls/vwFooter');
			$this->load->view('admin/controls/vwFooterJavascript');
		
    } //this is use for edit records end
    public function edit_page($id='') //this is use for edit records start
	{
        $data['page'] = 'Page';
		$arr['pagetitle']='Manage'.' '.$data['page'].'s | Edit '.$data['page'];
		$data['ckeditor']=true;
		$data['gridTable']=false;
		$this->form_validation->set_rules('page_name', 'page name', 'required');
    	$this->form_validation->set_rules('page_title', 'page title', 'required');
		$this->form_validation->set_rules('description', 'page description', 'required');
		$this->form_validation->set_rules('meta_title', 'meta title', 'required');
		if($id!='')
		{
			if ($this->form_validation->run() === FALSE)
			{
				$arr['contents']=$this->content->edit_content_form($id);
				$this->load->view('admin/controls/vwHeader');
				$this->load->view('admin/controls/vwLeft',$data);
				$this->load->view('admin/vwEditContent',$arr);
				$this->load->view('admin/controls/vwFooter');
				$this->load->view('admin/controls/vwFooterJavascript',$data);
			}
			else
			{
				$formSubmit = $this->input->post('Submit');
				if($formSubmit=="Save")
				{
					$tblName = "content";
					$fieldName = "content_id";
					$data = array(
						'page_name' => $this->input->post('page_name'),
						'page_title' => $this->input->post('page_title'),
						'page_description' => $this->input->post('description'),
						'meta_title' => $this->input->post('meta_title'),
						'meta_keyword' => $this->input->post('meta_keyword'),
						'meta_description' => $this->input->post('meta_description'),
						'display_order' => $this->input->post('display_order'),
						'is_banner'=>$this->input->post('is_banner')	
						
					);
					
					$this->common->update_record($fieldName,$id,$tblName,$data);
					$this->session->set_flashdata('msg', 'Page has been updated successfully.');
					redirect('admin/pages/','refresh'); //redirect in manage with msg
				}
				
			}
		}
		else
		{
            redirect('admin/pages');
        }
    } //this is use for edit records end
	
	public function delete_content($id) {
		
		$arr['page'] = 'Page';
		

		$sub_menu_id=$this->common->GetValue('sub_menu','sub_menu_id','content_id',''.$id.'');
		if($sub_menu_id>0)
		{
			echo "ref_id";//reference id not delete
		}
		else
		{
			
			$this->content->delete_record('content_id',$id,'content');
			echo "delete";
		}
			
    }
	public function bulk_delete() {
		$arr['page'] = 'Page';
	
		$ids = ( explode( ',', $this->input->get_post('data_ids') ));
            
			if($this->content->delete_all($ids)==false)
			{
				echo 'ref_id';
			}
			if($this->content->delete_all($ids)==true)
			{
				echo 'delete';
			}
			
    }
	public function is_active($val,$id)
	{
		$fieldName='is_active';
		$fieldId='content_id';
		$tableName='content';
		$this->common->update_is_active($val,$id,$fieldName,$fieldId,$tableName);
	}

}
