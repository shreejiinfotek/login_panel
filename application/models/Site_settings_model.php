<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site_settings_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	function get_site_settings()
	{
		$result = $this->db->get('site_settings');
		return $result->row();
		
	}


}
