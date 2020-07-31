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
		//$data['newsList'] = $this->Get_model->loadNewsList(0,8);
		$data['jsFile'] = "home_view";
		$data['content'] = $this->viewFolder.'/home_view';
		$this->load->view('Layouts/layout_view', $data);
	}
	
	public function loadNewsList($start){
		$newsList = $this->Get_model->loadNewsList($start);
		foreach($newsList as $key => $value){
			if(checkNewsCover($value->news_id) == 0){
				$image =  base_url()."public/img/nophoto.jpg";
			}else{
				$image = base_url()."public/img/uploadfile/crop/".loadNewsCover($value->news_id)->image;
			}
			echo '<div class="col-lg-3 col-md-4 col-sm-6 col-12 news-list-index">
		<a href="'.$value->youtube.'" target="_blank">
        <div class="card">
          <div class="img-cover"><img src="'.$image.'" class="img-fluid  " alt="'.$value->title.'"></div>
          <div class="card-body ">
            <div class="text-center"><h5 class="card-title text-center">'.$value->title.'</h5></div>
			<div  class="news-list-content-index" >
            <p class="card-text">'.strip_tags($value->detail).'</p>
			</div>
          </div>
        </div>
		</a>
      </div>';
			
			
		}
	}
	
}
