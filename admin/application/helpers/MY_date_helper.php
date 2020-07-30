<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Extended date helper */
function text_thaidate($strDate=null, $time=true, $full=false)
{
    if($strDate!=null) 
        $date = strtotime($strDate);
    else 
        $date = time();

    if($full)
        $strMonth = array('','มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม');
    else
        $strMonth = array('','ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.');
            
    $strDay = date('j', $date);
    $month = date('n', $date);
    $strYear = date('Y', $date) + 543;
    
    $textDate = $strDay.' '.$strMonth[$month].' '.$strYear;
    
    if($time)
        $textDate .= date(' H:i', $date);
        
    return $textDate;
}


function text_engdate($strDate=null, $time=true, $full=false)
{
    if($strDate!=null) 
        $date = strtotime($strDate);
    else 
        $date = time();
            
    $strDOW = date('D', $date);
    $strDay = date('j', $date);
    $month  = date('F', $date);
    $strYear    = date('Y', $date);
    
    $textDate = $strDOW.', '.$strDay.' '.$month.' '.$strYear;
    
    if($time) 
        $textDate .= date(' H:i', $date);
    
    return $textDate;
}


/* End of file DA_date_helper.php */
/* Location: ./system/helpers/DA_date_helper.php */