<?php
header('Content-Type: text/html; charset=utf-8');
include($_SERVER['DOCUMENT_ROOT']."/admin/public/uploadifive/connectDB.php");
include($_SERVER['DOCUMENT_ROOT']."/admin/public/uploadifive/function.php");

	$news_id = $_REQUEST['news_id'];
	$tempFile = $_FILES['Filedata']['tmp_name'];
	$imgFile=$_FILES["Filedata"]["tmp_name"];
	$tmp=_IMGZ($imgFile);
	$imgName=time()."-".ran_all(10).".".$tmp[6];

	// Validate the file type
	$fileTypes = array('jpg','jpeg','gif','png'); // File extensions
	$fileParts = pathinfo($_FILES['Filedata']['name']);
		 ResizeFileW(1170,$imgFile,$_SERVER['DOCUMENT_ROOT']."/public/img/uploadfile/".$imgName,95);
		 cropImage($imgFile,$_SERVER['DOCUMENT_ROOT']."/public/img/uploadfile/crop/".$imgName,500,333);
		 $adate = date('Y-m-d H:i:s');
		  $sql = "update news set image = '$imgName', edit_adate = '$adate' where news_id = '$news_id' ";

			 
		if(mysql_query($sql)) { echo "true"; }