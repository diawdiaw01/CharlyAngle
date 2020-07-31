<?PHP
class Delete_model extends CI_Model {
	
	public  function deletecategory() {
		$deleteID = $this->input->post('delete_parcel_category_id');
		$data = array(	
			'is_delete'		=> 'y'	
		);
		$this->db->where('parcel_category_id',$deleteID);
		$this->db->update('parcel_category', $data);
		return ($this->db->affected_rows() != 1) ? "true" : "true";
	}
	
	public  function deleteposition() {
		$deleteID = $this->input->post('delete_position_id');
		$this->db->where('position_id',$deleteID);
		$this->db->delete('position');
		return ($this->db->affected_rows() != 1) ? "true" : "true";
	}
	
	public  function deleteFollowingPositionStage() {
		$this->db->where('following_id',$_POST['following_id']);
		$this->db->where('document_id',$_POST['document_id']);
		$this->db->where('position_id',$_POST['position_id']);
		$this->db->delete('progress');
		return ($this->db->affected_rows() != 1) ? "true" : "true";
	}
	

	
}