<?
if( !defined('BASEPATH'))
exit('No direct script access allowed');

class Contact_us extends My_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	public function index(){
		$data['currentPage']='8';
		$data['content']=$this->content->get_content_by_page_id($data['currentPage']);
		
		$this->load->view('controls/vwHeader',$data);
		$this->load->view('vwContactUs',$data);
		$this->load->view('controls/vwFooter',$data);
		
	}
	public function sendmessage() {
      	
		if($this->input->get('Quotation_fullname')!="")
			{
					$tblName = "enquiry";
					$data = array(
					'enquiry_name' => $this->input->get('Quotation_fullname'),
					'email' => $this->input->get('Quotation_email'),
					'telephone' => $this->input->get('Quotation_phone'),
					'message' => $this->input->get('Quotation_message'),
					'ip_address' => $this->input->ip_address(),
					'created_date' => date('Y-m-d')
				
					);
					$this->common->insert_record($tblName,$data);
					$this->load->library('email');
					$this->email->set_newline("\r\n");
		
					$this->email->from($this->data['site_settings_value']->admin_mailing_address,$this->input->get('Quotation_email'));
					$this->email->to($this->data['site_settings_value']->admin_mailing_address);
			
					$data = array(
					 'project_name'=> $this->data['site_settings_value']->site_project_name,
					 'site_url'=> base_url(),
					 'copyright'=> $this->data['site_settings_value']->site_copy_right,
					 'name'=> $this->input->get('Quotation_fullname'),
					 'email'=> $this->input->get('Quotation_email'),
					 'phone'=> $this->input->get('Quotation_phone'),
					 'message'=> $this->input->get('Quotation_message')
					
						 );
					$body = $this->load->view('email_template/contactus_email',$data,TRUE);
					$this->email->subject($this->data['site_settings_value']->site_project_name.' Enquiry received');
					$this->email->message($body);
					if(MAIL_ENABLE)
					{
						$this->email->send();
						echo"success";
					}
				
					
			}
			

    }
	
	
}


?>