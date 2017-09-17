<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register_user_model extends CI_Model {


	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	function get_datatables($sql_details)
	{
		$this->load->library('datatables_ssp');
		$table = 'register_user';
 
            // Table's primary key
        $primaryKey = 'register_user_id';
			
		$columns = array(
				 
					array('customfilter' => 'register_user_id','db' => 'register_user_id', 'dt'  =>0,
						'formatter' => function( $register_user_id, $row ) {
							return get_delete_all_id($register_user_id);
						}
					),
					
					array( 'customfilter' => 'register_user_first_name','db' => 'CONCAT(register_user_first_name,"#",register_user_last_name)',
						   'dt' => 1,
						   'formatter' => function( $user_name, $row ) {
							return get_user_name($user_name);
						   }
						   
					),
					array( 'customfilter' => 'register_user_email','db' => 'register_user_email',  'dt' => 2 ),
					array( 'customfilter' => 'register_user_phone_number','db' => 'register_user_phone_number',  'dt' => 3 ),
					array( 'customfilter' => 'created_date','db' => 'created_date',
						   'dt' => 4,
						   'formatter' => function( $created_date, $row ) {
							return get_format_date($created_date);
						   }
						   
					),
					array('customfilter' => 'register_user_id','db' => 'register_user_id', 'dt'  =>5,
						'formatter' => function( $register_user_id, $row ) {
							return get_view($register_user_id);
						}
					),
					array('customfilter' => 'register_user_id','db' => 'register_user_id', 'dt'  =>6,
						'formatter' => function( $register_user_id, $row ) {
							return get_delete($register_user_id);
						}
					)
				);

				function get_format_date($created_date)
				{
					if($created_date=="0000-00-00")
					{
						return '<div class="TextCenter"></div>';
					}
					else
					{
						return '<div class="TextCenter">'.date("d M Y",strtotime($created_date)).'</div>';
					}
				}
				function get_user_name($user_name)
				{
					$explode_username=explode('#',$user_name);
						return '<div>'.$explode_username[0].' '.$explode_username[1].'</div>';
				}
				function get_view($register_user_id)
				{
					return "<div class='TextCenter'><a class='fa fa-fw fa-eye' href='".base_url()."admin/register_user/view_register_user/".$register_user_id."'></a></div>";
				}
				function get_delete($register_user_id)
				{
					return "<div class='TextCenter'><a  href='' onclick='return deleteFunction(".$register_user_id.");' class='fa fa-fw fa-trash-o'></a><input type='hidden' value='".$register_user_id."' name='hid_del_id' id='hid_del_id".$register_user_id."' /></div>";
				}
				function get_delete_all_id($register_user_id)
				{
					
					return "<div class='TextCenter'><input type='checkbox'  class='deleteRow' value='".$register_user_id."' onclick='check_del_button();' /></div>";
				}
            return json_encode(
                    Datatables_ssp::simple($_GET, $sql_details, $table, $primaryKey, $columns,'','')
            );
	}
	

	function delete_all($ids){
        $ids = $ids;
		$this->db->select('register_user_profile_picture');
		$this->db->where_in('register_user_id',$ids);
		$banner_query= $this->db->get('register_user');
	   	foreach($banner_query->result_array() as $register_user_profile_picture)
		{
			if($register_user_profile_picture['register_user_profile_picture']!="")
			{
				if(file_exists("./".$register_user_profile_picture['register_user_profile_picture']))
				{
					unlink("./".$register_user_profile_picture['register_user_profile_picture']);
				}
			}
       	}
	    $this->db->where_in('register_user_id', $ids);
		$this->db->delete('register_user'); 
	   	return true;
	}	
	function delete_record ($fieldName,$id,$tblName){  // this is to Delete record in database  
		
		$register_user_profile_picture=$this->common->GetValue("register_user","register_user_profile_picture","register_user_id",''.$id.'');
		if($register_user_profile_picture!="")
		{
			if(file_exists("./".$register_user_profile_picture))
			{
				unlink("./".$register_user_profile_picture);
			}
		}
		$this->db->where($fieldName, $id);
		if($this->db->delete($tblName))
			return true;
		else
			 return false;
    }
	function get_register_user_by_id($id)
	{
		$this->db->join('security_question','security_question.security_question_id = register_user.security_question_id','left');
		$this->db->where('register_user_id',$id);
		$result = $this->db->get('register_user')->row();
		return $result;
	}
public function duplicate_mobile($mobile){	
		
		$this->db->select('*');
		$this->db->from('student_register');
		$this->db->where('student_mobile',$mobile);
		
		$query = $this->db->get();
	
		if ($query->num_rows() >= 1) {
			return 1;
		} else {
			return 0;
		}
	}

}

?>