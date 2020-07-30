<?PHP
class Get_model extends CI_Model {
	
	public function maxID($table,$condition=''){
		$query = $this->db->query("select count(*) as countdata from $table $condition");
		return $query->row()->countdata+1;
	}
	
	public function loadNewsCategory($news_category_id){
		$this->db->where('news_category_id', $news_category_id);
		$query = $this->db->get('news_category');
		return $query->row();
	}
	
	public function loadNewsList($news_category_id){
		$this->db->where('news_category_id', $news_category_id);
        $this->db->where('visible', 'y');
		$this->db->order_by('add_adate', 'desc');
		$query = $this->db->get('news');
		return $query->result();
	}
	
    public function loadNewsCover($news_id){
		$this->db->where('news_id', $news_id);
		$this->db->order_by('sort_id', 'asc');
		$this->db->limit(1);
		$query = $this->db->get('news_gallery');
		return $query->row();
	}
    
    public function loadNewsData($news_id){
		$this->db->where('news_id', $news_id);
		$this->db->limit(1);
		$query = $this->db->get('news');
		return $query->row();
	}
	
	public function loadNewsGallery($news_id){
		$this->db->where('news_id', $news_id);
		$this->db->order_by('sort_id', 'asc');
		$query = $this->db->get('news_gallery');
		return $query;
	}
	
	
}