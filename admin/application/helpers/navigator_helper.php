<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Extended for text helper */

function modules()
{
	$ci=& get_instance();
	$ci->load->database(); 
	$ci->db->order_by('order', 'asc');
	$query	= $ci->db->get('dw_module');
	$rows	= $query->result();
	return $rows;
}

function modulesACL($id)
{
	$ci=& get_instance();
	$ci->load->database();
	$ci->db->where('id', $id);
	//$ci->db->where('position', 'both');
	$ci->db->order_by('order', 'asc');
	$query	= $ci->db->get('dw_module');
	$rows	= $query->row();
	return $rows;
}

function modulesCheck($controller)
{
	$ci=& get_instance();
	$ci->load->database(); 
	$ci->db->where('controller', $controller); 
	$query	= $ci->db->get('dw_module');
	return $query->row()->id;
}

function modulesName($controller)
{
	$ci=& get_instance();
	$ci->load->database(); 
	$ci->db->where('controller', $controller); 
	$query	= $ci->db->get('dw_module');
	return $query->row()->module;
}

function submodules($controller)
{
	$ci=& get_instance();
	$ci->load->database(); 
	$ci->db->where('controller', $controller); 
	$query		= $ci->db->get('dw_module');
	$module_id	= $query->row()->id;

	$ci->db->where('module_id', $module_id); 
	$ci->db->order_by('order', 'asc');
	$query	= $ci->db->get('dw_submodule');
	$rows	= $query->result();
	return $rows;
}

function submoduleName($action)
{
	if($action=='all'):
		return '';		
		//return 'ทั้งหมด';
	else:
		$ci=& get_instance();
		$ci->load->database(); 
		$ci->db->where('action', $action); 
		$query	= $ci->db->get('dw_submodule');
		$name	= $query->row()->submodule;
		return $name;
	endif;

}

function submoduleNameBanners($module_id, $group_name)
{
		$ci=& get_instance();
		$ci->load->database(); 
		$ci->db->where('module_id', $module_id); 
		$ci->db->where('id', $group_name); 
		$query	= $ci->db->get('dw_submodule');
		$name	= $query->row()->submodule;
		return $name;
}

function categoryName($group_id)
{
		$ci=& get_instance();
		$ci->load->database();
		$ci->db->where('id', $group_id); 
		$query	= $ci->db->get('topic_group');
		return $query->row()->name;
}

/* End of file navigator_helper.php */