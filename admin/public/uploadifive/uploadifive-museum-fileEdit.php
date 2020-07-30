<?php
header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set("Asia/Bangkok");
include($_SERVER['DOCUMENT_ROOT']."/art-culture2019-green/admin/public/uploadifive/connectDB.php");
include($_SERVER['DOCUMENT_ROOT']."/art-culture2019-green/admin/public/uploadifive/function.php");

	$museum_id = $_REQUEST['museum_id'];
	$tempFile = $_FILES['Filedata']['tmp_name'];
	$imgFile=$_FILES["Filedata"]["name"];
	//$tmp=_IMGZ($imgFile);
    $ext = end((explode(".", $imgFile)));
	$imgName=time()."-".ran_all(10).".".$ext;
	$realName = $_FILES["Filedata"]["name"];
	// Validate the file type
	$fileTypes = array('jpg','jpeg','gif','png'); // File extensions
	$fileParts = pathinfo($_FILES['Filedata']['name']);
		 move_uploaded_file($_FILES["Filedata"]["tmp_name"],$_SERVER['DOCUMENT_ROOT']."/art-culture2019-green/public/img/uploadfile/".$imgName);
		 $adate = date('Y-m-d H:i:s');
		  echo $sql = "update museum set file = '$imgName', file_real_name = '$realName', edit_adate = '$adate' where museum_id = '$museum_id' ";

			 
		if(mysql_query($sql)) { echo "true"; }