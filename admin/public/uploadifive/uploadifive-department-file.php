<?php
header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set("Asia/Bangkok");
include($_SERVER['DOCUMENT_ROOT']."/admin/public/uploadifive/connectDB.php");
include($_SERVER['DOCUMENT_ROOT']."/admin/public/uploadifive/function.php");

	$news_id = $_REQUEST['departfile_id'];
	$tempFile = $_FILES['Filedata']['tmp_name'];
	$imgFile=$_FILES["Filedata"]["name"];
	//$tmp=_IMGZ($imgFile);
    $ext = end((explode(".", $imgFile)));
	$imgName=time()."-".ran_all(10).".".$ext;
	$realName = $_FILES["Filedata"]["name"];
	// Validate the file type
	$fileTypes = array('jpg','jpeg','gif','png'); // File extensions
	$fileParts = pathinfo($_FILES['Filedata']['name']);
		 //ResizeFileW(1170,$imgFile,$_SERVER['DOCUMENT_ROOT']."/art-culture2019-green/public/img/uploadfile/".$imgName,95);
		 //cropImage($imgFile,$_SERVER['DOCUMENT_ROOT']."/art-culture2019-green/public/img/uploadfile/crop/".$imgName,500,333);
		 move_uploaded_file($_FILES["Filedata"]["tmp_name"],$_SERVER['DOCUMENT_ROOT']."/public/img/uploadfile/".$imgName);
		 
		  $sql = "update ar_depart_file set departfile_file = '$imgName', file_real_name = '$realName' where departfile_id = '$news_id' ";

			 
		if(mysql_query($sql)) { echo "true"; }