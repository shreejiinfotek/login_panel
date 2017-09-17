<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reset_password_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	function edit_reset_password_form($id)
	{
		$qry ='Select * from admin where verification_code="'.$id.'"' ; // select data from db
		return $this->db->query($qry)->result_array();	
		
		
	}
	function client_reset_password($verification_code)
	{
		$this->db->where('register_user.verification_code',$verification_code);
		$this->db->join('security_question', 'security_question.security_question_id = register_user.security_question_id','inner');
		$result = $this->db->get('register_user');
		return $result->row();
	}
}
