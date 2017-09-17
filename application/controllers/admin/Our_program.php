<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Our_program extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Our_program_model','our_program');
		
	}

	public function index()
	{
		$data['page'] = 'Our Program';
		$data['pagetitle']='Manage'.' '.$data['page'].'s';
		$data['path'] = ''.base_url().'admin/our_program/delete_content/';
		$data['bulk_path'] = ''.base_url().'admin/our_program/bulk_delete/';
		$data['ckeditor']=false;
		$data['manage_view_path']=''.base_url().'admin/our_program/our_program_view/';
		$data['soringCol']='"order": [[ 1, "asc" ]],';
		$data['is_active_path']=''.base_url().'admin/our_program/is_active/';
		$data['gridTable']=true;
		$this->load->view('admin/controls/vwHeader');
		$this->load->view('admin/controls/vwLeft',$data);
		$this->load->view('admin/controls/vwFooterJavascript',$data);
        $this->load->view('admin/vwManageOurProgram',$data);
		
		$this->load->view('admin/controls/vwFooter');
	}

	public function our_program_view()
	{
		$data['page'] = 'Our Program';
		$sql_details=$this->common->sql_detial();
		echo $results = $this->our_program->get_datatables($sql_details);
	}
	
	public function add_our_program() { //this is use for redirect form in add section start
		$data['page'] = 'Our Program';
	
		$data['pagetitle']='Manage'.' '.$data['page'].'s | Add '.$data['page'];
		$data['ckeditor']=true;
		$data['gridTable']=false;

		$this->form_validation->set_rules('our_program_title', 'our_program_title', 'required');
			
			$formSubmit = $this->input->post('Submit');
			if($formSubmit=="Save")
			{
					$data['error']="";				
					$tblName = "our_program";
					$duplicate_our_program=$this->common->CountByTable('our_program','WHERE our_program_title="'.$this->input->post('our_program_title').'"');
					if($duplicate_our_program>=1)
					{
						$data['error']='Please enter other title. This title already exists.';
					}
					if(!empty($_FILES['our_program_banner']['name']))
					{
						$tmp_banner = $_FILES['our_program_banner']['name'];
						$ext_banner = explode('.',$tmp_banner);
						$banner_extension  = strtolower($ext_banner[1]);
						if(($banner_extension =="gif" || $banner_extension =="jpeg" || $banner_extension =="jpg" || $banner_extension =="png")==false)
						{
							$data['error']="Please upload correct image( gif / jpeg / jpg / png).";
						}
					}
					if(!empty($_FILES['our_program_image']['name']))
					{
						$tmp = $_FILES['our_program_image']['name'];
						$ext = explode('.',$tmp);
						$image_extension  = strtolower($ext[1]);
						if(($image_extension =="gif" || $image_extension =="jpeg" || $image_extension =="jpg" || $image_extension =="png")==false)
						{
							$data['error']="Please upload correct image( gif / jpeg / jpg / png).";
						}
					}
					if(!empty($_FILES['our_program_syllabus']['name']))
					{
						$our_program_syllabus_file =str_replace(" ","_",$_FILES['our_program_syllabus']['name']);
						$our_program_syllabus_file  = preg_replace("/[&']/","",$our_program_syllabus_file);
						$our_program_syllabus_file = preg_replace("/[^a-zA-Z0-9.]/", "_", $our_program_syllabus_file);
						$tmp = $our_program_syllabus_file;
						$ext = explode('.',$tmp);
						$doc_extension  = strtolower($ext[1]);
						if(($doc_extension =="pdf")==false)
						{
							$data['error']="Please upload pdf file.";
						}
					}

					if($data['error']=="")
					{
						if($this->form_validation->run() === TRUE)
						{
							$filepath="";
							$our_program_syllabus="";
							$our_program_banner="";
							if(isset($_FILES['our_program_banner']['name']) && !empty($_FILES['our_program_banner']['name']))
							{
								$today = date('mdyHis');
								$banner_image_pathMain = './uploads/OurProgramBanner/';
								if (!is_dir($banner_image_pathMain))
										mkdir($banner_image_pathMain, 0755);
								$configImage['upload_path'] = $banner_image_pathMain;
								$configImage['max_size'] =  "'".UPLOAD_IMAGE_MAX_SIZE."'";
								$configImage['allowed_types'] = 'gif|jpg|jpeg|png';
								$image_file_name=$today.'.'.$banner_extension;
								$configImage['file_name'] = $image_file_name;
								
								$this->load->library('upload', $configImage, 'our_banner'); 
								$this->our_banner->initialize($configImage);
								$this->our_banner->do_upload('our_program_banner');
								$our_program_banner=str_replace("./","",$banner_image_pathMain.$image_file_name);
							}
														
							if(isset($_FILES['our_program_image']['name']) && !empty($_FILES['our_program_image']['name']))
							{
								$today = date('mdyHis');
								$image_pathMain = './uploads/OurProgram/';
								if (!is_dir($image_pathMain))
										mkdir($image_pathMain, 0755);
								$configImage['upload_path'] = $image_pathMain;
								$configImage['max_size'] =  "'".UPLOAD_IMAGE_MAX_SIZE."'";
								$configImage['allowed_types'] = 'gif|jpg|jpeg|png';
								$image_file_name=$today.'.'.$image_extension;
								$configImage['file_name'] = $image_file_name;
								
								$this->load->library('upload', $configImage, 'our_programimage'); 
								$this->our_programimage->initialize($configImage);
								$this->our_programimage->do_upload('our_program_image');
								$filepath=str_replace("./","",$image_pathMain.$image_file_name);
							}
							if(isset($_FILES['our_program_syllabus']['name']) && !empty($_FILES['our_program_syllabus']['name']))
							{
								$today2 = date('mdyHis');
								$docx_pathMain = './uploads/Syllabus/';
								if (!is_dir($docx_pathMain))
										mkdir($docx_pathMain, 0755);
								$configDocx['upload_path'] = $docx_pathMain;
								$configDocx['max_size'] =  "'".UPLOAD_IMAGE_MAX_SIZE."'";
								$configDocx['allowed_types'] = 'pdf';
								$docx_file_name=$today2.'.'.$doc_extension;
								$configDocx['file_name'] = $docx_file_name;
							
								
								
								$this->load->library('upload', $configDocx, 'our_program_syllabus_upload'); // Create custom object for cover upload
								$this->our_program_syllabus_upload->initialize($configDocx);
								$this->our_program_syllabus_upload->do_upload('our_program_syllabus');
								
								$our_program_syllabus=str_replace("./","",$docx_pathMain.$docx_file_name);
							}
							
							$url_value=strtolower(preg_replace('/-+/', '-', preg_replace('/[^\wáéíóú]/', '-', $this->input->post('our_program_title'))));
							
							$data = array(
							'school_id'=>$this->input->post('school_id'),
							'our_program_title'=>$this->input->post('our_program_title'),
							'our_program_banner' => $our_program_banner,
							'our_program_image' => $filepath,
							'our_program_short_description'=>$this->input->post('our_program_short_description'),
							'description'=>$this->input->post('description'),
							'our_program_syllabus'=>$our_program_syllabus,
							'redirect_link' =>$this->input->post('redirect_link'),
							'display_order' => $this->input->post('display_order'),
							'created_date'=>date('Y-m-d'),
							'url_path'=>$url_value
							);
							//print_r($data); exit();
							$this->common->insert_record($tblName,$data);
					
							$this->session->set_flashdata('msg', 'Our Program has been added successfully.');
							redirect('admin/our_program/','refresh'); //redirect in manage with msg

						}
					}
			}
					$data['school'] = $this->our_program->get_school_id();
					$this->load->view('admin/controls/vwHeader');
					$this->load->view('admin/controls/vwLeft',$data);
					$this->load->view('admin/vwAddOurProgram',$data);    
					$this->load->view('admin/controls/vwFooter');
					$this->load->view('admin/controls/vwFooterJavascript',$data);
				
		
	} //this is use for redirect form in add section end */
	
	
    public function edit_our_program($id='') //this is use for edit records start
	{
		
        $data['page'] = 'Our Program';
		$data['pagetitle']='Manage'.' '.$data['page'].'s | Edit '.$data['page'];
		$data['ckeditor']=true;
		$data['gridTable']=false;
		$this->form_validation->set_rules('our_program_title', 'our_program', 'required');
		if($id!='')
		{	
		
			$formSubmit = $this->input->post('Submit');
			if($formSubmit=="Save")
			{
				 $tblName = "our_program";
				 $fieldName = "our_program_id";
				
				$data['error']="";
				
				$duplicate_our_program=$this->common->CountByTable('our_program','WHERE our_program_id!="'.$id.'" AND our_program_title="'.$this->input->post('our_program_title').'"');
				if($duplicate_our_program>=1)
				{
					$data['error']='Please enter other title. This title already exists.';
				}
				else
				{
					if (isset($_FILES['our_program_image']['name']) && !empty($_FILES['our_program_image']['name']))
					{
						$tmp = $_FILES['our_program_image']['name'];
						$ext = explode('.',$tmp);
						$extension  = strtolower($ext[1]);
					
						if(($extension =="gif" || $extension =="jpeg" || $extension =="jpg" || $extension =="png")==false)
						{
							$data['error']="Please upload correct file( gif / jpeg / jpg / png).";
						}
					
					}
					if (isset($_FILES['our_program_banner']['name']) && !empty($_FILES['our_program_banner']['name']))
					{
						$tmp_banner = $_FILES['our_program_banner']['name'];
						$ext_banner = explode('.',$tmp_banner);
						$banner_extension  = strtolower($ext_banner[1]);
					
						if(($banner_extension =="gif" || $banner_extension =="jpeg" || $banner_extension =="jpg" || $banner_extension =="png")==false)
						{
							$data['error']="Please upload correct file( gif / jpeg / jpg / png).";
						}
					
					}
					if(!empty($_FILES['our_program_syllabus']['name']))
					{
						$our_program_syllabus_file =str_replace(" ","_",$_FILES['our_program_syllabus']['name']);
						$our_program_syllabus_file  = preg_replace("/[&']/","",$our_program_syllabus_file);
						$our_program_syllabus_file = preg_replace("/[^a-zA-Z0-9.]/", "_", $our_program_syllabus_file);
						$tmp = $our_program_syllabus_file;
						$ext = explode('.',$tmp);
						$doc_extension  = strtolower($ext[1]);
						if(($doc_extension =="pdf")==false)
						{
						$data['error']="Please upload pdf file.";
						}
					}

				if($data['error']=="")
				{
					$filepath=$this->common->GetValue("our_program","our_program_image","our_program_id",''.$id.'');
					$our_program_banner=$this->common->GetValue("our_program","our_program_banner","our_program_id",''.$id.'');
					$our_program_syllabus=$this->common->GetValue("our_program","our_program_syllabus","our_program_id",''.$id.'');
					
					if(!empty($_FILES['our_program_banner']['name']))
					{
							$tmp_banner = $_FILES['our_program_banner']['name'];
							$ext_banner = explode('.',$tmp_banner);
							$banner_extension  = strtolower($ext_banner[1]);
							
							$today = date('mdyHis');
							$pathMain = './uploads/OurProgramBanner/';
								if (!is_dir($pathMain))
									mkdir($pathMain, 0755);
							$configImage['upload_path'] = $pathMain;
							$configImage['max_size'] =  "'".UPLOAD_IMAGE_MAX_SIZE."'";
							$configImage['allowed_types'] = 'gif|jpg|jpeg|png';
							$img_name =$today.'.'.$banner_extension;
							$configImage['file_name'] = $img_name;
							$this->load->library('upload', $configImage,'our_banner');
							$this->our_banner->initialize($configImage);
							if (!$this->our_banner->do_upload('our_program_banner')) 
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
								if($our_program_banner!="" && file_exists("./".$our_program_banner))
								{
									unlink("./".$our_program_banner);
								}
								$our_program_banner = str_replace("./","",$pathMain.$img_name);
								
							}
						}
						
						
					if(!empty($_FILES['our_program_image']['name']))
					{
							$tmp = $_FILES['our_program_image']['name'];
							$ext = explode('.',$tmp);
							$extension  = strtolower($ext[1]);
							
							$today = date('mdyHis');
							$pathMain = './uploads/OurProgram/';
								if (!is_dir($pathMain))
									mkdir($pathMain, 0755);
							$configImage['upload_path'] = $pathMain;
							$configImage['max_size'] =  "'".UPLOAD_IMAGE_MAX_SIZE."'";
							$configImage['allowed_types'] = 'gif|jpg|jpeg|png';
							$img_name =$today.'.'.$extension;
							$configImage['file_name'] = $img_name;
							$this->load->library('upload', $configImage,'our_program_image');
							$this->our_program_image->initialize($configImage);
							if (!$this->our_program_image->do_upload('our_program_image')) 
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
						
						if(isset($_FILES['our_program_syllabus']['name']) && !empty($_FILES['our_program_syllabus']['name']))
						{
							
							$today2 = date('mdyHis');
							$docx_pathMain = './uploads/Syllabus/';
							if (!is_dir($docx_pathMain))
									mkdir($docx_pathMain, 0755);
							$configDocx['upload_path'] = $docx_pathMain;
							$configDocx['max_size'] =  "'".UPLOAD_IMAGE_MAX_SIZE."'";
							$configDocx['allowed_types'] = 'pdf';
							//$docx_file_name=str_replace(' ','_',$_FILES['tournament_rules_path']['name']);
							$docx_file_name=$today2.'.'.$doc_extension;
							$configDocx['file_name'] = $docx_file_name;
						
							
							
							$this->load->library('upload', $configDocx, 'our_program_syllabus_upload'); // Create custom object
							$this->our_program_syllabus_upload->initialize($configDocx);
							$this->our_program_syllabus_upload->do_upload('our_program_syllabus');
							if($our_program_syllabus!="")
							{
								if(file_exists("./".$our_program_syllabus))
								{
									unlink("./".$our_program_syllabus);
								}
							}
							$our_program_syllabus=str_replace("./","",$docx_pathMain.$docx_file_name);
						}
						
						$url_value=strtolower(preg_replace('/-+/', '-', preg_replace('/[^\wáéíóú]/', '-', $this->input->post('our_program_title'))));
						
					$data = array(
					'our_program_title'=>$this->input->post('our_program_title'),
					'our_program_banner' => $our_program_banner,
					'our_program_image' => $filepath,
					'our_program_short_description'=>$this->input->post('our_program_short_description'),
					'description'=>$this->input->post('description'),
					'our_program_syllabus'=>$our_program_syllabus,
					'redirect_link' =>$this->input->post('redirect_link'),
					'display_order' => $this->input->post('display_order'),
					'url_path'=>$url_value
				
					);
					//print_r($data); exit();
					$this->common->update_record($fieldName,$id,$tblName,$data);
					$this->session->set_flashdata('msg', 'Our Program has been updated successfully.');
					redirect('admin/our_program/','refresh'); //redirect in manage with msg
				}
			  }
			}
			
			$data['our_program']=$this->our_program->get_our_program_by_id($id);
			$data['school'] = $this->our_program->get_school_id();
			$this->load->view('admin/controls/vwHeader');
			$this->load->view('admin/controls/vwLeft',$data);
	        $this->load->view('admin/vwEditOurProgram',$data);
			$this->load->view('admin/controls/vwFooter');
			$this->load->view('admin/controls/vwFooterJavascript',$data);
		}
		else
		{
            redirect('admin/our_program');
        }
    } //this is use for edit records end
	
	public function delete_content($id) {
		$arr['page'] = 'Our Program';
		$our_program_count=$this->common->CountByTable('our_course','WHERE our_program_id='.$id.'');
		
		if($our_program_count>0 )
		{
			echo 'ref_id';
		}
		else
		{
			$this->our_program->delete_record('our_program_id',$id,'our_program');
			echo "delete";
		}
    }
	public function bulk_delete() {
		$arr['page'] = 'Our Program';
		
		$ids = ( explode( ',', $this->input->get_post('data_ids') ));
		if($this->our_program->delete_all($ids))
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
		$fieldId='our_program_id';
		$tableName='our_program';
		$this->common->update_is_active($val,$id,$fieldName,$fieldId,$tableName);
	}

} 