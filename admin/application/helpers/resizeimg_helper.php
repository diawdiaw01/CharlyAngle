<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Extended for text helper */

function uploadAndResizeImg($photo, $NewNamePhoto, $sizePhoto) {

	$photo_tmp	= $photo['tmp_name'];
	$photo_name	= strtolower($photo['name']);
	$photo_type	= $photo['type'];
	$photo_size	= $photo['size'];
	
	//echo $sizePhoto;
	//exit();
	
	$split = '.';

	$NewName = explode($split, $photo_name);
	//echo '0 = '.$NewName[0].'<br />';
	//echo '1 = '.$NewName[1].'<br />';
	
	$photo_name = $NewNamePhoto.$sizePhoto.'.'.$NewName[1];  // NEW PHOTO NAME
	
	//echo 'New Name Photo = '.$photo_name;
	//exit();

/** CONFIG */ 
	$MAX_FILE_SIZE	= 2048000;
	$FILEPATH_REAL	= "./public/uploads/card/"; // OLD photo
	$FILEPATH_BIG		= "./public/uploads/card/big/";
	$FILEPATH_SMALL = "./public/uploads/card/thumb/"; // thumbnail
	$BigWidth		= 430; // height ของ photos_member_big
	$ThumbHeight	= 74; // height ของ photos_member_small
	//echo $photo_tmp.'<br />';
	//echo $photo_name.'<br />';
	//echo $photo_type.'<br />';
	//echo $photo_size.'<br />';
	//exit();

	if($photo_size != 0) {

		//echo 'have file';
		//exit();
		if($photo_size > $MAX_FILE_SIZE) {
			echo "<script>alert('ขนาดไฟล์ใหญ่กว่าที่กำหนดไว้'); history.back();</script>";
			exit();
		}

		if($photo_type == "image/gif")   { $ftype = "gif"; }
		if($photo_type == "image/pjpeg") { $ftype = "jpg"; }
		if($photo_type == "image/jpeg") { $ftype = "jpg"; }


		if(@$ftype != "gif" AND @$ftype != "jpg") {
			echo "<script>alert('ชนิดไฟล์ของรูปไม่ถูกต้อง'); history.back();</script>";
			exit();
		}

		//echo 'TMP = '.$photo_tmp;
		//exit();

		copy($photo_tmp, $FILEPATH_REAL.$photo_name);  
		
		if ($ftype == "gif") {
			$imgc = @ImageCreateFromGIF;
			$imgj = @ImageGIF;
		}

		if ($ftype == "jpg") {
			$imgc = @ImageCreateFromJPEG;
			$imgj = @ImageJPEG;
		}

//----------------------------------- Resize --------------------------------------/
		$images = $photo_tmp;
		//กำหนดความสูงของรูปใหม่
		$width = $BigWidth;
		$size	= GetimageSize($images);
		//$width	= round($height*$size[0]/$size[1]); // fix ตาม height
		$height	= round($width*$size[1]/$size[0]); // fix ตาม width
		$images_orig = $imgc($images);
		$photoX = ImagesX($images_orig);
		$photoY = ImagesY($images_orig); 
		$images_fin = ImageCreateTrueColor($width, $height); 
		ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width+1, $height+1, $photoX, $photoY); 
		//$imgj($images_fin,"photos_upload/photos_member_big/".$photo_name); 
		$imgj($images_fin, $FILEPATH_BIG.$photo_name); 
		ImageDestroy($images_orig);
		ImageDestroy($images_fin); 
		$photo_name2=$photo_name;
//-------------------------------------------------------------------------------------------/
		#เริ่มสร้างภาพขนาดเล็กหรือใหญ่ตามต้องการ

		$ThumbPhoto	= $FILEPATH_BIG;
		$ThumbFile	= $ThumbPhoto.$photo_name2;

		$ThumbH		= $ThumbHeight;
		$Quality	= 100;

		List($SourceW,$SourceH)=GetImageSize($ThumbFile);

		$Percent=$ThumbH/$SourceH ;
		$ThumbW=$SourceW*$Percent;

		$ImgTarget=ImageCreateTrueColor($ThumbW,$ThumbH);
		$ImgSource=$imgc($ThumbFile);

		#ImageCopyResampled($ImgTarget,$ImgSource,0,0,0,0,$ThumbW,$ThumbH,$SourceW,$SourceH);
		ImageCopyResampled($ImgTarget,$ImgSource,0,0,0,0,$ThumbW,$ThumbH,$SourceW,$SourceH);

		$imgj($ImgTarget, $FILEPATH_SMALL.$photo_name2,$Quality);

		ImageDestroy($ImgTarget);
		ImageDestroy($ImgSource);

		//unlink($FILEPATH_REAL.$photo_name);
		// เอาไว้แสดงรูป
		//echo '<img src="photos_upload/photos_member_small/'.$photo_name2.'"></img>';
		//exit();

		return $photo_name;



	}
}


/* End of file Replaceclip_helper.php */
/* Location: ./system/helpers/Replaceclip_helper.php */

