<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Newsletter_subscription extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Newsletter_subscription_model','Newsletter_subscription');
		
	}

	public function index()
	{
		$data['page'] = 'Newsletter Subscription';
		$data['path'] = ''.base_url().'admin/newsletter_subscription/delete_content/';
		$data['bulk_path'] = ''.base_url().'admin/newsletter_subscription/bulk_delete/';
		$data['ckeditor']=false;
		$data['soringCol']='"order": [[ 3, "desc" ]],';
		$data['manage_view_path']=''.base_url().'admin/newsletter_subscription/newsletter_subscription_view/';
		$data['is_active_path']=''.base_url().'admin/newsletter_subscription/is_active/';
		$data['pagetitle']='Manage'.' '.$data['page'];
		$data['gridTable']=true;
		
		$this->load->view('admin/controls/vwHeader');
		$this->load->view('admin/controls/vwLeft',$data);
		$this->load->view('admin/controls/vwFooterJavascript',$data);
        $this->load->view('admin/vwManageNewsletterSubscription',$data);
		
		$this->load->view('admin/controls/vwFooter');
	}

	public function newsletter_subscription_view()
	{
		$data['page'] = 'Newsletter Subscription';
		$sql_details=$this->common->sql_detial();
		echo $list = $this->Newsletter_subscription->get_datatables($sql_details);
	}
	public function delete_content($id) {
		
		$arr['page'] = 'Newsletter';
		
		$this->Newsletter_subscription->delete_record('news_letter_subscription_id',$id,'newsletter_subscription');
		echo "delete";			
    }
	public function bulk_delete() {
		$arr['page'] = 'Newsletter';
			
		$ids = ( explode( ',', $this->input->get_post('data_ids') ));
			$this->Newsletter_subscription->delete_all($ids);
			echo 'delete';
			
    }
	public function is_active($val,$id)
	{
		$fieldName='is_active';
		$fieldId='news_letter_subscription_id';
		$tableName='newsletter_subscription';
		$this->common->update_is_active($val,$id,$fieldName,$fieldId,$tableName);
	}

}
