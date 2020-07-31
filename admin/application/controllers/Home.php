<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

public function _construct(){
	parent::_construct();
	
}

	public function index(){
		$this->viewFolder	= $this->router->class;
		$data['returnStrategic'] =  $this->Get_model->loadIndexList();
		$data['missonImpossible'] = $this->Get_model->loadMission()->row();
		$data['title'] = "หน้าแรก";
		$data['jsFile'] = "home_view";
		$data['content']	= $this->viewFolder.'/home_view';
		$this->load->view('Layouts/layout_view',$data);
	}
	
	
}
