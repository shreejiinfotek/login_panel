<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Partner extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Partner_model','partnership');
		
	}

	public function index()
	{
		$data['page'] = 'Partner';
		$data['pagetitle']='Manage'.' '.$data['page'].'s';
		$data['path'] = ''.base_url().'admin/partner/delete_content/';
		$data['bulk_path'] = ''.base_url().'admin/partner/bulk_delete/';
		$data['ckeditor']=false;
		$data['manage_view_path']=''.base_url().'admin/partner/partnership_view/';
		$data['soringCol']='"order": [[ 1, "asc" ]],';
		$data['is_active_path']=''.base_url().'admin/partner/is_active/';
		$data['gridTable']=true;
		$this->load->view('admin/controls/vwHeader');
		$this->load->view('admin/controls/vwLeft',$data);
		$this->load->view('admin/controls/vwFooterJavascript',$data);
        $this->load->view('admin/vwManagePartnership',$data);
		
		$this->load->view('admin/controls/vwFooter');
	}

	public function partnership_view()
	{
		$data['page'] = 'Partner';
		$sql_details=$this->common->sql_detial();
		echo $results = $this->partnership->get_datatables($sql_details);
	}
	
	public function add_partner() { //this is use for redirect form in add section start
		$data['page'] = 'Partner';
	
		$data['pagetitle']='Manage'.' '.$data['page'].'s | Add '.$data['page'];
		$data['ckeditor']=false;
		$data['gridTable']=false;

		$this->form_validation->set_rules('partnership_title', 'partnership title', 'required');
			
			$formSubmit = $this->input->post('Submit');
			if($formSubmit=="Save")
			{
					$data['error']="";				
					$tblName = "partnership";
					$duplicate_partnership=$this->common->CountByTable('partnership','WHERE partnership_title="'.$this->input->post('partnership_title').'"');
					if($duplicate_partnership>=1)
					{
						$data['error']='Please enter other title. This title already exists.';
					}
					if(!empty($_FILES['partnership_image']['name']))
					{
						$tmp = $_FILES['partnership_image']['name'];
						$ext = explode('.',$tmp);
						$image_extension  = strtolower($ext[1]);
						if(($image_extension =="gif" || $image_extension =="jpeg" || $image_extension =="jpg" || $image_extension =="png")==false)
						{
							$data['error']="Please upload correct image( gif / jpeg / jpg / png)";
						}
					}
					if($data['error']=="")
					{
						if($this->form_validation->run() === TRUE)
						{
							$filepath="";
							if(isset($_FILES['partnership_image']['name']) && !empty($_FILES['partnership_image']['name']))
							{
								$today = date('mdyHis');
								$image_pathMain = './uploads/Partnership/';
								if (!is_dir($image_pathMain))
										mkdir($image_pathMain, 0755);
								$configImage['upload_path'] = $image_pathMain;
								$configImage['max_size'] = "'".UPLOAD_IMAGE_MAX_SIZE."'";
								$configImage['allowed_types'] = 'gif|jpg|jpeg|png';
								$image_file_name=$today.'.'.$image_extension;
								$configImage['file_name'] = $image_file_name;
								
								$this->load->library('upload', $configImage, 'partnershipimage'); 
								$this->partnershipimage->initialize($configImage);
								$this->partnershipimage->do_upload('partnership_image');
								$filepath=str_replace("./","",$image_pathMain.$image_file_name);
							}
							$url_value=strtolower(preg_replace('/-+/', '-', preg_replace('/[^\wáéíóú]/', '-', $this->input->post('partnership_title'))));
							$data = array(
							'partnership_title'=>$this->input->post('partnership_title'),
							'partnership_image' => $filepath,
							'description'=>$this->input->post('description'),
							'redirect_link'=>$this->input->post('redirect_link'),
							'display_order' => $this->input->post('display_order'),
							'url_path'=>$url_value,
							);
							$this->common->insert_record($tblName,$data);
					
							$this->session->set_flashdata('msg', 'Partner has been added successfully.');
							redirect('admin/partner/','refresh'); //redirect in manage with msg
						}
					}
			}
			
					$this->load->view('admin/controls/vwHeader');
					$this->load->view('admin/controls/vwLeft',$data);
					$this->load->view('admin/vwAddPartnership',$data);    
					$this->load->view('admin/controls/vwFooter');
					$this->load->view('admin/controls/vwFooterJavascript',$data);
				
		
	} //this is use for redirect form in add section end */
	
	
    public function edit_partner($id='') //this is use for edit records start
	{
		
        $data['page'] = 'Partner';
		$data['pagetitle']='Manage'.' '.$data['page'].'s | Edit '.$data['page'];
		$data['ckeditor']=false;
		$data['gridTable']=false;
		$this->form_validation->set_rules('partnership_title', 'partnership title', 'required');
		if($id!='')
		{	
		
			$formSubmit = $this->input->post('Submit');
			if($formSubmit=="Save")
			{
				 $tblName = "partnership";
				 $fieldName = "partnership_id";
				
				$data['error']="";
				
				$duplicate_partnership=$this->common->CountByTable('partnership','WHERE partnership_id!="'.$id.'" AND partnership_title="'.$this->input->post('partnership_title').'"');
				if($duplicate_partnership>=1)
				{
					$data['error']='Please enter other title. This title already exists.';
				}
				else
				{
					if (isset($_FILES['partnership_image']['name']) && !empty($_FILES['partnership_image']['name']))
					{
						$tmp = $_FILES['partnership_image']['name'];
						$ext = explode('.',$tmp);
						$extension  = strtolower($ext[1]);
					
						if(($extension =="gif" || $extension =="jpeg" || $extension =="jpg" || $extension =="png")==false)
						{
							$data['error']="Please upload correct file( gif / jpeg / jpg / png)";
						}
					
					}
				if($data['error']=="")
				{
					$filepath=$this->common->GetValue("partnership","partnership_image","partnership_id",''.$id.'');
					if(!empty($_FILES['partnership_image']['name']))
					{
							$tmp = $_FILES['partnership_image']['name'];
							$ext = explode('.',$tmp);
							$extension  = strtolower($ext[1]);
							
							$today = date('mdyHis');
							$pathMain = './uploads/Partnership/';
								if (!is_dir($pathMain))
									mkdir($pathMain, 0755);
							$configImage['upload_path'] = $pathMain;
							$configImage['max_size'] = "'".UPLOAD_IMAGE_MAX_SIZE."'";
							$configImage['allowed_types'] = 'gif|jpg|jpeg|png';
							$img_name =$today.'.'.$extension;
							$configImage['file_name'] = $img_name;
							$this->load->library('upload', $configImage,'partnership_image');
							$this->partnership_image->initialize($configImage);
							if (!$this->partnership_image->do_upload('partnership_image')) 
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
					$url_value=strtolower(preg_replace('/-+/', '-', preg_replace('/[^\wáéíóú]/', '-', $this->input->post('partnership_title'))));
					$data = array(
					'partnership_title'=>$this->input->post('partnership_title'),
					'partnership_image' => $filepath,
					'description'=>$this->input->post('description'),
					'redirect_link'=>$this->input->post('redirect_link'),
					'display_order' => $this->input->post('display_order'),
					'url_path'=>$url_value,
				
					);
					
					$this->common->update_record($fieldName,$id,$tblName,$data);
					$this->session->set_flashdata('msg', 'Partner has been updated successfully.');
					redirect('admin/partner/','refresh'); //redirect in manage with msg
				}
			  }
			}
			
			$data['partnership']=$this->partnership->get_partnership_by_id($id);
			$this->load->view('admin/controls/vwHeader');
			$this->load->view('admin/controls/vwLeft',$data);
	        $this->load->view('admin/vwEditPartnership',$data);
			$this->load->view('admin/controls/vwFooter');
			$this->load->view('admin/controls/vwFooterJavascript',$data);
		}
		else
		{
            redirect('admin/partner');
        }
    } //this is use for edit records end
	
	public function delete_content($id) {
		$arr['page'] = 'Partner';
		$this->partnership->delete_record('partnership_id',$id,'partnership');
		echo "delete";			
    }
	public function bulk_delete() {
		$arr['page'] = 'Partner';
		$ids = ( explode( ',', $this->input->get_post('data_ids') ));
			$this->partnership->delete_all($ids);
			echo 'delete';
    }
		
	public function is_active($val,$id)
	{
		$fieldName='is_active';
		$fieldId='partnership_id';
		$tableName='partnership';
		$this->common->update_is_active($val,$id,$fieldName,$fieldId,$tableName);
	}

} 