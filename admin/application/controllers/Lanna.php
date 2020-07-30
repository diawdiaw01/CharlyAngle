<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lanna extends CI_Controller {

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
	
	
	public function lists($news_category_id){
     if (!isset($this->session->userdata['active'])) {
			redirect(base_url().'Login/');
		}
		$this->viewFolder	= $this->router->class;
		$data['title'] = $this->Get_model->loadNewsCategory($news_category_id)->title;
		
        if($news_category_id == '201' || $news_category_id == '202' || $news_category_id == '203'){
		$data['content']	= $this->viewFolder.'/list_view';
        $data['jsFile'] =  "lanna_list_view";
        }else{
            $data['content']	= $this->viewFolder.'/news_list_view';
            $data['jsFile'] =  "news_list_view";
        }
		$this->load->view('Layouts/layout_view',$data);
	}
	
	
	public function loadLannaList(){
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
			}else{
				$photo = '<img src="../../../public/img/nophoto.jpg" style="max-width:140px; float:left; margin-right:7px;">';
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
			
			echo '
			<tr><td class="text-center">'.($key+1).'</td>
			<td><a id="link'.$value->news_id.'"  style="font-size:1.15em;" href="#" data-id="'.$value->news_id.'" data-title="'.$value->title.'" data-youtube="'.$value->youtube.'" data-detail="'.$value->detail.'" data-file="'.$value->file_real_name.'" data-toggle="modal" data-target="#myModalEdit">'.$photo.'</a><a id="link'.$value->news_id.'"  style="font-size:1.15em;" href="#" data-id="'.$value->news_id.'" data-title="'.$value->title.'" data-youtube="'.$value->youtube.'" data-detail="'.$value->detail.'" data-file="'.$value->file_real_name.'" data-toggle="modal" data-target="#myModalEdit"><strong><i class="fas fa-pencil-alt"></i> '.$value->title.'</strong></a>'.$file.'
			</td>
			<td class="text-center">'.Tdate($value->add_adate).'</td>
			<td class="text-center">'.Tdate($value->edit_adate).'</td>
			<td class="text-center"><a href="#" class="deleteLanna text-danger" data-delete-id="'.$value->news_id.'"><i class="fas fa-trash-alt"></i></a></td>
			</tr>';
		}
	}
	
	
	
	public function formAdd()
	{
		echo $this->Insert_model->addFromGuide();
	}
	
	public function updateGuideVisible(){
		echo $this->Update_model->updateGuideVisible();
	}
	
	public function deleteLanna(){
		echo $this->Update_model->deleteNews();
	}
	
	public function formEdit(){
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
		echo  ($this->db->affected_rows() != 1) ? "true" : "true";
	}
	
	public function newsPhotoList(){
		$news_id = $_POST['news_id'];
		$returnImg = $this->Get_model->loadNewsGallery($news_id)->result();
		foreach($returnImg as $key => $value){
			echo '<div data-id="'.$value->gallery_id.'" class="col-xs-4 col-sm-3 col-md-2 col-lg-2 ui-sortable-handle" style="margin-bottom:25px;"><a data-fancybox="gallery" href="../../../public/img/uploadfile/'.$value->image.'"><img src="../../../public/img/uploadfile/crop/'.$value->image.'" class="img-responsive gallery-img"></a><a href="#" data-id="'.$value->gallery_id.'" class="deleteGallery text-danger"><i class="fas fa-trash-alt"></i></a></div>';
		}
	}
	
	public function updateorder(){
		echo $this->Update_model->updateorder();
	}
	
	public function deleteGallery(){
		echo $this->Delete_model->deleteGallery();
	}
	
	
}
