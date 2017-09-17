<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Newsletter_send extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Newsletter_send_model','newsletter_send');
		
	}

	public function index()
	{
		$data['page'] = 'Newsletter';
		$data['ckeditor']=false;
		$data['pagetitle']=$data['page'].' Send';
		$data['gridTable']=true;
		$data['newsletter_subscription']=$this->newsletter_send->fetch_newsletter_subcribtion();
		$data['newsletter']=$this->newsletter_send->fetch_newsletter();
		$this->load->view('admin/controls/vwHeader');
		$this->load->view('admin/controls/vwLeft',$data);
		$this->load->view('admin/controls/vwFooterJavascript',$data);
        $this->load->view('admin/vwManageNewsletterSend',$data);
		
		$this->load->view('admin/controls/vwFooter');
	}
	public function send_mail() {

		$to=$this->input->post('to');
		$email_array=explode(",",$to);
		$hid_subcribtion_id=$this->input->post('hid_subcribtion_id');
		$subcribtion_id=explode(",",$hid_subcribtion_id);
		//print_r($subcribtion_id);exit;
		$newsletter=$this->newsletter_send->get_newsletter_data($this->input->post('news_latter_id'));
		for($i=0;$i<count($email_array);$i++)
		{
			$this->load->library('email');
			$this->email->set_newline("\r\n");
		
			$this->email->from($this->data['admin_site_settings']->admin_mailing_address,$this->data['admin_site_settings']->admin_mailing_address);
			$this->email->to($email_array[$i]);
			
		 $data = array(
					 'project_name'=> $this->data['admin_site_settings']->site_project_name,
					 'site_url'=> base_url(),
					 'copyright'=> $this->data['admin_site_settings']->site_copy_right,
					 'description'=> $newsletter[0]['description'],
					 'newsletter_id'=> $subcribtion_id[$i]
						 );
			$body = $this->load->view('admin/email_template/newsletter',$data,TRUE);
			$this->email->subject($this->data['admin_site_settings']->site_project_name.' '.$newsletter[0]["subject"]);
			$this->email->message($body);
			if($email_array[$i]!="")
			{
				if(MAIL_ENABLE)
				{
					
					 $is_sucess=$this->email->send();
				}
				else
				{
					$is_sucess="";
				}
			}
			if($is_sucess)
			{
				$tblName = "newsletter";
				$fieldName = "news_latter_id";
				
				$data = array(
						'last_send_date' => date('Y-m-d'),
						'is_status' => 1
						);
				$this->common->update_record($fieldName,$this->input->post('news_latter_id'),$tblName,$data);
				$this->session->set_flashdata('msg', 'Newsletter has been sent successfully.');
			}
			else
			{
				$this->session->set_flashdata('error', 'Message delivery failed... Please try Again');
			}
			 
		}
		redirect('admin/newsletter_send');
    }
}
