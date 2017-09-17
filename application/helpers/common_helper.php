<?
if(!function_exists('google_analytics')){

  function google_analytics(){
	  $CI = get_instance();
   		$result = $CI->db->get('google_analytics');
		return $result->row();
  }
}

?>