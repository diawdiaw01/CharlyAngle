<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Extended for text helper */


function getReference($table, $field)
{
	$ci=& get_instance();
	$ci->load->database();
	//$ci->db->where('prefix_id', $prefixID);
	$ci->db->order_by($field, "ASC"); 	
	$query	= $ci->db->get($table);
	return $query->result();
}

function getGroupMemberName($group_member_id)
{
	$ci=& get_instance();
	$ci->load->database(); 
	$ci->db->where('group_member_id', $group_member_id);
	$query	= $ci->db->get('trgroupmember');
    return $query->row()->name;
}

function getGroupMember()
{
	$ci=& get_instance();
	$ci->load->database();
	$ci->db->order_by("group_member_id", "DESC"); 
	$query	= $ci->db->get('trgroupmember');

    return $query->result();
}


function get_month() {
	$CI =& get_instance();
	$CI->db->order_by("id", "asc"); 
	$query = $CI->db->get('trmonth');
	return $query->result();	
}

function getMonthName($id) {
	$ci=& get_instance();
	$ci->load->database(); 
	$ci->db->where('id', $id);	
	$query	= $ci->db->get('trmonth');
    return $query->row();
}

function getReferenceName($table, $id)
{
	$ci=& get_instance();
	$ci->load->database();
	$ci->db->where('id', $id);
	$query	= $ci->db->get($table);
	return $query->row()->name;
}

function getReferenceIcon($id)
{
	$ci=& get_instance();
	$ci->load->database();
	$ci->db->where('id', $id);
	$query	= $ci->db->get('trlists');
	return $query->row();
}










function __getReferenceName($table, $field, $id)
{
	$ci=& get_instance();
	$ci->load->database();
	$ci->db->where($field, $id);
	//$ci->db->order_by("id", "ASC"); 	
	$query	= $ci->db->get($table);
	return $query->row()->name;
}

function getReferenceRow($table, $field, $id)
{
	$ci=& get_instance();
	$ci->load->database();
	$ci->db->where($field, $id);
	//$ci->db->order_by("id", "ASC"); 	
	$query	= $ci->db->get($table);
	return $query->row();
}


/* End of file members_helper.php */