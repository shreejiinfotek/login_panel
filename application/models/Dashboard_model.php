<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

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
	function edit_register_user()
	{
		$this->db->join('security_question','security_question.security_question_id = register_user.security_question_id','left');
		$this->db->where('register_user_id',$this->session->userdata('user_id'));
		$result = $this->db->get('register_user');
		return $result->row();
	}
}
