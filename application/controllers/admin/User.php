<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends Admin_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_model','user');
		$this->load->model('Common_function_model','common');
		$this->load->library('encrypt');
		$this->load->library('form_validation');
		
		
		
         if (!$this->session->userdata('is_admin_login')) {
            redirect('admin/home');
        }
	}

	public function index()
	{
		$data['table_count']=$this->common->CountByTable('admin','');
		$data['page'] = 'User';
		$data['path'] = ''.base_url().'admin/user/delete_content/';
		$data['bulk_path'] = ''.base_url().'admin/user/bulk_delete/';
		$data['ckeditor']=false;
		$data['soringCol']='"order": [[ 1, "asc" ]],';
		$data['is_approve_path']=''.base_url().'admin/user/is_appvove/';
		$data['manage_view_path']=''.base_url().'admin/user/user_view/';
		
		$data['pagetitle']='Manage'.' '.$data['page'].'s';
		$data['gridTable']=true;
		
		$this->load->view('admin/controls/vwHeader');
		$this->load->view('admin/controls/vwLeft',$data);
		$this->load->view('admin/controls/vwFooterJavascript',$data);
        $this->load->view('admin/vwManageUser',$data);
		
		$this->load->view('admin/controls/vwFooter');
	}
	
	public function user_view()
	{
		$data['page'] = 'User';
		$sql_details=$this->common->sql_detial();
		echo $list = $this->user->get_datatables($sql_details);
	}
	
	public function add_user() //this is use for edit records start
	{
        $data['page'] = 'User';
		$data['pagetitle']='Manage'.' '.$data['page'].'s | Add '.$data['page'];
		
		$data['ckeditor']=false;
		$data['gridTable']=false;
		$this->form_validation->set_rules('email', 'email', 'required');
		$this->form_validation->set_rules('username', 'username', 'required');
		
	
	//	$this->form_validation->set_rules('meta_title', 'meta title', 'required');
		
			$formSubmit = $this->input->post('Submit');
			if($formSubmit=="Save")
			{
					$filepath="";			
					$tblName = "admin";
					if (!empty($_FILES['profile_path']['name']))
					{
						if(!empty($_FILES['profile_path']['name']))
						{
							$tmp = $_FILES['profile_path']['name'];
							$ext = explode('.',$tmp);
							$extension  = strtolower($ext[1]);
							
							$today = date('mdyHis');
							$pathMain = './uploads/User Profile/';
								if (!is_dir($pathMain))
									mkdir($pathMain, 0755);
							$configImage['upload_path'] = $pathMain;
							$configImage['max_size'] = "'".UPLOAD_IMAGE_MAX_SIZE."'";
							$configImage['allowed_types'] = 'gif|jpg|jpeg|png';
							$img_name =$today.'.'.$extension;
							$configImage['file_name'] = $img_name;
							$this->load->library('upload', $configImage,'profile_img');
							$this->profile_img->initialize($configImage);
							if (!$this->profile_img->do_upload('profile_path')) 
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
							'email'=>$this->input->post('email'),
							'username'=>$this->input->post('username'),
							'phone_number' => $this->input->post('phone_number'),
							'address' => $this->input->post('address'),
							'ip_address' => $this->input->ip_address(),
							'profile_path' => $filepath,
							'user_type'=>'A',
							'is_approve'=>0,
							'created_date'=>date('Y-m-d'),
							);
							$this->common->insert_record($tblName,$data);
							$this->session->set_flashdata('msg', 'New User has been added successfully and now approve user.');
							redirect('admin/user/','refresh'); //redirect in manage with msg
				}
			}
			else
			{
				$this->form_validation->set_rules('profile_path', 'profile_path', 'required');
				$this->form_validation->set_message('required', 'Please upload profile picture.');
				if ($this->form_validation->run() === FALSE)
				{
					$this->load->view('admin/controls/vwHeader');
					$this->load->view('admin/controls/vwLeft',$data);
					$this->load->view('admin/vwAddUser',$data);    
					$this->load->view('admin/controls/vwFooter');
					$this->load->view('admin/controls/vwFooterJavascript',$data);
				}
			}
			
		
		
    }
	public function view_user($id='') //this is use for edit records start
	{
       		$data['page'] = 'User';
			$data['ckeditor']=false;
			$data['gridTable']=false;
			$data['pagetitle']='Manage'.' '.$data['page'].'s';
			$arr['user']=$this->user->get_user_by_id($id);
			$this->load->view('admin/controls/vwHeader');
			$this->load->view('admin/controls/vwLeft',$data);
		
			$this->load->view('admin/vwViewUser',$arr);
			$this->load->view('admin/controls/vwFooter');
			$this->load->view('admin/controls/vwFooterJavascript');
		
    } //this is use for edit records end
    public function edit_user($id='') //this is use for edit records start
	{
        $data['page'] = 'User';
		$data['pagetitle']='Manage'.' '.$data['page'].'s | Edit '.$data['page'];
		
		$data['ckeditor']=false;
		$data['gridTable']=false;
		$this->form_validation->set_rules('username', 'username', 'required');
		
	
	//	$this->form_validation->set_rules('meta_title', 'meta title', 'required');
		if($id!='')
		{
			$formSubmit = $this->input->post('Submit');
			if($formSubmit=="Save")
			{
				 $tblName = "admin";
				 $fieldName = "id";
				
				
				if ($this->form_validation->run() === TRUE)
					{
						
						
						$data = array(
								'username' => $this->input->post('username'),
								'phone_number' => $this->input->post('phone_number'),
								'address' => $this->input->post('address'),
								'password'=>$this->encrypt->encode($this->input->post('password'))
							);
					
					$this->common->update_record($fieldName,$id,$tblName,$data);
					$this->session->set_flashdata('msg', 'User has been updated successfully.');
					redirect('admin/user/','refresh'); //redirect in manage with msg
					}
			}
			
			$data['user']=$this->user->get_user_by_id($id);
			$this->load->view('admin/controls/vwHeader');
			$this->load->view('admin/controls/vwLeft',$data);
	        $this->load->view('admin/vwEditUser',$data);
			$this->load->view('admin/controls/vwFooter');
			$this->load->view('admin/controls/vwFooterJavascript',$data);
			
		}
		else
		{
            redirect('admin/user');
        }
		
    } //this is use for edit records end

	public function delete_content($id) {
		
		$arr['page'] = 'User';
		$this->user->delete_record('id',$id,'admin');
		echo "delete";			
    }
	public function bulk_delete() {
		$arr['page'] = 'User';
	
		$ids = ( explode( ',', $this->input->get_post('data_ids') ));
			$this->user->delete_all($ids);
			echo 'delete';
			
    }
	public function is_appvove($val,$id)
	{
		
		if($val==1){
		$random_password=$this->common->random_string(10);	
		$user_data=$this->user->get_user_by_id($id);
		
			$this->load->library('email');
			$this->email->set_newline("\r\n");
		
			$this->email->from($this->data['admin_site_settings']->admin_mailing_address,$this->data['admin_site_settings']->admin_mailing_address);
			$this->email->to($user_data->email);
			
			$data = array(
					 'project_name'=> $this->data['admin_site_settings']->site_project_name,
					 'site_url'=> base_url(),
					 'site_email'=> $this->data['admin_site_settings']->site_email,
					 'copyright'=> $this->data['admin_site_settings']->site_copy_right,
					 'username'=> $user_data->username,
					 'user_email'=> $user_data->email,
					 'password'=> $random_password
						 );
				$body = $this->load->view('admin/email_template/user_approve_mail',$data,TRUE);
				$this->email->subject($this->data['admin_site_settings']->site_project_name.' admin panel password');
				$this->email->message($body);
				
				if(MAIL_ENABLE)
				{
					 $is_success=$this->email->send();
				}
		
		$fieldName='is_approve';
		$fieldId='id';
		$tableName='admin';
		$password=$this->encrypt->encode($random_password);
		$this->common->update_is_approve($val,$id,$fieldName,$fieldId,$tableName,$password);
		
		} else {
		$fieldName='is_approve';
		$fieldId='id';
		$tableName='admin';
		$password='';
		$this->common->update_is_approve($val,$id,$fieldName,$fieldId,$tableName,$password);
		}
		
	}
}
