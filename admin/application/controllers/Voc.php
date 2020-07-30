<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Voc extends CI_Controller {

public function _construct(){
	parent::_construct();
	
}


	

	
	public function lists($voc_category_id){
         if (!isset($this->session->userdata['active'])) {
			redirect(base_url().'Login/');
		}
		$this->viewFolder	= $this->router->class;
        $returnTitle = $this->Get_model->loadVocCategoryTitle($voc_category_id);
		$data['title'] = "VOC - ".$returnTitle->voc_category_title;
        $data['detail']  = $this->Get_model->loadVocList($voc_category_id);
		$data['content']	= $this->viewFolder.'/list_view';
		$this->load->view('Layouts/layout_view',$data);
	}
	

	
	
}
