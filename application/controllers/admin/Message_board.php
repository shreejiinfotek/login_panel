<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Message_board extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Message_board_model','message_board');
	}

	public function index()
	{
		$data['page'] = 'Message Board';
		$data['path'] = ''.base_url().'admin/message_board/delete_content/';
		$data['bulk_path'] = ''.base_url().'admin/message_board/bulk_delete/';
		$data['ckeditor']=false;
		$data['soringCol']='"order": [[ 1, "asc" ]],';
		$data['manage_view_path']=''.base_url().'admin/message_board/message_board_view/';
		$data['pagetitle']='Manage '.$data['page'].'s';
		$data['is_active_path']=''.base_url().'admin/message_board/is_active/';
		$data['gridTable']=true;
		
		$this->load->view('admin/controls/vwHeader');
		$this->load->view('admin/controls/vwLeft',$data);
		$this->load->view('admin/controls/vwFooterJavascript',$data);
        $this->load->view('admin/vwManageMessageBoard',$data);
		
		$this->load->view('admin/controls/vwFooter');
	}

	public function message_board_view()
	{
		$data['page'] = 'Message Board';
		$sql_details=$this->common->sql_detial();
		echo $list = $this->message_board->get_datatables($sql_details);
	}
	public function view_message_board() //this is use for edit records start
	{
		$this->message_board->view_message_board($this->input->get_post('message_board_title_id'));
		
    } //this is use for edit records end
	
	public function add_message_board() { //this is use for redirect form in add section start
		$data['page'] = 'Message Board';
		$data['pagetitle']='Manage '.$data['page'].'s | Add '.$data['page'];
		$data['ckeditor']=false;
		$data['gridTable']=false;
		$formSubmit = $this->input->post('Submit');
		if($formSubmit=="Save")
		{
			$total_addfield_count=$this->input->post('hide_total_field');
			
			$tblName = "message_board_title";
			
				$data = array(
					'message_board_title_name' =>$this->input->post('message_board_title_name'),
					'display_order' => $this->input->post('display_order'),
					'created_date'=>date('Y-m-d'),
				);
			$insert_id=$this->message_board->add_message_board_title($tblName,$data);
			for($i=1; $i<=$total_addfield_count; $i++)
			{
				
			$tblName = "message_board";
			$fieldName = "message_board_id";
			
				$data = array(
							'message_board_title_id'=>$insert_id,
							'message_board_multiple_question'=>$this->input->post('message_board_multiple_question'.$i),
							//'display_order' => $this->input->post('display_order'),
							'created_date'=>date('Y-m-d'),
							);
				$this->common->insert_record($tblName,$data);
			}
			
			$this->session->set_flashdata('msg', 'Message Board has been added successfully.');
			redirect('admin/message_board/','refresh'); //redirect in manage with msg			
		
		}
		//$data['message_board_title_id'] = $this->message_board->get_message_board_title_id();
		$this->load->view('admin/controls/vwHeader');
		$this->load->view('admin/controls/vwLeft',$data);
		$this->load->view('admin/vwAddMessageBoard',$data);    
		$this->load->view('admin/controls/vwFooter');
		$this->load->view('admin/controls/vwFooterJavascript',$data);
	} //this is use for redirect form in add section end
    public function edit_message_board($id='') //this is use for edit records start
	{
        $data['page'] = 'Message Board';
		$data['pagetitle']='Manage '.$data['page'].'s | Edit '.$data['page'];
		$data['ckeditor']=false;
		$data['gridTable']=false;
		
		
		if($id!='')
		{
			$formSubmit = $this->input->post('Submit');
			if($formSubmit=="Save")
			{
				$total_addfield_count=$this->input->post('hide_total_field');
				
				$tblName = "message_board_title";
				$fieldName = "message_board_title_id";
						$data = array(
						'message_board_title_name' => $this->input->post('message_board_title_name'),
						'display_order' => $this->input->post('display_order'),
						);
				
				$this->common->update_record($fieldName,$id,$tblName,$data);
				
				for($i=1; $i<=$total_addfield_count; $i++)
				{
				$tblName = "message_board";
				$fieldName = "message_board_id";
						$message_board_id=$this->input->post('hid_message_board_id'.$i);
						
						
						if($message_board_id!="")
						{
						$data = array(
						'message_board_title_id' =>$this->input->post('hid_message_board_title_id'),
						'message_board_multiple_question' =>$this->input->post('message_board_multiple_question'.$i)
						);
						$this->common->update_record($fieldName,$message_board_id,$tblName,$data);
						
						} 
						else
						{
							$data = array(
							'message_board_title_id' =>$this->input->post('hid_message_board_title_id'),
							'message_board_multiple_question' =>$this->input->post('message_board_multiple_question'.$i),
							'created_date'=>date('Y-m-d'),
							);
							$this->common->insert_record($tblName,$data);
						}
						
					}
						
						$this->session->set_flashdata('msg', 'Message Board has been updated successfully.');
						redirect('admin/message_board/','refresh'); //redirect in manage with msg
			}
			$data['message_board']=$this->message_board->get_message_board_by_id($id);
//			$data['message_board_title_id'] = $this->message_board->get_message_board_title_id();
			$data['message_questions']=$this->message_board->get_question_by_title_id($id);
			$this->load->view('admin/controls/vwHeader');
			$this->load->view('admin/controls/vwLeft',$data);
	        $this->load->view('admin/vwEditMessageBoard',$data);
			$this->load->view('admin/controls/vwFooter');
			$this->load->view('admin/controls/vwFooterJavascript',$data);
		}
		else
		{
            redirect('admin/message_board');
        }
    } //this is use for edit records end
	
	public function delete_content($id) {
		$arr['page'] = 'Message Board';
		$this->message_board->delete_record('message_board_title_id',$id,'message_board_title');
		$this->message_board->delete_record('message_board_title_id',$id,'message_board');
		echo "delete";
		
    }
	public function delete_message_question($id) {
		$arr['page'] = 'Message Board';
		$this->message_board->delete_record('message_board_id',$id,'message_board');
		echo "delete";
		
    }
	public function bulk_delete() {
		$arr['page'] = 'Message Board';
		
		$ids = ( explode( ',', $this->input->get_post('data_ids') ));
			$this->message_board->delete_all($ids);
			echo 'delete';
			
    }
	public function is_active($val,$id)
	{
		$fieldName='is_active';
		$fieldId='message_board_title_id';
		$tableName='message_board_title';
		$this->common->update_is_active($val,$id,$fieldName,$fieldId,$tableName);
	}

}
?>