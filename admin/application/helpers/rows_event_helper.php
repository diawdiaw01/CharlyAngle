<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Extended for text helper */

function getRowsEvent($eventID) {
	$CI =& get_instance();
	$CI->db->where("event_name_id",$eventID);
	$query = $CI->db->get('event_answer');
	return $query->num_rows();	
}


/* End of file rename_helper.php */
/* Location: ./system/helpers/note_helper.php */