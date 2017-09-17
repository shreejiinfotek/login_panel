<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register_user extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Register_user_model','register_user');
	         
	}

	public function index()
	{
		$data['page'] = 'User';
		$data['path'] = ''.base_url().'admin/register_user/delete_content/';
		$data['bulk_path'] = ''.base_url().'admin/register_user/bulk_delete/';
		$data['ckeditor']=false;
		$data['soringCol']='"order": [[ 4, "desc" ]],';
		$data['manage_view_path']=''.base_url().'admin/register_user/register_user_view/';
		$data['pagetitle']='Manage'.' Users';
		$data['gridTable']=true;
		
		$this->load->view('admin/controls/vwHeader');
		$this->load->view('admin/controls/vwLeft',$data);
		$this->load->view('admin/controls/vwFooterJavascript',$data);
        $this->load->view('admin/vwManageRegisterUser',$data);
		
		$this->load->view('admin/controls/vwFooter');
	}
	public function register_user_view()
	{
		$data['page'] = 'User';
		$sql_details=$this->common->sql_detial();
		echo $list = $this->register_user->get_datatables($sql_details);
	}
	public function view_register_user($id='') //this is use for edit records start
	{
       		$data['page'] = 'User';
			$data['ckeditor']=false;
			$data['gridTable']=false;
			$data['pagetitle']='Manage Users';
			$data['register_user']=$this->register_user->get_register_user_by_id($id);
			$this->load->view('admin/controls/vwHeader');
			$this->load->view('admin/controls/vwLeft',$data);
		
			$this->load->view('admin/vwViewRegisterUser',$data);
			$this->load->view('admin/controls/vwFooter');
			$this->load->view('admin/controls/vwFooterJavascript');
		
    } //this is use for edit records end
	public function delete_content($id) {
		
		$arr['page'] = 'User';
		$this->register_user->delete_record('register_user_id',$id,'register_user');
		echo "delete";
			
    }
	public function bulk_delete() {
		$arr['page'] = 'User';
	
		$ids = ( explode( ',', $this->input->get_post('data_ids') ));
		$this->register_user->delete_all($ids);
		echo 'delete';
			
    }

}
?>