<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function get_datatables($sql_details)
	{
		
		$this->load->library('datatables_ssp');
		$where_condition=" id!=1";
		$table = 'admin';
 
            // Table's primary key
        $primaryKey = 'id';
			
	
		
			$columns = array(
							 array( 'customfilter'=>'id',
								'db'        => 'id',
								'dt'        => 0,
								'formatter' => function( $id, $row ) {
									return get_delete_all_id($id);
								}
							),
				array( 'customfilter' => 'username','db' => 'username',  'dt' => 1 ),
				array( 'customfilter' => 'email','db' => 'email',  'dt' => 2 ),
				array( 'customfilter' => 'phone_number','db' => 'phone_number',  'dt' => 3 ),
				array('customfilter' => 'id',
					'db'        => 'CONCAT( is_approve, "#", id)',
					'dt'        => 4,
					'formatter' => function( $is_approve, $row ) {
						return getisis_approve($is_approve);
					}
				),
				array( 'customfilter' => 'id','db' => 'id',  'dt' => 5,
					  'formatter' => function( $id, $row ) {
						return get_view($id);
					}),
				array('customfilter' => 'id','db' => 'id', 'dt'  => 6,
					'formatter' => function( $id, $row ) {
						return get_edit($id);
					}),
				array('customfilter' => 'id','db' => 'id', 'dt'  => 7,
					'formatter' => function( $id, $row ) {
						return get_delete($id);
					}
				)
			);
				
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
				
				function get_view($id)
				{
					return "<div class='TextCenter'><a class='fa fa-fw fa-eye' href='".base_url()."admin/user/view_user/".$id."'></a></div>";
				}
				function get_edit($id)
				{
					return "<div class='TextCenter'><a class='fa fa-fw fa-edit' href='".base_url()."admin/user/edit_user/".$id."'></a></div>";
				}
				function get_delete($id)
				{
					return "<div class='TextCenter'><a  href='' onclick='return deleteFunction(".$id.");' class='fa fa-fw fa-trash-o' class='fa fa-fw fa-trash-o'></a><input type='hidden' value='".$id."' id='hid_del_id".$id."' /></div>";
				}
				function get_delete_all_id($id)
				{
					
					return "<div class='TextCenter'><input type='checkbox'  class='deleteRow' value='".$id."' onclick='check_del_button();' /></div>";
				}
            return json_encode(
                    Datatables_ssp::simple($_GET, $sql_details, $table, $primaryKey, $columns,'',$where_condition)
            );
	}
	
	
	
	
	function delete_all($ids){
     	$this->db->where_in('user_id', $ids);
		$this->db->delete('user');  
		return true;
	}
	function get_user_by_id($id)
	{
		$this->db->where('id',$id);
		$result = $this->db->get('admin');
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
	function user_list()
	{
		$this->db->where('is_active','1');
		
		$result = $this->db->get('user');
		return $result->result_array();
	}
	
}
