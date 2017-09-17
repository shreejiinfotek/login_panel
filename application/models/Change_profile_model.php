<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Change_profile_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	function edit_profile_form()
	{
		$this->db->where('id',$this->session->userdata('id'));
		$result = $this->db->get('admin');
		return $result->row();
	}
	
}
