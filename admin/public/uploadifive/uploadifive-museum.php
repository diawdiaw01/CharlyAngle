<?php
header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set("Asia/Bangkok");
include($_SERVER['DOCUMENT_ROOT']."/admin/public/uploadifive/connectDB.php");
include($_SERVER['DOCUMENT_ROOT']."/admin/public/uploadifive/function.php");

	$museum_id = $_REQUEST['museum_id'];
	$tempFile = $_FILES['Filedata']['tmp_name'];
	$imgFile=$_FILES["Filedata"]["tmp_name"];
	$tmp=_IMGZ($imgFile);
	$imgName=time()."-".ran_all(10).".".$tmp[6];

	// Validate the file type
	$fileTypes = array('jpg','jpeg','gif','png'); // File extensions
	$fileParts = pathinfo($_FILES['Filedata']['name']);
		 FixResize(1280,$imgFile,$_SERVER['DOCUMENT_ROOT']."/public/img/uploadfile/".$imgName,95);
 //ResizeFileIMG(1280,720,$_SERVER['DOCUMENT_ROOT']."/art-culture2019-green/public/img/uploadfile/test.jpg",$_SERVER['DOCUMENT_ROOT']."/art-culture2019-green/public/img/uploadfile/test5.jpg",95);
		// cropImage($_SERVER['DOCUMENT_ROOT']."/art-culture2019-green/public/img/uploadfile/test.jpg",$_SERVER['DOCUMENT_ROOT']."/art-culture2019-green/public/img/uploadfile/test3.jpg",1280,720);
		// FixResize(500,$imgFile,$_SERVER['DOCUMENT_ROOT']."/art-culture2019-green/public/img/uploadfile/crop/".$imgName,95);
		 cropImage($imgFile,$_SERVER['DOCUMENT_ROOT']."/public/img/uploadfile/crop/".$imgName,500,333);
	 echo $sql = "INSERT INTO `museum_gallery` (`gallery_id`, `museum_id`, `image`, `caption`, `sort_id`) VALUES (NULL, '$museum_id', '$imgName', '', '0');";

			 
		if(mysql_query($sql)) { echo "true"; }