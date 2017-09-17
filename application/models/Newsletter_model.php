<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Newsletter_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	function get_datatables($sql_details)
	{
		$this->load->library('datatables_ssp');
		$table = 'newsletter';
 
            // Table's primary key
        $primaryKey = 'news_latter_id';
			
		$columns = array(
				 
					array('customfilter' => 'news_latter_id','db' => 'news_latter_id', 'dt'  => 0,
						'formatter' => function( $news_latter_id, $row ) {
							return get_delete_all_id($news_latter_id);
						}
					),
					
					array( 'customfilter' => 'subject','db' => 'subject',  'dt' => 1 ),
					
					array( 'customfilter' => 'created_date','db' => 'created_date',
						   'dt' => 2,
						   'formatter' => function( $created_date, $row ) {
							return get_format_date($created_date);
						   }
						   
					),
					array( 'customfilter' => 'last_send_date','db' => 'last_send_date',
						   'dt' => 3,
						   'formatter' => function( $last_send_date, $row ) {
							return get_lastdate_format($last_send_date);
						   }
						   
					),
					array('customfilter' => 'news_latter_id',
						'db'        => 'CONCAT( is_status, "#", news_latter_id)',
						'dt'        => 4,
						'formatter' => function( $is_status, $row ) {
							return get_is_status($is_status);
						}
					),
					array('customfilter' => 'news_latter_id','db' => 'news_latter_id', 'dt'  => 5,
						'formatter' => function( $news_latter_id, $row ) {
							return get_edit($news_latter_id);
						}
					),
					array('customfilter' => 'news_latter_id','db' => 'news_latter_id', 'dt'  => 6,
						'formatter' => function( $news_latter_id, $row ) {
							return get_delete($news_latter_id);
						}
					)
				);

				function get_is_status($is_status)
				{
					$is_status_yes_no=explode('#',$is_status);
					if($is_status_yes_no[0]==1)
					{
						return "<div class='TextCenter'>Sent</div>";
					}
					else
					{
						return "<div class='TextCenter'>Draft</div>";
					}
					
				}
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
				function get_lastdate_format($last_send_date)
				{
					if($last_send_date=="0000-00-00")
					{
						return '<div class="TextCenter"></div>';
					}
					else
					{
						return '<div class="TextCenter">'.date("d M Y",strtotime($last_send_date)).'</div>';
					}
				}
				function get_edit($news_latter_id)
				{
					return "<div class='TextCenter'><a class='fa fa-fw fa-edit' href='".base_url()."admin/newsletter/edit_newsletter/".$news_latter_id."'></a></div>";
				}
				function get_delete($news_latter_id)
				{
					return "<div class='TextCenter'><a  href='' onclick='return deleteFunction(".$news_latter_id.");' class='fa fa-fw fa-trash-o' data-toggle='modal' data-target='#modelConfirm'></a><input type='hidden' value='".$news_latter_id."' name='hid_del_id' id='hid_del_id".$news_latter_id."' /></div>";
				}
				function get_delete_all_id($news_latter_id)
				{
					
					return "<div class='TextCenter'><input type='checkbox'  class='deleteRow' value='".$news_latter_id."' onclick='check_del_button(".$news_latter_id.");' /></div>";
				}
            return json_encode(
                    Datatables_ssp::simple($_GET, $sql_details, $table, $primaryKey, $columns,'','')
            );
	}
		
	function delete_all($ids){
     	$this->db->where_in('news_latter_id', $ids);
		$this->db->delete('newsletter');  
		return true;
	}
	
	function edit_newsletter_form($id)
	{
		$qry ='Select * from newsletter where news_latter_id='.$id ; // select data from db
		return $this->db->query($qry)->result_array();	
		
		
	}
	function delete_record ($fieldName,$id,$tblName){  // this is to Delete record in database created jignesh 10-6-15 start 
	
		$this->db->where($fieldName, $id);

		if($this->db->delete($tblName))
			return true;
		else
			 return false;
		
    } // this is to insert delete in database created end


}
