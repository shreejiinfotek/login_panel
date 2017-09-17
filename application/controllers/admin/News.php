<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class News extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('News_model','news');
		
	}

	public function index()
	{
		$data['page'] = 'News';
		$data['path'] = ''.base_url().'admin/news/delete_content/';
		$data['bulk_path'] = ''.base_url().'admin/news/bulk_delete/';
		$data['ckeditor']=false;
		$data['manage_view_path']=''.base_url().'admin/news/news_view/';
		$data['soringCol']='"order": [[ 1, "asc" ]],';
		$data['is_active_path']=''.base_url().'admin/news/is_active/';
		$data['pagetitle']='Manage'.' News';
		$data['gridTable']=true;
		$this->load->view('admin/controls/vwHeader');
		$this->load->view('admin/controls/vwLeft',$data);
		$this->load->view('admin/controls/vwFooterJavascript',$data);
        $this->load->view('admin/vwManageNews',$data);
		
		$this->load->view('admin/controls/vwFooter');
	}

	public function news_view()
	{
		$data['page'] = 'News';
		$sql_details=$this->common->sql_detial();
		echo $results = $this->news->get_datatables($sql_details);
	}
	
	public function add_news() { //this is use for redirect form in add section start
		$data['page'] = 'News';
	
		$data['pagetitle']='Manage'.' News | Add  '.$data['page'];
		$data['ckeditor']=true;
		$data['gridTable']=false;

		
			$formSubmit = $this->input->post('Submit');
			if($formSubmit=="Save")
			{
				$duplicate_news=$this->common->CountByTable('news','WHERE news_name="'.$this->input->post('news_name').'"');
				if($duplicate_news>=1)
				{
					$data['error']='Please enter other news name. This news name already exists.';
				}
				else
				{
					$filepath="";			
					$tblName = "news";
						
						if(!empty($_FILES['news_image']['name']))
						{
							$tmp = $_FILES['news_image']['name'];
							$ext = explode('.',$tmp);
							$extension  = strtolower($ext[1]);
							
							$today = date('mdyHis');
							$pathMain = './uploads/News/';
								if (!is_dir($pathMain))
									mkdir($pathMain, 0755);
							$configImage['upload_path'] = $pathMain;
							$configImage['max_size'] = "'".UPLOAD_IMAGE_MAX_SIZE."'";
							$configImage['allowed_types'] = 'gif|jpg|jpeg|png';
							$img_name =$today.'.'.$extension;
							$configImage['file_name'] = $img_name;
							$this->load->library('upload', $configImage,'news_image');
							$this->news_image->initialize($configImage);
							
							if (!$this->news_image->do_upload('news_image')) 
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
							$url_value=strtolower(preg_replace('/-+/', '-', preg_replace('/[^\wáéíóú]/', '-', $this->input->post('news_name'))));
							$data = array(
							'news_name'=>$this->input->post('news_name'),
							'news_image' => $filepath,
							'short_description'=>$this->input->post('short_description'),
							'description'=>$this->input->post('description'),
							'created_date' => date('Y-m-d', strtotime($this->input->get_post('created_date'))),
							'url_path'=>$url_value,
							'created_by'=>$this->session->userdata('id')
							);
							$this->common->insert_record($tblName,$data);
					
							$this->session->set_flashdata('msg', 'News has been added successfully.');
							redirect('admin/news/','refresh'); //redirect in manage with msg
				}
					
				
			}
			else
			{
				$this->form_validation->set_rules('news_image', 'news', 'required');
				$this->form_validation->set_message('required', 'Please upload news/event.');
				if ($this->form_validation->run() === FALSE)
				{
					
					$this->load->view('admin/controls/vwHeader');
					$this->load->view('admin/controls/vwLeft',$data);
					
					$this->load->view('admin/vwAddNews',$data);    
					$this->load->view('admin/controls/vwFooter');
					$this->load->view('admin/controls/vwFooterJavascript',$data);
				}
			}
		
	} //this is use for redirect form in add section end */
	
	
    public function edit_news($id='') //this is use for edit records start
	{
		
        $data['page'] = 'News';
		$data['pagetitle']='Manage News | Edit '.$data['page'];
		$data['ckeditor']=true;
		$data['gridTable']=false;
		if($id!='')
		{	
		
			$formSubmit = $this->input->post('Submit');
			if($formSubmit=="Save")
			{
				 $tblName = "news";
				 $fieldName = "news_id";
				
				$data['error']='';
				if (isset($_FILES['news_image']['name']) && !empty($_FILES['news_image']['name']))
				{
					$tmp = $_FILES['news_image']['name'];
					$ext = explode('.',$tmp);
					$extension  = strtolower($ext[1]);
					
					if(($extension =="gif" || $extension =="jpeg" || $extension =="jpg" || $extension =="png")==false)
					{
						$data['error']="Please upload correct file( gif / jpeg / jpg / png)";
					}
					
				}
				 $duplicate_news=$this->common->CountByTable('news','WHERE news_id!="'.$id.'" AND news_name="'.$this->input->post('news_name').'"' );
				if($duplicate_news>=1)
				{
					$data['error']='Please enter other news name. This news name already exists.';
				}
				if($data['error']=="")
				{
					$filepath=$this->common->GetValue("news","news_image","news_id",''.$id.'');
					if(!empty($_FILES['news_image']['name']))
					{
							$tmp = $_FILES['news_image']['name'];
							$ext = explode('.',$tmp);
							$extension  = strtolower($ext[1]);
							
							$today = date('mdyHis');
							$pathMain = './uploads/NewsEvent/';
								if (!is_dir($pathMain))
									mkdir($pathMain, 0755);
							$configImage['upload_path'] = $pathMain;
							$configImage['max_size'] = "'".UPLOAD_IMAGE_MAX_SIZE."'";
							$configImage['allowed_types'] = 'gif|jpg|jpeg|png';
							$img_name =$today.'.'.$extension;
							$configImage['file_name'] = $img_name;
							$this->load->library('upload', $configImage,'news_image');
							$this->news_image->initialize($configImage);
							if (!$this->news_image->do_upload('news_image')) 
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
					$url_value=strtolower(preg_replace('/-+/', '-', preg_replace('/[^\wáéíóú]/', '-', $this->input->post('news_name'))));
					$created_date=$this->common->GetValue("news","created_date","news_id",'');
					$data = array(
					'news_name'=>$this->input->post('news_name'),
					'news_image' => $filepath,
					'short_description'=>$this->input->post('short_description'),
					'description'=>$this->input->post('description'),
					'url_path'=>$url_value,
				    'created_date' => date('Y-m-d', strtotime($this->input->get_post('created_date'))),
					'created_by'=>$this->session->userdata('id')
					);
					
					$this->common->update_record($fieldName,$id,$tblName,$data);
					$this->session->set_flashdata('msg', 'News has been updated successfully.');
					redirect('admin/news/','refresh'); //redirect in manage with msg
				}
			}
			
			
			$data['news']=$this->news->get_news_by_id($id);
			$this->load->view('admin/controls/vwHeader');
			$this->load->view('admin/controls/vwLeft',$data);
	        $this->load->view('admin/vwEditNews',$data);
			$this->load->view('admin/controls/vwFooter');
			$this->load->view('admin/controls/vwFooterJavascript',$data);
		}
		else
		{
            redirect('admin/news');
        }
    } //this is use for edit records end
	public function view_news($id='') //this is use for edit records start
	{
       		$data['page'] = 'News';
			$data['ckeditor']=false;
			$data['gridTable']=false;
			$data['pagetitle']='Manage News';
			$data['news']=$this->news->get_news_by_id($id);
			$this->load->view('admin/controls/vwHeader');
			$this->load->view('admin/controls/vwLeft',$data);
			$this->load->view('admin/vwViewNews',$data);
			$this->load->view('admin/controls/vwFooter');
			$this->load->view('admin/controls/vwFooterJavascript');
		
    }
	public function delete_content($id) {
		$arr['page'] = 'News';
		$this->news->delete_record('news_id',$id,'news');
		echo "delete";			
    }
	public function bulk_delete() {
		$arr['page'] = 'News';
		$ids = ( explode( ',', $this->input->get_post('data_ids') ));
			$this->news->delete_all($ids);
			echo 'delete';
    }
		
	public function is_active($val,$id)
	{
		$fieldName='is_active';
		$fieldId='news_id';
		$tableName='news';
		$this->common->update_is_active($val,$id,$fieldName,$fieldId,$tableName);
	}

} 