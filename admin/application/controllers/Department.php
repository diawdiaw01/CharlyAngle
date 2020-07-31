<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Department extends CI_Controller {

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
	
	
	public function sub($news_category_id){
         if (!isset($this->session->userdata['active'])) {
			redirect(base_url().'Login/');
		}
		$this->viewFolder	= $this->router->class;
		$data['title'] = $this->Get_model->loadDepartmentSub($news_category_id)->departsub_name;
		$data['jsFile'] =  "department_list_view";
        $data['jsPlugin'] = $this->viewFolder.'/plugin_view';
		$data['content']	= $this->viewFolder.'/list_view';
		$this->load->view('Layouts/layout_view',$data);
	}
	
	
	public function loadDepartmentList(){
         if (!isset($this->session->userdata['active'])) {
			redirect(base_url().'Login/');
		}
		$news_category_id = $_POST['departsub_id'];
		$retunrArray = $this->Get_model->loadDepartmentList($news_category_id);
		foreach($retunrArray as $key => $value){	
			

			
			if($value->departfile_file != ''){
                $fileName = $value->departfile_file;
                if($value->file_real_name != ''){
                    $fileName = $value->file_real_name;
                }
				$file = '<br>
			<a style="font-size:0.9em;" target="_blank"  class="text-muted" href="../../../public/img/uploadfile/'.$value->departfile_file.'"><em><i class="fas fa-paperclip"></i> '.$fileName.'</em></a>';
			}else{
				$file = '';
			}
            $intro = '';
			if($news_category_id == '24'){
                $intro = "เลขที่: ".$value->departfile_code." ปี:".$value->departfile_year." ";
            }else if($news_category_id == '25'){
                $intro  = "วันที่: ".TdateNoTime($value->departfile_start_date)." ";
            }else{
                $intro = "";
            }

			echo '
			<tr><td class="text-center">'.($key+1).'</td>
			<td><a id="link'.$value->departfile_id.'"  style="font-size:1.15em;" href="#" data-id="'.$value->departfile_id.'" data-title="'.$value->departfile_name.'" data-code="'.$value->departfile_code.'" data-year="'.$value->departfile_year.'" data-start-date="'.dateNoTime($value->departfile_start_date).'" data-file="'.$fileName.'" data-toggle="modal" data-target="#myModalEdit"><strong><i class="fas fa-pencil-alt"></i> '.$intro.$value->departfile_name.'</strong></a>'.$file.'
			</td>

			<td class="text-center">'.Tdate($value->departfile_udate).'</td>
			<td class="text-center">'.loadDepartmentSession($value->departfile_session).'</td>
            <td class="text-center"><a href="#" class="deleteDepartmentFile text-danger" data-delete-id="'.$value->departfile_id.'"><i class="fas fa-trash-alt"></i></a></td>
			</tr>';
		}
	}
	
	
	
	public function formAdd()
	{
		echo $this->Insert_model->addDepartmentFile();
	}
	
	public function updateGuideVisible(){
		echo $this->Update_model->updateDepartmentFile();
	}
	
	public function deleteGuide(){
		echo $this->Delete_model->deleteDepartmentFile();
	}
	
	public function formEdit(){
        echo $this->Update_model->updateDepartmentFile();
	}
	
	public function newsPhotoList(){
		$news_id = $_POST['news_id'];
		$returnImg = $this->Get_model->loadNewsGallery($news_id)->result();
		foreach($returnImg as $key => $value){
			echo '<div data-id="'.$value->gallery_id.'" class="col-xs-4 col-sm-3 col-md-2 col-lg-2 ui-sortable-handle" style="margin-bottom:25px;"><img src="../../../public/img/uploadfile/crop/'.$value->image.'" class="img-responsive gallery-img"><a href="#" data-id="'.$value->gallery_id.'" class="deleteGallery text-danger"><i class="fas fa-trash-alt"></i></a></div>';
		}
	}
	
	public function updateorder(){
		echo $this->Update_model->updateorder();
	}
	
	public function deleteDepartmentFile(){
		echo $this->Update_model->deleteDepartmentFile();
	}
	
	
}
