<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Newsletter_subscription_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	function get_datatables($sql_details)
	{
		$this->load->library('datatables_ssp');
		$table = 'newsletter_subscription';
 
            // Table's primary key
        $primaryKey = 'news_letter_subscription_id';
			
		$columns = array(
				 
					array( 'customfilter' => 'news_letter_subscription_id','db' => 'news_letter_subscription_id',
						   'dt' => 0,
						   'formatter' => function( $news_letter_subscription_id, $row ) {
							return get_delete_all_id($news_letter_subscription_id);
						   }
						   
					),
					
					
					array( 'customfilter' => 'email','db' => 'email',  'dt' => 1 ),
					array( 'customfilter' => 'create_date','db' => 'create_date',
						   'dt' => 2,
						   'formatter' => function( $create_date, $row ) {
							return get_format_date($create_date);
						   }
						   
					),
					array('customfilter' => 'news_letter_subscription_id',
						'db'        => 'CONCAT( is_active, "#", news_letter_subscription_id)',
						'dt'        => 3,
						'formatter' => function( $is_active, $row ) {
							return get_is_active($is_active);
						}
					),
					array('customfilter' => 'news_letter_subscription_id','db' => 'news_letter_subscription_id', 'dt'  => 4,
						'formatter' => function( $news_letter_subscription_id, $row ) {
							return get_delete($news_letter_subscription_id);
						}
					)
				);
				function get_is_active($is_active)
				{
					$is_active_yes_no=explode('#',$is_active);
					if($is_active_yes_no[0]==1)
					{
						return "<div class='TextCenter poiter' id='display_isactive".$is_active_yes_no[1]."'><span class='fa fa-fw fa-check' onclick='update_is_active(0,".$is_active_yes_no[1].",&#39;newsletter_subscription&#39;,&#39;is_active&#39;);'></span></div>";
					}
					else
					{
						return "<div class='TextCenter poiter' id='display_isactive".$is_active_yes_no[1]."'><span class='fa fa-fw fa-close' onclick='update_is_active(1,".$is_active_yes_no[1].",&#39;newsletter_subscription&#39;,&#39;is_active&#39;);'></span></div>";
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
				function get_delete($news_letter_subscription_id)
				{
					return "<div class='TextCenter'><a  href='' onclick='return deleteFunction(".$news_letter_subscription_id.");' class='fa fa-fw fa-trash-o' data-toggle='modal' data-target='#modelConfirm'></a><input type='hidden' value='".$news_letter_subscription_id."' name='hid_del_id' id='hid_del_id".$news_letter_subscription_id."' /></div>";
				}
				function get_delete_all_id($news_letter_subscription_id)
				{
					
					return "<div class='TextCenter'><input type='checkbox'  class='deleteRow' value='".$news_letter_subscription_id."' onclick='check_del_button();' /></div>";
				}
            return json_encode(
                    Datatables_ssp::simple($_GET, $sql_details, $table, $primaryKey, $columns,'','')
            );
	}
		
	function delete_all($ids){
     	$this->db->where_in('news_letter_subscription_id', $ids);
		$this->db->delete('newsletter_subscription');  
		return true;
	}
	
	function delete_record ($fieldName,$id,$tblName){  // this is to Delete record in database created jignesh 10-6-15 start 
	
		$this->db->where($fieldName, $id);

		if($this->db->delete($tblName))
			return true;
		else
			 return false;
		
    } // this is to insert delete in database created end
	public function duplicate_email($email){	
		
		$this->db->select('*');
		$this->db->from('newsletter_subscription');
		$this->db->where('email',$email);
		
		$query = $this->db->get();
	
		if ($query->num_rows() >= 1) 
		{
			return 1;
		} else 
		{
			return 0;
		}
	}

}
