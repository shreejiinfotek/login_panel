<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Newsletter_send_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	 function fetch_newsletter_subcribtion() 
	 {
		$this->db->select('*');
		$this->db->from('newsletter_subscription');
		$this->db->where('is_active', 1);
		$query = $this->db->get();
		
		  if($query->num_rows() > 0) 
			{				
				foreach ($query->result() as $row) 
				{			
					$datas[] = $row;
				}         				
				return $datas;
			}
		  //return $datas;
 	}
	function fetch_newsletter()
	{
		$this->db->select('*');
		$this->db->from('newsletter');
		$this->db->where('is_status', 0);
		$query = $this->db->get();
		
		  if($query->num_rows() > 0) 
			{				
				foreach ($query->result() as $row) 
				{			
					$datas[] = $row;
				}         				
				return $datas;
			}
	}
	function get_newsletter_data($id)
	{
		$qry ='Select * from newsletter where news_latter_id="'.$id.'"' ; // select data from db
		return $this->db->query($qry)->result_array();	
		
		
	}

}
