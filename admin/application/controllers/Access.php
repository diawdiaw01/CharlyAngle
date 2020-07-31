<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Access extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// Your own constructor code
		//$this->insert_model->AccessLog(); // Insert Access Log									
	}
	
	function index()
    {

		$data['title'] = "";
		$this->viewFolder	= $this->router->class;
		$array_items = array('active'  =>  FALSE,
                    'loginname' => "",
                    'cmuitaccount' => "");
		$this->session->unset_userdata($array_items);
		$this->session->sess_destroy();
        $this->load->view('access_view');
		//header('Location: http://art-culture.cmu.ac.th/admin');
    }
	
	
	
	
	
}