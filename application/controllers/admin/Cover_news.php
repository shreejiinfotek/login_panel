<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cover_news extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Cover_news_model','cover_news');		
	}

	public function index()
	{
		$data['page'] = 'Cover News / Events';
		$data['pagetitle']='Manage '.$data['page'];
		$data['ckeditor']=false;
		$data['gridTable']=false;	
		$this->form_validation->set_rules('cover_news_title', 'cover news title', 'required');
		$this->form_validation->set_rules('redirect_link', 'redirect link', 'required');
		$this->form_validation->set_rules('description', 'description', 'required');
		$formSubmit = $this->input->post('Submit');
		if ($formSubmit=="Save")
		{
			$data['error']="";	
			$tblName = "cover_news";
			$fieldName = "cover_news_id";
			
			if(!empty($_FILES['cover_news_image']['name']))
			{
				$tmp = $_FILES['cover_news_image']['name'];
				$ext = explode('.',$tmp);
				$image_extension  = strtolower($ext[1]);
				if(($image_extension =="gif" || $image_extension =="jpeg" || $image_extension =="jpg" || $image_extension =="png")==false)
				{
				$data['error']="Please upload correct image( gif / jpeg / jpg / png)";
				}
			}
			if($data['error']=="")
			{
				if ($this->form_validation->run() === TRUE)
				{
					$id=1;
					$cover_news_image=$this->common->GetValue("cover_news","cover_news_image","cover_news_id",''.$id.'');
					if(isset($_FILES['cover_news_image']['name']) && !empty($_FILES['cover_news_image']['name']))
					{
						$today = date('mdyHis');
						$image_pathMain = './uploads/CoverNews/';
						if (!is_dir($image_pathMain))
								mkdir($image_pathMain, 0755);
						$configImage['upload_path'] = $image_pathMain;
						$configImage['max_size'] = "'".UPLOAD_IMAGE_MAX_SIZE."'";
						$configImage['allowed_types'] = 'gif|jpg|jpeg|png';
						$image_file_name=$today.'.'.$image_extension;
						$configImage['file_name'] = $image_file_name;
						$this->load->library('upload', $configImage, 'cover_news_image'); // Create custom object for cover upload
						$this->cover_news_image->initialize($configImage);
						$this->cover_news_image->do_upload('cover_news_image');
						if($cover_news_image!="" && file_exists("./".$cover_news_image))
						{
							unlink("./".$cover_news_image);
						}
						$cover_news_image=str_replace("./","",$image_pathMain.$image_file_name);
					}
					$data = array(
  					    'cover_news_title' => $this->input->post('cover_news_title'),
						'redirect_link' => $this->input->post('redirect_link'),
						'cover_news_image'=>$cover_news_image,
						'description' => $this->input->post('description')
					);
					
					
					$this->common->update_record($fieldName,$id,$tblName,$data);
					$this->session->set_flashdata('msg','Cover News / Events  has been updated successfully.');
					redirect('admin/cover_news/','refresh'); //redirect in manage with msg
				}
			}
		}
		$data['cover_news']=$this->cover_news->get_cover_news();
		$this->load->view('admin/controls/vwHeader');
		$this->load->view('admin/controls/vwLeft',$data);
		$this->load->view('admin/vwManageCoverNews',$data);
		$this->load->view('admin/controls/vwFooter');
		$this->load->view('admin/controls/vwFooterJavascript',$data);
	}
} 