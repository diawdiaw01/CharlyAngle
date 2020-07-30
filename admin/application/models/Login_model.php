<?php
class Login_model extends CI_Model {
	
	public function checkLogin(){
		$this->db->where('username', $this->input->post('username'));
		$this->db->where('password', $this->input->post('password'));
		$query = $this->db->get('user');
		$numrows = $query->num_rows();
		$expireCookie = "3600"; // 1 hour
		if($numrows == 1 && $query->row()->visible == 'y') {
			$data = array(
			'active'  =>  TRUE,
			'loginname' => $query->row()->name,
			'loginlevel' => $query->row()->level,
			 'user_id' =>  $query->row()->user_id
			 );
            $this->session->set_userdata($data);
			return true;
		}else{
			return false;
		}
	}





}



?>