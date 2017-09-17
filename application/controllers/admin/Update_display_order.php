<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Update_display_order extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		
	}

	public function index()
	{
		$content=explode(',',$_POST['hid_file_name']);
	   	$redirect_file=$_POST['hid_file_name'];
		 foreach($_POST['hid_table_id'] as $key=>$val) 
		 {
			$display_order=$_POST['display_order'.$val];
			$data = array(
					'display_order' => $display_order
					);

			$this->common->update_record($content[1],$val,$content[0],$data);
		
		 }
		 $module_msg=str_replace('_',' ',ucfirst($content[2]));
		 
		 if($this->uri->segment(4)!="")
		 {
			 $this->session->set_flashdata('msg', 'Catalogue image has been updated successfully.');
		 	redirect('admin/'.$content[2]."/".$this->uri->segment(4));
		 }
		 else
		 {
			  $this->session->set_flashdata('msg', $module_msg.' has been updated successfully.');
			 redirect('admin/'.$content[2]);
		 }
	}

	
}
