<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sub_menu extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Sub_menu_model','sub_menu');
		
	}

	public function index()
	{
		$data['table_count']=$this->common->CountByTable('sub_menu','');
		$data['page'] = 'Sub Menu';
		$data['path'] = ''.base_url().'admin/sub_menu/delete_content/';
		$data['bulk_path'] = ''.base_url().'admin/sub_menu/bulk_delete/';
		$data['is_active_path']=''.base_url().'admin/sub_menu/is_active/';
		$data['ckeditor']=false;
		$data['soringCol']='"order": [[ 1, "asc" ]],';
		$data['manage_view_path']=''.base_url().'admin/sub_menu/submenu_view/';
		$data['pagetitle']='Manage'.' '.$data['page'].'s';
		$data['gridTable']=true;
		
		$this->load->view('admin/controls/vwHeader');
		$this->load->view('admin/controls/vwLeft',$data);
		$this->load->view('admin/controls/vwFooterJavascript',$data);
        $this->load->view('admin/vwManageSubMenu',$data);
		$this->load->view('admin/controls/vwFooter');
	}

	public function submenu_view()
	{
	
		$data['page'] = 'Sub Menu';
		$sql_details=$this->common->sql_detial();
		echo $list = $this->sub_menu->get_datatables($sql_details);
	}
	
	public function add_submenu() { //this is use for redirect form in add section start
	
		$data['page'] = 'Sub Menu';
		$data['pagetitle']='Manage'.' '.$data['page'].'s | Add '.$data['page'];

		$data['ckeditor']=true;
		$data['gridTable']=false;
		$data['menus'] = $this->sub_menu->get_menu();
		//$this->form_validation->set_rules('content_id', 'main menu', 'required|callback_main_menu_check');
		$this->form_validation->set_rules('menu_name', 'menu name', 'required');
		$this->form_validation->set_rules('menu_title', 'menu title', 'required');
		
		$formSubmit = $this->input->post('Submit');
			if($formSubmit=="Save")
			{
				$data['error']="";
				$tblName = "sub_menu";
				$duplicate_submenu=$this->common->CountByTable('sub_menu','WHERE menu_name="'.$this->input->post('menu_name').'"');
					if($duplicate_submenu>=1)
					{
						$data['error']='Please enter other menu. This menu already exists.';
					}
					
			if($data['error']=="")
			{
				if($this->form_validation->run() === TRUE)
				{
					
				if($this->input->post('is_active')=="on")
				{
					$is_active=1;	
				}
				else
				{
					$is_active=0;
				}
				
				if($this->input->post('menu_name') != '')
				{
					$url_value=strtolower(preg_replace('/-+/', '-', preg_replace('/[^\wáéíóú]/', '-', $this->input->post('menu_name'))));
					$data = array(
					//'content_id' => $this->input->post('content_id'),
					'menu_name' => $this->input->post('menu_name'),
					'menu_title' => $this->input->post('menu_title'),
					'description' => $this->input->post('description'),
					'meta_title' => $this->input->post('meta_title'),
					'meta_keyword' => $this->input->post('meta_keyword'),
					'meta_description' => $this->input->post('meta_description'),
					'display_order' => $this->input->post('display_order'),
					'url_path' => $url_value
					
					
				);
					
				}
			
				if(isset($_POST['menu_name']) && !empty($_POST['menu_name']))
				{
					$this->common->insert_record($tblName,$data);
				}
				$this->session->set_flashdata('msg', 'Sub Menu has been added successfully.');
				redirect('admin/sub_menu/','refresh'); //redirect in manage with msg
				}
		}
	}
			$this->load->view('admin/controls/vwHeader');
					$this->load->view('admin/controls/vwLeft',$data);
					$this->load->view('admin/vwAddSubMenu',$data);    
					$this->load->view('admin/controls/vwFooter');
					$this->load->view('admin/controls/vwFooterJavascript',$data);
		
	} //this is use for redirect form in add section end
	public function view_submenu($id='') //this is use for edit records start
	{
       		$data['page'] = 'Sub Menu';
			$data['ckeditor']=false;
			$data['gridTable']=false;
			$data['pagetitle']='Manage'.' '.$data['page'].'s';
			$arr['sub_menus']=$this->sub_menu->view_submenu($id);
			$this->load->view('admin/controls/vwHeader');
			$this->load->view('admin/controls/vwLeft',$data);
		
			$this->load->view('admin/vwViewSubMenu.php',$arr);
			$this->load->view('admin/controls/vwFooter');
			$this->load->view('admin/controls/vwFooterJavascript');
		
    } //this is use for edit records end
    public function edit_submenu($id='') //this is use for edit records start
	{
        $data['page'] = 'Sub Menu';
		$data['pagetitle']='Manage'.' '.$data['page'].'s | Edit '.$data['page'];
		$data['ckeditor']=true;
		$data['gridTable']=false;
		$this->form_validation->set_rules('content_id', 'main menu', 'required|callback_main_menu_check');
		$this->form_validation->set_rules('menu_name', 'menu name', 'required');
		$this->form_validation->set_rules('menu_title', 'menu title', 'required');
		
			if($id!='')
			{
				$formSubmit = $this->input->post('Submit');
				if($formSubmit=="Save")
				{
					$tblName = "sub_menu";
					$fieldName = "sub_menu_id";
					
					$data['error']="";
				
				$duplicate_submenu=$this->common->CountByTable('sub_menu','WHERE sub_menu_id!="'.$id.'" AND menu_name="'.$this->input->post('menu_name').'"');
				if($duplicate_submenu>=1)
				{
					//echo "====>".$duplicate_submenu; exit();
					$data['error']='Please enter other menu. This menu already exists.';
				}
				else
				{
					if($data['error']=="")
					{
						
					if($this->input->post('is_active')=="on")
					{
						$is_active=1;	
					}
					else
					{
						$is_active=0;
					}
					
					
						
					$url_value=strtolower(preg_replace('/-+/', '-', preg_replace('/[^\wáéíóú]/', '-', $this->input->post('menu_name'))));
					$data = array(
					//	'content_id' => $this->input->post('content_id'),
						'menu_name' => $this->input->post('menu_name'),
						'menu_title' => $this->input->post('menu_title'),
						'description' => $this->input->post('description'),
						'meta_title' => $this->input->post('meta_title'),
						'meta_keyword' => $this->input->post('meta_keyword'),
						'meta_description' => $this->input->post('meta_description'),
						'display_order' => $this->input->post('display_order'),
						'url_path' => $url_value,
						'is_active' => $is_active,
						
					);
					
					$this->common->update_record($fieldName,$id,$tblName,$data);
					$this->session->set_flashdata('msg', 'Sub Menu has been updated successfully.');
					redirect('admin/sub_menu/','refresh'); //redirect in manage with msg
					}
				}
			  }
			$data['sub_menu']=$this->sub_menu->get_sub_menu_by_page_id($id);
			$data['menus'] = $this->sub_menu->get_menu();
			$this->load->view('admin/controls/vwHeader');
			$this->load->view('admin/controls/vwLeft',$data);
			$this->load->view('admin/vwEditSubMenu',$data);
			$this->load->view('admin/controls/vwFooter');
			$this->load->view('admin/controls/vwFooterJavascript',$data);
			}
			else
			{
				redirect('admin/sub_menu');
			}
		
    } //this is use for edit records end
	public function delete_content($id) {
			$arr['page'] = 'Sub Menu';
			
			$sub_menu_count=$this->common->CountByTable('content','WHERE FIND_IN_SET('.$id.',sub_menu_ids)');
		
			if($sub_menu_count>0)
			{
				echo 'ref_id';
			}
			else
			{
				$this->sub_menu->delete_record('sub_menu_id',$id,'sub_menu');
				echo "delete";
			}
			
		}
	
	public function bulk_delete() {
		$arr['page'] = 'Sub Menu';
		
		$ids = ( explode( ',', $this->input->get_post('data_ids') ));
	
		
		if($this->sub_menu->delete_all($ids))
		{
			echo 'delete';
		}
		else
		{
			echo 'ref_id';
		}
		
    }
	
	public function main_menu_check()//use for form validation message
    {
            if($this->input->post('content_id')==="")  {
				
            $this->form_validation->set_message('main_menu_check', 'Please select main menu.');
            return FALSE;
        }
        else {
            return TRUE;
        }
    }
	public function is_active($val,$id)
	{
		$fieldName='is_active';
		$fieldId='sub_menu_id';
		$tableName='sub_menu';
		$this->common->update_is_active($val,$id,$fieldName,$fieldId,$tableName);
	}
	
}
