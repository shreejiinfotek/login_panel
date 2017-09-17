<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Event extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Event_model','event');
		
	}

	public function index()
	{
		$data['page'] = 'Event';
		$data['path'] = ''.base_url().'admin/event/delete_content/';
		$data['bulk_path'] = ''.base_url().'admin/event/bulk_delete/';
		$data['ckeditor']=false;
		$data['manage_view_path']=''.base_url().'admin/event/event_view/';
		$data['soringCol']='"order": [[ 1, "asc" ]],';
		$data['is_active_path']=''.base_url().'admin/event/is_active/';
		$data['pagetitle']='Manage Event';
		$data['gridTable']=true;
		$this->load->view('admin/controls/vwHeader');
		$this->load->view('admin/controls/vwLeft',$data);
		$this->load->view('admin/controls/vwFooterJavascript',$data);
        $this->load->view('admin/vwManageEvent',$data);
		
		$this->load->view('admin/controls/vwFooter');
	}

	public function event_view()
	{
		$data['page'] = 'Event';
		$sql_details=$this->common->sql_detial();
		echo $results = $this->event->get_datatables($sql_details);
	}
	
	public function add_event() { //this is use for redirect form in add section start
		$data['page'] = 'Event';
	
		$data['pagetitle']='Manage Event | Add  '.$data['page'];
		$data['ckeditor']=true;
		$data['gridTable']=false;

		
			$formSubmit = $this->input->post('Submit');
			if($formSubmit=="Save")
			{
				$duplicate_event=$this->common->CountByTable('event','WHERE event_name="'.$this->input->post('event_name').'"');
				if($duplicate_event>=1)
				{
					$data['error']='Please enter other event name. This event name already exists.';
				}
				else
				{
					$filepath="";			
					$tblName = "event";
						
						if(!empty($_FILES['event_image']['name']))
						{
							$tmp = $_FILES['event_image']['name'];
							$ext = explode('.',$tmp);
							$extension  = strtolower($ext[1]);
							
							$today = date('mdyHis');
							$pathMain = './uploads/Event/';
								if (!is_dir($pathMain))
									mkdir($pathMain, 0755);
							$configImage['upload_path'] = $pathMain;
							$configImage['max_size'] = "'".UPLOAD_IMAGE_MAX_SIZE."'";
							$configImage['allowed_types'] = 'gif|jpg|jpeg|png';
							$img_name =$today.'.'.$extension;
							$configImage['file_name'] = $img_name;
							$this->load->library('upload', $configImage,'event_image');
							$this->event_image->initialize($configImage);
							
							if (!$this->event_image->do_upload('event_image')) 
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
							$url_value=strtolower(preg_replace('/-+/', '-', preg_replace('/[^\wáéíóú]/', '-', $this->input->post('event_name'))));
							$data = array(
							'event_name'=>$this->input->post('event_name'),
							'event_image' => $filepath,
							'short_description'=>$this->input->post('short_description'),
							'description'=>$this->input->post('description'),
							'event_start_date' => date('Y-m-d h:m:s', strtotime($this->input->get_post('created_date'))),
							'event_venue'=>$this->input->post('event_venue'),
							'event_city'=>$this->input->post('event_city'),
							'url_path'=>$url_value,
							'created_by'=>$this->session->userdata('id')
							);
							$this->common->insert_record($tblName,$data);
					
							$this->session->set_flashdata('msg', 'event has been added successfully.');
							redirect('admin/event/','refresh'); //redirect in manage with msg
				}
					
				
			}
			
			else
			{
				$this->form_validation->set_rules('event_image', 'event', 'required');
				$this->form_validation->set_message('required', 'Please upload event/event.');
				if ($this->form_validation->run() === FALSE)
				{
					
					$this->load->view('admin/controls/vwHeader');
					$this->load->view('admin/controls/vwLeft',$data);
					
					$this->load->view('admin/vwAddEvent',$data);    
					$this->load->view('admin/controls/vwFooter');
					$this->load->view('admin/controls/vwFooterJavascript',$data);
				}
			}
		
	} //this is use for redirect form in add section end */
	
	
    public function edit_event($id='') //this is use for edit records start
	{
		
        $data['page'] = 'Event';
		$data['pagetitle']='Manage Event | Edit '.$data['page'];
		$data['ckeditor']=true;
		$data['gridTable']=false;
		if($id!='')
		{	
		
			$formSubmit = $this->input->post('Submit');
			if($formSubmit=="Save")
			{
				 $tblName = "event";
				 $fieldName = "event_id";
				
				$data['error']='';
				if (isset($_FILES['event_image']['name']) && !empty($_FILES['event_image']['name']))
				{
					$tmp = $_FILES['event_image']['name'];
					$ext = explode('.',$tmp);
					$extension  = strtolower($ext[1]);
					
					if(($extension =="gif" || $extension =="jpeg" || $extension =="jpg" || $extension =="png")==false)
					{
						$data['error']="Please upload correct file( gif / jpeg / jpg / png)";
					}
					
				}
				$duplicate_event=$this->common->CountByTable('event','WHERE event_id!="'.$id.'" AND event_name="'.$this->input->post('event_name').'"' );
				if($duplicate_event>=1)
				{
					$data['error']='Please enter other event name. This event name already exists.';
				}
				if($data['error']=="")
				{
					$filepath=$this->common->GetValue("event","event_image","event_id",''.$id.'');
					if(!empty($_FILES['event_image']['name']))
					{
							$tmp = $_FILES['event_image']['name'];
							$ext = explode('.',$tmp);
							$extension  = strtolower($ext[1]);
							
							$today = date('mdyHis');
							$pathMain = './uploads/Event/';
								if (!is_dir($pathMain))
									mkdir($pathMain, 0755);
							$configImage['upload_path'] = $pathMain;
							$configImage['max_size'] = "'".UPLOAD_IMAGE_MAX_SIZE."'";
							$configImage['allowed_types'] = 'gif|jpg|jpeg|png';
							$img_name =$today.'.'.$extension;
							$configImage['file_name'] = $img_name;
							$this->load->library('upload', $configImage,'event_image');
							$this->event_image->initialize($configImage);
							if (!$this->event_image->do_upload('event_image')) 
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
					$url_value=strtolower(preg_replace('/-+/', '-', preg_replace('/[^\wáéíóú]/', '-', $this->input->post('event_name'))));
					$created_date=$this->common->GetValue("event","created_date","event_id",'');
					$data = array(
					'event_name'=>$this->input->post('event_name'),
					'event_image' => $filepath,
					'short_description'=>$this->input->post('short_description'),
					'description'=>$this->input->post('description'),
					'event_venue'=>$this->input->post('event_venue'),
					'event_city'=>$this->input->post('event_city'),
					'url_path'=>$url_value,
				    'event_start_date' => date('Y-m-d h:m:s', strtotime($this->input->get_post('created_date'))),
					'created_by'=>$this->session->userdata('id')
					);
					
					$this->common->update_record($fieldName,$id,$tblName,$data);
					$this->session->set_flashdata('msg', 'Event has been updated successfully.');
					redirect('admin/event/','refresh'); //redirect in manage with msg
				}
			}
			
			
			$data['event']=$this->event->get_event_by_id($id);
			$this->load->view('admin/controls/vwHeader');
			$this->load->view('admin/controls/vwLeft',$data);
			$this->load->view('admin/controls/vwFooterJavascript',$data);
	        $this->load->view('admin/vwEditEvent',$data);
			$this->load->view('admin/controls/vwFooter');
			
		}
		else
		{
            redirect('admin/event');
        }
    } //this is use for edit records end
	public function view_event($id='') //this is use for edit records start
	{
       		$data['page'] = 'Event';
			$data['ckeditor']=false;
			$data['gridTable']=false;
			$data['pagetitle']='Manage Events';
			$data['event']=$this->event->get_event_by_id($id);
			$this->load->view('admin/controls/vwHeader');
			$this->load->view('admin/controls/vwLeft',$data);
			$this->load->view('admin/vwViewEvent',$data);
			$this->load->view('admin/controls/vwFooter');
			$this->load->view('admin/controls/vwFooterJavascript');
		
    }
	public function delete_content($id) {
		$arr['page'] = 'Event';
		$this->event->delete_record('event_id',$id,'event');
		echo "delete";			
    }
	public function bulk_delete() {
		$arr['page'] = 'Event';
		$ids = ( explode( ',', $this->input->get_post('data_ids') ));
			$this->event->delete_all($ids);
			echo 'delete';
    }
		
	public function is_active($val,$id)
	{
		$fieldName='is_active';
		$fieldId='event_id';
		$tableName='event';
		$this->common->update_is_active($val,$id,$fieldName,$fieldId,$tableName);
	}

} 