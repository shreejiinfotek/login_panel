<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Blog_model','blog');
		
	}

	public function index()
	{
		$data['page'] = 'Blog';
		$data['path'] = ''.base_url().'admin/blog/delete_content/';
		$data['bulk_path'] = ''.base_url().'admin/blog/bulk_delete/';
		$data['ckeditor']=false;
		$data['manage_view_path']=''.base_url().'admin/blog/blog_view/';
		$data['soringCol']='"order": [[ 1, "asc" ]],';
		$data['is_active_path']=''.base_url().'admin/blog/is_active/';
		$data['pagetitle']='Manage blog';
		$data['gridTable']=true;
		$this->load->view('admin/controls/vwHeader');
		$this->load->view('admin/controls/vwLeft',$data);
		$this->load->view('admin/controls/vwFooterJavascript',$data);
        $this->load->view('admin/vwManageBlog',$data);
		
		$this->load->view('admin/controls/vwFooter');
	}

	public function blog_view()
	{
		$data['page'] = 'Blog';
		$sql_details=$this->common->sql_detial();
		echo $results = $this->blog->get_datatables($sql_details);
	}
	
	public function add_blog() { //this is use for redirect form in add section start
		$data['page'] = 'Blog';
	
		$data['pagetitle']='Manage Blog | Add  '.$data['page'];
		$data['ckeditor']=true;
		$data['gridTable']=false;

		
			$formSubmit = $this->input->post('Submit');
			if($formSubmit=="Save")
			{
				
					$filepath="";			
					$tblName = "blogs";
						
						if(!empty($_FILES['blog_image']['name']))
						{
							$tmp = $_FILES['blog_image']['name'];
							$ext = explode('.',$tmp);
							$extension  = strtolower($ext[1]);
							
							$today = date('mdyHis');
							$pathMain = './uploads/Blog/';
								if (!is_dir($pathMain))
									mkdir($pathMain, 0755);
							$configImage['upload_path'] = $pathMain;
							$configImage['max_size'] = "'".UPLOAD_IMAGE_MAX_SIZE."'";
							$configImage['allowed_types'] = 'gif|jpg|jpeg|png';
							$img_name =$today.'.'.$extension;
							$configImage['file_name'] = $img_name;
							$this->load->library('upload', $configImage,'blog_image');
							$this->blog_image->initialize($configImage);
							
							if (!$this->blog_image->do_upload('blog_image')) 
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
								
								$filepath = str_replace("./","",$pathMain.$img_name);
								
							}
						}
							$url_value=strtolower(preg_replace('/-+/', '-', preg_replace('/[^\wáéíóú]/', '-', $this->input->post('blog_name'))));
							$data = array(
							'blog_name'=>$this->input->post('blog_name'),
							'blog_image' => $filepath,
							'short_description'=>$this->input->post('short_description'),
							'description'=>$this->input->post('description'),
							'created_date' => date('Y-m-d', strtotime($this->input->get_post('created_date'))),
							'url_path'=>$url_value,
							'created_by'=>$this->session->userdata('id')
							);
							$this->common->insert_record($tblName,$data);
					
							$this->session->set_flashdata('msg', 'blog has been added successfully.');
							redirect('admin/blog/','refresh'); //redirect in manage with msg
					
				
			}
			
			else
			{
				$this->form_validation->set_rules('blog_image', 'blog', 'required');
				$this->form_validation->set_message('required', 'Please upload blog.');
				if ($this->form_validation->run() === FALSE)
				{
					
					$this->load->view('admin/controls/vwHeader');
					$this->load->view('admin/controls/vwLeft',$data);
					
					$this->load->view('admin/vwAddBlog',$data);    
					$this->load->view('admin/controls/vwFooter');
					$this->load->view('admin/controls/vwFooterJavascript',$data);
				}
			}
		
	} //this is use for redirect form in add section end */
	
	
    public function edit_blog($id='') //this is use for edit records start
	{
		
        $data['page'] = 'Blog';
		$data['pagetitle']='Manage Blog | Edit '.$data['page'];
		$data['ckeditor']=true;
		$data['gridTable']=false;
		if($id!='')
		{	
		
			$formSubmit = $this->input->post('Submit');
			if($formSubmit=="Save")
			{
				 $tblName = "blogs";
				 $fieldName = "blog_id";
				
				$data['error']='';
				if (isset($_FILES['blog_image']['name']) && !empty($_FILES['blog_image']['name']))
				{
					$tmp = $_FILES['blog_image']['name'];
					$ext = explode('.',$tmp);
					$extension  = strtolower($ext[1]);
					
					if(($extension =="gif" || $extension =="jpeg" || $extension =="jpg" || $extension =="png")==false)
					{
						$data['error']="Please upload correct file( gif / jpeg / jpg / png)";
					}
					
				}
				if($data['error']=="")
				{
					$filepath=$this->common->GetValue("blogs","blog_image","blog_id",''.$id.'');
					if(!empty($_FILES['blog_image']['name']))
					{
							$tmp = $_FILES['blog_image']['name'];
							$ext = explode('.',$tmp);
							$extension  = strtolower($ext[1]);
							
							$today = date('mdyHis');
							$pathMain = './uploads/Blog/';
								if (!is_dir($pathMain))
									mkdir($pathMain, 0755);
							$configImage['upload_path'] = $pathMain;
							$configImage['max_size'] = "'".UPLOAD_IMAGE_MAX_SIZE."'";
							$configImage['allowed_types'] = 'gif|jpg|jpeg|png';
							$img_name =$today.'.'.$extension;
							$configImage['file_name'] = $img_name;
							$this->load->library('upload', $configImage,'blog_image');
							$this->blog_image->initialize($configImage);
							if (!$this->blog_image->do_upload('blog_image')) 
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
								if($filepath!="" && file_exists("./".$filepath))
								{
									unlink("./".$filepath);
								}
								$filepath = str_replace("./","",$pathMain.$img_name);
								
							}
						}
					$url_value=strtolower(preg_replace('/-+/', '-', preg_replace('/[^\wáéíóú]/', '-', $this->input->post('blog_name'))));
					$created_date=$this->common->GetValue("blog","created_date","blog_id",'');
					$data = array(
					'blog_name'=>$this->input->post('blog_name'),
					'blog_image' => $filepath,
					'short_description'=>$this->input->post('short_description'),
					'description'=>$this->input->post('description'),
					'url_path'=>$url_value,
				    'created_date' => date('Y-m-d', strtotime($this->input->get_post('created_date'))),
					'created_by'=>$this->session->userdata('id')
					);
					
					$this->common->update_record($fieldName,$id,$tblName,$data);
					$this->session->set_flashdata('msg', 'Blog has been updated successfully.');
					redirect('admin/blog/','refresh'); //redirect in manage with msg
				}
			}
			
			
			$data['blog']=$this->blog->get_blog_by_id($id);
			$this->load->view('admin/controls/vwHeader');
			$this->load->view('admin/controls/vwLeft',$data);
	        $this->load->view('admin/vwEditBlog',$data);
			$this->load->view('admin/controls/vwFooter');
			$this->load->view('admin/controls/vwFooterJavascript',$data);
		}
		else
		{
            redirect('admin/blog');
        }
    } //this is use for edit records end
	public function view_blog($id='') //this is use for edit records start
	{
       		$data['page'] = 'Blog';
			$data['ckeditor']=false;
			$data['gridTable']=false;
			$data['pagetitle']='Manage Blogs';
			$data['blog']=$this->blog->get_blog_by_id($id);
			$this->load->view('admin/controls/vwHeader');
			$this->load->view('admin/controls/vwLeft',$data);
			$this->load->view('admin/vwViewBlog',$data);
			$this->load->view('admin/controls/vwFooter');
			$this->load->view('admin/controls/vwFooterJavascript');
		
    }
	public function delete_content($id) {
		$arr['page'] = 'Blog';
		$this->blog->delete_record('blog_id',$id,'blog');
		echo "delete";			
    }
	public function bulk_delete() {
		$arr['page'] = 'Blog';
		$ids = ( explode( ',', $this->input->get_post('data_ids') ));
			$this->blog->delete_all($ids);
			echo 'delete';
    }
		
	public function is_active($val,$id)
	{
		$fieldName='is_active';
		$fieldId='blog_id';
		$tableName='blog';
		$this->common->update_is_active($val,$id,$fieldName,$fieldId,$tableName);
	}

} 