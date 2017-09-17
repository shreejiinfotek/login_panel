<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Change_password_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	function change_password_form()
	{
		$this->db->where('id',$this->session->userdata('id'));
		$result = $this->db->get('admin');
		return $result->row();
	}
	function change_password_form_user()
	{
		$this->db->where('user_id',$this->session->userdata('user_id'));
		$result = $this->db->get('user');
		return $result->row();
	}
	
}
