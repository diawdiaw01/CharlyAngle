<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// Your own constructor code
	
	}
	
	function index()
    {
		$data['title'] = "เข้าสู่ระบบ";
		$this->viewFolder	= $this->router->class;
		$this->load->view('Login/login_view');
    }
	
	
	function check()
    {
		$this->viewFolder	= $this->router->class;
		$checkLogin = $this->Login_model->checkLogin();
		if($checkLogin){
			redirect(base_url().'News/lists/1');
		}else{
			echo "false";
			redirect(base_url().'Login/');
		}
    }
	
}
?>