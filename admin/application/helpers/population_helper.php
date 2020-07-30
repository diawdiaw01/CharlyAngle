<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Extended for text helper */


function getAllTribe()
{
	$ci=& get_instance();
	$ci->load->database();
	//$ci->db->where('prefix_id', $prefixID);
	$ci->db->order_by("tribe_id", "ASC"); 	
	$query	= $ci->db->get('trtribe');
	return $query->result();
}


/* End of file members_helper.php */