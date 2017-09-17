<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Banner extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Banner_model','banner');
	}
	public function index()
	{
		$data['page'] = 'Banner';
		$data['path'] = ''.base_url().'admin/banner/delete_content/';
		$data['bulk_path'] = ''.base_url().'admin/banner/bulk_delete/';
		$data['ckeditor']=false;
		$data['manage_view_path']=''.base_url().'admin/banner/banner_view/';
		$data['soringCol']='"order": [[ 1, "asc" ]],';
		$data['is_active_path']=''.base_url().'admin/banner/is_active/';
		$data['pagetitle']='Manage'.' '.$data['page'].'s';
		$data['gridTable']=true;
		$this->load->view('admin/controls/vwHeader');
		$this->load->view('admin/controls/vwLeft',$data);
		$this->load->view('admin/controls/vwFooterJavascript',$data);
        $this->load->view('admin/vwManageBanner',$data);
		$this->load->view('admin/controls/vwFooter');
	}
	public function banner_view()
	{
		$data['page'] = 'Banner';
		$sql_details=$this->common->sql_detial();
		echo $results = $this->banner->get_datatables($sql_details);
	}
	public function add_banner() { //this is use for redirect form in add section start
		$data['page'] = 'Banner';
		$data['pagetitle']='Manage'.' '.$data['page'].'s | Add '.$data['page'];
		$data['ckeditor']=false;
		$data['gridTable']=false;
		
			$formSubmit = $this->input->post('Submit');
			if($formSubmit=="Save")
			{
					$filepath="";			
					$tblName = "banner";
					if (!empty($_FILES['banner_image']['name']))
					{
						if(!empty($_FILES['banner_image']['name']))
						{
							$tmp = $_FILES['banner_image']['name'];
							$ext = explode('.',$tmp);
							$extension  = strtolower($ext[1]);
							
							$today = date('mdyHis');
							$pathMain = './uploads/Banner/';
								if (!is_dir($pathMain))
									mkdir($pathMain, 0755);
							$configImage['upload_path'] = $pathMain;
							$configImage['max_size'] = "'".UPLOAD_IMAGE_MAX_SIZE."'";
							$configImage['allowed_types'] = 'gif|jpg|jpeg|png';
							$img_name =$today.'.'.$extension;
							$configImage['file_name'] = $img_name;
							$this->load->library('upload', $configImage,'banner_img');
							$this->banner_img->initialize($configImage);
							if (!$this->banner_img->do_upload('banner_image')) 
							{
								$data['error']='Please upload correct image( gif / jpeg / jpg / png).';
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
							$data = array(
							'banner_path' => $filepath,
							'caption'=>$this->input->post('caption'),
							'display_order' => $this->input->post('display_order')
							);
							$this->common->insert_record($tblName,$data);
							$this->session->set_flashdata('msg', 'Banner has been added successfully.');
							redirect('admin/banner/','refresh'); //redirect in manage with msg
				}
			}
			else
			{
				$this->form_validation->set_rules('banner_image', 'banner', 'required');
				$this->form_validation->set_message('required', 'Please upload banner.');
				if ($this->form_validation->run() === FALSE)
				{
					$this->load->view('admin/controls/vwHeader');
					$this->load->view('admin/controls/vwLeft',$data);
					$this->load->view('admin/vwAddBanner',$data);    
					$this->load->view('admin/controls/vwFooter');
					$this->load->view('admin/controls/vwFooterJavascript',$data);
				}
			}
		
	} //this is use for redirect form in add section end
    public function edit_banner($id='') //this is use for edit records start
	{
        $data['page'] = 'Banner';
		$data['pagetitle']='Manage'.' '.$data['page'].'s | Edit '.$data['page'];
		$data['ckeditor']=false;
		$data['gridTable']=false;
		if($id!='')
		{
			$formSubmit = $this->input->post('Submit');
			if($formSubmit=="Save")
			{
				 $tblName = "banner";
				 $fieldName = "banner_id";
				$data['error']='';
				if (isset($_FILES['banner_image']) && !empty($_FILES['banner_image']['name']))
				{
					$tmp = $_FILES['banner_image']['name'];
					$ext = explode('.',$tmp);
					$extension  = strtolower($ext[1]);
					if(($extension =="gif" || $extension =="jpeg" || $extension =="jpg" || $extension =="png")==false)
					{
						$data['error']="Please upload correct file( gif / jpeg / jpg / png).";
					}
				}
				if($data['error']=="")
				{
					$filepath=$this->common->GetValue("banner","banner_path","banner_id",''.$id.'');
					if(!empty($_FILES['banner_image']['name']))
					{
							$tmp = $_FILES['banner_image']['name'];
							$ext = explode('.',$tmp);
							$extension  = strtolower($ext[1]);
							
							$today = date('mdyHis');
							$pathMain = './uploads/Banner/';
								if (!is_dir($pathMain))
									mkdir($pathMain, 0755);
							$configImage['upload_path'] = $pathMain;
							$configImage['max_size'] = "'".UPLOAD_IMAGE_MAX_SIZE."'";
							$configImage['allowed_types'] = 'gif|jpg|jpeg|png';
							$img_name =$today.'.'.$extension;
							$configImage['file_name'] = $img_name;
							$this->load->library('upload', $configImage,'banner_img');
							$this->banner_img->initialize($configImage);
							if (!$this->banner_img->do_upload('banner_image')) 
							{
								$data['error']='Please upload correct image( gif / jpeg / jpg / png).';
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
					
					$data = array(
							'banner_path' => $filepath,
							'caption'=>$this->input->post('caption'),
							'display_order' => $this->input->post('display_order')
							);
					$this->common->update_record($fieldName,$id,$tblName,$data);
					$this->session->set_flashdata('msg', 'Banner has been updated successfully.');
					redirect('admin/banner/','refresh'); //redirect in manage with msg
				}
			}
			$data['banner']=$this->banner->get_banner_by_id($id);
			$this->load->view('admin/controls/vwHeader');
			$this->load->view('admin/controls/vwLeft',$data);
	        $this->load->view('admin/vwEditBanner',$data);
			$this->load->view('admin/controls/vwFooter');
			$this->load->view('admin/controls/vwFooterJavascript',$data);
		}
		else
		{
            redirect('admin/banner');
        }
    } //this is use for edit records end
	public function delete_content($id) {
		$arr['page'] = 'Banner';
		$this->banner->delete_record('banner_id',$id,'banner');
		echo "delete";			
    }
	public function bulk_delete() {
		$arr['page'] = 'Banner';
		$ids = ( explode( ',', $this->input->get_post('data_ids') ));
			$this->banner->delete_all($ids);
			echo 'delete';
    }
	public function is_active($val,$id)
	{
		$fieldName='is_active';
		$fieldId='banner_id';
		$tableName='banner';
		$this->common->update_is_active($val,$id,$fieldName,$fieldId,$tableName);
	}
} 