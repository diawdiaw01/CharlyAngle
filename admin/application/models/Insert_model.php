<?php
class Insert_model extends CI_Model {
	

/***************************** IT Support  ****************************/

	


public function addFromPopup(){
    $data = array(
			'title'		=> addslashes(trim($this->input->post('hiddentitle'))),
			'link'			=> $this->input->post('link'),
			'add_adate'			=> date('Y-m-d H:i:s'),
			'finish_adate'			=> $this->input->post('finish_adate'),
			'cmuitaccount'			=> $this->session->userdata('cmuitaccount'),
            'is_read'  => $this->input->post('is_read'),
			'is_delete'		=> 'n'
		);
	
		$this->db->insert('popup', $data);
		return ($this->db->affected_rows() != 1) ? "false" : "true";
}



/***************************** /  IT Guide  ****************************/
public  function addFromGuide() {
		
		$data = array(
			'news_category_id' => $this->input->post('news_category_id'),
			'title'		=> $this->input->post('title'),			
			'detail'		=> addslashes(trim($this->input->post('hiddendetail'))),
			'youtube'			=> $this->input->post('youtube'),
			'add_adate'			=> date('Y-m-d H:i:s'),
			'add_by'			=> $this->session->userdata('user_id'),
			'edit_adate'			=> date('Y-m-d H:i:s'),
			'edit_by'			=> $this->session->userdata('user_id'),
			'visible'		=> 'y',
			'views'				=> 0,
            'sort'				=> 0
		);
	
		$this->db->insert('news', $data);
		return ($this->db->affected_rows() != 1) ? "false" : "true".":".$this->db->insert_id();
		//return ($this->db->affected_rows() != 1) ? "false" : "true".":".$this->input->post('inventory_id');	
	}

/***************************** /  IT Guide  ****************************/


public  function addFromGuideKnowledge() {
		
		$data = array(
			'news_category_id' => $this->input->post('news_category_id'),
            'knowledge_category_id' => $this->input->post('knowledge_category_id'),
            'knowlage_sub_category_id' =>'1',
			'title'		=> $this->input->post('title'),			
			'detail'		=> addslashes(trim($this->input->post('hiddendetail'))),
			'youtube'			=> $this->input->post('youtube_vid'),
			'image'		=> '',
			'file'		=> '',
			'file_real_name'		=> '',
			'add_adate'			=> date('Y-m-d H:i:s'),
			'add_by'			=> $this->session->userdata('cmuitaccount'),
			'edit_adate'			=> date('Y-m-d H:i:s'),
			'edit_by'			=> $this->session->userdata('cmuitaccount'),
            'finish_adate'  => $this->input->post('finish_adate'),
			'visible'		=> 'y',
			'views'				=> 0
		);
	
		$this->db->insert('news', $data);
		return ($this->db->affected_rows() != 1) ? "false" : "true".":".$this->db->insert_id();
		//return ($this->db->affected_rows() != 1) ? "false" : "true".":".$this->input->post('inventory_id');	
	}


public  function addDepartmentFile() {
		if($this->input->post('departfile_start_date') == null){
            $startdate = date('Y-m-d H:i:s');
        }else{
       $d=strtotime($this->input->post('departfile_start_date'));
        $startdate =  (date("Y",$d)-543)."-".date("m",$d)."-".date("d",$d);

        }
		$data = array(
			'departsub_id' => $this->input->post('news_category_id'),
            'departfile_code'		=> $this->input->post('departfile_code'),
            'departfile_year'		=> $this->input->post('departfile_year'),
            'departfile_start_date'			=> $startdate,
			'departfile_name'		=> $this->input->post('title'),			
			'departfile_udate'			=> date('Y-m-d H:i:s'),
            'departfile_session'    => $this->session->userdata('cmuitaccount'),
            'is_delete'			=> 'n'
		);
	
		$this->db->insert('ar_depart_file', $data);
		return ($this->db->affected_rows() != 1) ? "false" : "true".":".$this->db->insert_id();
		//return ($this->db->affected_rows() != 1) ? "false" : "true".":".$this->input->post('inventory_id');	
	}



}


?>