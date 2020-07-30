<?php
header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set("Asia/Bangkok");
include($_SERVER['DOCUMENT_ROOT']."/admin/public/uploadifive/connectDB.php");
include($_SERVER['DOCUMENT_ROOT']."/admin/public/uploadifive/function.php");

	$news_id = 1;
	$tempFile = $_FILES['Filedata']['tmp_name'];
	$imgFile=$_FILES["Filedata"]["name"];
    $ext = end((explode(".", $imgFile)));
	$imgName=time()."-".ran_all(10).".".$ext;
	$realName = $_FILES["Filedata"]["name"];
	$fileTypes = array('jpg','jpeg','gif','png'); // File extensions
	$fileParts = pathinfo($_FILES['Filedata']['name']);
    
    $sql0 = "select stf_file from ar_structure where stf_id = '$news_id'";
    $result0 = mysql_query($sql0);
    $numrows0 = mysql_num_rows($result0);
    if($numrows0 != 0){
    $rows0 = mysql_fetch_array($result0);
    unlink($_SERVER['DOCUMENT_ROOT']."/public/img/uploadfile/".$rows0['stf_file']);
    }
		 move_uploaded_file($_FILES["Filedata"]["tmp_name"],$_SERVER['DOCUMENT_ROOT']."/2019/public/img/uploadfile/".$imgName);
		 $adate = date('Y-m-d H:i:s');
		  echo $sql = "update ar_structure set stf_file = '$imgName', stf_udate = '$adate' where stf_id = '$news_id' ";

			 
		if(mysql_query($sql)) { echo "true"; }