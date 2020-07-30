<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	function replace_underscoreToBlank($input) {
		$text	= str_replace("_", " ", $input);
		$text_2	= clear_zip_suffix($text);
		return $text_2;
	}

	function clear_zip_suffix($input)
	{
		$text = str_replace(".zip", "", $input);
		return $text;
	}
?>