<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Museum extends CI_Controller {

public function _construct(){
	parent::_construct();
	
}

	public function index(){
         if (!isset($this->session->userdata['active'])) {
			redirect(base_url().'Login/');
		}
		$this->viewFolder	= $this->router->class;
		$data['title'] = "พิพิธภัณฑ์เรือนโบราณล้านนา";
		//$data['result'] = $this->Get_model->loadMuseumList();
		$data['jsFile'] =  "museum_view";
		$data['content']	= $this->viewFolder.'/museum_view';
		$this->load->view('Layouts/layout_view',$data);
	}
	
	
	public function lists(){
         if (!isset($this->session->userdata['active'])) {
			redirect(base_url().'Login/');
		}
		$this->viewFolder	= $this->router->class;
		$data['title'] = $this->Get_model->loadMuseum()->title;
		$data['jsFile'] =  "news_list_view";
		$data['content']	= $this->viewFolder.'/list_view';
		$this->load->view('Layouts/layout_view',$data);
	}
	
	
	public function loadMuseumList(){
         if (!isset($this->session->userdata['active'])) {
			redirect(base_url().'Login/');
		}
		$retunrArray = $this->Get_model->loadMuseumList();
		foreach($retunrArray as $key => $value){
			$returnImg = $this->Get_model->loadMuseumGallery($value->museum_id);

					$photo = '<img src="../public/img/parallax-museum'.$value->museum_id.'.jpg" class="img-responsive">';

			
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
			<div class=" col-md-3 col-sm-4 col-xs-6" style=" height: 250px;">
			<a href="'.base_url().'Museum/detail/'.$value->museum_id.'"  data-detail="'.$value->detail.'" data-file="'.$value->file_real_name.'"  data-youtube="'.$value->youtube.'" data-id="'.$value->museum_id.'" class="report-link-block" data-toggle="modal" data-target="#myModalEdit" data-title="'.$value->title.'">
				<div class="text-center">
					'.$photo.$value->title.'
				</div>
				</a>
			</div>
			';
		}
	}
	
	
	public function knowledge(){
         if (!isset($this->session->userdata['active'])) {
			redirect(base_url().'Login/');
		}
		$news_category_id = 101;
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
			<td>'.$photo.'<a id="link'.$value->news_id.'"  style="font-size:1.15em;" href="#" data-id="'.$value->news_id.'" data-title="'.$value->title.'" data-youtube="'.$value->youtube.'" data-detail="'.$value->detail.'" data-file="'.$value->file_real_name.'" data-toggle="modal" data-target="#myModalEdit"><strong><i class="fas fa-pencil-alt"></i> '.$value->title.'</strong></a>'.$file.'
			</td>
			<td class="text-center">'.Tdate($value->add_adate).'</td>
			<td class="text-center">'.$value->add_by.'</td>
			<td class="text-center">'.Tdate($value->edit_adate).'</td>
			<td class="text-center">'.$value->edit_by.'</td>
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
	
	public function deleteGuide(){
		echo $this->Delete_model->deleteGuide();
	}
	
	public function formEdit(){
		$data = array(
			'title'		=> $this->input->post('titleEdit'),			
			'detail'		=>  addslashes(trim($this->input->post('hiddendetailEdit'))),
			'youtube'			=> $this->input->post('youtube_vidEdit'),
			'edit_adate'			=> date('Y-m-d H:i:s'),
			'edit_by'			=> $this->session->userdata('cmuitaccount'),
			'visible'		=> 'y'
		);
	
		$this->db->where('museum_id', $this->input->post('editID'));
		$this->db->update('museum', $data);
		echo  ($this->db->affected_rows() != 1) ? "true" : "true";
	}
	
	public function museumPhotoList(){
		$news_id = $_POST['museum_id'];
		$returnImg = $this->Get_model->loadMuseumGallery($news_id)->result();
		foreach($returnImg as $key => $value){
			echo '<div data-id="'.$value->gallery_id.'" class="col-xs-4 col-sm-3 col-md-2 col-lg-2 ui-sortable-handle" style="margin-bottom:25px;"><img src="../public/img/uploadfile/crop/'.$value->image.'" class="img-responsive gallery-img"><a href="#" data-id="'.$value->gallery_id.'" class="deleteGallery text-danger"><i class="fas fa-trash-alt"></i></a></div>';
		}
	}
	
	public function updateorder(){
		echo $this->Update_model->updateMuseumorder();
	}
	
	public function deleteGallery(){
		echo $this->Delete_model->deleteMuseumGallery();
	}
	
	
}
