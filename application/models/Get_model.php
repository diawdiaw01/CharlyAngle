<?PHP
class Get_model extends CI_Model {
	

     public function loadNewsList($start){
		$this->db->where('visible', 'y');
		$this->db->order_by('add_adate', 'desc');
		$this->db->limit(8,$start);
		$query = $this->db->get('news');
		return $query->result();
	}
	
    public function getTotalRow($table){
		$query = $this->db->get($table);
        return $query->num_rows();
        
    }
    
	
	public function loadNewsCover($news_id){
		$this->db->where('news_id', $news_id);
		$this->db->order_by('sort_id', 'asc');
		$this->db->limit(1);
		$query = $this->db->get('news_gallery');
		return $query->row();
	}
	
	public function checkNewsCover($news_id){
		$this->db->where('news_id', $news_id);
		$this->db->order_by('sort_id', 'asc');
		$query = $this->db->get('news_gallery');
		return $query->num_rows();
	}
	
	public function loadNewsDetail($news_id){
		$this->db->where('news_id', $news_id);
        $this->db->where('visible', 'y');
		$query = $this->db->get('news');
		return $query->row();
	}
    
    
    
}