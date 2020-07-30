<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Knowledge extends CI_Controller {

public function _construct(){
	parent::_construct();
	
}

	public function index(){
         if (!isset($this->session->userdata['active'])) {
			redirect(base_url().'Login/');
		}
		$this->viewFolder	= $this->router->class;
		$data['title'] = "ข่าวสารและกิจกรรม";
		$data['content']	= $this->viewFolder.'/news_category_view';
		$this->load->view('Layouts/layout_view',$data);
	}
	
	
	public function lists($news_category_id,$knowledge_category_id,$knowlage_sub_category_id=0){
        if (!isset($this->session->userdata['active'])) {
			redirect(base_url().'Login/');
		}
		$this->viewFolder	= $this->router->class;
		$data['title'] = $this->Get_model->loadNewsCategory($news_category_id)->title;
        $data['knowledgetitle'] = $this->Get_model->loadKnowledgeCategory($knowledge_category_id)->title;
		$data['jsFile'] =  "knowledge_list_view";
		$data['content']	= $this->viewFolder.'/list_view';
		$this->load->view('Layouts/layout_view',$data);
	}
	
	
	public function loadNewsList(){
         if (!isset($this->session->userdata['active'])) {
			redirect(base_url().'Login/');
		}
		$news_category_id = $_POST['news_category_id'];
        $knowledge_category_id = $_POST['knowledge_category_id'];
		$retunrArray = $this->Get_model->loadKnowledgeList($news_category_id,$knowledge_category_id);
		foreach($retunrArray as $key => $value){
			$returnImg = $this->Get_model->loadNewsGallery($value->news_id);
			if($returnImg->num_rows() != 0){
				if($returnImg->row()->image != ''){
					$photo = '<img src="../../../../public/img/uploadfile/crop/'.$returnImg->row()->image.'" style="max-width:140px; float:left; margin-right:7px;">';
				}else{
					$photo = '<img src="../../../../public/img/nophoto.jpg" style="max-width:140px; float:left; margin-right:7px;">';
				}
			}else if($returnImg->num_rows() == 0 && $value->youtube != ''){
                $photo = '<img src="https://i.ytimg.com/vi/'.$value->youtube.'/hqdefault.jpg" style="max-width:140px; float:left; margin-right:7px;">';
			}else{
                $photo = '<img src="../../../../public/img/nophoto.jpg" style="max-width:140px; float:left; margin-right:7px;">';
            }
			
			
			if($value->visible =="y"){
				$checked = "checked";
			}else{
				$checked = "";
			}
			
			if($value->file != ''){
				$file = '<br>
			<a style="font-size:0.9em;" target="_blank"  class="text-muted" href="../../../public/img/uploadfile/'.$value->file.'"><em><i class="fas fa-paperclip"></i> '.$value->file_real_name.'</em></a>';
			}else{
				$file = '';
			}
			$addby = $value->add_by;
			$addBy = explode('@',$addby);
			$editby = $value->edit_by;
			$editBy = explode('@',$editby);
			echo '
			<tr><td class="text-center">'.($key+1).'<br><a href="#" data-id="'.$value->news_id.'" title="ลบ"  class="text-danger deleteNews"><i class="fas fa-trash-alt"></i></a></td>
			<td>'.$photo.'<a data-finishadate="'.date("Y-m-d", strtotime($value->finish_adate)).'" id="link'.stripslashes($value->news_id).'"  style="font-size:1.15em;" href="#" data-id="'.$value->news_id.'"  data-title="'.$value->title.'" data-youtube="'.$value->youtube.'" data-detail="'.htmlspecialchars($value->detail).'" data-file="'.$value->file_real_name.'" data-toggle="modal" data-target="#myModalEdit"><strong><i class="fas fa-pencil-alt"></i> '.$value->title.'</strong></a>'.$file.'
			</td>
			<td class="text-center">'.Tdate($value->add_adate).'</td>
			<td class="text-center">'.$addBy[0].'</td>
			<td class="text-center">'.Tdate($value->edit_adate).'</td>
			<td class="text-center">'.$editBy[0].'</td>
			</tr>';
		}
	}
	
	
	
	public function formAdd()
	{
         if (!isset($this->session->userdata['active'])) {
			redirect(base_url().'Login/');
		}
		echo $this->Insert_model->addFromGuideKnowledge();
	}
	
	public function updateGuideVisible(){
         if (!isset($this->session->userdata['active'])) {
			redirect(base_url().'Login/');
		}
		echo $this->Update_model->updateGuideVisible();
	}
	
	public function deleteGuide(){
         if (!isset($this->session->userdata['active'])) {
			redirect(base_url().'Login/');
		}
		echo $this->Delete_model->deleteGuide();
	}
	
	public function formEdit(){
         if (!isset($this->session->userdata['active'])) {
			redirect(base_url().'Login/');
		}
		$data = array(
			'title'		=> $this->input->post('titleEdit'),			
			'detail'		=> $this->input->post('hiddendetailEdit'),
			'youtube'			=> $this->input->post('youtube_vidEdit'),
			'edit_adate'			=> date('Y-m-d H:i:s'),
			'edit_by'			=> $this->session->userdata('cmuitaccount'),
            'finish_adate'			=> $this->input->post('finish_adateEdit'),
			'visible'		=> 'y'
		);
	
		$this->db->where('news_id', $this->input->post('editID'));
		$this->db->update('news', $data);
		echo  ($this->db->affected_rows() != 1) ? "true" : "true";
	}
	
	public function newsPhotoList(){
         if (!isset($this->session->userdata['active'])) {
			redirect(base_url().'Login/');
		}
		$news_id = $_POST['news_id'];
		$returnImg = $this->Get_model->loadNewsGallery($news_id)->result();
		foreach($returnImg as $key => $value){
			echo '<div data-id="'.$value->gallery_id.'" class="col-xs-4 col-sm-3 col-md-2 col-lg-2 ui-sortable-handle" style="margin-bottom:25px;"><img src="../../../../public/img/uploadfile/crop/'.$value->image.'" class="img-responsive gallery-img"><a href="#" data-id="'.$value->gallery_id.'" class="deleteGallery text-danger"><i class="fas fa-trash-alt"></i></a></div>';
		}
	}
	
	public function updateorder(){
         if (!isset($this->session->userdata['active'])) {
			redirect(base_url().'Login/');
		}
		echo $this->Update_model->updateorder();
	}
	
	public function deleteGallery(){
         if (!isset($this->session->userdata['active'])) {
			redirect(base_url().'Login/');
		}
		echo $this->Delete_model->deleteGallery();
	}
    
    public function updateCategoryID(){
         if (!isset($this->session->userdata['active'])) {
			redirect(base_url().'Login/');
		}
		echo $this->Update_model->updateKnoledgeID();
	}
	
    
    public function deletenews(){
		echo $this->Update_model->deleteNews();
	}
	
}
