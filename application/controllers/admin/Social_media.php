<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Social_media extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Social_media_model','social_media');
		
	}

	public function index()
	{
		$data['page'] = 'Social Media';
		$data['path'] = ''.base_url().'admin/social_media/delete_content/';
		$data['bulk_path'] = ''.base_url().'admin/social_media/bulk_delete/';
		$data['ckeditor']=false;
		$data['manage_view_path']=''.base_url().'admin/social_media/social_media_view/';
		$data['soringCol']='"order": [[ 1, "asc" ]],';
		$data['is_active_path']=''.base_url().'admin/social_media/is_active/';
		$data['pagetitle']='Manage'.' '.$data['page'];
		$data['gridTable']=true;
		$this->load->view('admin/controls/vwHeader');
		$this->load->view('admin/controls/vwLeft',$data);
		$this->load->view('admin/controls/vwFooterJavascript',$data);
        $this->load->view('admin/vwManageSocialMedia',$data);
		
		$this->load->view('admin/controls/vwFooter');
	}

	public function social_media_view()
	{
		$data['page'] = 'Social Media';
		$sql_details=$this->common->sql_detial();
		echo $results = $this->social_media->get_datatables($sql_details);
	}
	public function add_social_media() { //this is use for redirect form in add section start
		$data['page'] = 'Social Media';
		$data['pagetitle']='Manage'.' '.$data['page'].' | Add '.$data['page'];
		$data['ckeditor']=false;
		$data['gridTable']=false;
        $this->form_validation->set_rules('social_media_name', 'social media name', 'required');
		$this->form_validation->set_rules('social_media_link', 'social media link', 'required');
		
			$formSubmit = $this->input->post('Submit');
			if($formSubmit=="Save")
			{
				if ($this->form_validation->run() === TRUE)
				{
								
					$tblName = "social_media";
                    
                   
						if(!empty($_FILES['social_media_image']['name']))
						{
							$tmp = $_FILES['social_media_image']['name'];
							$ext = explode('.',$tmp);
							$extension  = strtolower($ext[1]);
							
							$today = date('mdyHis');
							$pathMain = './uploads/SocialMedia/';
								if (!is_dir($pathMain))
									mkdir($pathMain, 0755);
							$configImage['upload_path'] = $pathMain;
							$configImage['max_size'] = "'".UPLOAD_IMAGE_MAX_SIZE."'";
							$configImage['allowed_types'] = 'gif|jpg|jpeg|png';
							$img_name =$today.'.'.$extension;
							$configImage['file_name'] = $img_name;
							$this->load->library('upload', $configImage,'social_media_img');
							$this->social_media_img->initialize($configImage);
							
                            if (!$this->social_media_img->do_upload('social_media_image')) 
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
						$url_value=strtolower(preg_replace('/-+/', '-', preg_replace('/[^\wáéíóú]/', '-', $this->input->post('social_media_name'))));
						if($this->input->post('social_icon_type')==1)
						{
							$social_icon='social_media_image';
							$social_icon_value=''.$filepath.'';
						}
						else
						{
							$social_icon='social_icon_class';
							$social_icon_value=''.$this->input->post('social_icon_class').'';
						}
							$data = array(
                            'social_media_name' =>$this->input->post('social_media_name'),
							'social_media_link' =>$this->input->post('social_media_link'),
							$social_icon =>$social_icon_value,
							'social_icon_type' =>$this->input->post('social_icon_type'),
                            'url_path' =>$url_value,
                            'display_order' => $this->input->post('display_order')
							
							);
							$this->common->insert_record($tblName,$data);
					
							$this->session->set_flashdata('msg', 'Social Media has been added successfully.');
							redirect('admin/social_media/','refresh'); //redirect in manage with msg
				
                }
			}
			
			
					$this->load->view('admin/controls/vwHeader');
					$this->load->view('admin/controls/vwLeft',$data);
					$this->load->view('admin/vwAddSocialMedia',$data);    
					$this->load->view('admin/controls/vwFooter');
					$this->load->view('admin/controls/vwFooterJavascript',$data);
			 
		
	} //this is use for redirect form in add section end
	
    public function edit_social_media($id='') //this is use for edit records start
	{
        $data['page'] = 'Social Media';
		$data['pagetitle']='Manage'.' '.$data['page'].' | Edit '.$data['page'];
		$data['ckeditor']=false;
		$data['gridTable']=false;
        $this->form_validation->set_rules('social_media_name', 'social media name', 'required');
		$this->form_validation->set_rules('social_media_link', 'social media link', 'required');
		if($id!='')
		{
			$formSubmit = $this->input->post('Submit');
			if($formSubmit=="Save")
			{
                if ($this->form_validation->run() === TRUE)
				{
                    
				$tblName = "social_media";
				$fieldName = "social_media_id";
                
				
				$data['error']='';
				if (isset($_FILES['social_media_image']) && !empty($_FILES['social_media_image']['name']))
				{
					$tmp = $_FILES['social_media_image']['name'];
					$ext = explode('.',$tmp);
					$extension  = strtolower($ext[1]);
					
					if(($extension =="gif" || $extension =="jpeg" || $extension =="jpg" || $extension =="png")==false)
					{
						$data['error']="Please upload correct file( gif / jpeg / jpg / png)";
					}
					
				}
				
				if($data['error']=="")
				{
					$filepath=$this->common->GetValue("social_media","social_media_image","social_media_id",''.$id.'');
					
                    if(!empty($_FILES['social_media_image']['name']))
					{
							$tmp = $_FILES['social_media_image']['name'];
							$ext = explode('.',$tmp);
							$extension  = strtolower($ext[1]);
							
							$today = date('mdyHis');
							$pathMain = './uploads/SocialMedia/';
								if (!is_dir($pathMain))
									mkdir($pathMain, 0755);
							$configImage['upload_path'] = $pathMain;
							$configImage['max_size'] = "'".UPLOAD_IMAGE_MAX_SIZE."'";
							$configImage['allowed_types'] = 'gif|jpg|jpeg|png';
							$img_name =$today.'.'.$extension;
							$configImage['file_name'] = $img_name;
							$this->load->library('upload', $configImage,'social_media_img');
							$this->social_media_img->initialize($configImage);
                        
							if (!$this->social_media_img->do_upload('social_media_image')) 
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
						if($this->input->post('social_icon_type')==1)
						{
							$social_icon_value="";
						}
						else
						{
							if($filepath!="" && file_exists($filepath))
							{
								unlink("./".$filepath);
							}
							$filepath="";
							$social_icon_value=''.$this->input->post('social_icon_class').'';
						}
						$url_value=strtolower(preg_replace('/-+/', '-', preg_replace('/[^\wáéíóú]/', '-', $this->input->post('social_media_name'))));
                                $data = array(
                                'social_media_name' =>$this->input->post('social_media_name'),
                                'social_media_link' =>$this->input->post('social_media_link'),
								'social_media_image'=>$filepath,
								'social_icon_class'=>$social_icon_value,
								'social_icon_type' =>$this->input->post('social_icon_type'),
                                'url_path' =>$url_value,
                                'display_order' => $this->input->post('display_order')

                                );
					
                                $this->common->update_record($fieldName,$id,$tblName,$data);
                                $this->session->set_flashdata('msg', 'Social Media has been updated successfully.');
                                redirect('admin/social_media/','refresh'); //redirect in manage with msg
						
				    }
                }
			}
			
			
			$data['social_media']=$this->social_media->get_social_media_by_id($id);
			$this->load->view('admin/controls/vwHeader');
			$this->load->view('admin/controls/vwLeft',$data);
	        $this->load->view('admin/vwEditSocialMedia',$data);
			$this->load->view('admin/controls/vwFooter');
			$this->load->view('admin/controls/vwFooterJavascript',$data);
		}
		else
		{
            redirect('admin/social_media');
        }
    } //this is use for edit records end
	public function delete_content($id) {
		
		$arr['page'] = 'Social Media';
		
		$this->social_media->delete_record('social_media_id',$id,'social_media');
		echo "delete";			
    }
	public function bulk_delete() {
		$arr['page'] = 'Social Media';
	
		$ids = ( explode( ',', $this->input->get_post('data_ids') ));
			$this->social_media->delete_all($ids);
			echo 'delete';
			
    }
	public function is_active($val,$id)
	{
		$fieldName='is_active';
		$fieldId='social_media_id';
		$tableName='social_media';
		$this->common->update_is_active($val,$id,$fieldName,$fieldId,$tableName);
	}

}
