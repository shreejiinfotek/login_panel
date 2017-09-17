<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student_model extends CI_Model {

public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	function get_datatables($sql_details)
	{
		
		$this->load->library('datatables_ssp');
		$where_condition="";
		$table = 'student_register';
 
            // Table's primary key
        $primaryKey = 'student_id';
			
	
		
			$columns = array(
							 array( 'customfilter'=>'student_id',
								'db'        => 'student_id',
								'dt'        => 0,
								'formatter' => function( $student_id, $row ) {
									return get_delete_all_id($student_id);
								}
							),
				array( 'customfilter' => 'student_name','db' => 'student_name',  'dt' => 1 ),
				array( 'customfilter' => 'student_fathername','db' => 'student_fathername',  'dt' => 2 ),
				array( 'customfilter' => 'student_mobile','db' => 'student_mobile',  'dt' => 3 ),
				array( 'customfilter' => 'caste_community','db' => 'caste_community',  'dt' => 4 ),
				array( 'customfilter' => 'gender','db' => 'gender',  'dt' => 5),
				array('customfilter' => 'student_id',
					'db'        => 'CONCAT( is_active, "#", student_id)',
					'dt'        => 6,
					'formatter' => function( $is_active, $row ) {
						return getisactive($is_active);
					}
				),
				array( 'customfilter' => 'student_id','db' => 'student_id',  'dt' => 7,
					  'formatter' => function( $student_id, $row ) {
						return get_view($student_id);
					}),
				array('customfilter' => 'student_id','db' => 'student_id', 'dt'  => 8,
					'formatter' => function( $student_id, $row ) {
						return get_edit($student_id);
					}),
				array('customfilter' => 'student_id','db' => 'student_id', 'dt'  => 9,
					'formatter' => function( $student_id, $row ) {
						return get_delete($student_id);
					}
				)
			);
				function getisactive($is_active)
				{
					$is_active_yes_no=explode('#',$is_active);
					if($is_active_yes_no[0]==1)
					{
						return "<div class='TextCenter poiter' id='display_isactive".$is_active_yes_no[1]."'><span class='fa fa-fw fa-check' onclick='update_is_active(0,".$is_active_yes_no[1].",&#39;student_register&#39;,&#39;is_active&#39;);'></span></div>";
					}
					else
					{
						return "<div class='TextCenter poiter' id='display_isactive".$is_active_yes_no[1]."'><span class='fa fa-fw fa-close' onclick='update_is_active(1,".$is_active_yes_no[1].",&#39;student_register&#39;,&#39;is_active&#39;);'></span></div>";
					}
					
				}
				function getisis_approve($is_approve)
				{
					$is_approve_yes_no=explode('#',$is_approve);
					if($is_approve_yes_no[0]==1)
					{
						return "<div class='TextCenter poiter' id='display_is_approve".$is_approve_yes_no[1]."'><span class='fa fa-fw fa-check' onclick='update_is_approve(0,".$is_approve_yes_no[1].",&#39;admin&#39;,&#39;is_approve&#39;);'></span></div>";
					}
					else
					{
						return "<div class='TextCenter poiter' id='display_is_approve".$is_approve_yes_no[1]."'><span class='fa fa-fw fa-close' onclick='update_is_approve(1,".$is_approve_yes_no[1].",&#39;admin&#39;,&#39;is_approve&#39;);'></span></div>";
					}
					
				}
				
				function get_view($student_id)
				{
					return "<div class='TextCenter'><a class='fa fa-fw fa-eye' href='".base_url()."admin/student/view_student/".$student_id."'></a></div>";
				}
				function get_edit($student_id)
				{
					return "<div class='TextCenter'><a class='fa fa-fw fa-edit' href='".base_url()."admin/student/edit_student/".$student_id."'></a></div>";
				}
				function get_delete($student_id)
				{
					return "<div class='TextCenter'><a  href='' onclick='return deleteFunction(".$student_id.");' class='fa fa-fw fa-trash-o' class='fa fa-fw fa-trash-o'></a><input type='hidden' value='".$student_id."' id='hid_del_id".$student_id."' /></div>";
				}
				function get_delete_all_id($student_id)
				{
					
					return "<div class='TextCenter'><input type='checkbox'  class='deleteRow' value='".$student_id."' onclick='check_del_button();' /></div>";
				}
            return json_encode(
                    Datatables_ssp::simple($_GET, $sql_details, $table, $primaryKey, $columns,'',$where_condition)
            );
	}
	
	
	function delete_all($ids){
     	$this->db->where_in('student_id', $ids);
		$this->db->delete('student_register');  
		return true;
	}
	function get_student_by_id($student_id)
	{
		$this->db->where('student_id',$student_id);
		$result = $this->db->get('student_register');
		return $result->row();
	}
	function delete_record ($fieldName,$id,$tblName){  // this is to Delete record in database  
	
		$this->load->model('Common_function_model','common');
		
		$this->db->where($fieldName, $id);

		if($this->db->delete($tblName))
			return true;
		else
			 return false;
		
    } // this is to insert delete in database created end
	
	public function student_by_id($student_id) {

		$where_array = array('student_id' =>$student_id, 'is_active' => '1');
		$this->db->select('*');
		$this->db->where($where_array);
		$query = $this->db->get('student_register');
		return $query->row();
		
	}
	function get_student_list(){  
	
		$where_array = array('is_active' => '1');
		$this->db->select('*');
		$this->db->from('student_register');
		$this->db->where($where_array); 
		$this->db->order_by("student_id");
		$query=$this->db->get();
		return $query->result_array();
    }
	function get_student_list_by_id($student_id){  
	
		$where_array = array('student_id' =>$student_id, 'is_active' => '1');
		$this->db->select('*');
		$this->db->from('student_register');
		$this->db->where($where_array); 
		$this->db->order_by("student_id");
		$query=$this->db->get();
		return $query->result_array();
    }
	function get_student(){  
		$this->db->select('student_id,student_name');
		$this->db->from('student_register');
		$this->db->order_by("student_id");
		$query=$this->db->get();
		$students=array();
	    foreach ($query->result() as $student) 
		{
			$students[$student->student_id] = $student->student_name;
        }
         return $students;
    }


}

?>