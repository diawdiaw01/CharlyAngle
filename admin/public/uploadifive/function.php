<?
//$date_name = array("อาทิตย์", "จันทร์", "อังคาร", "พุธ", "พฤหัสบดี", "ศุกร์", "เสาร์");
$month_name = array("มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");

/* ---------------------------------------------------------------------- *\
  Function		:	For date
  Description	:	แสดงวัน,วันเวลา
  Usage			:
  Arguments	:	ไม่มี
\* ---------------------------------------------------------------------- */

function resizeImageAspectRatio($originalImagePath, $newImageName, $newImagePath){
	$original_image = imagecreatefromjpeg($imagePath);
	
	$original_image_width  = imagesx($original_image);
	$original_image_height = imagesy($original_image);
	$new_image_max_width = 170;
	$new_image_max_height = 170;
	
	$original_image_aspect_ratio = $original_image_width / $original_image_height;
	
	$profile_aspect_ratio = $new_image_max_width / $new_image_max_height;
	
	if ($original_image_width <= $new_image_max_width && $original_image_height <= $new_image_max_height) {
		$profile_image_width = $original_image_width;
		$profile_image_height = $original_image_height;
		
	} elseif ($profile_aspect_ratio > $original_image_aspect_ratio) {
		$profile_image_width = (int) ($new_image_max_height * $original_image_aspect_ratio);
		$profile_image_height = $new_image_max_height;
		
	} else {
		$profile_image_width = $new_image_max_width;
		$profile_image_height = (int) ($new_image_max_width / $original_image_aspect_ratio);
	}
	
	$new_image = imagecreatetruecolor($profile_image_width, $profile_image_height);
	imagecopyresampled($new_image, $original_image, 0, 0, 0, 0, $profile_image_width, $profile_image_height, $original_image_width, $original_image_height);
	imagejpeg($new_image, $newImagePath.$newImageName);
	imagedestroy($new_image);
}


function facebook_time($begin)
	{
		$end=date("Y:m:d H:i:s");
		$remain=intval(strtotime($end)-strtotime($begin));
		$wan=floor($remain/86400);
		$l_wan=$remain%86400;
		$hour=floor($l_wan/3600);
		$l_hour=$l_wan%3600;
		$minute=floor($l_hour/60);
		$second=$l_hour%60;
		//return "ผ่านมาแล้ว ".$wan." วัน ".$hour." ชั่วโมง ".$minute." นาที ".$second." วินาที";
		if($wan<10)
			{
				if($wan>0)
					{
						//return $wan." วัน ".$hour." ชั่วโมง ".$minute." นาที ".$second." วินาที";
						return thaiDate($wan);
					}
				elseif($hour>0)
					{
						//return $hour." ชั่วโมง ".$minute." นาที ".$second." วินาที";
						return $hour." hrs ".$minute." mins ";
					}
				elseif($minute>0)
					{
						return $minute." mins ";
					}
					elseif($second < 30){
						return "just now.";
					}
				else
					{
						return $second." secs";
					}
			}
		elseif($begin!='0000-00-00 00:00:00')
			{
				//return thaiDatenoTime($begin);
				return thaiDate($begin);
			}
	}
function _Tdate($d)
	{
		if(is_string($d)){$d=strtotime($d);}

		$date_name = array("อาทิตย์", "จันทร์", "อังคาร", "พุธ", "พฤหัสบดี", "ศุกร์", "เสาร์");
		$month_name = array("","มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
		return "วัน".$date_name[date("w",$d)]."ที่ ".date("j",$d)." ".$month_name[date("n",$d)]." พ.ศ ".(date("Y",$d)+543);
	}


function SemiThaiDateNoTime($d)
	{
		if(is_string($d)){$d=strtotime($d);}

		$date_name = array("อาทิตย์", "จันทร์", "อังคาร", "พุธ", "พฤหัสบดี", "ศุกร์", "เสาร์");
		$month_name = array("","มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
		return date("j",$d)." ".$month_name[date("n",$d)]." ".(date("Y",$d)+543);
	}
function thaiDate($d,$timestamp=0)
	{
		if(is_string($d)){$d=strtotime($d)+$timestamp;}
		$dateText=date("d",$d)."/".date("m",$d)."/".(date("Y",$d)+543)." ".date("H",$d).":".date("i",$d).":".date("s",$d);
		return $dateText;
	}

function thaiDatenoTime($d)
	{
		if(is_string($d)){$d=strtotime($d);}
		$dateText=date("d",$d)."-".date("m",$d)."-".(date("Y",$d)+543);
		return $dateText;
	}

function timeonlynosecond($d,$timestamp=0)
	{
		if(is_string($d)){$d=strtotime($d)+$timestamp;}
		$dateText=date("H",$d).":".date("i",$d);
		return $dateText;
	}


//ลบวัน
function day_diff($first_date,$second_date)
	{
		 $first_date = strtotime($first_date);
		 $second_date = strtotime($second_date);

		 $time_diff = $second_date-$first_date;
		 $day_diff = $time_diff/86400;
		 return 	$day_diff;
	}

//เพิ่มวัน
function day_sum($first_date,$num)
	{
		 $first_date = strtotime($first_date);
		 $day_sum = $first_date+(86400*$num);
		 return 	$day_sum;
	}

/* ---------------------------------------------------------------------- *\
  Function		:	For images
  Description	:	จัดการรูปภาพ
  Usage			:
  Arguments	:	ไม่มี
\* ---------------------------------------------------------------------- */

//ส่งค่าของ Size ของรูปภาพและขนาด
/*
		array[0]		กว้าง
		array[1]		ยาว
		array[2]		กว้าง*ยาว ออกมาในรูปของ width=500 height=500
		array[3]		ขนาดเป็น byte
		array[4]		ขนาดเป็น kb ปัดค่าเศษขึ้น
		array[5]		ขนาดเป็น mb ค่าเศษ 2 ตำแหน่ง
		array[6]		ชนิดของรูป

		fn จะทำการส่งค่ากลับมาเป็น array แต่ถ้า fn ส่งค่ามาเป็น 1 หมายความว่าไฟล์ที่ระบุไม่มีเป็นค่าว่าง ถ้าเป็น 2 หมายความว่าไฟล์ไม่ใช่ไฟล์รูปภาพ

*/
function _IMGZ($_objIMG)
	{
		$img=array();
		$type=array("","gif", "jpg","png","swf","psd","bmp","tiff"," tiff","jpc","jp2","jpx","jb2","swc","iff","wbmp", "xbm");

		if(is_file($_objIMG))
			{
				list($img[0],$img[1],$tmp,$img[2])=GetimageSize($_objIMG);

				if($tmp>=1 && $tmp<=16)
					{
						$img[3]=filesize($_objIMG);
						$img[4]=ceil(filesize($_objIMG)/1024);
						$img[5]=number_format((filesize($_objIMG)/1024)/1024,2);
						$img[6]=$type[$tmp];
						return $img;
					}else{return 2;}

			}else{return 1;}
	}

function ResizeFileW($newSize,$file,$newName,$quality)
		{
			$chk=false;

			$images = $file;
			//กำหนดความกว้างของรูปใหม่ ความสูงจะปรับเอง
			// เพราะโปรแกรมจะทำการคำรวณความสูงให้พอดีกับขนาดของรูปที่ได้ทำการ Resize
			$width=$newSize;
			$size=GetimageSize($images);

			//ตรวจสอบว่าขนาดของรูปน้อยกว่าที่กำหนดไหม
			if($width>=$size[0])
				{
					$width=$size[0];
					$height=$size[1];
					if(copy($file,$newName)){return true;}else{return false;}
				}
			else
				{
					//<--สลับตำแหน่ง size[1] size[0]
					$height=round($width*$size[1]/$size[0]);


			//$images_orig = ImageCreateFromJPEG($images);

			//ตรวจสอบชนิดของรูป
			//$images_orig = ($size[2] == 1) ? imagecreatefromgif($images) : imagecreatefromjpeg($images);
			switch($size[2])
				{
					case 1:{$images_orig =  imagecreatefromgif($images);break;}
					case 2:{$images_orig =  imagecreatefromjpeg($images);break;}
					case 3:{$images_orig =  imagecreatefrompng($images);break;}
				}

			$photoX = ImagesX($images_orig);
			$photoY = ImagesY($images_orig);

			//$transColor=imagecolorclosest($images_orig, 0, 0, 0);
			//imagecolortransparent($images_orig, $transColor);

			$images_fin = ImageCreateTrueColor($width, $height);

			/* Check if this image is PNG or GIF, then set if Transparent*/
			if(($size[2] == 1) OR ($size[2]==3)){
			imagealphablending($images_fin, false);
			imagesavealpha($images_fin,true);
			$transparent = imagecolorallocatealpha($images_fin, 255, 255, 255, 127);
			imagefilledrectangle($images_fin, 0, 0, $size[0], $size[1], $transparent);
			/*-------------------------------------------------------------------------*/
}

			ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width+1, $height+1, $photoX, $photoY);

			// ชื่อไฟล์ใหม่
			if($size[2]==2){if(ImageJPEG($images_fin,$newName,$quality)){$chk=true;}else{$chk=false;}}
			elseif($size[2]==1){if(ImageGIF($images_fin,$newName,$quality)){$chk=true;}else{$chk=false;}}
			elseif($size[2]==3){if(ImagePNG($images_fin,$newName,9)){$chk=true;}else{$chk=false;}}


			ImageDestroy($images_orig);
			ImageDestroy($images_fin);
			return $chk;
			}
		}

	function ResizeFileH($newSize,$file,$newName,$quality)
		{
			$images = $file;
			//กำหนดความสูงของรูปใหม่ ความกว้างจะปรับเอง
			// เพราะโปรแกรมจะทำการคำรวณความกว้างให้พอดีกับขนาดของรูปที่ได้ทำการ Resize
			$height=$newSize;
			$size=GetimageSize($images);

			//ตรวจสอบว่าขนาดของรูปน้อยกว่าที่กำหนดไหม
			if($height>$size[1])
				{
					//$width=$size[0];
					//$height=$size[1];
					if(copy($file,$newName)){return true;}else{return false;}
				}
			else
				{
					//<--สลับตำแหน่ง size[1] size[0]
					$width=round($height*$size[0]/$size[1]);


			//$images_orig = ImageCreateFromJPEG($images);

			//$images_orig = ($size[2] == 1) ? imagecreatefromgif($images) : imagecreatefromjpeg($images);
			switch($size[2])
				{
					case 1:{$images_orig =  imagecreatefromgif($images);break;}
					case 2:{$images_orig =  imagecreatefromjpeg($images);break;}
					case 3:{$images_orig =  imagecreatefrompng($images);break;}
				}

			$photoX = ImagesX($images_orig);
			$photoY = ImagesY($images_orig);

			//$transColor=imagecolorclosest($images_orig, 0, 0, 0);
			//imagecolortransparent($images_orig, $transColor);

			$images_fin = ImageCreateTrueColor($width, $height);

			/* Check if this image is PNG or GIF, then set if Transparent*/
			if(($size[2] == 1) OR ($size[2]==3)){
			imagealphablending($images_fin, false);
			imagesavealpha($images_fin,true);
			$transparent = imagecolorallocatealpha($images_fin, 255, 255, 255, 127);
			imagefilledrectangle($images_fin, 0, 0, $size[0], $size[1], $transparent);
			}
			/*-------------------------------------------------------------------------*/

			ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width+1, $height+1, $photoX, $photoY);

			// ชื่อไฟล์ใหม่
			if($size[2]==2){if(ImageJPEG($images_fin,$newName,$quality)){$chk=true;}else{$chk=false;}}
			elseif($size[2]==1){if(ImageGIF($images_fin,$newName,$quality)){$chk=true;}else{$chk=false;}}
			elseif($size[2]==3){if(ImagePNG($images_fin,$newName,$quality)){$chk=true;}else{$chk=false;}}

			ImageDestroy($images_orig);
			ImageDestroy($images_fin);
			return $chk;
			}
		}

function FixResize($newSize,$file,$NewName,$quality)
		{
			//ปรับความสูงของไฟล์

			//หาขนาดของไฟล์
			$size=GetimageSize($file);

			//ดึงค่าขนาดของไฟล์จริง
			$width=$size[0];		# กว้าง
			$height=$size[1];	# สูง

			//หาค่า % จากการย่อโดยใช้ค่าที่กำหนดมาเป็นตัวตั้ง ($newSize)
			$tmp_height=round(($newSize*100)/$height);	#round()  ปัดค่าลงให้เป็นจำนวนเต็ม เช่น 4.3 = 4
			$tmp_width=round(($newSize*100)/$width);	#round()  ปัดค่าลงให้เป็นจำนวนเต็ม เช่น 4.3 = 4

			//echo "จากกำหนดความสูง $newSize คิด % จากความสูง $height ได้เท่ากับ =".$tmp_height." %<br>";
			//echo "จากกำหนดความกว้า $newSize คิด % จากความกว้าง $width ได้เท่ากับ =".$tmp_width." %<br>";

			//ทำการย่อรูป
			//echo $width." ".$newSize." ".$height;
			//echo "นำเอาค่าที่ได้จากการหา % จากความสูงมากคิดกับความกว้างจะได้เท่ากับ ".($tmp_height/100)*$width;

			if($width<=$newSize && $height<=$newSize)
				{
					//echo "ขนาดรูปพอดี";
					/*if(!copy($file,$NewName)){echo "ไม่สามารถ Copy รูปภาพได้";}
					else{return true;}*/
					return ResizeFileIMG($width,$height,$file,$NewName,$quality);

				}
			elseif(($tmp_height/100)*$width>$newSize)
				{
					//echo "ความกว้างที่ได้มีค่ามากกว่าความสูง";
					return ResizeFileW($newSize,$file,$NewName,$quality);
				}
			else
				{
					//echo "ความย่อส่วนของความสูงให้มีขนาดพอดี";
					return ResizeFileH($newSize,$file,$NewName,$quality);
				}
			//------------------------------------------------------------

		}
function FixResizeH($newSize,$file,$NewName)
		{
			//Ѻ٧ͧ

			//ҢҴͧ
			$size=GetimageSize($file);

			//֧ҢҴͧԧ
			$width=$size[0];		# ҧ
			$height=$size[1];	# ٧

			//Ҥ % ҡҷ˹繵ǵ ($newSize)
			$tmp_height=round(($newSize*100)/$height);	#round()  Ѵŧ繨ӹǹ  4.3 = 4
			$tmp_width=round(($newSize*100)/$width);	#round()  Ѵŧ繨ӹǹ  4.3 = 4

			//echo "ҡ˹٧ $newSize Դ % ҡ٧ $height ҡѺ =".$tmp_height." %<br>";
			//echo "ҡ˹ $newSize Դ % ҡҧ $width ҡѺ =".$tmp_width." %<br>";

			//ӡٻ
			//echo $width." ".$newSize." ".$height;
			//echo "Ҥҷҡ % ҡ٧ҡԴѺҧҡѺ ".($tmp_height/100)*$width;

			if($width<=$newSize && $height<=$newSize)
				{
					//echo "Ҵٻʹ";
					if(!copy($file,$NewName)){echo "ö Copy ٻҾ";}
				}
			elseif(($tmp_height/100)*$width>$newSize)
				{
					//echo "ҧդҡҤ٧";
					ResizeFileW($newSize,$file,$NewName);
				}
			else
				{
					//echo "ǹͧ٧բҴʹ";
					ResizeFileH($newSize,$file,$NewName);
				}
			//------------------------------------------------------------

		}


function ResizeFileIMG($newSize_Width,$newSize_Hight,$file,$newName,$quality)
	{
		$images = $file;
		$width=$newSize_Width;
		$height=$newSize_Hight;
		$size=GetimageSize($images);


		//$images_orig = ImageCreateFromJPEG($images);

		//$images_orig = ($size[2] == 1) ? imagecreatefromgif($images) : imagecreatefromjpeg($images);
		switch($size[2])
			{
				case 1:{$images_orig =  imagecreatefromgif($images);break;}
				case 2:{$images_orig =  imagecreatefromjpeg($images);break;}
				case 3:{$images_orig =  imagecreatefrompng($images);break;}
			}

		$photoX = ImagesX($images_orig);
		$photoY = ImagesY($images_orig);

		//$transColor=imagecolorclosest($images_orig, 0, 0, 0);
		//imagecolortransparent($images_orig, $transColor);

		$images_fin = ImageCreateTrueColor($width, $height);
		ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width+1, $height+1, $photoX, $photoY);

		// ชื่อไฟล์ใหม่
		if(ImageJPEG($images_fin,$newName,$quality)){return true;}else{return false;}

		ImageDestroy($images_orig);
		ImageDestroy($images_fin);
	}
/* ---------------------------------------------------------------------- *\
  Function		:	For File Manager
  Description	:	จัดการไฟล์
  Usage			:
  Arguments	:	ไม่มี
\* ---------------------------------------------------------------------- */



function crop_image($image) {

    //$x_o и $y_o - Output image top left angle coordinates on input image
    //$w_o и h_o - Width and height of output image

    list($w_i, $h_i, $type) = getimagesize($image); // Return the size and image type (number)

    //calculating 16:9 ratio
    $w_o = $w_i;
    $h_o = 9 * $w_o / 16;

    //if output height is longer then width
    if ($h_i < $h_o) {
        $h_o = $h_i;
        $w_o = 16 * $h_o / 9;
    }

    $x_o = $w_i - $w_o;
    $y_o = $h_i - $h_o;

    $types = array("", "gif", "jpeg", "png"); // Array with image types
    $ext = $types[$type]; // If you know image type, "code" of image type, get type name
    if ($ext) {
      $func = 'imagecreatefrom'.$ext; // Get the function name for the type, in the way to create image
      $img_i = $func($image); // Creating the descriptor for input image
    } else {
      echo 'Incorrect image'; // Showing an error, if the image type is unsupported
      return false;
    }
    if ($x_o + $w_o > $w_i) $w_o = $w_i - $x_o; // If width of output image is bigger then input image (considering x_o), reduce it
    if ($y_o + $h_o > $h_i) $h_o = $h_i - $y_o; // If height of output image is bigger then input image (considering y_o), reduce it
    $img_o = imagecreatetruecolor($w_o, $h_o); // Creating descriptor for input image
    imagecopy($img_o, $img_i, 0, 0, $x_o/2, $y_o/2, $w_o, $h_o); // Move part of image from input to output
    $func = 'image'.$ext; // Function that allows to save the result
    return $func($img_o, $image); // Overwrite input image with output on server, return action's result    
}


function delFile($path)
	{
		if(is_file($path))
			{
				return unlink($path);
			}
		else
			{
				return false;
			}
	}

function remove_directory($dir)
	{
		 if($dir!="../" && $dir!=".." && $dir!="." && $dir!="./")
			{
		 if(substr($dir, -1, 1) == "/"){
		   $dir = substr($dir, 0, strlen($dir) - 1);
		 }
		 if ($handle = opendir("$dir")) {
		   while (false !== ($item = readdir($handle))) {
			 if ($item != "." && $item != "..") {
			   if (is_dir("$dir/$item")) { remove_directory("$dir/$item");  }
			   else { unlink("$dir/$item"); }
			 }
		   }
		   closedir($handle);
		   rmdir($dir);
		 }
			}
   }

function count_dir($dir_path)
	{
		$file_count = 0;
		$dir_count = 0;

		if (is_dir($dir_path))
			{
				if ($dh = opendir($dir_path))
					{
						while (($file = readdir($dh)) !== false)
							{
								if($file!="." && $file!=".." && $file!="0")$dir_count++;
								//echo $file."<br>";
							}
						closedir($dh);
					}
			}

		return $dir_count;
	}

function _getType($objType)
	{
		$aType=array();
		$chk=false;

		//Make Array File Type
		$aType[0]="image/pjpeg:jpg";
		$aType[1]="application/vnd.ms-excel:xls";
		$aType[2]="application/msword:doc";
		$aType[3]="application/x-zip-compressed:zip";

		for($x=0;$x<=count($aType)-1;$x++)
			{
				$tmp=explode(":",$aType[$x]);
				if($tmp[0]==$objType)
					{
						return $tmp[1];
						exit();
					}
			}

		return 0;

	}
	
	
	

//หาไฟล์ที่ระบบเปิดอยู่
function FileRUN()
	{
		//หาไฟล์ที่เปิดอยู่
		$tmp=explode("/",$_SERVER["PHP_SELF"]);
		return $tmp[count($tmp)-1];
	}



/* ---------------------------------------------------------------------- *\
  Function		:	Check Compatible
  Description	:	ตรวจสอบความเท่ากัน
  Usage			:
  Arguments	:	ไม่มี
\* ---------------------------------------------------------------------- */

function comP($x,$y,$txt)
	{
		if($x==$y){echo $txt;}
	}

function _comP($x,$y,$txt)
	{
		if($x==$y){return $txt;}
	}

//ตรวจสอบ email
function CheckEmail1($email)
	{
		return preg_match('/^[a-zA-Z0-9][a-zA-Z0-9-_.\s]+@[a-zA-Z0-9-\s].+\.[a-zA-Z]{2,5}$/',$email);
	}

function CheckEmail2($email)
	  {
		// checks proper syntax
		return preg_match("/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/" , $email);
	  }
 /* strip_selected_tags ( string str [, string strip_tags[, strip_content flag]] )
     * ---------------------------------------------------------------------
     * Like strip_tags() but inverse; the strip_tags tags will be stripped, not kept.
     * strip_tags: string with tags to strip, ex: "<a><p><quote>" etc.
     * strip_content flag: TRUE will also strip everything between open and closed tag
     */
   function strip_selected_tags($str, $tags = "", $stripContent = false)
   {
       preg_match_all("/<([^>]+)>/i",$tags,$allTags,PREG_PATTERN_ORDER);
       foreach ($allTags[1] as $tag){
           if ($stripContent) {
               $str = preg_replace("/<".$tag."[^>]*>.*<\/".$tag.">/iU","",$str);
           }
           $str = preg_replace("/<\/?".$tag."[^>]*>/iU","",$str);
       }
       return $str;
   }

/* ---------------------------------------------------------------------- *\
  Function		:	Javascript Add on
  Description	:	เรียกใช้ Javascript
  Usage			:
  Arguments	:	ไม่มี
\* ---------------------------------------------------------------------- */

function PHPalert($text)
  {
	echo '<script language="JavaScript">';
	echo "alert(\"".$text."\");";
	echo '</script>';
  }
  
  
  function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

 function PHPconfirm($text,$url)
  {
	echo '<script language="JavaScript">';
	echo "if(!confirm(\"$text\")){window.location.href=\"$url\";}";
	echo '</script>';
  }

  function PHPgourl($text)
  {
	echo '<script language="JavaScript">';
	echo 'window.location="'.$text.'";';
	echo '</script>';
  }

   function PHPmetaURL($url,$time=0)
  {
	echo "<meta http-equiv=\"refresh\" content=\"$time;URL=$url\">";
  }

  function PHPback()
  {
	echo '<script language="JavaScript">';
	echo 'history.back();';
	echo '</script>';
  }

 function PHPreload()
  {
	echo '<script language="JavaScript">';
	echo 'window.opener.location.reload();';
	echo '</script>';
  }

   function PHPJavaScript($text)
  {
	echo '<script language="JavaScript">';
	echo $text;
	echo '</script>';
  }



/* ---------------------------------------------------------------------- *\
  Function		:	Randon
  Description	:	สุ่มตัวอักษร
  Usage			:
  Arguments	:	ไม่มี
\* ---------------------------------------------------------------------- */

//สุ่มตัวเลขตามกำหนด
	function ranNum($num)
	{
		$tmp="";
		for($x=1;$x<=$num;$x++)
			{
				$tmp=$tmp.chr(rand(48,57));
			}
		return $tmp;
	}

//สุ่มตัวอักษรตามกำหนด
function ranTEXT($text,$count)
	{
		$newText="";
		if(strlen($text)>0)
			{
			  for($x=1;$x<=$count;$x++)
					{
						$newText.=substr($text,rand(0,strlen($text)-1),1);
					}
				return $newText;
			}
		else{echo "ระบุตัวอักษรที่ต้องการ";}
	}

//สุ่มเลขและตัวอักษร
function ran_all($num)
	{
		$text = "";
		for($x=1;$x<=$num;$x++)
			{
				if(rand(1,2)==2)
					{
						$text=$text.chr(rand(48,57));
					}
				else
					{
						$text=$text.chr(rand(97,122));
					}
			}
		return $text;
	}

/* ---------------------------------------------------------------------- *\
  Function		:	จัดการตัวอักษร
  Description	:
  Usage			:
  Arguments	:	ไม่มี
\* ---------------------------------------------------------------------- */
//เพิ่มเครื่องหมาย / เข้าไป
function _ads($text)
	{
		return addslashes($text);
	}

//ลบเครื่องหมาย /
function _rms($text)
	{
		return stripslashes($text);
	}
/* ---------------------------------------------------------------------- *\
  Function		:	For mysql
  Description	:	จัดการฐานข้อมูล mysql
  Usage			:
  Arguments	:	ไม่มี
\* ---------------------------------------------------------------------- */
function _FileType($file)
	{
		$type=array("","gif", "jpg","png","swf","psd","bmp","tiff"," tiff","jpc","jp2","jpx","jb2","swc","iff","wbmp", "xbm");
		list(, , $tmp, ) = getimagesize($file);
		return $type[$tmp];
	}
//ตรวจสอบค่าสูงสุดในตาราง
function maxID($field,$table,$condition="",$debug=false)
	{
		if($condition=="")
			{
				$sql="select MAX($field) from $table";
			}
		else
			{
				$sql="select MAX($field) from $table where ".$condition;
			}

	if($debug){echo $sql;};

	$result=mysql_query($sql);

	if(mysql_num_rows($result)>0)
		{
			$row=mysql_fetch_row($result);
			$row[0]=$row[0]==null?0:$row[0];
			return $row[0];
		}else{return 0;}
}

//ตรวจสอบค่าน้อยสุดในตาราง
function minID($field,$table,$condition="")
	{
		if($condition=="")
			{
				$sql="select MIN($field) from $table";
			}
		else
			{
				$sql="select MIN($field) from $table where ".$condition;
			}

	$result=mysql_query($sql);

	if(mysql_num_rows($result)>0)
		{
			$row=mysql_fetch_row($result);
			$row[0]=$row[0]==null?0:$row[0];
			return $row[0];
		}else{return 0;}
}

//ทำการ return ค่าโดยสามารถระบุตำแหน่งของ field ได้
function _SeekTo($result,$index)
	{
		if($result)
			{
				mysql_data_seek($result,$index);
				return mysql_fetch_assoc($result);
			}
		else{echo "ประมวลผลไม่ผ่าน ตรวจสอบ คำสั่ง SQL หรือตรวจสอบการติดต่อฐานข้อมูล";return false;}
	}

//Convert
function tis620_to_utf8($text) {
  $utf8 = "";
  for ($i = 0; $i < strlen($text); $i++) {
    $a = substr($text, $i, 1);
    $val = ord($a);

    if ($val < 0x80) {
      $utf8 .= $a;
    } elseif ((0xA1 <= $val && $val < 0xDA) || (0xDF <= $val && $val <= 0xFB)) {
      $unicode = 0x0E00+$val-0xA0;
      $utf8 .= chr(0xE0 | ($unicode >> 12));
      $utf8 .= chr(0x80 | (($unicode >> 6) & 0x3F));
      $utf8 .= chr(0x80 | ($unicode & 0x3F));
    }
  }
  return $utf8;
}

function utf8_to_tis620($string) {
  $str = $string;
  $res = "";
  for ($i = 0; $i < strlen($str); $i++) {
    if (ord($str[$i]) == 224) {
      $unicode = ord($str[$i+2]) & 0x3F;
      $unicode |= (ord($str[$i+1]) & 0x3F) << 6;
      $unicode |= (ord($str[$i]) & 0x0F) << 12;
      $res .= chr($unicode-0x0E00+0xA0);
      $i += 2;
    } else {
      $res .= $str[$i];
    }
  }
  return $res;
}

//ลบ array ในตำแหน่งที่ต้องการ
function array_trim ( $array, $index ) {
   if ( is_array ( $array ) ) {
     unset ( $array[$index] );
     array_unshift ( $array, array_shift ( $array ) );
     return $array;
     }
   else {
     return false;
     }
   }

function mkFolder($path)
	{
		if(!is_dir($path)){mkdir($path);}
	}

function crateFolder($path,$mode)
	{
		global $CONFIG;

		if(!is_dir($path))
			{
				if(!$CONFIG['FTP_Chmod'])
					{
						//@mkdir($path,$mode);
						mkdir($path);
					}
				if($CONFIG['FTP_Chmod']){_ftp_mkdir($CONFIG['FTP_Connect'],$CONFIG['FTP_Name'],$CONFIG['FTP_Password'],"$path",$mode);}
			}
	}

//เปลี่ยนค่า Permissions ของ Folder
function chmodFolder($server,$name,$password,$path,$mode)
	{
		// connect to ftp:
		$conn_id = ftp_connect($server);

		$login_result = ftp_login($conn_id, $name, $password);

		// set mode for the folder "uploads"
		$chmod_cmd="CHMOD $mode "."$path";

		if (!ftp_site($conn_id, $chmod_cmd)){ftp_close($conn_id);return false;}
		else{ftp_close($conn_id);return true;}
	}

//สร้างห้องพร้อมกับกำหนด Permissions ของ Folder
function _ftp_mkdir($server,$name,$password,$path,$mode)
	{
		// connect to ftp:
		$conn_id = ftp_connect($server);

		$login_result = ftp_login($conn_id, $name,$password);

		if(!is_dir($path))
			{
				if(@ftp_mkdir($conn_id, $path))
					{
						$chmod_cmd="CHMOD $mode "."$path";
						if(ftp_site($conn_id, $chmod_cmd)){ftp_close($conn_id);return true;}
						else{ftp_close($conn_id);return false;}
					}
				else
					{
						ftp_close($conn_id);
						return false;
					}
			}
	}

/*ดึงรายชื่อห้อง*/
function _folderdir($path)
	{
		if(is_dir($path))
			{
		$tmp=false;
		$d = dir($path);
		$x=0;
		while (false !== ($entry = $d->read()))
			{

				if($entry!=".." && $entry!=".")
					{
						if(is_dir("$path/$entry"))
							{
								$tmp[$x]=$entry;
								$x++;
							}
					}
			}
		$d->close();
		return $tmp;

			}else{return false;}
	}

/*ดึงไฟล์จากห้อง*/
function _filedir($path)
	{
		if(is_dir($path))
			{
		$tmp=false;
		$d = dir($path);
		$x=0;
		while (false !== ($entry = $d->read()))
			{
				if($entry!=".." && $entry!=".")
					{
						if(is_file("$path/$entry"))
							{
								$tmp[$x]=$entry;
								$x++;
							}
					}
			}
		$d->close();
		return $tmp;
			}else{return false;}
	}

/*ดึงไฟล์จากห้อง --ปรับปรุง--*/
/*
คืนค่าเป็น Array 2 มิติ
มิติที่ 1 คือลำดับ index
มิติที่ 2 คือ รายละเอียดของไฟล์ ดังนี้

[fileName] => ชื่อไฟล์
[fileSize] => ขนาด ** หน่วยเป็น byte
[lastModified] => เวลา **หน่วยเป็น timestamp
[imgWidth] => กรณีว่าประเภทไฟล์เป็นรูป จะคืนค่าความกว้างออกมา
[imgHeigth] => กรณีว่าประเภทไฟล์เป็นรูป จะคืนค่าความสุงออกมา
[imgType] =>  ประเภทของรูป


*/
function filedir($path,$chkType=true)
	{
		$type=array("","gif", "jpg","png","swf","psd","bmp","tiff"," tiff","jpc","jp2","jpx","jb2","swc","iff","wbmp", "xbm");

		if(is_dir($path))
			{

		//$tmp=array(array("fileName"=>"","fileSize"=>0,"fileType"=>"","lastModified"=>0,"imgWidth"=>0,"imgHeigth"=>0,"imgType"=>""));
		$d = dir($path);
		$x=0;
		$chk=false;
		while (false !== ($entry = $d->read()))
			{
				if($entry!=".." && $entry!=".")
					{
						$setFilePath="$path/$entry";
						if(is_file($setFilePath))
							{
								$chk=true;

								if($chkType){$name=$entry;}else{list($name,$fType)=explode(".",$entry);}

								$tmp[$x]["fileName"]=$name;
								$tmp[$x]["fileSize"]=filesize($setFilePath);
								$tmp[$x]["fileType"]=$fType;
								$tmp[$x]["lastModified"]=filemtime($setFilePath);

								//ตรวจสอบว่าเป็นรูปหรือไม่
								list($w,$h,$t,$wh)=GetimageSize($setFilePath);
								if($t>=1 && $t<=16)
									{
										$tmp[$x]["imgWidth"]=$w;
										$tmp[$x]["imgHeigth"]=$h;
										$tmp[$x]["imgType"]=$type[$t];
									}
								else
									{
										$tmp[$x]["imgWidth"]=null;
										$tmp[$x]["imgHeigth"]=null;
										$tmp[$x]["imgType"]=null;
									}

								$x++;
							}
					}
			}
		$d->close();

		if($chk){return $tmp;}else{return false;}
			}else{return false;}
	}

/*
การเรียงลำดับแอเรย์หลายมิติ เช่น แอเรย์ข้อมูลของ webboard text ที่ผมใช้งานอยู่ หรือมีลักษณะดังโค้ด


  $webboard[] = array( 'wb_id'=>4 , 'wb_topic'=> 'topic1' );
  $webboard[] = array( 'wb_id'=>5 , 'wb_topic'=> 'topic2' );
  $webboard[] = array( 'wb_id'=>2 , 'wb_topic'=> 'topic3' );
  $webboard[] = array( 'wb_id'=>1 , 'wb_topic'=> 'topic4' );


$array = แอเรย์ของข้อมูล ที่ข้อมูลต้องเป็นแอเรย์ที่มีสมาชิกไม่น้อยกว่า $column
$column = สมาชิกของตัวแปรลำดับที่ต้องการใช้เปรียบเทียบ
$sortasc = เรียงลำดับจากน้อยไปหามาก (true)
$first, $last ตัวแปรสองตัวนี้เรียกครั้งแรกไม่ต้องใส่

ที่มา http://www.goragod.com/tag-Array.html
*/
function sortcolumn(&$array, $column=0, $sortasc=true, $first=0, $last= -2)
	{
	  $keys = array_keys($array);
	  if($last == -2) $last = count($array) - 1;
	  if($last > $first) {
	  $alpha = $first;
	  $omega = $last;
	  $key_alpha = $keys[$alpha];
	  $key_omega = $keys[$omega];
	  $guess = $array[$key_alpha][$column];
	  while($omega >= $alpha) {
		if($sortasc) {
	   while($array[$key_alpha][$column] < $guess) {$alpha++; $key_alpha = $keys[$alpha]; }
	   while($array[$key_omega][$column] > $guess) {$omega--; $key_omega = $keys[$omega]; }
		} else {
	   while($array[$key_alpha][$column] > $guess) {$alpha++; $key_alpha = $keys[$alpha]; }
	   while($array[$key_omega][$column] < $guess) {$omega--; $key_omega = $keys[$omega]; }
		}
		if($alpha > $omega) break;
		$temporary = $array[$key_alpha];
		$array[$key_alpha] = $array[$key_omega];
		$alpha++;
		$key_alpha = $keys[$alpha];
		$array[$key_omega] = $temporary;
		$omega--;
		$key_omega = $keys[$omega];
		}
	  sortcolumn($array, $column, $sortasc, $first, $omega);
	  sortcolumn($array, $column, $sortasc, $alpha, $last);
	  }
	}

 /*ตัดรูปออกจาก Code  Html*\

\*-------------------------------------*/
function splitIMG($codeHtml)
	{
		if(preg_match_all('/src="(.*?)"/i', $codeHtml, $image)){return $image[1];}
		else{return false;}
	}

/*ดึงข้อความสุ่ม*/
function metacut($separator,$text)
	{
		if($text!="" && $separator!="")
			{
				$text=explode ($separator,$text);
				$text=count($text)>1?$text[rand(0, count($text)-1)]:$text[0];
				return $text;
			}
		//else{echo "ตรวจสอบรูปแบบคำสั่ง";}
	}

/*สร้าง cache ไฟล์รูป*/
function imgCache($source,$destination,$imgsize,$resolution)
	{
		//ตรวจสอบรูป
		if(!is_file($destination))
			{
				//สร้างไฟล์ Cache

				//ตรวจสอบขนาดรูป
				$TMP=_IMGZ($source);
				if($TMP[0]<=$imgsize)
					{
						if(copy($source, $destination)){return $destination;}else{return false;}
					}
				$chk=ResizeFileW($imgsize,$source,$destination,$resolution);
				return $chk==true?$destination:false;
			}
		else
			{
				return $destination;
			}
	}

function array_random($dataArray)
	{
		if($dataArray[0]!=""){
		$tmp=array();
		srand ((float) microtime() * 10000000);
		$keys = array_rand ($dataArray, sizeof($dataArray));
		while (list($k, $v) = each($keys))
			{
				$tmp[]=$dataArray[$v];
			}
		return $tmp;}
	}

//new update
function cropImage( $source , $target , $thumbwidth , $thumbheight,$quality=100)
{
 $size = getImageSize( $source );
    $w = $size[0];
    $h = $size[1];

 switch ( $size[mime] )
 {
  case 'image/gif':
   $o_im = imageCreateFromGIF( $source );
   break;
  case 'image/jpeg':
   $o_im = imageCreateFromJPEG( $source );
   break;
  case 'image/png':
   $o_im = imageCreateFromPNG( $source );
   break;
  default:
   $error = $size[mime].' ไม่รองรับ.';
   break;
 };

 if ( $error == '' )
 {
  $wm = $w / $thumbwidth;
  $hm = $h / $thumbheight;
  $h_height = $thumbheight / 2;
  $w_height = $thumbwidth / 2;

  $t_im = ImageCreateTrueColor( $thumbwidth , $thumbheight );
$backgroundColor = imagecolorallocate($t_im, 0, 0, 0);
imagefill($t_im, 0, 0, $backgroundColor);
  if(($w==$thumbwidth) && ($h==$thumbheight))
	 {
		echo "$w==$thumbwidth && $h==$thumbheight";
		copy($source , $target );
	 }
  elseif( $w > $h )
  {
   $adjusted_width = $w  / $hm;
   $half_width = $adjusted_width / 2;
   $int_width = $half_width - $w_height;
   ImageCopyResampled( $t_im , $o_im , -$int_width , 0 , 0 , 0 , $adjusted_width , $thumbheight , $w , $h );
  }
  elseif ( ( $w < $h ) || ( $w == $h ) )
  {
   $adjusted_height = $h / $wm;
   $half_height = $adjusted_height / 2;
   $int_height = $half_height - $h_height;
   ImageCopyResampled( $t_im , $o_im , 0 , -$int_height , 0 , 0 , $thumbwidth , $adjusted_height , $w , $h );
  }
  else
  {
   ImageCopyResampled( $t_im , $o_im , 0 , 0 , 0 , 0 , $thumbwidth , $thumbheight , $w , $h );
  };

  if ( !@ImageJPEG( $t_im , $target,$quality ) )
  {
   $error = "ไม่สามารถสร้างรูปได้, ตรวจสอบไดเร็คทอรี่ให้ถูกต้อง";
  };

  imageDestroy( $o_im );
  imageDestroy( $t_im );
 };

 return $error;
}

function thumbnail( $source , $target , $thumbwidth , $thumbheight)
	{
		if(is_file($target))
			{
				return $target;
			}
		else
			{
				cropImage( $source ,$target , $thumbwidth , $thumbheight );
				return  $target;
			}

	}

function openURL($url,$cookie_path="")
	{
		$ch = curl_init();
		$timeout = 0; // set to zero for no timeout
		curl_setopt ($ch, CURLOPT_URL, $url);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

		if($cookie_path!="")
			{
				curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_path);
				curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_path);
			}

		$file_contents = curl_exec($ch);
		curl_close($ch);

		return $file_contents;
	}

function openURL_Post($url,$cookie_path="",$post_url="")
	{
		$ch = curl_init();
		$timeout = 0; // set to zero for no timeout
		curl_setopt ($ch, CURLOPT_URL, $url);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		$agent = "Mozilla/5.0 (Windows; U; Windows NT 5.0; en-US; rv:1.4) Gecko/20030624 Netscape/7.1 (ax)";
		curl_setopt($ch, CURLOPT_USERAGENT, $agent);

		if($cookie_path!="")
			{
				curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_path);
				curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_path);
			}

		if($post_url!="")
			{
				curl_setopt ($ch, CURLOPT_POST, 1);
				curl_setopt ($ch, CURLOPT_POSTFIELDS, $post_url);
				curl_setopt($ch, CURLOPT_HEADER, 0);
				//$agent = "Mozilla/5.0 (Windows; U; Windows NT 5.0; en-US; rv:1.4) Gecko/20030624 Netscape/7.1 (ax)";
				curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
				//curl_setopt($ch, CURLOPT_USERAGENT, $agent);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			}

		$file_contents = curl_exec($ch);
		curl_close($ch);

		return $file_contents;
	}

function wFile($filename,$data)
	{
		if (!$handle = fopen($filename, 'w+')) {return false;	}
		if (fwrite($handle, $data) === FALSE){return false;}

		fclose($handle);
		return true;
	}

function rFile($filename)
	{
		if(is_file($filename))
			{
				if (!$handle = fopen($filename, 'r+')) {return false;}
				$contents = @fread($handle, filesize($filename));
				fclose($handle);
				return $contents;
			}
		else
			{
				return "";
			}
	}

function getKeyword($dataKey)
	{
		$key = explode("#",$dataKey);
		$key=array_random($key);
		return $key[0];
	}

function getIP()
	{
		if (!empty($_SERVER['HTTP_CLIENT_IP']))
			//check ip from share internet
			{
				$ip=$_SERVER['HTTP_CLIENT_IP'];
			}
		elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
		//to check ip is pass from proxy
			{
				$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
			}
		else
			{
				$ip=$_SERVER['REMOTE_ADDR'];
			}
		return $ip;
	}

function PHPcookie($objName,$value,$hour)
	{
		if($hour<=0)
			{
				setcookie($objName, $value,time()-(24*3600));
			}
		else
			{
				setcookie($objName, $value,time()+($hour*3600));
			}
	}

function text2mysql($obj)
	{
		return addslashes(trim($obj));
	}

function mysql2text($obj)
	{
		return stripslashes($obj);
	}

//แสดงค่า Arrray
function printArray($obj)
	{
		echo "<pre>";
		print_r($obj);
		echo "</pre>";
	}

//หา URL หน้าปัจุบัน
function curPageURL()
	{
		$pageURL = 'http';
		if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
		$pageURL .= "://";
		if ($_SERVER["SERVER_PORT"] != "80")
			{
				$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
			}
		else
			{
				$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
			}
		return $pageURL;
	}

/*Mod Rewrite By Mysignz*/
function URLfriendly($string,$encode=true)
	{
		$string=strtolower(trim($string));
		$string = strtolower(str_replace(" ","-",$string));
		$string = preg_replace('~[^a-z0-9ก-๙\.\-\_]~iu','',$string);
		$string=preg_replace("/[\-]{2,}/",'-',$string);
		return $encode==true?rawurlencode(trim($string, '-')):trim($string, '-');
	}

function html2txt ( $document )
{
        $search = array ("'<script[^>]*?>.*?</script>'si",  // strip out javascript
                "'<[\/\!]*?[^<>]*?>'si",        // strip out html tags
                "'([\r\n])[\s]+'",          // strip out white space
                "'@<![\s\S]*?â��[ \t\n\r]*>@'",
                "'&(quot|#34|#034|#x22);'i",        // replace html entities
                "'&(amp|#38|#038|#x26);'i",     // added hexadecimal values
                "'&(lt|#60|#060|#x3c);'i",
                "'&(gt|#62|#062|#x3e);'i",
                "'&(nbsp|#160|#xa0);'i",
                "'&(iexcl|#161);'i",
                "'&(cent|#162);'i",
                "'&(pound|#163);'i",
                "'&(copy|#169);'i",
                "'&(reg|#174);'i",
                "'&(deg|#176);'i",
                "'&(#39|#039|#x27);'",
                "'&(euro|#8364);'i",            // europe
                "'&a(uml|UML);'",           // german
                "'&o(uml|UML);'",
                "'&u(uml|UML);'",
                "'&A(uml|UML);'",
                "'&O(uml|UML);'",
                "'&U(uml|UML);'",
                "'&szlig;'i",
                );
        $replace = array (  "",
                    "",
                    " ",
                    "\"",
                    "&",
                    "<",
                    ">",
                    " ",
                    chr(161),
                    chr(162),
                    chr(163),
                    chr(169),
                    chr(174),
                    chr(176),
                    chr(39),
                    chr(128),
                    "Ã¤",
                    "Ã¶",
                    "Ã¼",
                    "Ã�",
                    "Ã�",
                    "Ã�",
                    "Ã�",
                );

        $text = preg_replace($search,$replace,$document);

        return trim ( $text );
}


//เข้ารหัสข้อมูลแบบ GET แบบ Array ก่อนส่ง
function urlencode_array($tmp)
	{
		for($y=0;$y<=count($tmp)-1;$y++)
			{
				if($tmp[$y]!="")
					{
						$qTmp[]=urlencode($tmp[$y]);
					}
			}
		return $qTmp;
	}

//นับจำนวนตัวอักษรระบบอักขระ UTF-8
function strlen_utf8( $str )
	{
		$i = 0;
		$count = 0;
		$len = strlen( $str );
		while ( $i < $len )
			{
				$chr = ord( $str[$i] );
				$count++;
				$i++;
				if ( $i >= $len )
					{
						break;
					};
				if ( $chr & 0x80 )
					{
						$chr <<= 1;
						while ( $chr & 0x80 )
							{
								$i++;
								$chr <<= 1;
							};
					};
			};
		return $count;
	};

//ตัดข้อความส่วนที่ต้องการในระบบอักขระ UTF-8
function substr_utf8( $str, $from , $len )
	{
		return preg_replace( '#^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$from.'}'. '((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$len.'}).*#s', '$1' , $str );
	}

//ตรวจสอบอักขระ
function checkEncoding ( $string, $string_encoding )
{
    $fs = $string_encoding == 'UTF-8' ? 'UTF-32' : $string_encoding;

    $ts = $string_encoding == 'UTF-32' ? 'UTF-8' : $string_encoding;

    return $string === mb_convert_encoding ( mb_convert_encoding ( $string, $fs, $ts ), $ts, $fs );
}


//แยกข้อความออกมาเป็นคำสั่ง SQL
function multiSelectSQL($field,$text,$type=0,$condition)
	{
		//$sqlText="";
		if($type==0)
			{
				$text=explode(" ",$text);
				for($x=0;$x<=count($text)-1;$x++)
					{
						if($text[$x]!="")
							{
								$sqlText[]="$field LIKE '%$text[$x]%'";
							}
					}
				return implode(" $condition ",$sqlText);
			}
	}

// สร้างฟังก์ชั่น สำหรับแสดงการแบ่งหน้า SQL ใช้ร่วมกับไฟล์ CSS splitpage.css
/*
รูปแบบ URL http://www.xxx.com/aaaa/$query.html
$sPage หน้าที่ส่งมา
$dataPage จำนวนหน้าทั้งหมด
$url URL ที่ทำงานอยู่
$query ค่าที่ต้องการจะส่งไปด้วยอยู่ในรูปแบบ GET
$showPage แสดงจำนวนหน้า ก่อนหน้าและย้อนหลัง
$DEBUG แสดงค่าที่ใช้ในการทำงาน
*/
function splitPage($sPage,$dataPage,$url="",$query="",$showPage=10,$DEBUG=false)
	{
		if($DEBUG){echo "หน้าที่ส่งมา :: $sPage<br>";}

		//ตรวจสอบค่าที่ต้องการจะส่งไปด้วย
		if($query!=""){

		//คำนวนหาหน้าสูงสุดต่ำสุด
		if($sPage<=$showPage)
			{
				$sP=1;
				$eP=$showPage+1;
			}
		else
			{
				$sP=$sPage-$showPage;
				$eP=$sPage+$showPage;
			}

		if($DEBUG){echo "sP = $sP :: eP = $eP";
		echo "<br />หน้าที่ส่งมาอยู่ระหว่างหน้าที่ $sP ถึง $eP<br>จำนวนหน้าทั้งหมด :: $dataPage<br>";}

		//แสดงหน้าแรกถ้าข้อมูลมากกว่า $showPage
		if($sPage>=$showPage+2)
			{
				$newQuery=str_replace("[xxx]","1",$query);
				$menu="<a href=\"$url".$newQuery."\">1</a><a class='SpaceC' style='font-size: 15px;'>›</a>";
			}

		//ตรวจสอบจำนวนสิ้นสุดของข้อมูล
		if($eP>$dataPage){$eP=$dataPage;}

		//แสดงผล
		for($x=$sP;$x<=$eP;$x++)
			{
				if($sPage==$x)
					{
						$newQuery=str_replace("[xxx]","$x",$query);
						$menu.="<a href=\"$url".$newQuery."\" class='selectPage'>$x </a>\r\n";
					}
				else
					{
						$newQuery=str_replace("[xxx]","$x",$query);
						$menu.="<a href=\"$url".$newQuery."\">$x</a>\r\n";
					}
			}

		//แสดงหน้าสุดท้าย
		if(($sPage+$showPage)<$dataPage)
			{
				$newQuery=str_replace("[xxx]","$dataPage",$query);
				$menu.="<a class='SpaceC' style='color:;font-size: 15px'>›</a><a href=\"$url".$newQuery."\">$dataPage</a>";
			}

		for($x=1;$x<=$dataPage;$x++){$listMenu.="<option "._comP($sPage,$x,"selected")." value='$x'>$x</option>\r\n";}

		//เตรียมช่อง listbox
		$newQuery=str_replace("[xxx]","'+this.value+'",$query);
		$listMenu="<select onchange=\"if(this.value!=''){window.location='$url".$newQuery."'}\" class=\"selectBox\">$listMenu</select>";

		//เตรียมปุ่ม เดินหน้า,ถอยหลัง
		if($sPage>1)
			{
				$newQuery=str_replace("[xxx]",($sPage-1),$query);
				$menu="<a class=\"naviPN\" href=\"$url".$newQuery."\" style=\"width:59px;font-size: 11px\">กลับ</a>$menu";
			}
		if($sPage<$dataPage)
			{
				$newQuery=str_replace("[xxx]",($sPage+1),$query);
				$menu="$menu<a class=\"naviPN\" href=\"$url".$newQuery."\" style=\"width:65px;font-size: 11px\">หน้าต่อไป</a>";
			}

		//echo "<div class=\"browse_page\">";
		//echo $menu."<a class='goPage'>#</a>".$listMenu;
		echo "<table class=\"browse_page\"  style=\"float:right\"><tr><td>$menu</td><td style=\"width:20px; text-align:center;color:#333333;font-size: 15px\">›</td><td>$listMenu</td></tr></table>";
		//echo "</div>";
		}
	}

// สร้างฟังก์ชั่น สำหรับแสดงการแบ่งหน้า ใช้ร่วมกับไฟล์ CSS splitpage.css
/*
$sPageText ต้องการให้แสดงค่าหน้าที่จะส่งเป็นของตัวเอง
$sPage หน้าที่ส่งมา
$start หน้าแรก
$end จำนวนหน้าสุดท้าย
$url URL ที่ทำงานอยู่
$query ค่าที่ต้องการจะส่งไปด้วยอยู่ในรูปแบบ GET
$showPage แสดงจำนวนหน้า ก่อนหน้าและย้อนหลัง
$DEBUG แสดงค่าที่ใช้ในการทำงาน
*/
function splitData($sPageText="sPage",$sPage,$start,$end,$url="",$query="",$showPage=10,$DEBUG=false)
	{
		if($DEBUG){echo "หน้าที่ส่งมา :: $sPage<br>";}

		//ตรวจสอบค่าที่ต้องการจะส่งไปด้วย
		if($query!=""){$query="&$query";}

		//คำนวนหาหน้าสูงสุดต่ำสุด
		if($sPage<=$start+$showPage)
			{
				$sP=$start;
				$eP=$showPage+$start+1;
			}
		else
			{
				$sP=$sPage-$showPage;
				$eP=$sPage+$showPage;
			}

		if($DEBUG){echo "sP = $sP :: eP = $eP";
		echo "<br />หน้าที่ส่งมาอยู่ระหว่างหน้าที่ $sP ถึง $eP<br>จำนวนหน้าทั้งหมด :: $end<br>";}

		//แสดงหน้าแรกถ้าข้อมูลมากกว่า $showPage
		if($sPage>$start+$showPage){$menu.="<a href=\"$url?$sPageText=$start".$query."\">$start</a><a class='SpaceC'>&raquo;</a>";}

		//ตรวจสอบจำนวนสิ้นสุดของข้อมูล
		if($eP>$end){$eP=$end;}

		//แสดงผล
		for($x=$sP;$x<=$eP;$x++)
			{
				$menu.=($sPage==$x)?"<a href=\"$url?$sPageText=$x".$query."\" class='selectPage'>$x</a>\r\n":"<a href=\"$url?$sPageText=$x".$query."\">$x</a>\r\n";

			}

		//แสดงหน้าสุดท้าย
		if(($sPage+$showPage)<$end){$menu.="<a class='SpaceC'>&raquo;</a><a href=\"$url?$sPageText=$end".$query."\">$end</a>";}

		for($x=$start;$x<=$end;$x++){$listMenu.="<option "._comP($sPage,$x,"selected")." value='$x'>$x</option>\r\n";}

		//เตรียมช่อง listbox
		$listMenu="<select onchange=\"if(this.value!=''){window.location='$url?$sPageText='+this.value+'".$query."'}\">$listMenu</select>";

		//เตรียมปุ่ม เดินหน้า,ถอยหลัง
		if($sPage>$start){$menu="<a class=\"naviPN\" href=\"$url?$sPageText=".($sPage-1).$query."\" style=\"width:59px;font-size: 12px\">กลับ</a>$menu";}
		if($sPage<$end){$menu="$menu<a class=\"naviPN\" href=\"$url?$sPageText=".($sPage+1).$query."\" style=\"width:65px;font-size: 12px\">หน้าต่อไป</a>";}

		echo "<div class=\"browse_page\">";
		echo $menu."<a class='goPage'>#</a>".$listMenu;
		echo "</div>";
	}

//จัดการ XML=================================
//ดึงข้อมูลจากไฟล์ XML แล้วแปลงค่าให้อยู่ในรูปแบบ Array
function xml2array($xmlData,$status=0)
	{
		if(file_exists($xmlData))
			{
				$xml=simplexml_load_file($xmlData);
			}
		else
			{
				$xml=simplexml_load_string($xmlData);
			}

		if($status==0){return object2array($xml);}
		if($status==1){echo "<pre>".print_r($xml,true)."</pre>";return object2array($xml);}
	}

//แปลง obj ที่ได้จาก XML ให้อยู่ในรูปของ Array
function object2array($object)
	{
		$return = NULL;

		if(is_array($object))
			{
				foreach($object as $key => $value)
					$return[$key] = object2array($value);
			}
		else
			{
				$var = get_object_vars($object);

				if($var)
					{
						foreach($var as $key => $value)
							$return[$key] = ($key && !$value) ? NULL : object2array($value);
					}
				else return $object;
			}

		return $return;
	}

//ตัดคำ
function createTitle($text,$setCount,$sign)
	{
		//ตัด tag ออก
		if($text=="")return "";

		$text=strip_tags($text);
		//$text=str_replace("&nbsp;&nbsp;","",$text);
		$text=str_replace("'","",$text);
		$text=str_replace("&amp;","",$text);
		$text=str_replace('"',"",$text);
		$text=str_replace("\r\n","",$text);
		$text=str_replace("#39;","",$text);
		$text=str_replace("&amp;","",$text);
		$text=preg_replace("/[\s]{2,}/",'',$text);
		$text=preg_replace("/([\&nbsp\;]){2,}/",'*',$text);
		$text=preg_replace("/[\*]{1}/",' ',$text);
		$text=clean_tag($text);

		if(strlen_utf8($text)>$setCount)
			{
				 $text=substr_utf8($text,0,$setCount)."$sign";
			}
		return $text;
	}

//ลบตัวอักษรพิเศษ
function clean_tag($text)
	{
		$text=trim(strtolower($text));
		$code_entities_match = array(' ','--','&quot;','!','@','#','$','%','^','&','*','(',')','_','+','{','}','|',':','"','<','>','?','[',']','\\',';',"'",',','.','/','*','+','~','`','=');
		$code_entities_replace = array(' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ');
		$text = str_replace($code_entities_match, $code_entities_replace, $text);
		return $text;
	}

//ตรวจสอบ browser
function browser_detection()
	{
		$useragent = $_SERVER['HTTP_USER_AGENT'];

		if (preg_match('|MSIE ([0-9].[0-9]{1,2})|',$useragent,$matched))
			{
				$browser_version=$matched[1];
				$browser = 'IE';
			}
		elseif (preg_match( '|Opera ([0-9].[0-9]{1,2})|',$useragent,$matched))
			{
				$browser_version=$matched[1];
				$browser = 'Opera';
			}
		elseif(preg_match('|Firefox/([0-9\.]+)|',$useragent,$matched))
			{
				$browser_version=$matched[1];
				$browser = 'Firefox';
			}
		elseif(preg_match('|Safari/([0-9\.]+)|',$useragent,$matched))
			{
				$browser_version=$matched[1];
				$browser = 'Safari';
			}
		else
			{
				// browser not recognized!
				$browser_version = 0;
				$browser= 'other';
			}

		return array($browser_version,$browser);
	}

//BBCODE
###############################################

//ลบค่า BBcode
function stripBBCode($text_to_search) {

 $pattern = '|[[\/\!]*?[^\[\]]*?]|si';

 $replace = '';

 return preg_replace($pattern, $replace, $text_to_search);

}

function bbcode2html($message)
	{
		  $preg = array(
          '/(?<!\\\\)\[color(?::\w+)?=(.*?)\](.*?)\[\/color(?::\w+)?\]/si'   => "<span style=\"color:\\1\">\\2</span>",
          '/(?<!\\\\)\[size(?::\w+)?=(.*?)\](.*?)\[\/size(?::\w+)?\]/si'     => "<span style=\"font-size:\\1\">\\2</span>",
          '/(?<!\\\\)\[font(?::\w+)?=(.*?)\](.*?)\[\/font(?::\w+)?\]/si'     => "<span style=\"font-family:\\1\">\\2</span>",
          '/(?<!\\\\)\[align(?::\w+)?=(.*?)\](.*?)\[\/align(?::\w+)?\]/si'   => "<div style=\"text-align:\\1\">\\2</div>",
          '/(?<!\\\\)\[b(?::\w+)?\](.*?)\[\/b(?::\w+)?\]/si'                 => "<span style=\"font-weight:bold\">\\1</span>",
          '/(?<!\\\\)\[i(?::\w+)?\](.*?)\[\/i(?::\w+)?\]/si'                 => "<span style=\"font-style:italic\">\\1</span>",
          '/(?<!\\\\)\[u(?::\w+)?\](.*?)\[\/u(?::\w+)?\]/si'                 => "<span style=\"text-decoration:underline\">\\1</span>",
          '/(?<!\\\\)\[center(?::\w+)?\](.*?)\[\/center(?::\w+)?\]/si'       => "<div style=\"text-align:center\">\\1</div>",
		  '/(?<!\\\\)\[move\](.*?)\[\/move\]/si'       => "<MARQUEE>\\1</MARQUEE>",
		  '/(?<!\\\\)\[hr\]/si'       => "<hr />",

          // [email]
          '/(?<!\\\\)\[email(?::\w+)?\](.*?)\[\/email(?::\w+)?\]/si'         => "<a href=\"mailto:\\1\" class=\"bb-email\">\\1</a>",
          '/(?<!\\\\)\[email(?::\w+)?=(.*?)\](.*?)\[\/email(?::\w+)?\]/si'   => "<a href=\"mailto:\\1\" class=\"bb-email\">\\2</a>",
          // [url]
          '/(?<!\\\\)\[url(?::\w+)?\]www\.(.*?)\[\/url(?::\w+)?\]/si'        => "<a href=\"http://www.\\1\" target=\"_blank\" class=\"bb-url\">\\1</a>",
          '/(?<!\\\\)\[url(?::\w+)?\](.*?)\[\/url(?::\w+)?\]/si'             => "<a href=\"\\1\" target=\"_blank\" class=\"bb-url\">\\1</a>",
          '/(?<!\\\\)\[url(?::\w+)?=(.*?)?\](.*?)\[\/url(?::\w+)?\]/si'      => "<a href=\"\\1\" target=\"_blank\" class=\"bb-url\">\\2</a>",
          // [img]
          '/(?<!\\\\)\[img(?::\w+)?\](.*?)\[\/img(?::\w+)?\]/si'             => "<img src=\"\\1\" alt=\"\\1\" class=\"bb-image\" />",
          '/(?<!\\\\)\[img(?::\w+)?=(.*?)x(.*?)\](.*?)\[\/img(?::\w+)?\]/si' => "<img width=\"\\1\" height=\"\\2\" src=\"\\3\" alt=\"\\3\" class=\"bb-image\" />",

          // [list]
          '/(?<!\\\\)(?:\s*<br\s*\/?>\s*)?\[\*(?::\w+)?\](.*?)(?=(?:\s*<br\s*\/?>\s*)?\[\*|(?:\s*<br\s*\/?>\s*)?\[\/?list)/si' => "\n<li class=\"bb-listitem\">\\1</li>",
          '/(?<!\\\\)(?:\s*<br\s*\/?>\s*)?\[\/list(:(?!u|o)\w+)?\](?:<br\s*\/?>)?/si'    => "\n</ul>",
          '/(?<!\\\\)(?:\s*<br\s*\/?>\s*)?\[\/list:u(:\w+)?\](?:<br\s*\/?>)?/si'         => "\n</ul>",
          '/(?<!\\\\)(?:\s*<br\s*\/?>\s*)?\[\/list:o(:\w+)?\](?:<br\s*\/?>)?/si'         => "\n</ol>",
          '/(?<!\\\\)(?:\s*<br\s*\/?>\s*)?\[list(:(?!u|o)\w+)?\]\s*(?:<br\s*\/?>)?/si'   => "\n<ul class=\"bb-list-unordered\">",
          '/(?<!\\\\)(?:\s*<br\s*\/?>\s*)?\[list:u(:\w+)?\]\s*(?:<br\s*\/?>)?/si'        => "\n<ul class=\"bb-list-unordered\">",
          '/(?<!\\\\)(?:\s*<br\s*\/?>\s*)?\[list:o(:\w+)?\]\s*(?:<br\s*\/?>)?/si'        => "\n<ol class=\"bb-list-ordered\">",
          '/(?<!\\\\)(?:\s*<br\s*\/?>\s*)?\[list(?::o)?(:\w+)?=1\]\s*(?:<br\s*\/?>)?/si' => "\n<ol class=\"bb-list-ordered,bb-list-ordered-d\">",
          '/(?<!\\\\)(?:\s*<br\s*\/?>\s*)?\[list(?::o)?(:\w+)?=i\]\s*(?:<br\s*\/?>)?/s'  => "\n<ol class=\"bb-list-ordered,bb-list-ordered-lr\">",
          '/(?<!\\\\)(?:\s*<br\s*\/?>\s*)?\[list(?::o)?(:\w+)?=I\]\s*(?:<br\s*\/?>)?/s'  => "\n<ol class=\"bb-list-ordered,bb-list-ordered-ur\">",
          '/(?<!\\\\)(?:\s*<br\s*\/?>\s*)?\[list(?::o)?(:\w+)?=a\]\s*(?:<br\s*\/?>)?/s'  => "\n<ol class=\"bb-list-ordered,bb-list-ordered-la\">",
          '/(?<!\\\\)(?:\s*<br\s*\/?>\s*)?\[list(?::o)?(:\w+)?=A\]\s*(?:<br\s*\/?>)?/s'  => "\n<ol class=\"bb-list-ordered,bb-list-ordered-ua\">",

          //line breaks
          '/\n/'                                                               => "<br>",
          // escaped tags like \[b], \[color], \[url], ...
          '/\\\\(\[\/?\w+(?::\w+)*\])/'                                      => "\\1"

		);

  $message = preg_replace(array_keys($preg), array_values($preg), $message);
  return $message;
}
###############################################
?>
