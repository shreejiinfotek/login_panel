<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Upload_news_event_image extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Upload_news_event_image_model','news_event_image');
	}
	public function index($id)
	{
		$data['page'] = 'News / Event Image';
		$data['path'] = ''.base_url().'admin/upload_news_event_image/delete_content/';
		$data['bulk_path'] = ''.base_url().'admin/upload_news_event_image/bulk_delete/';
		$data['ckeditor']=false;
		$data['soringCol']='"order": [[ 1, "asc" ]],';
		$data['is_main_image_path']=''.base_url().'admin/upload_news_event_image/is_main_image/';
		$data['manage_view_path']=''.base_url().'admin/upload_news_event_image/news_event_image_view/'.$id;
		$data['pagetitle']='Manage'.' '.$data['page'].'s';
		$data['gridTable']=true;
		$data['id']=$this->uri->segment(4);
		$this->load->view('admin/controls/vwHeader');
		$this->load->view('admin/controls/vwLeft',$data);
		$this->load->view('admin/controls/vwFooterJavascript',$data);
        $this->load->view('admin/vwManageNewsEventImage',$data);
		$this->load->view('admin/controls/vwFooter');
	}
	public function news_event_image_view($id)
	{
		$data['page'] = 'News / Event Image';
		$sql_details=$this->common->sql_detial();
		echo $list = $this->news_event_image->get_datatables($sql_details);
	}
	public function add_news_event_image($id) //this is use for redirect form in add section start
	{ 
		$data['page'] = 'News / Event Image';
		$data['pagetitle']='Manage '.$data['page'].'s | Add '.$data['page'].'';
		$data['id']=$this->uri->segment(4);
		$data['ckeditor']=false;
		$data['gridTable']=false;
		$formSubmit = $this->input->post('Submit');
		if($formSubmit=="Save")
		{
			$total_addfield_count=$this->input->post('hide_total_field');
			$tblName = "news_event_image";
			$data['error']="";
			for($i=1; $i<=$total_addfield_count; $i++)
			{
					if(!empty($_FILES['news_event_image'.$i]['name']))
					{
						$tmp = $_FILES['news_event_image'.$i]['name'];
						$ext = explode('.',$tmp);
						$extension  = strtolower($ext[1]);
						if(($extension =="gif" || $extension =="jpeg" || $extension =="jpg" || $extension =="png")==false)
						{
							$data['error']="Please upload correct image( gif / jpeg / jpg / png)";
						}
					}
			}
			
						
					if(!empty($_FILES['news_event_videofile']['name']))
					{
						$tmp = $_FILES['news_event_videofile']['name'];
						$ext = explode('.',$tmp);
						$extension  = strtolower($ext[1]);
						if(($extension =="mp4" || $extension =="mkv" || $extension =="3gp")==false)
						{
							$data['error']="Please upload correct image( mp4 / mkv / 3gp)";
						}
					}
			
	$data['error']="";
	if($data['error']=="")
	{
		if($this->input->post('news_event_gallery_type_id')==1)
		{
			for($i=1; $i<=$total_addfield_count; $i++)
				{
					if(!empty($_FILES['news_event_image'.$i]['name']))
					{
						$tblName = "news_event_image";
							$tmp = $_FILES['news_event_image'.$i]['name'];
							$ext = explode('.',$tmp);
							$extension  = strtolower($ext[1]);
							
								$today = date('mdyHis');
								
								$pathlarge = './uploads/NewsEventImage/';
									if (!is_dir($pathlarge))
										mkdir($pathlarge, 0755);
									
								
								$configImage['upload_path'] = $pathlarge;
								$configImage['max_size'] = "'".UPLOAD_IMAGE_MAX_SIZE."'";
								$configImage['allowed_types'] = 'gif|jpg|jpeg|png';
								$img_name =$today.$i.'.'.$extension;
								$configImage['file_name'] = $img_name;
								$this->load->library('upload', $configImage,'news_eventImage');
								$this->news_eventImage->initialize($configImage);
								$this->news_eventImage->do_upload('news_event_image'.$i);
								
									$this->load->library('image_lib');
									$configThumb = array();  
									$configThumb['image_library']   = 'gd2'; 
									$configThumb['source_image']  = $pathlarge.$img_name; 
									$configThumb['create_thumb']    = TRUE;
									
									
									
									$mainpath = str_replace("./","",$pathlarge.$img_name);
									
									$url_value=strtolower(preg_replace('/-+/', '-', preg_replace('/[^\wáéíóú]/', '-', $this->input->post('caption'.$i))));
									$data = array(
										'news_event_id'=>$id,
										'caption' => $this->input->post('caption'.$i),
										'news_event_gallery_type_id' => $this->input->post('news_event_gallery_type_id'),
										
										'large_image_path' =>$mainpath,
										'url_path'=>$url_value
										);
									$this->common->insert_record($tblName,$data);
								}
			}
			$this->session->set_flashdata('msg', 'News / Event Image has been added successfully.');
				redirect('admin/upload_news_event_image/index/'.$this->uri->segment(4),'refresh'); //redirect in manage with msg
		}
		else if($this->input->post('news_event_gallery_type_id')==2)
		{
				
				$url_value=strtolower(preg_replace('/-+/', '-', preg_replace('/[^\wáéíóú]/', '-', $this->input->post('caption_video'))));
				
				$data = array(
					'news_event_id'=>$id,
					'caption' => $this->input->post('caption_video'),
					'news_event_gallery_type_id' => $this->input->post('news_event_gallery_type_id'),
					'video_link' => $this->input->post('video_link'),
					'url_path'=>$url_value
				
					);
					$this->common->insert_record($tblName,$data);
				
					$this->session->set_flashdata('msg', 'News / Event Video has been added successfully.');
					redirect('admin/upload_news_event_image/index/'.$this->uri->segment(4),'refresh'); //redirect in manage with msg
			
		}
		else if($this->input->post('news_event_gallery_type_id')==3)
		{
				
						$filepath="";
						if(!empty($_FILES['news_event_videofile']['name']))
						{
							$tmp = $_FILES['news_event_videofile']['name'];
							$ext = explode('.',$tmp);
							$extension  = strtolower($ext[1]);
							
							$today = date('mdyHis');
							$pathMain = './uploads/NewsEventVideo/';
								if (!is_dir($pathMain))
									mkdir($pathMain, 0755);
							$configImage['upload_path'] = $pathMain;
							$configImage['max_size'] = "'".UPLOAD_IMAGE_MAX_SIZE."'";
							$configImage['allowed_types'] = 'mp4|mkv|3gp';
							$img_name =$today.'.'.$extension;
							$configImage['file_name'] = $img_name;
							$this->load->library('upload', $configImage,'news_event_video');
							$this->news_event_video->initialize($configImage);
							if (!$this->news_event_video->do_upload('news_event_videofile')) 
							{
								$data['error']='Please upload correct video( mp4 / mkv / 3gp)';
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
						$url_value=strtolower(preg_replace('/-+/', '-', preg_replace('/[^\wáéíóú]/', '-', $this->input->post('caption_videofile'))));
							$data = array(
							'news_event_id'=>$id,
							'caption' => $this->input->post('caption_videofile'),
							'news_event_gallery_type_id' => $this->input->post('news_event_gallery_type_id'),
							'news_event_videofile' => $filepath,
							'url_path'=>$url_value
							);
							$this->common->insert_record($tblName,$data);
							
			
			$this->session->set_flashdata('msg', 'News / Event Video has been added successfully.');
			redirect('admin/upload_news_event_image/index/'.$this->uri->segment(4),'refresh'); //redirect in manage with msg
			
		
		}
		
	}
		}
		$data['news_event_gallery'] = $this->news_event_image->get_news_event_gallery();
		$this->load->view('admin/controls/vwHeader');
		$this->load->view('admin/controls/vwLeft',$data);
		$this->load->view('admin/vwAddNewsEventImage',$data);    
		$this->load->view('admin/controls/vwFooter');
		$this->load->view('admin/controls/vwFooterJavascript',$data);
	} //this is use for redirect form in add section end
	public function edit_news_event_image($id='') //this is use for edit records start
	{	
        $data['page'] = 'News / Event Image';
		$data['pagetitle']='Manage '.$data['page'].'s | Edit '.$data['page'].'';
		$data['id']=$this->uri->segment(4);
		$data['ckeditor']=false;
		$data['gridTable']=false;
		if($id!='')
		{
			$formSubmit = $this->input->post('Submit');
			if($formSubmit=="Save")
			{
				$total_addfield_count=$this->input->post('hide_total_field');
				
				$tblName = "news_event_image";
				$fieldName = "news_event_image_id";
				
				$news_event_gallery_type_id=$this->common->GetValue("news_event_image","news_event_gallery_type_id","news_event_image_id",''.$id.'');
				
				$this->db->select('news_event_id,large_image_path');
						$this->db->where('news_event_image_id',$id);
						$result = $this->db->get('news_event_image');
						$news_event_image_result=$result->row();
				
				if($news_event_gallery_type_id==1)
				{
					
					if(isset($_FILES['news_event_image']['name']) && !empty($_FILES['news_event_image']['name']))
						{
							$tmp = $_FILES['news_event_image']['name'];
							$ext = explode('.',$tmp);
							$extension  = strtolower($ext[1]);
							
							if(($extension =="gif" || $extension =="jpeg" || $extension =="jpg" || $extension =="png")==false)
							{
								$data['error']="Please upload correct file( gif / jpeg / jpg / png)";
							}
						}
					$data['error']="";
					if($data['error']=="")
					{
						
						$largepath=$news_event_image_result->large_image_path;
						if(!empty($_FILES['news_event_image']['name']))
						{
							$tmp = $_FILES['news_event_image']['name'];
							$ext = explode('.',$tmp);
							$extension  = strtolower($ext[1]);
								$today = date('mdyHis');
								$pathlarge = './uploads/NewsEventImage/';
									if (!is_dir($pathlarge))
										mkdir($pathlarge, 0755);
										
								$configImage['upload_path'] = $pathlarge;
								$configImage['max_size'] = "'".UPLOAD_IMAGE_MAX_SIZE."'";
								$configImage['allowed_types'] = 'gif|jpg|jpeg|png';
								$img_name =$today.'.'.$extension;
								$configImage['file_name'] = $img_name;
								$this->load->library('upload', $configImage);
								
								if (!$this->upload->do_upload('news_event_image')) 
								{
									//$data['error']="Please upload correct file( gif / jpeg / jpg / png)";
								}
								else
								{
									$this->load->library('image_lib');
									$configThumb = array();  
									$configThumb['image_library']   = 'gd2'; 
									$configThumb['source_image']  = $pathlarge.$img_name; 
									$configThumb['create_thumb']    = TRUE;
									
									if($largepath!="" && file_exists("./".$largepath))
									{
										unlink("./".$largepath);
									}
									$largepath = str_replace("./","",$pathlarge.$img_name);
								}
						}
						$url_value=strtolower(preg_replace('/-+/', '-', preg_replace('/[^\wáéíóú]/', '-', $this->input->post('caption'))));
						$data = array(
						'caption' => $this->input->post('caption'),
						'large_image_path' =>$largepath,
						'video_link' => $this->input->post('video_link'),
						'url_path'=>$url_value
						);
						$this->common->update_record($fieldName,$id,$tblName,$data);
						$this->session->set_flashdata('msg', 'News / Event Image has been updated successfully.');
						redirect('admin/upload_news_event_image/index/'.$news_event_image_result->news_event_id,'refresh'); //redirect in manage with msg
						}
					}
					else if($news_event_gallery_type_id==2)
					{
								
						
						$url_value=strtolower(preg_replace('/-+/', '-', preg_replace('/[^\wáéíóú]/', '-', $this->input->post('caption_video'))));
						
						$data = array(
							'caption' => $this->input->post('caption'),
							'video_link' => $this->input->post('video_link'),
							'url_path'=>$url_value
						
							);
							$this->common->update_record($fieldName,$id,$tblName,$data);
							$this->session->set_flashdata('msg', 'News / Event Video has been updated successfully.');
							redirect('admin/upload_news_event_image/index/'.$news_event_image_result->news_event_id,'refresh'); //redirect in manage with msg
					
			
					}
					
					else if($news_event_gallery_type_id==3)
					{
						
									
									$filepath=$this->common->GetValue("news_event_image","news_event_videofile","news_event_image_id",''.$id.'');
									if(!empty($_FILES['news_event_videofile']['name']))
									{
										$tmp = $_FILES['news_event_videofile']['name'];
										$ext = explode('.',$tmp);
										$extension  = strtolower($ext[1]);
										
										$today = date('mdyHis');
										$pathMain = './uploads/NewsEventVideo/';
											if (!is_dir($pathMain))
												mkdir($pathMain, 0755);
										$configImage['upload_path'] = $pathMain;
										$configImage['max_size'] = "'".UPLOAD_IMAGE_MAX_SIZE."'";
										$configImage['allowed_types'] = 'mp4|mkv|3gp';
										$img_name =$today.'.'.$extension;
										$configImage['file_name'] = $img_name;
										$this->load->library('upload', $configImage,'news_event_video');
										$this->news_event_video->initialize($configImage);
										if (!$this->news_event_video->do_upload('news_event_videofile')) 
										{
											$data['error']='Please upload correct video( mp4 / mkv / 3gp)';
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
									$url_value=strtolower(preg_replace('/-+/', '-', preg_replace('/[^\wáéíóú]/', '-', $this->input->post('caption_videofile'))));
										$data = array(
										
										'caption' => $this->input->post('caption'),
										'news_event_videofile' => $filepath,
										'url_path'=>$url_value
										);
										$this->common->update_record($fieldName,$id,$tblName,$data);
										$this->session->set_flashdata('msg', 'News / Event Video has been updated successfully.');
										redirect('admin/upload_news_event_image/index/'.$news_event_image_result->news_event_id,'refresh'); //redirect in manage with msg
					
					
					}
			}
			
			$data['news_event_gallery'] = $this->news_event_image->get_news_event_gallery();
			$data['news_event_image']=$this->news_event_image->get_news_event_image_by_id($id);
			$this->load->view('admin/controls/vwHeader');
			$this->load->view('admin/controls/vwLeft',$data);
	        $this->load->view('admin/vwEditNewsEventImage',$data);
			$this->load->view('admin/controls/vwFooter');
			$this->load->view('admin/controls/vwFooterJavascript',$data);
		}
		else
		{
            redirect('admin/upload_news_event_image/index/'.$this->uri->segment(4),'refresh');
        }
    } //this is use for edit records end
	public function delete_content($id)
	{
		$arr['page'] = 'News / Event Image';
		$this->news_event_image->delete_record('news_event_image_id',$id,'news_event_image');
		echo "delete";			
    }
	public function bulk_delete() 
	{
		$arr['page'] = 'News / Event Image';
		$ids = ( explode( ',', $this->input->get_post('data_ids') ));
		$this->news_event_image->delete_all($ids);
		echo 'delete';
    }
}