<!-- Header-->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <div id="mobile-menu">
                    <div class="left-nav-toggle">
                        <a href="#" id="navHamberger">
                            <i class="stroke-hamburgermenu"></i>
                        </a>
                    </div>
                </div>
     <a class="navbar-brand" href="<?=base_url()?>">
                    CHARLY
                </a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <div class="left-nav-toggle">
                    <a href="">
                        <i class="stroke-hamburgermenu"></i>
                    </a>
					
                </div>
				<div style="float: left; margin-left: 20px; margin-top: 15px;"><h4 class="black inline">ระบบจัดการข้อมูลเว็บไซต์
				</h4></div>
                <ul class="nav navbar-nav navbar-right " >
					<li style="margin-top: 10px;">
                        <a href="<?=base_url()?>Logout">
                            <?=$this->session->userdata('loginname')?> <i class="fas fa-sign-in-alt"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End header-->