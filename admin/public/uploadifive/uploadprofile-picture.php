<?php
header('Content-Type: text/html; charset=utf-8');
include("../inc.config/config.php");
include("../inc.config/define.php");
include("../include/php/function.php");
include("../ex-function.php");
include("../inc.config/ConnectDB.php");
// Define a destination
$targetFolder = '../gallerys'; // Relative to the root

$verifyToken = md5('unique_salt' . $_POST['timestamp']);


	$tempFile = $_FILES['Filedata']['tmp_name'];
	$imgFile=$_FILES["Filedata"]["tmp_name"];
	$tmp=_IMGZ($imgFile);
	$imgName=ran_all(10).".".$tmp[6];
	$targetPath = $_SERVER['DOCUMENT_ROOT']."/".$targetFolder;
	$targetFile = rtrim($targetPath,'/') . '/' . $_FILES['Filedata']['name'];
	$targetFilethumb = rtrim($targetPath,'/') . '/cover-' . $_FILES['Filedata']['name'];
	
	// Validate the file type
	$fileTypes = array('jpg','jpeg','gif','png'); // File extensions
	$fileParts = pathinfo($_FILES['Filedata']['name']);
	

		//move_uploaded_file($tempFile,$targetFile);
		$sql = "update member set image = '$imgName' where id = '$editID'";
		mysql_query($sql);
		thumbnail($imgFile ,"../member_images/$imgName" ,150 , 150);
		 echo $imgName;
?>