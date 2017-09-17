<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Metadata_model extends CI_Model {

	

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	function get_metadata($page_name,$id)
	{
		
		if($page_name=='News / Event')
		{
			$this->db->where('news_event_id',$id);
			$result = $this->db->get('news_event');
			return $result->row();
		}
		if($page_name=='Our Program')
		{
			$this->db->where('our_program_id',$id);
			$result = $this->db->get('our_program');
			return $result->row();
		}
		if($page_name=='School')
		{
			$this->db->where('school_id',$id);
			$result = $this->db->get('school');
			return $result->row();
		}
				
	}
	


}
