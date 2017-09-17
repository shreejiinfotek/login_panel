<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
public function login_student($mobile) {

		$where_array = array('student_mobile' =>$mobile, 'is_active' => '1');
		$this->db->select('*');
		$this->db->where($where_array);
	
		$query = $this->db->get('student_register');
		return $query->row();
		
}

public function otp_student($mobile) {

		$where_array = array('student_mobile' =>$mobile);
		$this->db->select('*');
		$this->db->where($where_array);
		$query = $this->db->get('student_register');
		return $query->row();
		
}



}

?>