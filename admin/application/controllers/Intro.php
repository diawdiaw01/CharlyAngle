<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Intro extends CI_Controller {

	public function index(){
        if (!isset($this->session->userdata['active'])) {
			redirect(base_url().'Login/');
		}
		$this->viewFolder	= $this->router->class;
		$data['title'] = "หน้าแรก";
		$data['content']	= $this->viewFolder.'/intro_view';
		$this->load->view('Layouts/layout_view',$data);
	}
	public function oauthcallback(){
		$this->viewFolder	= $this->router->class;
		$this->load->view( $this->viewFolder.'/oauthcallback_view');
	}
	
}
