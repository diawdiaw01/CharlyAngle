<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Extended date helper */

  function getBasinBudget($idRiverBasin)
  {
	$ci=& get_instance();  	
    $ci->db->where('idRiverBasin', $idRiverBasin);    
    $query  = $ci->db->get('vw_allbasinsum');
    return number_format($query->row()->sumbudget);
  }

  function getBasinName($idRiverBasin)
  {
	$ci=& get_instance();  	
    $ci->db->where('idRiverBasin', $idRiverBasin);    
    $query  = $ci->db->get('vw_allbasinsum');
    return $query->row()->name;
  }

  function getAreaAllBasin($idRiverBasin)
  {
	$ci=& get_instance();  	
    $ci->db->where('idRiverBasin', $idRiverBasin);    
    $query  = $ci->db->get('vw_allareatarget');
    return $query->result();
  }

	function getGroupArea()
	{
		$ci=& get_instance();
		$ci->load->database("mis", TRUE);
		$ci->db->where_in('target_area_type_id', array('3','11'));	
		//$ci->db->where('target_area_type_id', '2');
		//$ci->db->or_where('target_area_type_id', '3');
		$ci->db->order_by("target_area_type_title", "ASC"); 
		$query	= $ci->db->get('trtarget_area_type');
	    return $query->result();
	}

	function getAreaAll()
	{
		$ci=& get_instance();
		$ci->load->database("mis", TRUE);
		$ci->db->select('trarea_target.*, trtarget_area_type.*');
		$ci->db->where_in('trarea_target.target_area_type_id', array('3','11'));		
		//$ci->db->where('target_area_type_id', $target_area_type_id);
		$ci->db->join('trtarget_area_type', 'trarea_target.target_area_type_id = trtarget_area_type.target_area_type_id', 'left'); 		
		$ci->db->order_by("trarea_target.target_area_type_id DESC, trarea_target.target_area_type_id ASC, trarea_target.target_name ASC"); 
		$query	= $ci->db->get('trarea_target');
		$ci->db->close();
		return $query->result();
	}

function getAreaAllDashboard()
{
	$ci=& get_instance();
	$ci->load->database("mis", TRUE);
	$ci->db->select('trarea_target.*, trtarget_area_type.*');
	$ci->db->where_in('trarea_target.target_area_type_id', array('3','11'));		
	//$ci->db->where('target_area_type_id', $target_area_type_id);
	$ci->db->join('trtarget_area_type', 'trarea_target.target_area_type_id = trtarget_area_type.target_area_type_id', 'left'); 		
	$ci->db->order_by("trarea_target.target_area_type_id DESC, trarea_target.target_area_type_id ASC, trarea_target.target_name ASC"); 
	$query	= $ci->db->get('trarea_target');
	//$ci->db->close();

	return $query->result();
}

function getAreaName($areatargetID)
{
	$ci=& get_instance();
	$ci->load->database("mis", TRUE);
	$ci->db->where('target_id', $areatargetID);	
	//$ci->db->order_by("target_area_type_id ASC, target_name ASC"); 
	$query	= $ci->db->get('trarea_target');
	$ci->db->close();
    return $query->row()->target_name;
}

function getHighlandAreaName($trarea_target_id)
{
	$ci=& get_instance();
	$ci->load->database(); 
	$ci->db->where('target_id', $trarea_target_id);	
	//$ci->db->order_by("target_name", "ASC"); 
	$query	= $ci->db->get('trarea_target');

    return $query->row()->target_name;
}




/*
function getThProvince()
{
	$ci=& get_instance();
	$ci->load->database(); 
	$query	= $ci->db->get('thailand_province');

    return $query->result();
}

function getDistrictName($district_id)
{
	$ci=& get_instance();
	$ci->load->database(); 
	$ci->db->where('DISTRICT_ID', $district_id); 
	$query	= $ci->db->get('thailand_district');
	return $query->row()->DISTRICT_NAME;
}

function getAmphurName($amphur_id)
{
	$ci=& get_instance();
	$ci->load->database(); 
	$ci->db->where('AMPHUR_ID', $amphur_id); 
	$query	= $ci->db->get('thailand_amphur');
	return $query->row()->AMPHUR_NAME;
}

function getProvinceName($privince_id)
{
	$ci=& get_instance();
	$ci->load->database(); 
	$ci->db->where('PROVINCE_ID', $privince_id); 
	$query	= $ci->db->get('thailand_province');
	return $query->row()->PROVINCE_NAME;
}
*/




/* End of file area_helper.php */
/* Location: ./system/helpers/area_helper.php */