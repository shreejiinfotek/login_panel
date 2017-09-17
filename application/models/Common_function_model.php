<?
defined('BASEPATH') OR exit('No direct script access allowed');

class Common_function_model extends CI_Model {


	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	function excel_number_to_date($num)
	{
		$num=$num-25570;
		$date='1970/01/02';
		$dat=str_replace("/","-",$date);
		$dat=date("Y-m-d",strtotime($dat));
		return date("Y-m-d",strtotime($num.' days',strtotime($dat)));
		//return addday('1970/01/02',$num);
	}
	function GetValue($table,$field,$where,$condition) //Get field value in the database//
	{		
		$this->db->select($field);
		$this->db->where($where,$condition);
		$querycat = $this->db->get($table);
		foreach ($querycat->result() as $row)
	   	{
		  return $row->$field;
	   	}				
	} 
	// this is to get filed value in database
	function GetDuplicateValue($table,$field,$field_val,$where,$condition) //Get field value in the database//
	{
		$where_array = array($field => $field_val,''.$where.' !=' => $condition);
		$this->db->select($field);
		$this->db->where($where_array);
		$querycat = $this->db->get($table);
		foreach ($querycat->result() as $row)
	   	{
		  return $row->$field;
	   	}				
	} 
	function sent_sms($messgae,$to_mobile)
	{
				$username='nira1074';
				$password=urlencode('reset@123');
				$sender='KUSUMF';
				$reqid = 1;
				$format = urlencode('{json|text}');
				$route_id='235';
				$sentmessage = urlencode($messgae);
				
			   $data = 'username='.$username.'&password='.$password.'&sender='.$sender.'&to='.$to_mobile.'&message='.$sentmessage.'&reqid='.$reqid.'&format='.$format.'&route_id='.$route_id;
					
					$ch = curl_init('http://203.129.225.68/API/WebSMS/Http/v1.0a/index.php?'.$data);
					curl_setopt($ch, CURLOPT_POST, true);
					curl_setopt($ch, CURLOPT_POSTFIELDS, $ch);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					$submit = curl_exec($ch);
					curl_close($ch);
		
	}
	// this is to get filed value in database
	function CountByTable($table,$where)
	{
		
			$qry='SELECT * FROM `'.$table.'` '.$where.'';
			$query = $this->db->query($qry);
			return $query->num_rows();
		
    }
	function CountBycontent($table,$where)
	{
		
		  $qry='SELECT * FROM `'.$table.'` '.$where.'';
			$query = $this->db->query($qry);
			return $query->num_rows();
	}
	function GetAge($dob) 
	{ 
			$dob=explode("-",$dob); 
			$curMonth = date("m");
			$curDay = date("j");
			$curYear = date("Y");
			$age = $curYear - $dob[0]; 
			if($curMonth<$dob[1] || ($curMonth==$dob[1] && $curDay<$dob[2])) 
					$age--; 
			return $age; 
	}
	function total_count_byid($table,$id,$field)
	{
	
		$this->db->select('*');
	
		$this->db->from($table);
	
		$this->db->where($field, $id);
	
		$total_sold = $this->db->count_all_results();
	
		if ($total_sold > 0)
		{
			return $total_sold;
		}
	
		return NULL;
	
	}
	function sql_detial()
	{
		$sql_details = array(
                'user' => $this->db->username,
                'pass' => $this->db->password,
                'db' => $this->db->database,
                'host' => $this->db->hostname
            );
		return  $sql_details;
	}
	function random_string($length) {
    $key = '';
    $keys = array_merge(range(0, 9), range('a', 'z'));

    for ($i = 0; $i < $length; $i++) {
        $key .= $keys[array_rand($keys)];
    }

    return $key;
	}
	function update_is_active($val,$id,$fieldName,$fieldId,$tableName)
	{
		$data=array($fieldName=>$val);
		$this->db->where($fieldId,$id);
		$this->db->update($tableName,$data);
		if($val==1)
		{
			echo "<a class='fa fa-fw fa-check' onclick=\"return update_is_active(0,".$id.");\"></a>";
		}
		if($val==0)
		{
			echo "<a class='fa fa-fw fa-close' onclick=\"return update_is_active(1,".$id.");\"></a>";
		}
	}
	function update_is_verified($val,$id,$fieldName,$fieldId,$tableName)
	{
		$data=array($fieldName=>$val);
		$this->db->where($fieldId,$id);
		$this->db->update($tableName,$data);
		if($val==1)
		{
			echo "<a class='fa fa-fw fa-check' onclick=\"return update_is_verified(0,".$id.");\"></a>";
		}
		if($val==0)
		{
			echo "<a class='fa fa-fw fa-close' onclick=\"return update_is_verified(1,".$id.");\"></a>";
		}
	}
	function update_is_approve($val,$id,$fieldName,$fieldId,$tableName,$password)
	{
		if($val==1){
		$data=array($fieldName=>$val,"password"=>$password);
		$this->db->where($fieldId,$id);
		$this->db->update($tableName,$data);
		} else {
		$data=array($fieldName=>$val);
		$this->db->where($fieldId,$id);
		$this->db->update($tableName,$data);	
		}
		if($val==1)
		{
			echo "<a class='fa fa-fw fa-check' onclick=\"return update_is_approve(0,".$id.");\"></a>";
		}
		if($val==0)
		{
			echo "<a class='fa fa-fw fa-close' onclick=\"return update_is_approve(1,".$id.");\"></a>";
		}
	}
	function update_is_publish($val,$id,$fieldName,$fieldId,$tableName)
	{
		$data=array($fieldName=>$val);
		$this->db->where($fieldId,$id);
		$this->db->update($tableName,$data);
		if($val==1)
		{
			echo "<a class='fa fa-fw fa-check' onclick=\"return update_is_publish(0,".$id.");\"></a>";
		}
		if($val==0)
		{
			echo "<a class='fa fa-fw fa-close' onclick=\"return update_is_publish(1,".$id.");\"></a>";
		}
	}
	function insert_record ($tblName,$data){  // this is to insert record in database  
	
		$query = $this->db->insert($tblName, $data);
		if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }		        
    }
	function update_record ($fieldName,$id,$tblName,$data){  // this is to Update record in database  
	
		$this->db->where($fieldName, $id);
		$this->db->update($tblName, $data);
		
		if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }		
        
    } // this is to insert Update in database created end
	function update_record_with_where_and($fieldName1,$fieldName2,$id1,$id2,$tblName,$data){  // this is to Update record with were and condition in database  
	$WhereArray = array($fieldName1 => $id1, $fieldName2 => $id2);
		$this->db->where($WhereArray);
		$this->db->update($tblName, $data);
		
		if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }		
        
    }
	function GetSiteValues($key)
	{
		return  $this->common->GetValue("site_setting","value","site_key",$key);
	} 
	function generatePassword($length, $strength) {
        $vowels = '64231';
        $consonants = '1239870456';
        if ($strength & 1) {
            $consonants .= '1234567890';
        }
        if ($strength & 2) {
            $vowels .= "456789231";
        }
        if ($strength & 4) {
            $consonants .= '9876543210';
        }
        if ($strength & 8) {
            $consonants .= '123456';
        }
        $password = '';
        $alt = time() % 2;
        for ($i = 0; $i < $length; $i++) {
            if ($alt == 1) {
                $password .= $consonants[(rand() % strlen($consonants))];
                $alt = 0;
            } else {
                $password .= $vowels[(rand() % strlen($vowels))];
                $alt = 1;
            }
        }
        return $password;
    }
	
	function GetshortString($str,$len)
	{
		if(strlen($str) > $len)
		{
			$stringval = substr($str, 0, $len)."...";
		}
		else
		{
			$stringval=$str;
		}
		return $stringval;
	}
	function array_column($array,$column_name)
    {

        return array_map(function($element) use($column_name){return $element[$column_name];}, $array);

    }
	
	function get_site_setting_value()
	{
		$result = $this->db->get('site_settings');
		return $result->row();
	}
	function closetags($html) {
		preg_match_all('#<(?!meta|img|br|hr|input\b)\b([a-z]+)(?: .*)?(?<![/|/ ])>#iU', $html, $result);
		$openedtags = $result[1];
		preg_match_all('#</([a-z]+)>#iU', $html, $result);
		$closedtags = $result[1];
		$len_opened = count($openedtags);
		if (count($closedtags) == $len_opened) {
			return $html;
		}
		$openedtags = array_reverse($openedtags);
		for ($i=0; $i < $len_opened; $i++) {
			if (!in_array($openedtags[$i], $closedtags)) {
				$html .= '</'.$openedtags[$i].'>';
			} else {
				unset($closedtags[array_search($openedtags[$i], $closedtags)]);
			}
		}
    	return $html;
	}

	function is_login_redirect()
		{
			if (!$this->session->userdata('is_student_login')) {
				if($this->uri->segment(2)!="")
				{
					redirect('/login?ReturnUrl='.$this->router->fetch_class().'&method='.$this->uri->segment(2).'&id='.$this->uri->segment(3).'','refresh');
				}
				else
				{
					redirect('/login?ReturnUrl='.$this->router->fetch_class().'','refresh');
				}
			}
			
		}

}
?>