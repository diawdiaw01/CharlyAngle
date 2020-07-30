<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Extended date helper */

function getEtcName($interviewID, $tableType)
{
	$ci=& get_instance();
	$ci->load->database(); 

	if($ci->db->get('thetc')):
		$ci->db->where('interview_id', $interviewID);
		$ci->db->where('table_type', $tableType);		
		return $ci->db->get('thetc')->row()->name;
	else:
		return '';
	endif;
}




/* End of file area_helper.php */
/* Location: ./system/helpers/area_helper.php */