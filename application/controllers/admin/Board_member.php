<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Board_Member extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Board_member_model','board_member');
		
	}

	public function index()
	{
		$data['page'] = 'Board Member';
		$data['pagetitle']='Manage'.' '.$data['page'].'s';
		$data['path'] = ''.base_url().'admin/board_member/delete_content/';
		$data['bulk_path'] = ''.base_url().'admin/board_member/bulk_delete/';
		$data['ckeditor']=false;
		$data['manage_view_path']=''.base_url().'admin/board_member/board_member_view/';
		$data['soringCol']='"order": [[ 1, "asc" ]],';
		$data['is_active_path']=''.base_url().'admin/board_member/is_active/';
		$data['gridTable']=true;
		$this->load->view('admin/controls/vwHeader');
		$this->load->view('admin/controls/vwLeft',$data);
		$this->load->view('admin/controls/vwFooterJavascript',$data);
        $this->load->view('admin/vwManageBoardMember',$data);
		
		$this->load->view('admin/controls/vwFooter');
	}

	public function board_member_view()
	{
		$data['page'] = 'Board Member';
		$sql_details=$this->common->sql_detial();
		echo $results = $this->board_member->get_datatables($sql_details);
	}
	
	public function add_board_member() { //this is use for redirect form in add section start
		$data['page'] = 'Board Member';
	
		$data['pagetitle']='Manage'.' '.$data['page'].'s | Add '.$data['page'];
		$data['ckeditor']=false;
		$data['gridTable']=false;

		$this->form_validation->set_rules('board_member_name', 'Please enter name', 'required');
		$this->form_validation->set_rules('board_member_designation', 'Please enter designation', 'required');
			
			$formSubmit = $this->input->post('Submit');
			if($formSubmit=="Save")
			{
				if($this->input->post('is_active')=="on")
				{
					$is_active=1;	
				}
				else
				{
					$is_active=0;
				}
					$data['error']="";				
					$tblName = "board_member";
					
					if(!empty($_FILES['profile_picture_path']['name']))
					{
						$tmp = $_FILES['profile_picture_path']['name'];
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
							if(isset($_FILES['profile_picture_path']['name']) && !empty($_FILES['profile_picture_path']['name']))
							{
								$today = date('mdyHis');
								$image_pathMain = './uploads/BoardMember/';
								if (!is_dir($image_pathMain))
										mkdir($image_pathMain, 0755);
								$configImage['upload_path'] = $image_pathMain;
								$configImage['max_size'] = "'".UPLOAD_IMAGE_MAX_SIZE."'";
								$configImage['allowed_types'] = 'gif|jpg|jpeg|png';
								$image_file_name=$today.'.'.$image_extension;
								$configImage['file_name'] = $image_file_name;
								
								$this->load->library('upload', $configImage, 'boardmemberimage'); 
								$this->boardmemberimage->initialize($configImage);
								$this->boardmemberimage->do_upload('profile_picture_path');
								$filepath=str_replace("./","",$image_pathMain.$image_file_name);
							}

							$data = array(
							'board_member_name'=>$this->input->post('board_member_name'),
							'profile_picture_path' => $filepath,
							'board_member_designation'=>$this->input->post('board_member_designation'),
							'display_order' => $this->input->post('display_order')
							
							);
							$this->common->insert_record($tblName,$data);
					
							$this->session->set_flashdata('msg', 'Board Member has been added successfully.');
							redirect('admin/board_member/','refresh'); //redirect in manage with msg
						}
					}
			}
			
					$this->load->view('admin/controls/vwHeader');
					$this->load->view('admin/controls/vwLeft',$data);
					$this->load->view('admin/vwAddBoardMember',$data);    
					$this->load->view('admin/controls/vwFooter');
					$this->load->view('admin/controls/vwFooterJavascript',$data);
				
		
	} //this is use for redirect form in add section end */
	
	
    public function edit_board_member($id='') //this is use for edit records start
	{
		
        $data['page'] = 'Board Member';
		$data['pagetitle']='Manage'.' '.$data['page'].'s | Edit '.$data['page'];
		$data['ckeditor']=false;
		$data['gridTable']=false;
		$this->form_validation->set_rules('board_member_name', 'Please enter name', 'required');
		$this->form_validation->set_rules('board_member_designation', 'Please enter designation', 'required');
		
		if($id!='')
		{	
		
			$formSubmit = $this->input->post('Submit');
			if($formSubmit=="Save")
			{
				if($this->input->post('is_active')=="on")
					{
						$is_active=1;	
					}
					else
					{
						$is_active=0;
					}
				 $tblName = "board_member";
				 $fieldName = "board_member_id";
				
				$data['error']="";
				
				
					if (isset($_FILES['profile_picture_path']['name']) && !empty($_FILES['profile_picture_path']['name']))
					{
						$tmp = $_FILES['profile_picture_path']['name'];
						$ext = explode('.',$tmp);
						$extension  = strtolower($ext[1]);
					
						if(($extension =="gif" || $extension =="jpeg" || $extension =="jpg" || $extension =="png")==false)
						{
							$data['error']="Please upload correct file( gif / jpeg / jpg / png)";
						}
					
					}
				if($data['error']=="")
				{
					$filepath=$this->common->GetValue("board_member","profile_picture_path","board_member_id",''.$id.'');
					if(!empty($_FILES['profile_picture_path']['name']))
					{
							$tmp = $_FILES['profile_picture_path']['name'];
							$ext = explode('.',$tmp);
							$extension  = strtolower($ext[1]);
							
							$today = date('mdyHis');
							$pathMain = './uploads/BoardMember/';
								if (!is_dir($pathMain))
									mkdir($pathMain, 0755);
							$configImage['upload_path'] = $pathMain;
							$configImage['max_size'] = "'".UPLOAD_IMAGE_MAX_SIZE."'";
							$configImage['allowed_types'] = 'gif|jpg|jpeg|png';
							$img_name =$today.'.'.$extension;
							$configImage['file_name'] = $img_name;
							$this->load->library('upload', $configImage,'boardmemberimage');
							$this->boardmemberimage->initialize($configImage);
							if (!$this->boardmemberimage->do_upload('profile_picture_path')) 
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

					$data = array(
					'board_member_name'=>$this->input->post('board_member_name'),
					'profile_picture_path' => $filepath,
					'board_member_designation'=>$this->input->post('board_member_designation'),
					'display_order' => $this->input->post('display_order'),
					'is_active' => $is_active,
					);
					
					$this->common->update_record($fieldName,$id,$tblName,$data);
					$this->session->set_flashdata('msg', 'Board Member has been update successfully.');
					redirect('admin/board_member/','refresh'); //redirect in manage with msg
				}
			  
			}
			
			$data['board_member']=$this->board_member->get_board_member_by_id($id);
			$this->load->view('admin/controls/vwHeader');
			$this->load->view('admin/controls/vwLeft',$data);
	        $this->load->view('admin/vwEditBoardMember',$data);
			$this->load->view('admin/controls/vwFooter');
			$this->load->view('admin/controls/vwFooterJavascript',$data);
		}
		else
		{
            redirect('admin/board_member');
        }
    } //this is use for edit records end
	
	public function delete_content($id) {
		$arr['page'] = 'Board Member';
		$this->board_member->delete_record('board_member_id',$id,'board_member');
		echo "delete";			
    }
	public function bulk_delete() {
		$arr['page'] = 'Board Member';
		$ids = ( explode( ',', $this->input->get_post('data_ids') ));
			$this->board_member->delete_all($ids);
			echo 'delete';
    }
		
	public function is_active($val,$id)
	{
		$fieldName='is_active';
		$fieldId='board_member_id';
		$tableName='board_member';
		$this->common->update_is_active($val,$id,$fieldName,$fieldId,$tableName);
	}

}