<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Extended for text helper */

function sub_id($id){

$id = '00000'.$id;
$newid = substr($id, -5); //ตัดจากด้านหลัง 5 หลัก

echo $newid;

}

function sub_date($date){

$newdate = substr($date, 0, 16);

echo $newdate;

}

/* End of file sub_str_helper.php */