<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Extended for text helper */

function maxID($field,$table,$condition="",$debug=false)
	{
		if($condition=="")
			{
				$sql="select MAX($field) from $table";
			}
		else
			{
				$sql="select MAX($field) from $table where ".$condition;
			}

	if($debug){echo $sql;};

	$result=mysql_query($sql);

	if(mysql_num_rows($result)>0)
		{
			$row=mysql_fetch_row($result);
			$row[0]=$row[0]==null?0:$row[0];
			return $row[0];
		}else{return 0;}
}

function loadUserData($userID){
	$CI = get_instance();
    $CI->db->where('user_id', $userID);
	$CI->db->limit(1);
	$query = $CI->db->get('user');
	return $query->row();
}

function loadNewsCategoryList(){
	$CI = get_instance();
    $CI->db->where('detail', 'ข่าว');
	$CI->db->order_by('sort_id', 'asc');
	$query = $CI->db->get('news_category');
	return $query->result();
}

function loadKnowledgeCategoryList(){
	$CI = get_instance();
    $CI->db->where('visible', 'y');
	$CI->db->order_by('sort_id', 'asc');
	$query = $CI->db->get('knowlage_category');
	return $query->result();
}



function loadNewsCover($news_id){
		$ci=& get_instance();
		return $ci->Get_model->loadNewsCover($news_id);
	}
    
    function loadNewsData($news_id){
		$ci=& get_instance();
		return $ci->Get_model->loadNewsData($news_id);
	}

function TdateNoTime($d)
	{
		if(is_string($d)){$d=strtotime($d);}
		$month_name = array("มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
		return date("d",$d)." ".$month_name[date("n",$d)-1]." ".(date("Y",$d)+543);
	}
    function dateNoTime($d){
        if(is_string($d)){$d=strtotime($d);}
        return (date("Y",$d)+543)."-".date("m",$d)."-".date("d",$d);
    }
    function Tdate($d)
	{
		if(is_string($d)){$d=strtotime($d);}
		$month_name = array("ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
		return date("d",$d)." ".$month_name[date("n",$d)-1]." ".(date("Y",$d)+543).date(" H",$d).":".date("i",$d)." น.";
	}
	
    function TdateShortNoTime($d)
	{
		if(is_string($d)){$d=strtotime($d);}
		$month_name = array("ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
		return date("d",$d)." ".$month_name[date("n",$d)-1]." ".(date("Y",$d)+543);
	}
	function Tmonth($d){
		$month_name = array("มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
		return $month_name[$d-1];
	}

	function _Tdate($d)
	{
		if(is_string($d)){$d=strtotime($d);}

		$date_name = array("อาทิตย์", "จันทร์", "อังคาร", "พุธ", "พฤหัสบดี", "ศุกร์", "เสาร์");
		$month_name = array("ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
		return date("j",$d)." ".$month_name[date("n",$d)-1]." ".substr((date("Y",$d)+543),2)." เวลา ".date("H",$d).":".date("i",$d).":".date("s",$d);
	}
	
	
	///เช็คปีงบประมาณ
	function fiscalYear($date) {
   // วันที่ที่ต้องการตรวจสอบ
   list($year, $month, $day) = explode("-", $date);
   // วันที่ที่ส่งมา (mktime)
   $cday = mktime(0, 0, 0, $month, $day, $year);
   // ปีงบประมาณตามค่าที่ส่งมา (mktime)
   $d1 = mktime(0, 0, 0, 10, 1, $year );
   // ปีใหม่
   $d2 = mktime(0, 0, 0, 9, 30, $year + 1);
   if ($cday >= $d1 && $cday < $d2) {
     // 1 ตค. -  ธค.
   
$year++;
   }
   $year+=543;
   echo $year;
}


function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

/* End of file get_helper.php */