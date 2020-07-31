<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Popup extends CI_Controller {

public function _construct(){
	parent::_construct();
	
}

public function index(){
		 if (!isset($this->session->userdata['active'])) {
			redirect(base_url().'Login/');
		}
		$this->viewFolder	= $this->router->class;
		$data['title'] = "Pop-up";
		$data['jsFile'] =  "popup_list_view";
        $data['detail'] = $this->Get_model->loadPopupList();
		$data['content']	= $this->viewFolder.'/list_view';
		$this->load->view('Layouts/layout_view',$data);
}

public function formAdd()
	{
         if (!isset($this->session->userdata['active'])) {
			redirect(base_url().'Login/');
		}
		echo $this->Insert_model->addFromPopup();
	}
    
    public function deletenews(){
		echo $this->Update_model->deletePopup();
	}
	
	
}
