<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

public function _construct(){
	parent::_construct();
	
}

	public function index()
	{
		$this->viewFolder	= $this->router->class;
		$data['title']		= "Charly Angle";
		$data['content'] = $this->viewFolder.'/home_view';
		$this->load->view('Layouts/layout_view', $data);
	}
	
}
