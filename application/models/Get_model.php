<?PHP
class Get_model extends CI_Model {
	
	public function loadBoard($baordtypeNo){
		$this->db->where("hr_type", $baordtypeNo);
		$this->db->order_by('sort_id', 'asc');
		$query = $this->db->get('ar_hr');
		return $query->result();
	}
	public function loadOfficer(){
		$this->db->select('b.hr_id, a.hr_department_id, a.hr_department_title, b.hr_name, b.hr_position, b.hr_pic, b.hr_email, b.hr_tel, b.hr_resume');
		$this->db->from('hr_department_ref a'); 
		$this->db->join('ar_hr b', 'b.hr_department=a.hr_department_id', 'left');
		$this->db->order_by('a.sort_id','asc');         
		$this->db->order_by('b.sort_id','asc');         
		return $this->db->get();
	}
	
	
	public function loadDepartmentNav($department_id){
		$this->db->where("department_id", $department_id);
		$this->db->order_by('departsub_id', 'asc');
		$query = $this->db->get('ar_depart_sub');
		return $query->result();
	}
	
	public function loadDepartmentFile($departsub_id){
		$this->db->where("departsub_id", $departsub_id);
        $this->db->where("is_delete", 'n');
        $this->db->order_by('departfile_year', 'asc');
		$this->db->order_by('departfile_code', 'asc');
		$query = $this->db->get('ar_depart_file');
		return $query->result();
	}
    
    public function loadDepartmentTab($departsub_id){
         $this->db->select('departfile_year');
		$this->db->where("departsub_id", $departsub_id);
        $this->db->where("is_delete", 'n');
        $this->db->group_by('departfile_year');
		$query = $this->db->get('ar_depart_file');
		return $query->result();
    }
	
	public function loadStructure(){
		$query = $this->db->get('ar_structure');
		return $query->row();
	}
	
	
	public function loadHeritage($art_type){
		$this->db->where("art_type", $art_type);
		$this->db->order_by('art_id', 'desc');
		$query = $this->db->get('ar_article');
		return $query->result();
	}
	
    
    public function loadHeritageNewsList($news_category_id){
		$this->db->where('news_category_id', $news_category_id);
		$this->db->where('visible', 'y');
		$this->db->order_by('news_id', 'desc');
		$query = $this->db->get('news');
		return $query->result();
	}
	
	public function loadHeritagePDF($file){
		$this->db->where("art_file", $file);
		$query = $this->db->get('ar_article');
		return $query->row();
	}
	
	
	public function loadWord(){
		$this->db->order_by('lan_id', 'asc');
		$query = $this->db->get('ar_lankum');
		return $query->result();
	}
	
	public function loadHouseElement(){
		$this->db->where('gal_type', '4');
		$this->db->order_by('sort_id', 'asc');
		$query = $this->db->get('ar_gallery');
		return $query->result();
	}
	
	public function loadNewsOld($acmain_id,$act_type){
		$this->db->where('acmain_id', $acmain_id);
		$this->db->where('act_type', $act_type);
		$this->db->order_by('act_id', 'desc');
		$this->db->limit(4);
		$query = $this->db->get('ar_activities');
		return $query->result();
	}
	
	
	public function loadNews($news_category_id){
		$this->db->where('news_category_id', $news_category_id);
        $this->db->where('visible', 'y');
         if($news_category_id == 7){
            $this->db->where('finish_adate >=', date('Y-m-d H:i:s'));
        }
		$this->db->order_by('add_adate', 'desc');
		$this->db->limit(4);
		$query = $this->db->get('news');
		return $query->result();
	}
	
	public function loadReport($type){
		$this->db->where('report_type', $type);
		$this->db->order_by('report_id', 'desc');
		$query = $this->db->get('ar_report');
		return $query->result();
	}
	
	public function loadGallery($type){
		$this->db->where('gal_type', $type);
		$this->db->order_by('gal_id', 'asc');
		$query = $this->db->get('ar_gallery');
		return $query;
	}
	
	public function loadGalleryName($gal_id){
		$this->db->where('gal_id', $gal_id);
		$query = $this->db->get('ar_gallery');
		return $query->row();
	}
	
	public function loadNewsCategoryTitle($news_category_id){
		$this->db->where('news_category_id', $news_category_id);
		$query = $this->db->get('news_category');
		return $query->row();
	}
	
	public function loadGalleryDetail($gal_id){
		$this->db->where('gal_id', $gal_id);
		$this->db->order_by('gal_id', 'asc');
		$this->db->limit(30);
		$query = $this->db->get('ar_gallery_pic');
		return $query->result();
	}
	
	
	public function loadNewsList($news_category_id){
		$this->db->where('news_category_id', $news_category_id);
        if($news_category_id == 7){
            $this->db->where('finish_adate >=', date('Y-m-d H:i:s'));
        }
		$this->db->where('visible', 'y');
		$this->db->order_by('edit_adate', 'desc');
		$this->db->limit('20');
		$query = $this->db->get('news');
		return $query->result();
	}
    
    public function loadKnowledgeList($news_category_id,$knowledge_category_id){
		$this->db->where('news_category_id', $news_category_id);
        $this->db->where('knowledge_category_id', $knowledge_category_id);
		$this->db->where('visible', 'y');
		$this->db->order_by('sort', 'asc');
		$query = $this->db->get('news');
		return $query->result();
	}
    
    public function loadNewsListTests($news_category_id,$start,$per_page){
        $end = $per_page;
        $where = '';
        if($news_category_id == 7){
           $where =  "and finish_adate >= '".date('Y-m-d H:i:s')."'";
        }
        $query = $this->db->query("SELECT * FROM news WHERE news_category_id = '$news_category_id' AND visible = 'y' $where ORDER BY news_id  DESC LIMIT $start,$end");
        //return $this->db->last_query();
		return $query->result();
	}
    
     public function loadNewsListAllTests($start,$per_page){
        $end = $per_page;
        $query = $this->db->query("SELECT * FROM news WHERE  news_category_id <= '7' and visible = 'y' ORDER BY news_id  DESC LIMIT $start,$end");
		return $query->result();
	}
    
     public function loadNewsListSearchTests($start,$per_page,$keyword,$orderBy='add_adate'){
        $end = $per_page;
        
        $query = $this->db->query("SELECT * FROM news WHERE title like '%$keyword%' and  news_category_id <= '7' and visible = 'y' or detail like '%$keyword%' and  news_category_id <= '7' and visible = 'y' ORDER BY $orderBy DESC LIMIT $start,$end");
		return $query->result();
	}

    public function getTotalRow($table,$where){
        $this->db->where($where);
        $this->db->where('visible', 'y');
		$query = $this->db->get($table);
        return $query->num_rows();
        
    }
    
    public function getTotalRowAll($table){
		$query = $this->db->get($table);
        return $query->num_rows();
        
    }
    
    public function getTotalRowNewsSearch($keyword){
        $query = $this->db->query("SELECT * FROM news WHERE title like '%$keyword%' and  news_category_id <= '7' and visible = 'y' or detail like '%$keyword%' and  news_category_id <= '7' and visible = 'y'");
        return $query->num_rows();
    }
    
	public function loadNewsListAll(){
		$this->db->where('visible', 'y');
		$this->db->where('news_category_id !=', '101');
		$this->db->where('news_category_id !=', '102');
        $this->db->where('news_category_id !=', '201');
		$this->db->where('news_category_id !=', '202');
        $this->db->where('news_category_id !=', '203');
        $this->db->limit(100); 
		$this->db->order_by('news_id', 'desc');
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
	
	public function loadNewsDetail($news_id){
		$this->db->where('news_id', $news_id);
        $this->db->where('visible', 'y');
		$query = $this->db->get('news');
		return $query->row();
	}
    
    public function loadNewsDetailEmpty($news_id){
		$this->db->where('news_id', $news_id);
        $this->db->where('visible', 'y');
		$query = $this->db->get('news');
		return $query->num_rows();
	}
	
	public function loadNewsDetailGallery($news_id){
		$this->db->where('news_id', $news_id);
		$this->db->order_by('sort_id', 'asc');
		$query = $this->db->get('news_gallery');
		return $query->result();
	}
	
	public function loadMuseumList(){
		$this->db->order_by('museum_id', 'asc');
		$query = $this->db->get('museum');
		return $query->result();
	}
	
	public function loadMuseumDetail($museum_id){
		$this->db->where('museum_id', $museum_id);
		$query = $this->db->get('museum');
		return $query->row();
	}
	
	public function loadMuseumDetailGallery($museum_id){
		$this->db->where('museum_id', $museum_id);
		$this->db->order_by('sort_id', 'asc');
		$query = $this->db->get('museum_gallery');
		return $query->result();
	}
	
	
	public function loadRelatedNewsList($news_id,$news_category_id){
		$this->db->where('news_id !=', $news_id);
		$this->db->where('news_category_id', $news_category_id);
        $this->db->where('visible', 'y');
		$this->db->order_by('new_id', 'RANDOM');
		$this->db->limit(3);
		$query = $this->db->get('news');
		return $query->result();
	}
    
    public function loadRelatedNewsListKnowledge($news_id,$knowledge_category_id){
		$this->db->where('news_id !=', $news_id);
		$this->db->where('knowledge_category_id', $knowledge_category_id);
        $this->db->where('visible', 'y');
		$this->db->order_by('new_id', 'RANDOM');
		$this->db->limit(3);
		$query = $this->db->get('news');
		return $query->result();
	}
	
	public function loadVocCategory($url_method){
		if($url_method != null){
			$this->db->where('url_method',$url_method);
		}
		$this->db->where('visible','y');
		$this->db->order_by('voc_category_id', 'asc');
		$query = $this->db->get('voc_category');
		return $query;
	}
    
    public function loadAboutus($menusub_id){
        $this->db->where('menusub_id', $menusub_id);
		$query = $this->db->get('ar_about_menu');
		return $query->row();
    }
    
    public function loadAuditoriumReport($auditorium_id){
         $this->db->where('auditorium_id', $auditorium_id);
		$query = $this->db->get('auditorium');
		return $query->row();
    }
	
    public function loadKnowledgeCategory($knowledge_category_id){
		$this->db->where('knowledge_category_id', $knowledge_category_id);
		$query = $this->db->get('knowlage_category');
		return $query->row();
	}
    
}