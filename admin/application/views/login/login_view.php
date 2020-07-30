<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">



    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900' rel='stylesheet' type='text/css'>	
	<link href="https://fonts.googleapis.com/css?family=Sarabun:300&display=swap" rel="stylesheet">
    <!-- Page title -->
    <title>ระบบจัดการข้อมูลเว็บไซต์</title>

    <!-- Vendor styles -->
    <link rel="stylesheet" href="<?=base_url()?>public/luna/vendor/fontawesome/css/font-awesome.css"/>
    <link rel="stylesheet" href="<?=base_url()?>public/luna/vendor/animate.css/animate.css"/>
    <link rel="stylesheet" href="<?=base_url()?>public/luna/vendor/bootstrap/css/bootstrap.css"/>
    <link rel="stylesheet" href="<?=base_url()?>public/luna/vendor/switchery/switchery.min.css"/>
    <link rel="stylesheet" href="<?=base_url()?>public/css/jquery.fancybox.min.css">
	<link rel="stylesheet" href="<?=base_url()?>public/luna/vendor/select2/dist/css/select2.min.css"/>
	<link rel="stylesheet" href="<?=base_url()?>public/luna/vendor/toastr/toastr.min.css"/>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
	<link rel="stylesheet" href="<?=base_url()?>public/luna/vendor/datatables/datatables.min.css"/>
    <!-- App styles -->
    <link rel="stylesheet" href="<?=base_url()?>public/luna/styles/pe-icons/pe-icon-7-stroke.css"/>
    <link rel="stylesheet" href="<?=base_url()?>public/luna/styles/pe-icons/helper.css"/>
    <link rel="stylesheet" href="<?=base_url()?>public/luna/styles/stroke-icons/style.css"/>
	<link href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css" rel="stylesheet">
    <link rel="stylesheet" href="<?=base_url()?>public/luna/styles/style.css">
	<link rel="stylesheet" href="<?=base_url()?>public/uploadifive/uploadifive.css">
	<link rel="stylesheet" href="<?=base_url()?>public/css/main.css">
	
	
</head>
<body>

<!-- Wrapper-->


        <div class="container-center animated slideInDown">


            <div class="view-header">
                <div class="header-icon">
                    <i class="pe page-header-icon pe-7s-unlock"></i>
                </div>
                <div class="header-title">
                    <h3>Login</h3>
                    <small>
                        Please enter your credentials to login.
                    </small>
                </div>
            </div>

            <div class="panel panel-filled">
                <div class="panel-body">
                    <form action="<?=base_url()?>Login/check" id="loginForm" method="post">
                        <div class="form-group">
                            <label class="control-label" for="username">Username</label>
                            <input type="text" placeholder="username" title="Please enter you username" required value="" name="username" id="username" class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="password">Password</label>
                            <input type="password" title="Please enter your password" placeholder="******" required value="" name="password" id="password" class="form-control">
                        </div>
                        <div>
                            <input type="submit" class="btn btn-accent" value="LOGIN">
                        </div>
                    </form>
                </div>
            </div>

        </div>

<!-- Vendor scripts -->
<script>
	var base_url = '<?=base_url()?>';
	
</script>
<script src="<?=base_url()?>public/luna/vendor/pacejs/pace.min.js"></script>
<script src="<?=base_url()?>public/luna/vendor/jquery/dist/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="<?=base_url()?>public/js/jquery.fancybox.min.js"></script>
<script src="<?=base_url()?>public/luna/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="<?=base_url()?>public/luna/vendor/switchery/switchery.min.js"></script>
<script src="<?=base_url()?>public/luna/vendor/select2/dist/js/select2.js"></script>
<script src="<?=base_url()?>public/luna/vendor/toastr/toastr.min.js"></script>
<script src="<?=base_url()?>public/luna/vendor/datatables/datatables.min.js"></script>
<!-- App scripts -->
<script src="http://art-culture.cmu.ac.th/activity/assets/plugins/sweetalert/sweetalert.min.js"></script>
<script src="<?=base_url()?>public/luna/vendor/wow.min.js"></script>
<script src="<?=base_url()?>public/luna/scripts/luna.js"></script>
</body>
</html>