<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Extended for text helper */

function setSize($text, $newwidth, $newheight){
	$nums	= substr_count($text,"width");
	$start	= 0;
	for($i=0;$i<$nums;$i++){
		$rep1_start = strpos($text,'width="',$start)+strlen('width="');   
		$rep1_end		= strpos($text,"\"",$rep1_start);  
		$len1				= $rep1_end-$rep1_start;   
		$text				= substr_replace($text,$newwidth,$rep1_start,$len1);  

		$rep2_start = strpos($text,'height="',$start)+strlen('height="');
		$rep2_end		= strpos($text,"\"",$rep2_start);
		$len2				= $rep2_end-$rep2_start;
		$text				= substr_replace($text,$newheight,$rep2_start,$len2);
		$start			= $rep2_end;
 }
 return $text;
}

/* End of file Replaceclip_helper.php */
/* Location: ./system/helpers/Replaceclip_helper.php */