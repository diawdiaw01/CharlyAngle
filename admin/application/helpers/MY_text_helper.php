<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Extended for text helper */
function post_brief($posttext, $line, $charline)
{
    $brief = character_limiter($posttext,$line*$charline);
    $text = explode('<br />', nl2br($posttext));
//    foreach($text as $line=>$linetext) {
        
//    }
    
    return $brief;  
}

function word_banned($str, $banwords, $replacement = '#') 
{
    if(!is_array($banwords)) {
        return $str;
    }
    
    foreach($banwords as $badword){
        $str = str_replace($badword, str_repeat($replacement, strlen($badword)), $str);
    }
    
    return $str;
}

function wordcate_test_review($catenumber)
{
    $ci =& get_instance();
    
    $query = $ci->db->get_where('test_review_cate', array('id'=>$catenumber));
    $text  = $query->row()->name;

    return $text;
}

function wordcate_article($catenumber)
{
    $ci =& get_instance();

    $query = $ci->db->get_where('article_cate', array('id'=>$catenumber));
    $text  = $query->row()->name;

    return $text;
}

function wordcate_download($catenumber)
{
    $ci =& get_instance();

    $query = $ci->db->get_where('donwload_cate', array('id'=>$catenumber));
    $text  = $query->row()->name;

    return $text;
}

function wordcate_webboard($catenumber)
{
    $ci =& get_instance();

    $query = $ci->db->get_where('webboard_cate', array('id'=>$catenumber));
    $text  = $query->row()->name;

    return $text;
}


function check_gallery($test_review_id)
{
    $ci =& get_instance();

    $query = $ci->db->get_where('test_review_image', array('test_review_id'=>$test_review_id));
    $number_row = $query->num_rows();

    return $number_row;
}

function text_position($type_id)
{

    if($type_id==1){
       $text = "Header (728x90)";
    }else if($type_id==2){
       $text = "Index Left (666x90)";
    }else if($type_id==3){
       $text = "Floating (160x600)";
    }else if($type_id==4){
       $text = "Index Right 1 (300x250)";
    }else if($type_id==5){
       $text = "Index Right 2 (300x250)";
    }else if($type_id==6){
       $text = "Index Right 3 (300x250)";
    }else if($type_id==7){
       $text = "Detail Right 1 (300x250)";
    }else if($type_id==8){
       $text = "Detail Right 2 (300x250)";
    }

    return $text;
}

function icon_is_show($text)
{
    if($text=='active'){
       $img = '<img title="แสดง" alt="แสดง" src="'.base_url().'public/img/icon/flag_green.png">';
    }else{
       $img = '<img title="ไม่แสดง" alt="ไม่แสดง" src="'.base_url().'public/img/icon/flag_red.png">';
    }

    return $img;
}

function setMagazine($id)
{
    $ci =& get_instance();
    $ci->load->model('get_model');
    $result = $ci->db->get_where('magazine', array('id'=>$id));
    $magazine    = $result->row();

    return $magazine;
}

function payonline($users)
{
    $ci =& get_instance();
    $ci->load->model('get_model');
    //$result = $ci->db->get_where('payonline', array('users'=>$users));
    $result = $ci->db->get_where('payonline', array('users'=>$users));
    $payonline = $result->num_rows();

    return $payonline;
}

function payonlineamt($users)
{
    $ci =& get_instance();
    $ci->load->model('get_model');
    //$result = $ci->db->get_where('payonline', array('users'=>$users));
    $result = $ci->db->get_where('payonline', array('users'=>$users));
    $payonlineamt = $result->row();

    return $payonlineamt;
}

/* End of file DA_text_helper.php */
/* Location: ./system/helpers/DA_text_helper.php */