<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends CI_Controller {

public function _construct(){
	parent::_construct();
	
}


	
	
	public function lists($news_category_id){
        if (!isset($this->session->userdata['active'])) {
			redirect(base_url().'Login/');
		}
		$this->viewFolder	= $this->router->class;
		$data['title'] = $this->Get_model->loadNewsCategory($news_category_id)->title;
		$data['jsFile'] =  "news_list_view";
		$data['content']	= $this->viewFolder.'/list_view';
		$this->load->view('Layouts/layout_view',$data);
	}
	
	
	public function loadNewsList(){
         if (!isset($this->session->userdata['active'])) {
			redirect(base_url().'Login/');
		}
		$news_category_id = $_POST['news_category_id'];
		$retunrArray = $this->Get_model->loadNewsList($news_category_id);
		foreach($retunrArray as $key => $value){
			$returnImg = $this->Get_model->loadNewsGallery($value->news_id);
			if($returnImg->num_rows() != 0){
				if($returnImg->row()->image != ''){
					$photo = '<img src="../../../public/img/uploadfile/crop/'.$returnImg->row()->image.'" style="max-width:140px; float:left; margin-right:7px;">';
				}else{
					$photo = '<img src="../../../public/img/nophoto.jpg" style="max-width:140px; float:left; margin-right:7px;">';
				}
			}/*else if($returnImg->num_rows() == 0 && $value->youtube != ''){
                $photo = '<img src="https://i.ytimg.com/vi/'.$value->youtube.'/hqdefault.jpg" style="max-width:140px; float:left; margin-right:7px;">';
			}*/else{
                $photo = '<img src="../../../public/img/nophoto.jpg" style="max-width:140px; float:left; margin-right:7px;">';
            }
			
			
			if($value->visible =="y"){
				$checked = "checked";
			}else{
				$checked = "";
			}
			echo '
			<tr><td class="text-center">'.($key+1).'<br><a href="#" data-id="'.$value->news_id.'" title="ลบ"  class="text-danger deleteNews"><i class="fas fa-trash-alt"></i></a></td>
			<td>'.$photo.'<a  id="link'.stripslashes($value->news_id).'"  style="font-size:1.15em;" href="#" data-id="'.$value->news_id.'"  data-title="'.$value->title.'" data-youtube="'.$value->youtube.'" data-detail="'.htmlspecialchars($value->detail).'" data-toggle="modal" data-target="#myModalEdit"><strong> '.$value->title.' <i class="far fa-edit"></i></strong></a>
			</td>
			<td class="text-center">'.Tdate($value->add_adate).'</td>
			<!--<td class="text-center">'.loadUserData(1)->name.'</td>-->
			<td class="text-center">'.Tdate($value->edit_adate).'</td>
			<!--<td class="text-center">'.loadUserData($value->edit_by)->name.'</td>-->
			</tr>';
		}
	}
	
	
	
	public function formAdd()
	{
         if (!isset($this->session->userdata['active'])) {
			redirect(base_url().'Login/');
		}
		echo $this->Insert_model->addFromGuide();
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
      echo $this->Update_model->updateFormGuide();
	}
	
	public function newsPhotoList(){
         if (!isset($this->session->userdata['active'])) {
			redirect(base_url().'Login/');
		}
		$news_id = $_POST['news_id'];
		$returnImg = $this->Get_model->loadNewsGallery($news_id)->result();
		foreach($returnImg as $key => $value){
			echo '<div data-id="'.$value->gallery_id.'" class="col-xs-4 col-sm-3 col-md-2 col-lg-2 ui-sortable-handle" style="margin-bottom:25px;"><img src="../../../public/img/uploadfile/crop/'.$value->image.'" class="img-responsive gallery-img"><a href="#" data-id="'.$value->gallery_id.'" class="deleteGallery text-danger"><i class="fas fa-trash-alt"></i></a></div>';
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
		echo $this->Update_model->updateCategoryID();
	}
	
    
    public function deletenews(){
		echo $this->Update_model->deleteNews();
	}
    
    
    public function deleteFile(){
         if (!isset($this->session->userdata['active'])) {
			redirect(base_url().'Login/');
		}
		echo $this->Update_model->deleteFile();
	}
	
}
