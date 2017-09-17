<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forgot_password_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
		
	function get_user_data($id)
	{
		$this->db->where('email',$id);
		$result = $this->db->get('admin');
		return $result->result_array();
	}
	function get_student_user_data($email)
	{
		$this->db->where('register_user_email',$email);
		$result = $this->db->get('student_register');
		return $result->row();
	}
	function get_student_data($user_mobile)
	{
		$this->db->where('student_mobile',$user_mobile);
		$result = $this->db->get('student_register');
		return $result->row();
	}

}
