<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Extended date helper */

function getThProvince()
{
	$ci=& get_instance();
	$ci->load->database();
	$ci->db->where('GEO_ID', '1');
	$ci->db->or_where('GEO_ID', '4');
	$ci->db->order_by("PROVINCE_NAME", "ASC"); 
	$query	= $ci->db->get('thailand_province');

    return $query->result();
}

function getAllAmphur($province_id)
{
	$ci=& get_instance();
	$ci->load->database(); 
	$ci->db->where('PROVINCE_ID', $province_id); 
	$query	= $ci->db->get('thailand_amphur');
    return $query->result();
}

function getAllThumbon($amphur_id)
{
	$ci=& get_instance();
	$ci->load->database(); 
	$ci->db->where('AMPHUR_ID', $amphur_id); 
	$query	= $ci->db->get('thailand_district');
    return $query->result();
}

function getAllVillage($district_code)
{
	$ci=& get_instance();
	$ci->load->database(); 
	$ci->db->where('DISTRICT_CODE', $district_code);
	$query	= $ci->db->get('thailand_village');
    return $query->result();
}

function getVillageName($villageID)
{
	$ci=& get_instance();
	$ci->load->database(); 
	$ci->db->where('id', $villageID);
	$query	= $ci->db->get('thailand_village');

	if(count($query->row()) >0)
		return $query->row()->VILLAGE_NAME;
}

function getDistrictName($district_code)
{
	$ci=& get_instance();
	$ci->load->database(); 
	$ci->db->where('DISTRICT_CODE', $district_code); 
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


/*
function getProvince()
{
	$ci=& get_instance();
	$ci->load->database(); 
	$query	= $ci->db->get('ssc_province');

    return $query->result();
}

function getProvinceSSC($province_id)
{
	$ci=& get_instance();
	$ci->load->database(); 
	$ci->db->where('id', $province_id); 
	$query	= $ci->db->get('ssc_province');
	$name	= $query->row()->name;

    return $name;
}

function getDistrictAll()
{
	$ci=& get_instance();
	$ci->load->database(); 
	$query	= $ci->db->get('ssc_district');

    return $query->result();
}


function getDistrict($distric_id)
{
	$ci=& get_instance();
	$ci->load->database(); 
	$ci->db->where('id', $distric_id); 
	$query	= $ci->db->get('ssc_district');
	$name	= $query->row()->name;

    return $name;
}
*/


/* End of file DA_date_helper.php */
/* Location: ./system/helpers/province_helper.php */