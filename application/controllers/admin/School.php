<?

defined('BASEPATH') OR exit('No direct script access allowed');

class School extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('School_model','school');
		
	}

	public function index()
	{
		$data['page'] = 'School';
		$data['pagetitle']='Manage'.' Schools';
		$data['path'] = ''.base_url().'admin/school/delete_content/';
		$data['bulk_path'] = ''.base_url().'admin/school/bulk_delete/';
		$data['ckeditor']=false;
		$data['manage_view_path']=''.base_url().'admin/school/school_view/';
		$data['soringCol']='"order": [[ 1, "asc" ]],';
		$data['is_active_path']=''.base_url().'admin/school/is_active/';
		$data['gridTable']=true;
		$this->load->view('admin/controls/vwHeader');
		$this->load->view('admin/controls/vwLeft',$data);
		$this->load->view('admin/controls/vwFooterJavascript',$data);
        $this->load->view('admin/vwManageSchool',$data);
		
		$this->load->view('admin/controls/vwFooter');
	}

	public function school_view()
	{
		$data['page'] = 'School';
		$sql_details=$this->common->sql_detial();
		echo $results = $this->school->get_datatables($sql_details);
	}
	
	public function add_school() { //this is use for redirect form in add section start
		$data['page'] = 'School';
		$data['pagetitle']='Manage'.' Schools | Add  '.$data['page'];
		$data['ckeditor']=true;
		$data['gridTable']=false;

		$this->form_validation->set_rules('school_title', 'school title', 'required');
			
			$formSubmit = $this->input->post('Submit');
			if($formSubmit=="Save")
			{
					$data['error']="";
					$school_banner="";
					$school_image_filepath="";
					$video_link="";
					$school_videofile_filepath="";
					$right_section_image="";
					$right_section_video_link="";
					$right_section_videofile="";
					$school_main_image="";
					
					$tblName = "school";
					
					$duplicate_school=$this->common->CountByTable('school','WHERE school_title="'.$this->input->post('school_title').'"');
					if($duplicate_school>=1)
					{
						$data['error']='Please enter other name. This name already exists.';
					}
						
					if($this->input->post('news_event_gallery_type_id')==1)
					{
						if(!empty($_FILES['school_image']['name']))
						{
							$tmp = $_FILES['school_image']['name'];
							$ext = explode('.',$tmp);
							$image_extension  = strtolower($ext[1]);
							if(($image_extension =="gif" || $image_extension =="jpeg" || $image_extension =="jpg" || $image_extension =="png")==false)
							{
								$data['error']="Please upload correct image( gif / jpeg / jpg / png)";
							}
						}
					}
					else if($this->input->post('news_event_gallery_type_id')==3)
					{
						if(!empty($_FILES['school_videofile']['name']))
						{
							$tmp = $_FILES['school_videofile']['name'];
							$ext = explode('.',$tmp);
							$extension  = strtolower($ext[1]);
							if(($extension =="mp4" || $extension =="mkv" || $extension =="3gp")==false)
							{
								$data['error']="Please upload correct image( mp4 / mkv / 3gp )";
							}
						}
					}
					
					if($this->input->post('news_event_gallery_2_type_id')==1)
					{
						if(!empty($_FILES['right_section_image']['name']))
						{
							$tmp_right_section_image = $_FILES['right_section_image']['name'];
							$ext_right_section_image = explode('.',$tmp_right_section_image);
							$image_extension_right_section_image  = strtolower($ext_right_section_image[1]);
							if(($image_extension_right_section_image =="gif" || $image_extension_right_section_image =="jpeg" || $image_extension_right_section_image =="jpg" || $image_extension_right_section_image =="png")==false)						{
								$data['error']="Please upload correct image( gif / jpeg / jpg / png)";
							}
						}
					}
					else 
					if($this->input->post('news_event_gallery_2_type_id')==3)
					{
						if(!empty($_FILES['right_section_videofile']['name']))
						{
							$tmp_right_section_videofile = $_FILES['right_section_videofile']['name'];
							$ext_right_section_videofile = explode('.',$tmp_right_section_videofile);
							$extension_right_section_videofile  = strtolower($ext_right_section_videofile[1]);
							if(($extension_right_section_videofile =="mp4" || $extension_right_section_videofile =="mkv" || $extension_right_section_videofile =="3gp")==false)						{
								$data['error']="Please upload correct image( mp4 / mkv / 3gp )";
							}
						}
						
						
					}
					
					if(!empty($_FILES['school_banner']['name']))
					{
						$tmp_banner = $_FILES['school_banner']['name'];
						$ext_banner = explode('.',$tmp_banner);
						$banner_extension  = strtolower($ext_banner[1]);
						if(($banner_extension =="gif" || $banner_extension =="jpeg" || $banner_extension =="jpg" || $banner_extension =="png")==false)
						{
							$data['error']="Please upload correct image( gif / jpeg / jpg / png)";
						}
					}
					if(!empty($_FILES['school_main_img']['name']))
					{
						$tmp_main_img = $_FILES['school_main_img']['name'];
						$ext_main_img = explode('.',$tmp_main_img);
						$school_extension  = strtolower($ext_main_img[1]);
						if(($school_extension =="gif" || $school_extension =="jpeg" || $school_extension =="jpg" || $school_extension =="png")==false)
						{
							$data['error']="Please upload correct image( gif / jpeg / jpg / png)";
						}
					}
			
					if($data['error']=="")
					{
						if($this->form_validation->run() === TRUE)
						{
							
							
							if(isset($_FILES['school_main_img']['name']) && !empty($_FILES['school_main_img']['name']))
							{
								$today_school = date('mdyHis');
								$maindir='./uploads/School/';
								if (!is_dir($maindir))
										mkdir($maindir, 0755);
								$school_image_pathMain = './uploads/School/SchoolMainImage/';
								if (!is_dir($school_image_pathMain))
										mkdir($school_image_pathMain, 0755);
								$configImageSchool['upload_path'] = $school_image_pathMain;
								$configImageSchool['max_size'] =  "'".UPLOAD_IMAGE_MAX_SIZE."'";
								$configImageSchool['allowed_types'] = 'gif|jpg|jpeg|png';
								$school_image_file_name=$today_school.'.'.$school_extension;
								$configImageSchool['file_name'] = $school_image_file_name;
								
								$this->load->library('upload', $configImageSchool, 'school_main_img'); 
								$this->school_main_img->initialize($configImageSchool);
								$this->school_main_img->do_upload('school_main_img');
								$school_main_image=str_replace("./","",$school_image_pathMain.$school_image_file_name);
							}
							if(isset($_FILES['school_banner']['name']) && !empty($_FILES['school_banner']['name']))
							{
								$today = date('mdyHis');
								$maindir='./uploads/School/';
								if (!is_dir($maindir))
										mkdir($maindir, 0755);
								$banner_image_pathMain = './uploads/School/SchoolBanner/';
								if (!is_dir($banner_image_pathMain))
										mkdir($banner_image_pathMain, 0755);
								$configImage['upload_path'] = $banner_image_pathMain;
								$configImage['max_size'] =  "'".UPLOAD_IMAGE_MAX_SIZE."'";
								$configImage['allowed_types'] = 'gif|jpg|jpeg|png';
								$image_file_name=$today.'.'.$banner_extension;
								$configImage['file_name'] = $image_file_name;
								
								$this->load->library('upload', $configImage, 'our_banner'); 
								$this->our_banner->initialize($configImage);
								$this->our_banner->do_upload('school_banner');
								$school_banner=str_replace("./","",$banner_image_pathMain.$image_file_name);
							}
							
							
							
						if($this->input->post('news_event_gallery_type_id')==1)
						{
							$school_image_filepath="";
							if(isset($_FILES['school_image']['name']) && !empty($_FILES['school_image']['name']))
							{
								$today = date('mdyHis');
								$maindir='./uploads/School/';
								if (!is_dir($maindir))
										mkdir($maindir, 0755);
								$image_pathMain = './uploads/School/SchoolImage/';
								if (!is_dir($image_pathMain))
										mkdir($image_pathMain, 0755);
								$configImage['upload_path'] = $image_pathMain;
								$configImage['max_size'] = "'".UPLOAD_IMAGE_MAX_SIZE."'";
								$configImage['allowed_types'] = 'gif|jpg|jpeg|png';
								$image_file_name=$today.'.'.$image_extension;
								$configImage['file_name'] = $image_file_name;
								
								$this->load->library('upload', $configImage, 'schoolimage'); 
								$this->schoolimage->initialize($configImage);
								$this->schoolimage->do_upload('school_image');
								$school_image_filepath=str_replace("./","",$image_pathMain.$image_file_name);
							}
						}
						else 
						if($this->input->post('news_event_gallery_type_id')==2)
						{
							
							$video_link=$this->input->post('video_link');
				
						}
						else if($this->input->post('news_event_gallery_type_id')==3)
						{
					
								$school_videofile_filepath="";
								if(!empty($_FILES['school_videofile']['name']))
								{
									$tmp = $_FILES['school_videofile']['name'];
									$ext = explode('.',$tmp);
									$extension  = strtolower($ext[1]);
									
									$today = date('mdyHis');
									$maindir='./uploads/School/';
									if (!is_dir($maindir))
										mkdir($maindir, 0755);
									$pathMain = './uploads/School/SchoolVideo/';
										if (!is_dir($pathMain))
											mkdir($pathMain, 0755);
									$configImage['upload_path'] = $pathMain;
									$configImage['max_size'] = "'".UPLOAD_IMAGE_MAX_SIZE."'";
									$configImage['allowed_types'] = 'mp4|mkv|3gp';
									$img_name =$today.'.'.$extension;
									$configImage['file_name'] = $img_name;
									$this->load->library('upload', $configImage,'news_event_video');
									$this->news_event_video->initialize($configImage);
									if (!$this->news_event_video->do_upload('school_videofile')) 
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
										
										$school_videofile_filepath = str_replace("./","",$pathMain.$img_name);
									}
								}
						}
						if($this->input->post('news_event_gallery_2_type_id')==1)
						{	
							$right_section_image="";
							if(isset($_FILES['right_section_image']['name']) && !empty($_FILES['right_section_image']['name']))
							{
								$today = date('mdyHis');
								$maindir='./uploads/School/';
								if (!is_dir($maindir))
										mkdir($maindir, 0755);
								$right_section_image = './uploads/School/RightSectionImage/';
								if (!is_dir($right_section_image))
										mkdir($right_section_image, 0755);
								$configImage['upload_path'] = $right_section_image;
								$configImage['max_size'] = "'".UPLOAD_IMAGE_MAX_SIZE."'";
								$configImage['allowed_types'] = 'gif|jpg|jpeg|png';
								$right_section_image_name=$today.'.'.$image_extension_right_section_image;
								$configImage['file_name'] = $right_section_image_name;
								
								$this->load->library('upload', $configImage, 'rightsectionimage'); 
								$this->rightsectionimage->initialize($configImage);
								$this->rightsectionimage->do_upload('right_section_image');
								$right_section_image=str_replace("./","",$right_section_image.$right_section_image_name);
							}
						}
						else
					 	if($this->input->post('news_event_gallery_2_type_id')==2)
						{
							
							$right_section_video_link=$this->input->post('right_section_video_link');
				
						}
						else
						if($this->input->post('news_event_gallery_2_type_id')==3)
						{
							
								$right_section_videofile="";
								if(!empty($_FILES['right_section_videofile']['name']))
								{
									$tmp_right_section_videofile = $_FILES['right_section_videofile']['name'];
									$ext_right_section_videofile = explode('.',$tmp_right_section_videofile);
									$extension_right_section_videofile  = strtolower($ext_right_section_videofile[1]);
									
									$today_right_section_videofile = date('mdyHis');
									$maindir='./uploads/School/';
									if (!is_dir($maindir))
										mkdir($maindir, 0755);
									$right_section_videofile = './uploads/School/RightSectionVideo/';
										if (!is_dir($right_section_videofile))
											mkdir($right_section_videofile, 0755);
									$configImage['upload_path'] = $right_section_videofile;
									$configImage['max_size'] = "'".UPLOAD_IMAGE_MAX_SIZE."'";
									$configImage['allowed_types'] = 'mp4|mkv|3gp';
									$right_section_video_name =$today_right_section_videofile.'.'.$extension_right_section_videofile;
									$configImage['file_name'] = $right_section_video_name;
									$this->load->library('upload', $configImage,'right_section_video');
									$this->right_section_video->initialize($configImage);
									if (!$this->right_section_video->do_upload('right_section_videofile')) 
									{
										$data['error']='Please upload correct video( mp4 / mkv / 3gp)';
									}
									else
									{
										$this->load->library('image_lib');
										$configThumb = array();  
										$configThumb['image_library']   = 'gd2'; 
										$configThumb['source_image']  = $right_section_videofile.$right_section_video_name; 
										$configThumb['create_thumb']    = TRUE;
										
										$right_section_videofile = str_replace("./","",$right_section_videofile.$right_section_video_name);
									}
								}
						}
						
						
						$url_value=strtolower(preg_replace('/-+/', '-', preg_replace('/[^\wáéíóú]/', '-', $this->input->post('school_title'))));
									$data = array(
									'school_title' => $this->input->post('school_title'),
									'school_main_img' => $school_main_image,
									'short_description'=>$this->input->post('short_description'),
									'news_event_gallery_type_id' => $this->input->post('news_event_gallery_type_id'),
									'news_event_gallery_2_type_id' => $this->input->post('news_event_gallery_2_type_id'),
									'school_title1'=>$this->input->post('school_title1'),
									'school_title2'=>$this->input->post('school_title2'),
									'school_image' => $school_image_filepath,
									'school_videofile' => $school_videofile_filepath,
									'video_link' => $video_link,
									'school_banner' => $school_banner,
									'right_section_title1'=>$this->input->post('right_section_title1'),
									'right_section_title2'=>$this->input->post('right_section_title2'),
									'right_section_image' => $right_section_image,
									'right_section_video_link' => $right_section_video_link,
									'right_section_videofile' => $right_section_videofile,
									'description'=>$this->input->post('description'),
									'display_order' => $this->input->post('display_order'),	
									'url_path'=>$url_value
									);
									$this->common->insert_record($tblName,$data);
									$this->session->set_flashdata('msg', 'School has been added successfully.');
									redirect('admin/school/','refresh'); //redirect in manage with msg
						
						
						}
					}
			}
					$data['news_event_gallery'] = $this->school->get_news_event_gallery();
					$this->load->view('admin/controls/vwHeader');
					$this->load->view('admin/controls/vwLeft',$data);
					$this->load->view('admin/vwAddSchool',$data);    
					$this->load->view('admin/controls/vwFooter');
					$this->load->view('admin/controls/vwFooterJavascript',$data);
				
		
	} //this is use for redirect form in add section end */
	
	
    public function edit_school($id='') //this is use for edit records start
	{
		
        $data['page'] = 'School';
		$data['pagetitle']='Manage Schools | Edit '.$data['page'];
		$data['ckeditor']=true;
		$data['gridTable']=false;
		$this->form_validation->set_rules('school_title', 'school title', 'required');
		if($id!='')
		{	
		
			$formSubmit = $this->input->post('Submit');
			if($formSubmit=="Save")
			{
				 $tblName = "school";
				 
				 $school_image_filepath="";
				 $school_videofile_filepath="";
				 $video_link="";
				 $right_section_image="";
				 $right_section_video_link="";
				 $right_section_videofile="";
				 $school_main_image="";
				 
				 $duplicate_school=$this->common->CountByTable('school','WHERE school_id!="'.$id.'" AND school_title="'.$this->input->post('school_title').'"' );
                                
				if($duplicate_school>=1)
				{
					$data['error']='Please enter other name. This name already exists.';
				}
				else
				{
				 
				$this->db->select('school_id,school_banner,school_main_img,school_image,school_videofile,right_section_image,right_section_videofile,news_event_gallery_type_id,news_event_gallery_2_type_id');
				$this->db->where('school_id',$id);
				$result = $this->db->get('school');
				$school_detail=$result->row();
				
				$school_media_type_1=$school_detail->news_event_gallery_type_id;
				$school_media_type_2=$school_detail->news_event_gallery_2_type_id; 
				 
				 $fieldName = "school_id";
				
				$data['error']="";
				
				if($data['error']=="")
				{
				   if($school_media_type_1==1)
					{
						if(!empty($_FILES['school_image']['name']))
						{
							$tmp = $_FILES['school_image']['name'];
							$ext = explode('.',$tmp);
							$image_extension  = strtolower($ext[1]);
							if(($image_extension =="gif" || $image_extension =="jpeg" || $image_extension =="jpg" || $image_extension =="png")==false)
							{
								$data['error']="Please upload correct image( gif / jpeg / jpg / png)";
							}
						}
					}
					else if($school_media_type_1==3)
					{
						if(!empty($_FILES['school_videofile']['name']))
						{
							$tmp = $_FILES['school_videofile']['name'];
							$ext = explode('.',$tmp);
							$extension  = strtolower($ext[1]);
							if(($extension =="mp4" || $extension =="mkv" || $extension =="3gp")==false)
							{
								$data['error']="Please upload correct image( mp4 / mkv / 3gp )";
							}
						}
					}
					
					if($school_media_type_2==1)
					{
						if(!empty($_FILES['right_section_image']['name']))
						{
							$tmp_right_section_image = $_FILES['right_section_image']['name'];
							$ext_right_section_image = explode('.',$tmp_right_section_image);
							$image_extension_right_section_image  = strtolower($ext_right_section_image[1]);
							if(($image_extension_right_section_image =="gif" || $image_extension_right_section_image =="jpeg" || $image_extension_right_section_image =="jpg" || $image_extension_right_section_image =="png")==false)						{
								$data['error']="Please upload correct image( gif / jpeg / jpg / png)";
							}
						}
					}
					else 
					if($school_media_type_2==3)
					{
						if(!empty($_FILES['right_section_videofile']['name']))
						{
							$tmp_right_section_videofile = $_FILES['right_section_videofile']['name'];
							$ext_right_section_videofile = explode('.',$tmp_right_section_videofile);
							$extension_right_section_videofile  = strtolower($ext_right_section_videofile[1]);
							if(($extension_right_section_videofile =="mp4" || $extension_right_section_videofile =="mkv" || $extension_right_section_videofile =="3gp")==false)						{
								$data['error']="Please upload correct image( mp4 / mkv / 3gp )";
							}
						}
						
						
					}
					
					if(!empty($_FILES['school_banner']['name']))
					{
						$tmp_banner = $_FILES['school_banner']['name'];
						$ext_banner = explode('.',$tmp_banner);
						$banner_extension  = strtolower($ext_banner[1]);
						if(($banner_extension =="gif" || $banner_extension =="jpeg" || $banner_extension =="jpg" || $banner_extension =="png")==false)
						{
							$data['error']="Please upload correct image( gif / jpeg / jpg / png)";
						}
					}  
					if(!empty($_FILES['school_main_img']['name']))
					{
						$tmp_main_img = $_FILES['school_main_img']['name'];
						$ext_main_img = explode('.',$tmp_main_img);
						$school_extension  = strtolower($ext_main_img[1]);
						if(($school_extension =="gif" || $school_extension =="jpeg" || $school_extension =="jpg" || $school_extension =="png")==false)
						{
							$data['error']="Please upload correct image( gif / jpeg / jpg / png)";
						}
					}
					
					$school_main_image=$school_detail->school_main_img; 
					if(isset($_FILES['school_main_img']['name']) && !empty($_FILES['school_main_img']['name']))
					{
						$tmp_main_img = $_FILES['school_main_img']['name'];
						$ext_main_img = explode('.',$tmp_main_img);
						$school_extension  = strtolower($ext_main_img[1]);
						
						$today_school = date('mdyHis');
						$maindir='./uploads/School/';
						if (!is_dir($maindir))
								mkdir($maindir, 0755);
						$school_image_pathMain = './uploads/School/SchoolMainImage/';
						if (!is_dir($school_image_pathMain))
								mkdir($school_image_pathMain, 0755);
						$configImageSchool['upload_path'] = $school_image_pathMain;
						$configImageSchool['max_size'] =  "'".UPLOAD_IMAGE_MAX_SIZE."'";
						$configImageSchool['allowed_types'] = 'gif|jpg|jpeg|png';
						$school_image_file_name=$today_school.'.'.$school_extension;
						$configImageSchool['file_name'] = $school_image_file_name;
						
						$this->load->library('upload', $configImageSchool, 'school_main_image'); 
						$this->school_main_image->initialize($configImageSchool);
						if (!$this->school_main_image->do_upload('school_main_img')) 
						{
							$data['error']='Please upload correct image( gif / jpeg / jpg / png)';
						}
						else
						{
							$this->load->library('image_lib');
							$configThumbSchool = array();  
							$configThumbSchool['image_library']   = 'gd2'; 
							$configThumbSchool['source_image']  = $school_image_pathMain.$school_image_file_name; 
							$configThumbSchool['create_thumb']    = TRUE;
							if($school_main_image!="" && file_exists("./".$school_main_image))
							{
								unlink("./".$school_main_image);
							}
							$school_main_image = str_replace("./","",$school_image_pathMain.$school_image_file_name);
							
						}
						
					}
				
				
				
				
					$school_banner=$school_detail->school_banner; 
					if(!empty($_FILES['school_banner']['name']))
					{
							$tmp_banner = $_FILES['school_banner']['name'];
							$ext_banner = explode('.',$tmp_banner);
							$banner_extension  = strtolower($ext_banner[1]);
							
							$today = date('mdyHis');
							$pathMain = './uploads/School/SchoolBanner/';
								if (!is_dir($pathMain))
									mkdir($pathMain, 0755);
							$configImage['upload_path'] = $pathMain;
							$configImage['max_size'] =  "'".UPLOAD_IMAGE_MAX_SIZE."'";
							$configImage['allowed_types'] = 'gif|jpg|jpeg|png';
							$img_name =$today.'.'.$banner_extension;
							$configImage['file_name'] = $img_name;
							$this->load->library('upload', $configImage,'our_banner');
							$this->our_banner->initialize($configImage);
							if (!$this->our_banner->do_upload('school_banner')) 
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
								if($school_banner!="" && file_exists("./".$school_banner))
								{
									unlink("./".$school_banner);
								}
								$school_banner = str_replace("./","",$pathMain.$img_name);
								
							}
					}
					
				if($school_media_type_1==1)
				{				
					
				
					
					$school_image_filepath=$this->common->GetValue("school","school_image","school_id",''.$id.'');
					if(!empty($_FILES['school_image']['name']))
					{
							$tmp = $_FILES['school_image']['name'];
							$ext = explode('.',$tmp);
							$extension  = strtolower($ext[1]);
							
							$today = date('mdyHis');
							$pathMain = './uploads/School/SchoolImage/';
								if (!is_dir($pathMain))
									mkdir($pathMain, 0755);
							$configImage['upload_path'] = $pathMain;
							$configImage['max_size'] = "'".UPLOAD_IMAGE_MAX_SIZE."'";
							$configImage['allowed_types'] = 'gif|jpg|jpeg|png';
							$img_name =$today.'.'.$extension;
							$configImage['file_name'] = $img_name;
							$this->load->library('upload', $configImage,'school_image');
							$this->school_image->initialize($configImage);
							if (!$this->school_image->do_upload('school_image')) 
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
								if($school_image_filepath!="" && file_exists("./".$school_image_filepath))
								{
									unlink("./".$school_image_filepath);
								}
								$school_image_filepath = str_replace("./","",$pathMain.$img_name);
								
							}
						}
						
				}
				
				else if($school_media_type_1==2)
				{						
						
					$video_link=$this->input->post('video_link');
					
				}
				else if($school_media_type_1==3)
				{						
				
					$school_videofile_filepath=$this->common->GetValue("school","school_videofile","school_id",''.$id.'');
					if(!empty($_FILES['school_videofile']['name']))
					{
						$tmp = $_FILES['school_videofile']['name'];
						$ext = explode('.',$tmp);
						$extension  = strtolower($ext[1]);
						
						$today = date('mdyHis');
						$maindir='./uploads/School/';
							if (!is_dir($maindir))
								mkdir($maindir, 0755);
						$pathMain = './uploads/School/SchoolVideo/';
							if (!is_dir($pathMain))
								mkdir($pathMain, 0755);
						$configImage['upload_path'] = $pathMain;
						$configImage['max_size'] = "'".UPLOAD_IMAGE_MAX_SIZE."'";
						$configImage['allowed_types'] = 'mp4|mkv|3gp';
						$img_name =$today.'.'.$extension;
						$configImage['file_name'] = $img_name;
						$this->load->library('upload', $configImage,'school_video');
						$this->school_video->initialize($configImage);
						if (!$this->school_video->do_upload('school_videofile')) 
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
							
							if($school_videofile_filepath!="" && file_exists("./".$school_videofile_filepath))
							{
								unlink("./".$school_videofile_filepath);
							}
							$school_videofile_filepath = str_replace("./","",$pathMain.$img_name);
						}
					}
										
				}
				
				if($school_media_type_2==1)
				{
				$right_section_image=$this->common->GetValue("school","right_section_image","school_id",''.$id.'');
					if(!empty($_FILES['right_section_image']['name']))
					{
							$tmp_right_section_image = $_FILES['right_section_image']['name'];
							$ext_right_section_image = explode('.',$tmp_right_section_image);
							$image_extension_right_section  = strtolower($ext_right_section_image[1]);
							
							$today = date('mdyHis');
							$pathMain = './uploads/School/RightSectionImage/';
								if (!is_dir($pathMain))
									mkdir($pathMain, 0755);
							$configImage['upload_path'] = $pathMain;
							$configImage['max_size'] = "'".UPLOAD_IMAGE_MAX_SIZE."'";
							$configImage['allowed_types'] = 'gif|jpg|jpeg|png';
							$img_name =$today.'.'.$image_extension_right_section;
							$configImage['file_name'] = $img_name;
							$this->load->library('upload', $configImage,'right_section_image');
							$this->right_section_image->initialize($configImage);
							if (!$this->right_section_image->do_upload('right_section_image')) 
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
								if($right_section_image!="" && file_exists("./".$right_section_image))
								{
									unlink("./".$right_section_image);
								}
								$right_section_image = str_replace("./","",$pathMain.$img_name);
								
							}
						}
				}
				else if($school_media_type_2==2)
				{
					$right_section_video_link=$this->input->post('right_section_video_link');
				}
				else if($school_media_type_2==3)
				{
					$right_section_videofile=$this->common->GetValue("school","right_section_videofile","school_id",''.$id.'');
					if(!empty($_FILES['right_section_videofile']['name']))
					{
						$tmp_right_section_videofile = $_FILES['right_section_videofile']['name'];
						$ext_right_section_videofile = explode('.',$tmp_right_section_videofile);
						$extension_right_section_videofile  = strtolower($ext_right_section_videofile[1]);
						
						$today_right_section_videofile = date('mdyHis');
						$maindir='./uploads/School/';
							if (!is_dir($maindir))
								mkdir($maindir, 0755);
						$pathMain = './uploads/School/RightSectionVideo/';
							if (!is_dir($pathMain))
								mkdir($pathMain, 0755);
						$configImage['upload_path'] = $pathMain;
						$configImage['max_size'] = "'".UPLOAD_IMAGE_MAX_SIZE."'";
						$configImage['allowed_types'] = 'mp4|mkv|3gp';
						$right_section_video_name =$today_right_section_videofile.'.'.$extension_right_section_videofile;
						$configImage['file_name'] = $right_section_video_name;
						$this->load->library('upload', $configImage,'right_section_video');
						$this->right_section_video->initialize($configImage);
						if (!$this->right_section_video->do_upload('right_section_videofile')) 
						{
							$data['error']='Please upload correct video( mp4 / mkv / 3gp)';
						}
						else
						{
							$this->load->library('image_lib');
							$configThumb = array();  
							$configThumb['image_library']   = 'gd2'; 
							$configThumb['source_image']  = $pathMain.$right_section_video_name; 
							$configThumb['create_thumb']    = TRUE;
							
							if($right_section_videofile!="" && file_exists("./".$right_section_videofile))
							{
								unlink("./".$right_section_videofile);
							}
							$right_section_videofile = str_replace("./","",$pathMain.$right_section_video_name);
						}
					}
				}
				
				
				
				
				$url_value=strtolower(preg_replace('/-+/', '-', preg_replace('/[^\wáéíóú]/', '-', $this->input->post('school_title'))));
					$data = array(
					'school_title' => $this->input->post('school_title'),
					'school_main_img' => $school_main_image,
					'short_description'=>$this->input->post('short_description'),
					//'news_event_gallery_type_id' => $this->input->post('news_event_gallery_type_id'),
					//'news_event_gallery_2_type_id' => $this->input->post('news_event_gallery_2_type_id'),
					'school_title1'=>$this->input->post('school_title1'),
					'school_title2'=>$this->input->post('school_title2'),
					'school_image' => $school_image_filepath,
					'school_videofile' => $school_videofile_filepath,
					'video_link' => $video_link,
					'school_banner' => $school_banner,
					'right_section_title1'=>$this->input->post('right_section_title1'),
					'right_section_title2'=>$this->input->post('right_section_title2'),
					'right_section_image' => $right_section_image,
					'right_section_video_link' => $right_section_video_link,
					'right_section_videofile' => $right_section_videofile,
					'description'=>$this->input->post('description'),
					'display_order' => $this->input->post('display_order'),	
					'url_path'=>$url_value
				
					);
					
					$this->common->update_record($fieldName,$id,$tblName,$data);
					$this->session->set_flashdata('msg', 'School has been updated successfully.');
					redirect('admin/school/','refresh'); //redirect in manage with msg
				}
				}
			}
			$data['news_event_gallery'] = $this->school->get_news_event_gallery();
			$data['school']=$this->school->get_school_by_id($id);
			$this->load->view('admin/controls/vwHeader');
			$this->load->view('admin/controls/vwLeft',$data);
	        $this->load->view('admin/vwEditSchool',$data);
			$this->load->view('admin/controls/vwFooter');
			$this->load->view('admin/controls/vwFooterJavascript',$data);
		
			
		}
		else
		{
            redirect('admin/School');
        }
    } //this is use for edit records end
	
	public function delete_content($id) {
		$arr['page'] = 'School';
		$school_count=$this->common->CountByTable('our_program','WHERE school_id='.$id.'');
		$our_course_id=$this->common->CountByTable('our_course','WHERE school_id="'.$id.'"');
		if($school_count>0 || $our_course_id>0)
		{
			echo 'ref_id';
		}
		else
		{
			$this->school->delete_record('school_id',$id,'school');
			echo "delete";
		}
    }
	public function bulk_delete() {
		$arr['page'] = 'School';
		
		$ids = ( explode( ',', $this->input->get_post('data_ids') ));
		if($this->school->delete_all($ids))
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
		$fieldId='school_id';
		$tableName='school';
		$this->common->update_is_active($val,$id,$fieldName,$fieldId,$tableName);
	}

} 