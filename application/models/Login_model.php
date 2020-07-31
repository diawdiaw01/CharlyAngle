<?php
class Login_model extends CI_Model {
	
	public function checkFromvLoadDetailStaff($username){
		$this->highland_info = $this->load->database('highland_info', TRUE);
		$this->highland_info->where('usr', $username);
		$this->highland_info->select('emp_id, frs_nam_tha, lst_nam_tha, department');
		$query			= $this->highland_info->get('vLoadDetailStaff')->row();
		$emp_id			= $query->emp_id;
		$frs_nam_tha	= $query->frs_nam_tha;
		$lst_nam_tha	= $query->lst_nam_tha;
		$department		= $query->department;
		$_SESSION['emp_id']			= $emp_id;
		$_SESSION['first_name']		= $frs_nam_tha;
		$_SESSION['last_name']		= $lst_nam_tha;

		$this->db->where('emp_id', $emp_id);
		$query  = $this->db->get('admin');

		$numrows = $query->num_rows();

			$expireCookie = "10800000"; // 3000 hour
			if($numrows == 1) {

				set_cookie('active', TRUE, $expireCookie); // Life Cookie 10 = 10 seconds				
				set_cookie('admin', TRUE, $expireCookie); // Life Cookie 10 = 10 seconds			
				set_cookie('emp_id', $emp_id, $expireCookie); // Life Cookie 10 = 10 seconds			
				set_cookie('fullname',$frs_nam_tha.' '.$lst_nam_tha, $expireCookie); // Life Cookie 10 = 10 seconds
				set_cookie('department',$department, $expireCookie); // Life Cookie 10 = 10 seconds
				set_cookie('status',$query->row()->status, $expireCookie); // Life Cookie 10 = 10 seconds

				return true;

			} else {
				set_cookie('active', TRUE, $expireCookie); // Life Cookie 10 = 10 seconds				
				//set_cookie('admin', FALSE, $expireCookie); // Life Cookie 10 = 10 seconds			
				set_cookie('emp_id', $emp_id, $expireCookie); // Life Cookie 10 = 10 seconds			
				set_cookie('fullname',$frs_nam_tha.' '.$lst_nam_tha, $expireCookie); // Life Cookie 10 = 10 seconds
				set_cookie('department',$department, $expireCookie); // Life Cookie 10 = 10 seconds
				set_cookie('status',$status, $expireCookie); // Life Cookie 10 = 10 seconds
			
				return true;
			}
	}





}



?>