<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Testimonial extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Testimonial_model','testimonial');
		
	}

	public function index()
	{
		$data['page'] = 'Testimonial';
		$data['pagetitle']='Manage'.' '.$data['page'].'s';
		$data['path'] = ''.base_url().'admin/testimonial/delete_content/';
		$data['bulk_path'] = ''.base_url().'admin/testimonial/bulk_delete/';
		$data['ckeditor']=false;
		$data['manage_view_path']=''.base_url().'admin/testimonial/testimonial_view/';
		$data['soringCol']='"order": [[ 1, "asc" ]],';
		$data['is_active_path']=''.base_url().'admin/testimonial/is_active/';
		$data['gridTable']=true;
		$this->load->view('admin/controls/vwHeader');
		$this->load->view('admin/controls/vwLeft',$data);
		$this->load->view('admin/controls/vwFooterJavascript',$data);
        $this->load->view('admin/vwManageTestimonial',$data);
		
		$this->load->view('admin/controls/vwFooter');
	}

	public function testimonial_view()
	{
		$data['page'] = 'Testimonial';
		$sql_details=$this->common->sql_detial();
		echo $results = $this->testimonial->get_datatables($sql_details);
	}
	
	public function add_testimonial() { //this is use for redirect form in add section start
		$data['page'] = 'Testimonial';
	
		$data['pagetitle']='Manage'.' '.$data['page'].'s | Add '.$data['page'];
		$data['ckeditor']=false;
		$data['gridTable']=false;

		$this->form_validation->set_rules('testimonial_name', 'testimonial name', 'required');
			
			$formSubmit = $this->input->post('Submit');
			if($formSubmit=="Save")
			{
					$data['error']="";				
					$tblName = "testimonial";
					
					if(!empty($_FILES['testimonial_image']['name']))
					{
						$tmp = $_FILES['testimonial_image']['name'];
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
							if(isset($_FILES['testimonial_image']['name']) && !empty($_FILES['testimonial_image']['name']))
							{
								$today = date('mdyHis');
								$image_pathMain = './uploads/Testimonial/';
								if (!is_dir($image_pathMain))
										mkdir($image_pathMain, 0755);
								$configImage['upload_path'] = $image_pathMain;
								$configImage['max_size'] = "'".UPLOAD_IMAGE_MAX_SIZE."'";
								$configImage['allowed_types'] = 'gif|jpg|jpeg|png';
								$image_file_name=$today.'.'.$image_extension;
								$configImage['file_name'] = $image_file_name;
								
								$this->load->library('upload', $configImage, 'testimonialimage'); 
								$this->testimonialimage->initialize($configImage);
								$this->testimonialimage->do_upload('testimonial_image');
								$filepath=str_replace("./","",$image_pathMain.$image_file_name);
							}
							$url_value=strtolower(preg_replace('/-+/', '-', preg_replace('/[^\wáéíóú]/', '-', $this->input->post('testimonial_name'))));
							$data = array(
							'school_id'=>$this->input->post('school_id'),
							'testimonial_name'=>$this->input->post('testimonial_name'),
							'testimonial_image' => $filepath,
							'course'=>$this->input->post('course'),
							'description'=>$this->input->post('testimonial_description'),
							'display_order' => $this->input->post('display_order'),
							'url_path'=>$url_value,
							);
							$this->common->insert_record($tblName,$data);
					
							$this->session->set_flashdata('msg', 'Testimonial has been added successfully.');
							redirect('admin/testimonial/','refresh'); //redirect in manage with msg
						}
					}
			}
			
					$data['school'] = $this->testimonial->get_school();
					$this->load->view('admin/controls/vwHeader');
					$this->load->view('admin/controls/vwLeft',$data);
					$this->load->view('admin/vwAddTestimonial',$data);    
					$this->load->view('admin/controls/vwFooter');
					$this->load->view('admin/controls/vwFooterJavascript',$data);
				
		
	} //this is use for redirect form in add section end */
	
	
    public function edit_testimonial($id='') //this is use for edit records start
	{
		
        $data['page'] = 'Testimonial';
		$data['pagetitle']='Manage'.' '.$data['page'].'s | Edit '.$data['page'];
		$data['ckeditor']=false;
		$data['gridTable']=false;
		$this->form_validation->set_rules('testimonial_name', 'testimonial name', 'required');
		if($id!='')
		{	
		
			$formSubmit = $this->input->post('Submit');
			if($formSubmit=="Save")
			{
				 $tblName = "testimonial";
				 $fieldName = "testimonial_id";
				
				$data['error']="";
				
				$duplicate_testimonial=$this->common->CountByTable('testimonial','WHERE testimonial_id!="'.$id.'" AND testimonial_name="'.$this->input->post('testimonial_name').'"');
				if($duplicate_testimonial>=1)
				{
					$data['error']='Please enter other name. This name already exists.';
				}
				else
				{
					if (isset($_FILES['testimonial_image']['name']) && !empty($_FILES['testimonial_image']['name']))
					{
						$tmp = $_FILES['testimonial_image']['name'];
						$ext = explode('.',$tmp);
						$extension  = strtolower($ext[1]);
					
						if(($extension =="gif" || $extension =="jpeg" || $extension =="jpg" || $extension =="png")==false)
						{
							$data['error']="Please upload correct file( gif / jpeg / jpg / png)";
						}
					
					}
				if($data['error']=="")
				{
					$filepath=$this->common->GetValue("testimonial","testimonial_image","testimonial_id",''.$id.'');
					if(!empty($_FILES['testimonial_image']['name']))
					{
							$tmp = $_FILES['testimonial_image']['name'];
							$ext = explode('.',$tmp);
							$extension  = strtolower($ext[1]);
							
							$today = date('mdyHis');
							$pathMain = './uploads/Testimonial/';
								if (!is_dir($pathMain))
									mkdir($pathMain, 0755);
							$configImage['upload_path'] = $pathMain;
							$configImage['max_size'] = "'".UPLOAD_IMAGE_MAX_SIZE."'";
							$configImage['allowed_types'] = 'gif|jpg|jpeg|png';
							$img_name =$today.'.'.$extension;
							$configImage['file_name'] = $img_name;
							$this->load->library('upload', $configImage,'testimonial_image');
							$this->testimonial_image->initialize($configImage);
							if (!$this->testimonial_image->do_upload('testimonial_image')) 
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
					$url_value=strtolower(preg_replace('/-+/', '-', preg_replace('/[^\wáéíóú]/', '-', $this->input->post('testimonial_name'))));
					$data = array(
					'testimonial_name'=>$this->input->post('testimonial_name'),
					'testimonial_image' => $filepath,
					'course'=>$this->input->post('course'),
					'description'=>$this->input->post('testimonial_description'),
					'display_order' => $this->input->post('display_order'),
					'url_path'=>$url_value,
				
					);
					
					$this->common->update_record($fieldName,$id,$tblName,$data);
					$this->session->set_flashdata('msg', 'Testimonial has been updated successfully.');
					redirect('admin/testimonial/','refresh'); //redirect in manage with msg
				}
			  }
			}
			
			$data['school'] = $this->testimonial->get_school();
			$data['testimonial']=$this->testimonial->get_testimonial_by_id($id);
			$this->load->view('admin/controls/vwHeader');
			$this->load->view('admin/controls/vwLeft',$data);
	        $this->load->view('admin/vwEditTestimonial',$data);
			$this->load->view('admin/controls/vwFooter');
			$this->load->view('admin/controls/vwFooterJavascript',$data);
		}
		else
		{
            redirect('admin/testimonial');
        }
    } //this is use for edit records end
	
	public function delete_content($id) {
		$arr['page'] = 'Testimonial';
		$this->testimonial->delete_record('testimonial_id',$id,'testimonial');
		echo "delete";			
    }
	public function bulk_delete() {
		$arr['page'] = 'Testimonial';
		$ids = ( explode( ',', $this->input->get_post('data_ids') ));
			$this->testimonial->delete_all($ids);
			echo 'delete';
    }
		
	public function is_active($val,$id)
	{
		$fieldName='is_active';
		$fieldId='testimonial_id';
		$tableName='testimonial';
		$this->common->update_is_active($val,$id,$fieldName,$fieldId,$tableName);
	}

} 