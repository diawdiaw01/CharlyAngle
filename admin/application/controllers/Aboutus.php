<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aboutus extends CI_Controller {

public function _construct(){
	parent::_construct();
	
}

	public function history(){
         if (!isset($this->session->userdata['active'])) {
			redirect(base_url().'Login/');
		}
		$this->viewFolder	= $this->router->class;
		$data['detail'] = $this->Get_model->loadAboutus('1');
		$data['title'] = $data['detail']->menusub_name;
		$data['jsFile'] = "home_view";
        $data['editID'] = 1;
		$data['content']	= $this->viewFolder.'/aboutus_view';
		$this->load->view('Layouts/layout_view',$data);
	}
    public function resolution(){
         if (!isset($this->session->userdata['active'])) {
			redirect(base_url().'Login/');
		}
		$this->viewFolder	= $this->router->class;
		$data['detail'] = $this->Get_model->loadAboutus('2');
		$data['title'] = $data['detail']->menusub_name;
		$data['jsFile'] = "home_view";
        $data['editID'] = 2;
		$data['content']	= $this->viewFolder.'/aboutus_view';
		$this->load->view('Layouts/layout_view',$data);
	}
    public function structure(){
         if (!isset($this->session->userdata['active'])) {
			redirect(base_url().'Login/');
		}
		$this->viewFolder	= $this->router->class;
		$data['detail'] = $this->Get_model->loadStructure();
		$data['jsFile'] = "home_view";
        $data['editID'] = 3;
		$data['content']	= $this->viewFolder.'/structure_view';
		$this->load->view('Layouts/layout_view',$data);
	}
    
    public function formEdit(){
        echo $this->Update_model->updateAboutus();
    }
	
	
}
