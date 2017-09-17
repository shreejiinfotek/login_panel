<?
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class My_Controller extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('Common_function_model','common');
		$this->load->model('Contents_model','content');
		$this->load->model('Social_media_model','social_media');
		$this->load->model('Newsletter_subscription_model','social_media');
		$this->load->helper('common_helper');
        $this->load->library('form_validation');
		
		
		$this->data['site_settings_value']= $this->common->get_site_setting_value();
		
		
		
		
		
		
	}
}


class Admin_Controller extends CI_Controller
{

    function __construct()
    {
	   parent::__construct();
	   
		if(!($this->router->fetch_class()=="home" || $this->router->fetch_class()=="forgot_password" || $this->router->fetch_class()=="reset_password"))
		{
		   if (!$this->session->userdata('is_admin_login')) {
    	        //redirect('admin/home');
        	}
		}
		
		$this->load->model('Common_function_model','common');
		
        $this->load->library('form_validation');
		$this->data['admin_site_settings'] = $this->common->get_site_setting_value();
    }
}
?>