<?PHP
class Update_model extends CI_Model {
	
	public function updateFormGuide(){
		$data = array(
			'title'		=> $this->input->post('titleEdit'),			
			'detail'		=> $this->input->post('hiddendetailEdit'),
			'youtube'			=> $this->input->post('youtubeEdit'),
			'edit_adate'			=> date('Y-m-d H:i:s'),
			'edit_by'			=> $this->session->userdata('user_id'),
			'visible'		=> 'y'
		);
	
		$this->db->where('news_id', $this->input->post('editID'));
		$this->db->update('news', $data);
		echo  ($this->db->affected_rows() != 1) ? "true" : "true";
	}
	
	public function updateorder(){
		$order  = explode(",",$_POST["ordered"]);
		for($i=0; $i < count($order);$i++) {
			$data = array(	
			'sort_id'		=> $i+1
		);
		$this->db->where('news_id', $this->input->post('news_id'));
		$this->db->where('gallery_id', $order[$i]);
		$this->db->update('news_gallery', $data);
		}
		return "true";
	}
	
	
	public function updateMuseumorder(){
		$order  = explode(",",$_POST["ordered"]);
		for($i=0; $i < count($order);$i++) {
			$data = array(	
			'sort_id'		=> $i+1
		);
		$this->db->where('museum_id', $this->input->post('museum_id'));
		$this->db->where('gallery_id', $order[$i]);
		$this->db->update('museum_gallery', $data);
		}
		return "true";
	}
    
    public function updateCategoryID(){
         $data = array(
			'news_category_id'		=> $this->input->post('Editnews_category_id'),
            'edit_adate'        => date('Y-m-d H:i:s'),
            'edit_by'		    => $this->session->userdata('cmuitaccount')
		);
         $this->db->where('news_id', $this->input->post('news_id'));
		$this->db->update('news', $data);
		echo  ($this->db->affected_rows() != 1) ? "false" : "true";
    }
    
    public function updateKnoledgeID(){
         $data = array(
			'knowledge_category_id'		=> $this->input->post('Editnews_category_id'),
            'edit_adate'        => date('Y-m-d H:i:s'),
            'edit_by'		    => $this->session->userdata('cmuitaccount')
		);
         $this->db->where('news_id', $this->input->post('news_id'));
		$this->db->update('news', $data);
		echo  ($this->db->affected_rows() != 1) ? "false" : "true";
    }
	
	public function updateDepartmentFile(){
        if($this->input->post('departfile_start_dateEdit') == null){
            $startdate = date('Y-m-d H:i:s');
        }else{
         $d=strtotime($this->input->post('departfile_start_dateEdit'));
        $startdate =  (date("Y",$d)-543)."-".date("m",$d)."-".date("d",$d);
        }
        $data = array(
			
            'departfile_code'		=> $this->input->post('departfile_codeEdit'),
            'departfile_year'		=> $this->input->post('departfile_yearEdit'),
            'departfile_start_date'		=>$startdate,
            'departfile_name'		=> $this->input->post('titleEdit'),
			'departfile_udate'			=> date('Y-m-d H:i:s'),
            'departfile_session'    =>$this->session->userdata('cmuitaccount')
		);
	
		$this->db->where('departfile_id', $this->input->post('editID'));
		$this->db->update('ar_depart_file', $data);
		echo  ($this->db->affected_rows() != 1) ? "true" : "true";
    }

    public function deleteDepartmentFile(){
        $data = array(
			'is_delete'		=> 'y',
            'departfile_udate'		=> date('Y-m-d H:i:s'),
            'departfile_session'    =>$this->session->userdata('cmuitaccount')
		);
		$this->db->where('departfile_id', $this->input->post('departfile_id'));
		$this->db->update('ar_depart_file', $data);
		echo  ($this->db->affected_rows() != 1) ? "true" : "true";
    }
    
    public function deleteNews(){
        $data = array(
			'visible'		=> 'n',
            'edit_adate'        => date('Y-m-d H:i:s'),
            'edit_by'   => $this->session->userdata('cmuitaccount')
		);
		$this->db->where('news_id', $this->input->post('news_id'));
		$this->db->update('news', $data);
		echo  ($this->db->affected_rows() != 1) ? "true" : "true";
    }
    
    
     public function deletePopup(){
        $data = array(
			'is_delete'		=> 'y'
		);
		$this->db->where('popup_id', $this->input->post('popup_id'));
		$this->db->update('popup', $data);
		echo  ($this->db->affected_rows() != 1) ? "true" : "true";
    }
    
    
    
    public function deleteFile(){
        $data = array(
			'file'		=> '',
            'file_real_name'        => '',
            'edit_by'   => $this->session->userdata('cmuitaccount')
		);
		$this->db->where('news_id', $this->input->post('news_id'));
		$this->db->update('news', $data);
		echo  ($this->db->affected_rows() != 1) ? "true" : "true";
    }
    
    public function updateAboutus(){
        $data = array(
			'menusub_detail'		=> $this->input->post('hiddendetailEdit')
		);
	
		$this->db->where('menusub_id', $this->input->post('editID'));
		$this->db->update('ar_about_menu', $data);
		echo  ($this->db->affected_rows() != 1) ? "true" : "true";
    }

	
}