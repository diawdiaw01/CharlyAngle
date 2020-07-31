<?PHP
class Update_model extends CI_Model {
	
	public  function updateFromGuide() {

		$data = array(
			'title'		=> $this->input->post('titleEdit'),			
			'detail'		=> $this->input->post('hiddendetailEdit'),
			'youtube'			=> $this->input->post('youtube_vidEdit'),
			'edit_adate'			=> date('Y-m-d H:i:s'),
			'edit_by'			=> '',
			'visible'		=> 'y'
		);
	
		$this->db->where('news_id', $this->input->post('editID'));
		$this->db->update('news', $data);
		return ($this->db->affected_rows() != 1) ? "true" : "true";
	}
	
	public function updateNewsView($news_id,$oldView){
		$data = array(
			'views'		=> $oldView+1			
		);
	
		$this->db->where('news_id', $news_id);
		$this->db->update('news', $data);
		return ($this->db->affected_rows() != 1) ? "true" : "true";
	}
	
	
	public function updateMuseumView($museum_id,$oldView){
		$data = array(
			'views'		=> $oldView+1			
		);
	
		$this->db->where('museum_id', $museum_id);
		$this->db->update('museum', $data);
		return ($this->db->affected_rows() != 1) ? "true" : "true";
	}
	

	
}