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
		if(SUPER_ADMIN_ENABLE==1)
		{
			$data['soringCol']='"order": [[ 1, "asc" ]],';
		}
	
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
				$url_value=strtolower(preg_replace('/-+/', '-', preg_replace('/[^\wáéíóú]/', '-', $this->input->post('page_name'))));
				
				if(SUPER_ADMIN_ENABLE)
				{
					if($this->input->post('is_banner')=="on")
					{
						$is_banner=1;
					}
					else
					{
						$is_banner=0;
					}
					
					$data = array(
					'page_name' => $this->input->post('page_name'),
					'page_title' => $this->input->post('page_title'),
					'page_description' => $this->input->post('description'),
					'meta_title' => $this->input->post('meta_title'),
					'meta_keyword' => $this->input->post('meta_keyword'),
					'meta_description' => $this->input->post('meta_description'),
					'display_order' => $this->input->post('display_order'),
					'url_path' => $url_value,
					'is_banner' =>$is_banner,
					);
				}
				else
				{
					$data = array(
					'page_name' => $this->input->post('page_name'),
					'page_title' => $this->input->post('page_title'),
					'page_description' => $this->input->post('description'),
					'meta_title' => $this->input->post('meta_title'),
					'meta_keyword' => $this->input->post('meta_keyword'),
					'meta_description' => $this->input->post('meta_description'),
					'display_order' => $this->input->post('display_order'),
					'url_path' => $url_value,
					);
				}
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
			$arr['contents']=$this->content->get_content_by_page_id($id);
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
		//$this->form_validation->set_rules('description', 'page description', 'required');
		$this->form_validation->set_rules('meta_title', 'meta title', 'required');
		if($id!='')
		{
			if ($this->form_validation->run() === FALSE)
			{
				$arr['contents']=$this->content->get_content_by_page_id($id);
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
					$data['error']='';
					if (isset($_FILES['inner_images']) && !empty($_FILES['inner_images']['name']))
					{
						$tmp = $_FILES['inner_images']['name'];
						$ext = explode('.',$tmp);
						$extension  = strtolower($ext[1]);
						
						if(($extension =="gif" || $extension =="jpeg" || $extension =="jpg" || $extension =="png")==false)
						{
							$data['error']="Please upload correct file( gif / jpeg / jpg / png)";
						}
						
					}
					if($data['error']=="")
					{
						$filepath=$this->common->GetValue("content","inner_images","content_id",''.$id.'');
					
						if(!empty($_FILES['inner_images']['name']))
						{
								$tmp = $_FILES['inner_images']['name'];
								$ext = explode('.',$tmp);
								$extension  = strtolower($ext[1]);
								
								$today = date('mdyHis');
								$pathMain = './uploads/Content/';
									if (!is_dir($pathMain))
										mkdir($pathMain, 0755);
								$configImage['upload_path'] = $pathMain;
								$configImage['max_size'] = '10240';
								$configImage['allowed_types'] = 'gif|jpg|jpeg|png';
								$img_name =$today.'.'.$extension;
								$configImage['file_name'] = $img_name;
								$this->load->library('upload', $configImage,'content_img');
								$this->content_img->initialize($configImage);
							
								if (!$this->content_img->do_upload('inner_images')) 
								{
									$data['error']='Please upload correct image( gif / jpeg / jpg / png)';
								}
								else
								{
									$this->load->library('image_lib');
									$configThumb = array();  
									$configThumb['image_library']   = 'gd2'; 
									$configThumb['source_image']  = $pathMain.$img_name; 
									$configThumb['create_thumb']    = TRUE;
									if($filepath!="")
									{
										unlink("./".$filepath);
									}
									$filepath = str_replace("./","",$pathMain.$img_name);
								}
							}
						
						$url_value=strtolower(preg_replace('/-+/', '-', preg_replace('/[^\wáéíóú]/', '-', $this->input->post('page_name'))));
						
						if(SUPER_ADMIN_ENABLE)
						{
							
							if($this->input->post('is_banner')=="on")
							{
								$is_banner=1;
							}
							else
							{
								$is_banner=0;
							}
								$data = array(
									'page_name' => $this->input->post('page_name'),
									'page_title' => $this->input->post('page_title'),
									'inner_images' => $filepath,
									'page_description' => $this->input->post('description'),
									'meta_title' => $this->input->post('meta_title'),
									'meta_keyword' => $this->input->post('meta_keyword'),
									'meta_description' => $this->input->post('meta_description'),
									'display_order' => $this->input->post('display_order'),
									'url_path' => $url_value,
									'is_banner' =>$is_banner,
									
									
								);
						}
						else
						{
							$data = array(
									'page_name' => $this->input->post('page_name'),
									'page_title' => $this->input->post('page_title'),
									'inner_images' => $filepath,
									'page_description' => $this->input->post('description'),
									'meta_title' => $this->input->post('meta_title'),
									'meta_keyword' => $this->input->post('meta_keyword'),
									'meta_description' => $this->input->post('meta_description'),
									'display_order' => $this->input->post('display_order'),
									'url_path' => $url_value
								);
						}
						
						$this->common->update_record($fieldName,$id,$tblName,$data);
						$this->session->set_flashdata('msg', 'Page has been updated successfully.');
						redirect('admin/pages/','refresh'); //redirect in manage with msg
					}
					
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
		$delete_return_value=$this->content->delete_all($ids);
		if($delete_return_value==1)
		{
			echo 'delete';
		}
		else
		{
			echo 'ref_id';
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
