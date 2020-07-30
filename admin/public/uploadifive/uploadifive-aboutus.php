<?php
header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set("Asia/Bangkok");
include($_SERVER['DOCUMENT_ROOT']."/admin/public/uploadifive/function.php");


	$tempFile = $_FILES['Filedata']['tmp_name'];
	$imgFile=$_FILES["Filedata"]["tmp_name"];
	$tmp=_IMGZ($imgFile);
	$imgName=time()."-".ran_all(10).".".$tmp[6];

	// Validate the file type
	$fileTypes = array('jpg','jpeg','gif','png'); // File extensions
	$fileParts = pathinfo($_FILES['Filedata']['name']);
		 ResizeFileW(1170,$imgFile,$_SERVER['DOCUMENT_ROOT']."/public/img/uploadfile/".$imgName,95);
		 echo $imgName;