<?PHP
class Delete_model extends CI_Model {
	
	public  function deleteGallery() {
		$deleteID = $this->input->post('gallery_id');
		$this->db->where('gallery_id',$deleteID);
		$this->db->delete('news_gallery');
		return ($this->db->affected_rows() != 1) ? "true" : "true";
	}
	
	
	public  function deleteMuseumGallery() {
		$deleteID = $this->input->post('gallery_id');
		$this->db->where('gallery_id',$deleteID);
		$this->db->delete('museum_gallery');
		return ($this->db->affected_rows() != 1) ? "true" : "true";
	}
    

	
}