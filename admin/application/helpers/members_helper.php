<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Extended for text helper */

function getPrefix($prefixID)
{
	$ci=& get_instance();
	//$ci->load->database();
	$ci->db->where('prefix_id', $prefixID);
	$query	= $ci->db->get('trprefix');
	$rows	= $query->row();
	return $rows;
}

function getAllPrefix()
{
	$ci=& get_instance();
	//$ci->load->database();
	//$ci->db->where('prefix_id', $prefixID);
	$ci->db->order_by("prefix_id", "ASC"); 	
	$query	= $ci->db->get('trprefix');
	$rs	= $query->result();
	return $rs;
}

function getInterviewer($interviewID)
{
	$ci=& get_instance();
	//$ci->load->database();
	$ci->db->where('interviewer_id', $interviewID);
	//$ci->db->order_by("id", "ASC"); 	
	$query	= $ci->db->get('trinterviewer');
	$rows	= $query->row();

	$prefix_name = getPrefix($rows->prefix_id)->name;

	$prefix_id = $prefix_name.$rows->fname.' '.$rows->lname;

	return $prefix_id;
}

function getCountCreatedBy($createdBy)
{
	$ci=& get_instance();
	//$ci->db->like('created_by', $createdBy);
	//$ci->db->where('live', 'active');
	//$query	= $ci->db->get('tbinterview');

	$query = $ci->db->query("SELECT * FROM tbinterview WHERE created_by LIKE '%$createdBy%' AND live = 'active'");
	return $query->num_rows();
}

function getCountInterview()
{
	$ci=& get_instance();
	//$ci->db->like('created_by', $createdBy);
	$ci->db->where('live', 'active');
	$query	= $ci->db->get('tbinterview');

	//$query = $ci->db->query("SELECT * FROM tbinterview WHERE created_by LIKE '%$createdBy%' AND live = 'active'");
	return $query->num_rows();
}























function getMembers()
{
	$ci=& get_instance();
	//$ci->load->database("mis", TRUE);
	$ci->db->where('live', 'active');
	$ci->db->order_by("fname", "ASC"); 
	$query	= $ci->db->get('trinterviewer');

    return $query->result();
}

function getFullname($STAFF_INDEX)
{
	$ci=& get_instance();
	//$ci->load->database(); 
	$ci->mssql	= $ci->load->database('mssql', TRUE);
	$row		= $ci->mssql->query("SELECT * FROM UOC_STAFF where STAFF_INDEX=$STAFF_INDEX and status_id=1;")->row();
	$fname		= $row->STF_FNAME;
	$lname		= $row->STF_LNAME;
	$fullname	= $fname." ".$lname;
	
	return iconv('TIS-620', 'UTF-8', $fullname);
}


function getFac($facID)
{
	$ci=& get_instance();
	//$ci->load->database(); 
	$ci->mssql	= $ci->load->database('mssql', TRUE);
	$fac		= $ci->mssql->query("SELECT * FROM REF_DEP where FAC_ID='$facID';")->row()->DEP_NAME;
	return iconv('TIS-620', 'UTF-8', $fac);
}


/* End of file members_helper.php */