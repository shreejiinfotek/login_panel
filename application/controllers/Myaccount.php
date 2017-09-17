<?
if( !defined('BASEPATH'))
exit('No direct script access allowed');

class Myaccount extends My_Controller
{
	public function __construct()
	{
		parent::__construct(); 
		
	}
	public function index(){
		$data['currentPage']='12';
		$data['content']=$this->content->get_content_by_page_id($data['currentPage']);
		$this->load->view('controls/vwHeader',$data);
		$this->load->view('vwMyAccount',$data);
		$this->load->view('controls/vwFooter',$data);
		
	}
	
}


?>