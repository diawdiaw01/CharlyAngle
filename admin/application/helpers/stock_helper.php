<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Extended for text helper */


function loadStockCateogry()
{
	$CI = get_instance();
    $CI->load->model('get_model');
    return $CI->get_model->getStockCateogryList()->result();
}

function loadStockCateTotal($cateParenID=null)
{
	$CI = get_instance();
    $CI->load->model('get_model');
	
	if($cateParenID==null)
		return $CI->get_model->getStockCateTotal();
	else
		return $CI->get_model->getStockCateTotal($cateParenID);
}

function loadStockCateName($cateParenID=null)
{
	$CI =& get_instance();
    $CI->load->model('get_model');
	
	return $CI->get_model->getStockCateName($cateParenID);
}

function loadStockBrand()
{
	$CI = get_instance();
    $CI->load->model('get_model');
    return $CI->get_model->getStockBrandList();
}


function loadStockCounter()
{
	$CI = get_instance();
    $CI->load->model('get_model');
    return $CI->get_model->getStockCounterList();
}

function loadStockDetailGallery($computer_part_id){
	$CI = get_instance();
    $CI->load->model('get_model');
    return $CI->get_model->getStockDetailGallery($computer_part_id);
}

function loadFullNameFromADDropDown(){
	$CI = get_instance();
    $CI->load->model('get_model');
	return $CI->get_model->getFullnameFromAD()->result();
	}

/* End of file task_helper.php */