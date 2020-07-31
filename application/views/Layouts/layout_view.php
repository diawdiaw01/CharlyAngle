<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<META NAME="Author" CONTENT="The Center for the Promotion of Arts and Culture, Chiang Mai University">
<META NAME="Keywords"  lang="th" CONTENT="The Center for the Promotion of Arts and Culture, Chiang Mai University, Lanna Traditional House Museum, Chiang Mai University">
<META NAME="description" CONTENT="The Center for the Promotion of Arts and Culture, The Lanna Traditional House Museum, Chiang Mai University">
<meta name="robots" content="index,follow">
<title><?=$title?></title>
<link rel="icon" href="<?=base_url()?>public/img/favicon.png" type="image/x-icon">
<link rel="stylesheet" href="<?=base_url()?>public/css/jquery-ui-1.12.1.css">
<link rel="stylesheet" href="<?=base_url()?>public/bootstrap-4.5.0-dist/css/bootstrap.min.css">
<link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?=base_url()?>public/css/fontawesome5.10.1/css/all.css">
<link rel="stylesheet" href="<?=base_url()?>public/css/animate.css">
<link rel="stylesheet" href="<?=base_url()?>public/bootstrap-4.5.0-dist/css/main.css">
</head>
<body>
	<span  id="rainbow-progress-bar"></span>
	
	<? $this->load->view('Layouts/header_view');?>
	<? $this->load->view($content)?>
	<div id="stop" class="scrollTop">
		<span><a href=""><i class="fas fa-chevron-circle-up fa-2x second-font-color"></i></a></span>
	  </div>
	<? $this->load->view('Layouts/footer_view');?>
	
	<script src="<?=base_url()?>public/js/jquery-1.12.4.min.js"></script>
	<script src="<?=base_url()?>public/js/jquery-ui-1.12.1.min.js"></script>
	<script src="<?=base_url()?>public/bootstrap-4.5.0-dist/js/bootstrap.bundle.min.js"></script>
	<script src="<?=base_url()?>public/js/jquery.fancybox.min.js"></script>
	<script src="<?=base_url()?>public/js/lightslider.js"></script>
	<script src="<?=base_url()?>public/js/wow.min.js"></script>
	<script src="<?=base_url()?>public/js/popper.min.js"></script>
	<script src="<?=base_url()?>public/js/main.js"></script>
	<script src="<?=base_url()?>public/js/jquery.fadeshow-0.1.2.min.js"></script>

		<script>
			var base_url = '<?=base_url()?>';
		</script>
		
	<?php if(isset($plugin)):?>
	<? $this->load->view($plugin);?>
	<?php endif;?>
	
	<?php if(isset($jsFile)):?>
	<script src="<?=base_url()?>public/js/<?=$jsFile?>.js"></script>
	<?php endif;?>
    </body>
</html>