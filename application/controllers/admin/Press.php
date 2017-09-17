<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Press extends Admin_Controller {

public function __construct()
	{
		parent::__construct();
		$this->load->model('Press_model','press');
		$this->load->model('common_function_model','common');
		
		$this->load->library('form_validation');
		
         if (!$this->session->userdata('is_admin_login')) {
            redirect('admin/home');
        }
	}

	public function index()
	{
		$data['page'] = 'Press';
		$data['path'] = ''.base_url().'admin/press/delete_content/';
		$data['bulk_path'] = ''.base_url().'admin/press/bulk_delete/';
		$data['ckeditor']=false;
		$data['soringCol']='"order": [[ 1, "asc" ]],';
		$data['manage_view_path']=''.base_url().'admin/press/press_view/';
		$data['is_active_path']=''.base_url().'admin/press/is_active/';
		$data['pagetitle']='Manage '.$data['page'];
		$data['gridTable']=true;
		
		$this->load->view('admin/controls/vwHeader');
		$this->load->view('admin/controls/vwLeft',$data);
		$this->load->view('admin/controls/vwFooterJavascript',$data);
        $this->load->view('admin/vwManagePress',$data);
		
		$this->load->view('admin/controls/vwFooter');
	}

	public function press_view()
	{
		$data['page'] = 'press';
		$sql_details=$this->common->sql_detial();
		echo $list = $this->press->get_datatables($sql_details);
	}
	public function add_press() //this is use for redirect form in add section start
	{ 
		$data['page'] = 'Press';
		$data['pagetitle']='Manage '.$data['page']. ' | Add '.$data['page'];
		$data['ckeditor']=false;
		$data['gridTable']=false;
		$formSubmit = $this->input->post('Submit');
		if($formSubmit=="Save")
		{
			
			$tblName = "press";
						
			$data['error']="";
			$mainpath="";
			
			
					if(!empty($_FILES['press_pdf']['name']))
					{
						$tmp = $_FILES['press_pdf']['name'];
						$ext = explode('.',$tmp);
						$extension  = strtolower($ext[1]);
						if(($extension =="pdf")==false)
						{
							$data['error']="Please upload correct file( pdf )";
						}
					}
					
					
			
			
			$data['error']="";
			
			
	if($data['error']=="")
	{
			
				
					if(!empty($_FILES['press_pdf']['name']))
					{
						$tblName = "press";
							$tmp = $_FILES['press_pdf']['name'];
							$ext = explode('.',$tmp);
							$extension  = strtolower($ext[1]);
							
							
								$today = date('mdyHis');
								$maindir='./uploads/press/';
								if (!is_dir($maindir))
										mkdir($maindir, 0755);
								
								
								$configImage['upload_path'] = $maindir;
								$configImage['max_size'] = '10240';
								$configImage['allowed_types'] = 'pdf';
								$img_name =$today.'.'.$extension;
								$configImage['file_name'] = $img_name;
								$this->load->library('upload', $configImage,'pressImage');
								$this->pressImage->initialize($configImage);
								$this->pressImage->do_upload('press_pdf');
								
								
									
							
									$this->load->library('image_lib');
									$configThumb = array();  
									$configThumb['image_library']   = 'gd2'; 
									$configThumb['source_image']  = $maindir.$img_name; 
									$configThumb['create_thumb']    = TRUE;
									
									
									
									
									$mainpath = str_replace("./","",$maindir.$img_name);
									
									
									$data = array(
												'press_title' => $this->input->post('press_title'),
												'pdf_path' =>$mainpath,
												'press_date' => date('Y-m-d', strtotime($this->input->get_post('created_date'))),
												'user_id'=>$this->session->userdata('id')
												
												);
									$this->common->insert_record($tblName,$data);
								
								$this->session->set_flashdata('msg', 'Press has been added successfully.');
								redirect('admin/press/','refresh'); //redirect in manage with msg
								}
					
			
			
		
			
			
				
		}
		}
		
		$this->load->view('admin/controls/vwHeader');
		$this->load->view('admin/controls/vwLeft',$data);
		$this->load->view('admin/vwAddPress',$data);    
		$this->load->view('admin/controls/vwFooter');
		$this->load->view('admin/controls/vwFooterJavascript',$data);
	} //this is use for redirect form in add section end
	
	
  public function edit_press($id='') //this is use for edit records start
	{
        $data['page'] = 'Press';
		$data['pagetitle']='Manage Press | Edit '.$data['page'];
		$data['ckeditor']=false;
		$data['gridTable']=false;
		
		
		if($id!='')
		{
			$formSubmit = $this->input->post('Submit');
			if($formSubmit=="Save")
			{
				
				
				
				$tblName = "press";
				$fieldName = "press_id";
				$data['error']="";	
				$mainpath="";
				
				if(isset($_FILES['press_pdf']['name']))
							{
								$tmp = $_FILES['press_pdf']['name'];
								$ext = explode('.',$tmp);
								$extension  = strtolower($ext[1]);
								
								if(($extension =="pdf")==false)
								{
									$data['error']="Please upload correct file( pdf )";
								}
							}	
					
				
				if($data['error']=="")
					{
						$mainpath=$this->common->GetValue("press","pdf_path","press_id",''.$id.'');
						
						
						if(!empty($_FILES['press_pdf']['name']))
						{
							
						
							$tmp = $_FILES['press_pdf']['name'];
							$ext = explode('.',$tmp);
							$extension  = strtolower($ext[1]);
								
								$today = date('mdyHis');
								$maindir='./uploads/press/';
								if (!is_dir($maindir))
										mkdir($maindir, 0755);
								
								
								$configImage['upload_path'] = $maindir;
								$configImage['max_size'] = '10240';
								$configImage['allowed_types'] = 'pdf';
								$img_name =$today.'.'.$extension;
								$configImage['file_name'] = $img_name;
								$this->load->library('upload', $configImage);
								
								if (!$this->upload->do_upload('press_pdf')) 
								{
									//$data['error']="Please upload correct file( gif / jpeg / jpg / png)";
								}
								else
								{
									
									
									$this->load->library('image_lib');
									$configThumb = array();  
									$configThumb['image_library']   = 'gd2'; 
									$configThumb['source_image']  = $maindir.$img_name; 
									$configThumb['create_thumb']    = TRUE;
									
									
									if(($mainpath!="" && file_exists("./".$mainpath)))
									{
										unlink("./".$mainpath);
										
									}
									
									
									$mainpath = str_replace("./","",$maindir.$img_name);
									
								}
						}
						
					
						$url_value=strtolower(preg_replace('/-+/', '-', preg_replace('/[^\wαινσϊ]/', '-', $this->input->post('caption'))));
						$data = array(
						'press_title' => $this->input->post('press_title'),
						'pdf_path' =>$mainpath,
						'press_date' => date('Y-m-d', strtotime($this->input->get_post('created_date'))),
						'user_id'=>$this->session->userdata('id')
					
						);
						$this->common->update_record($fieldName,$id,$tblName,$data);
						$this->session->set_flashdata('msg', 'Press has been updated successfully.');
						redirect('admin/press/','refresh'); //redirect in manage with msg
						}
					
				
				
			}
			

			$data['press']=$this->press->get_press_by_id($id);

			$this->load->view('admin/controls/vwHeader');
			$this->load->view('admin/controls/vwLeft',$data);
	        $this->load->view('admin/vwEditPress',$data);
			$this->load->view('admin/controls/vwFooter');
			$this->load->view('admin/controls/vwFooterJavascript',$data);
		}
		
		else
		{
            redirect('admin/press');
        }
    } //this is use for edit records end
	
	public function delete_content($id) {
		$arr['page'] = 'press';
		$this->press->delete_record('press_id',$id,'press');
		echo "delete";
		
    }
	
	public function bulk_delete() {
		$arr['page'] = 'press';
		
		$ids = ( explode( ',', $this->input->get_post('data_ids') ));
			$this->press->delete_all($ids);
			echo 'delete';
			
    }
	public function is_active($val,$id)
	{
		$fieldName='is_active';
		$fieldId='press_id';
		$tableName='press';
		$this->common->update_is_active($val,$id,$fieldName,$fieldId,$tableName);
	}


}
?>