<!-- Navigation-->
    <aside class="navigation">
        <nav>
            <ul class="nav luna-nav">
                <li class="nav-category">
                    <i class="fas fa-bars"></i> Menu
                </li>
                <?
                if($this->session->userdata('loginlevel') == 0 || $this->session->userdata('loginlevel') == 1){
                ?>
                 <li>
                    <a href="<?=base_url()?>News/lists/1"><i class="far fa-newspaper"></i> Article</a>
                </li>
                 <? }?>
    </aside>
    <!-- End navigation-->