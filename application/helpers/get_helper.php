<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Extended for text helper */


function Tdate($d)
	{
		if(is_string($d)){$d=strtotime($d);}
		$month_name = array("มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
		return date("j",$d)." ".$month_name[date("n",$d)-1]." ".(date("Y",$d)+543);
	}
	function TdateTime($d)
	{
		if(is_string($d)){$d=strtotime($d);}
		$month_name = array("มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
		return date("j",$d)." ".$month_name[date("n",$d)-1]." ".(date("Y",$d)+543)." ".date("H:i:s",$d);
	}
	
    
    function TdateNoTime($d)
	{
		if(is_string($d)){$d=strtotime($d);}
		$month_name = array("มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
		return "วันที่ ".date("j",$d)." เดือน ".$month_name[date("n",$d)-1]." พ.ศ. ".(date("Y",$d)+543);
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
		return date("j",$d)." ".$month_name[date("n",$d)-1]." ".substr((date("Y",$d)+543),2);
	}
	
    function loadDepartmentTab($departsub_id){
        $ci=& get_instance();
		return $ci->Get_model->loadDepartmentTab($departsub_id);
    }
    
	
	function loadDepartmentFile($departsub_id)
	{
		$ci=& get_instance();
		return $ci->Get_model->loadDepartmentFile($departsub_id);
	}
	
	function read_docx($filename){

    $striped_content = '';
    $content = '';

    if(!$filename || !file_exists($filename)) return false;

    $zip = zip_open($filename);
    if (!$zip || is_numeric($zip)) return false;

    while ($zip_entry = zip_read($zip)) {

        if (zip_entry_open($zip, $zip_entry) == FALSE) continue;

        if (zip_entry_name($zip_entry) != "word/document.xml") continue;

        $content .= zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));

        zip_entry_close($zip_entry);
    }
    zip_close($zip);      
    $content = str_replace('</w:r></w:p></w:tc><w:tc>', " ", $content);
    $content = str_replace('</w:r></w:p>', "\r\n", $content);
    $striped_content = strip_tags($content);

echo $striped_content;
}
    
    
	function cropImage( $source , $target , $thumbwidth , $thumbheight,$quality=100)
	{
		header('Content-Type: text/html; charset=utf-8');
		$error = "";
	 $size = getImageSize( $source );
		$w = $size[0];
		$h = $size[1];
	
	 switch ( $size['mime'] )
	 {
	  case 'image/gif':
	   $o_im = imageCreateFromGIF( $source );
	   break;
	  case 'image/jpeg':
	   $o_im = imageCreateFromJPEG( $source );
	   break;
	  case 'image/png':
	   $o_im = imageCreateFromPNG( $source );
	   break;
	  default:
	   $o_im = imageCreateFromJPEG( $source );
	   break;
	 };
	
	 if ( $error == '' )
	 {
	  $wm = $w / $thumbwidth;
	  $hm = $h / $thumbheight;
	  $h_height = $thumbheight / 2;
	  $w_height = $thumbwidth / 2;
	
	  $t_im = ImageCreateTrueColor( $thumbwidth , $thumbheight );
	$backgroundColor = imagecolorallocate($t_im, 255, 255, 255);
	imagefill($t_im, 0, 0, $backgroundColor);
	  if(($w==$thumbwidth) && ($h==$thumbheight))
		 {
			echo "$w==$thumbwidth && $h==$thumbheight";
			copy($source , $target );
		 }
	  elseif( $w > $h )
	  {
	   $adjusted_width = $w  / $hm;
	   $half_width = $adjusted_width / 2;
	   $int_width = $half_width - $w_height;
	   ImageCopyResampled( $t_im , $o_im , -$int_width , 0 , 0 , 0 , $adjusted_width , $thumbheight , $w , $h );
	  }
	  elseif ( ( $w < $h ) || ( $w == $h ) )
	  {
	   $adjusted_height = $h / $wm;
	   $half_height = $adjusted_height / 2;
	   $int_height = $half_height - $h_height;
	   ImageCopyResampled( $t_im , $o_im , 0 , -$int_height , 0 , 0 , $thumbwidth , $adjusted_height , $w , $h );
	  }
	  else
	  {
	   ImageCopyResampled( $t_im , $o_im , 0 , 0 , 0 , 0 , $thumbwidth , $thumbheight , $w , $h );
	  };
	
	  if ( !@ImageJPEG( $t_im , $target,$quality ) )
	  {
	   $error = "ไม่สามารถสร้างรูปได้, ตรวจสอบไดเร็คทอรี่ให้ถูกต้อง";
	  };
	
	  imageDestroy( $o_im );
	  imageDestroy( $t_im );
	 };
	
	 return $error;
	}
	
	
	function loadNewsCover($news_id){
		$ci=& get_instance();
		return $ci->Get_model->loadNewsCover($news_id);
	}

	
	function checkNewsCover($news_id){
		$ci=& get_instance();
		return $ci->Get_model->checkNewsCover($news_id);
	}
	
	function URLfriendly($string,$encode=true)
	{
		$string=strtolower(trim($string));
		$string = strtolower(str_replace(" ","-",$string));
		$string = preg_replace('~[^a-z0-9ก-๙\.\-\_]~iu','',$string);
		$string=preg_replace("/[\-]{2,}/",'-',$string);
		return $encode==true?rawurlencode(trim($string, '-')):trim($string, '-');
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


function notiLineAuditorium($tokenKey,$insertID,$title) {

		//1-on-1
		//audWw8hBbW88EEBr0s7SqLrZ7nA1WlqiA3lEdgcyVsF
		// IT Support
		//mK6MjKLNn5vfl0W5ThwJrMRMxIjuezJKBQEUWLo3mMO

		//$key 		= "MpZWyC6NH5HrPRfhoDoJdROI5F6GhqIubJjWeWcInRh";
        $key = $tokenKey;
		//$message 	= "ทดสอบจ้า";
/*
		$row 		= $this->get_model->getFullnameFromAD($empID)->row();
		$caseTitle 	= getSupportTypeName($caseID);
		$caseBy		= $row->frs_nam_tha.' '.$row->lst_nam_tha;
		$caseByDep	= '('.$row->department.')';*/

		$chOne = curl_init(); 
		curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
		// SSL USE 
		curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
		curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
		//POST 
		curl_setopt( $chOne, CURLOPT_POST, 1); 
		// Message 
		curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=\n\n🔔 แจ้งเตือน: ".$title."  \n\n📝 http://art-culture.cmu.ac.th/Office/linereport/".$insertID); 
		//ถ้าต้องการใส่รุป ให้ใส่ 2 parameter imageThumbnail และimageFullsize
		//curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=$message&imageThumbnail=http://mbasoftwarehouse.com/apiLine/line-noti.jpg&imageFullsize=http://mbasoftwarehouse.com/apiLine/line-noti.jpg"); 
		// follow redirects 
		curl_setopt( $chOne, CURLOPT_FOLLOWLOCATION, 1); 
		//ADD header array 
		$headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$key.'', );
		curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
		//RETURN 
		curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
		$result = curl_exec( $chOne ); 
		//Check error 
		if(curl_error($chOne)) { echo 'error:' . curl_error($chOne); } 
		else { $result_ = json_decode($result, true); 
		//echo "status : ".$result_['status']; echo "message : ". $result_['message'];
		} 
		//Close connect 
		curl_close( $chOne );
	}
    
    
    
    function loadKnowledgeCategoryList(){
	$CI = get_instance();
    $CI->db->where('visible', 'y');
	$CI->db->order_by('sort_id', 'asc');
	$query = $CI->db->get('knowlage_category');
	return $query->result();
}

function checkIfHaveSubCategoryList($catID){
    $CI = get_instance();
    $CI->db->where('visible', 'y');
    $CI->db->where('knowledge_category_id', $catID);
	$CI->db->order_by('sort_id', 'asc');
	$query = $CI->db->get('knowlage_sub_category');
	return $query->num_rows();
}

function loadKnowledgeSubCategoryList($catID){
	$CI = get_instance();
    $CI->db->where('visible', 'y');
    $CI->db->where('knowledge_category_id', $catID);
	$CI->db->order_by('sort_id', 'asc');
	$query = $CI->db->get('knowlage_sub_category');
	return $query->result();
}

function loadKnowledgeList($news_category_id,$knowledge_category_id,$knowlage_sub_category_id){
    $CI = get_instance();
    $CI->db->where('news_category_id', $news_category_id);
    $CI->db->where('knowledge_category_id', $knowledge_category_id);
    $CI->db->where('knowlage_sub_category_id', $knowlage_sub_category_id);
    $CI->db->where('visible', 'y');
    $CI->db->order_by('sort', 'asc');
    $query = $CI->db->get('news');
    return $query->result();
}


function checkPopup(){
    $CI = get_instance();
    $adate = date('Y-m-d H:i:s');
    $CI->db->where('is_delete', 'n');
    $CI->db->where('finish_adate >= ', $adate);
	$query = $CI->db->get('popup');
	return $query->num_rows();
}

function  loadPopupList(){
    $CI = get_instance();
    $adate = date('Y-m-d H:i:s');
    $CI->db->where('finish_adate >= ', $adate);
    $CI->db->where('is_delete = ', 'n');
    $query = $CI->db->get('popup');
    return $query->result();
    }

    
    function loadNewsData($news_id){
		 $CI = get_instance();
		$CI->db->where('news_id', $news_id);
		$CI->db->limit(1);
		$query = $CI->db->get('news');
		return $query->row();
	}

/* End of file get_helper.php */