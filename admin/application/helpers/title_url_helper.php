<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Extended for text helper */

function title_url($title) {
		$text = str_replace(" ", "-", $title);
		return $text;
}

function split_title($title) {
	$pieces = explode(" ", $title);
	return $pieces[0].' '.$pieces[1];
}

/* End of file title_url_helper.php */
/* Location: ./system/helpers/title_url_helper.php */