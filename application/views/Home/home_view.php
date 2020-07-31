<div class="container-fluid">
		<div class="text-center">
        <br><br>
        <h1 class="gradient-text">Online Entertainment Complex</h1>
<hr><br>
      </div>
      
      <div class="row gradientrow">
		<?
		foreach($newsList as $key => $value){
		?>
      <div class="col-lg-3 col-md-4 col-sm-6 col-12">
        <div class="card">
          <div class="img-cover"><img src="<?=base_url()?>public/img/uploadfile/crop/<?=loadNewsCover($value->news_id)->image?>" class="img-fluid  " alt="<?=$value->title?>"></div>
          <div class="card-body">
            <h5 class="card-title text-center"><?=$value->title?></h5>
            <p class="card-text"><?=strip_tags($value->detail)?></p>
			<em class="float-right"><small><?=Tdate($value->add_adate)?></small></em>
          </div>
        </div>
      </div>
      <? }?>

        <div class="clearfix">&nbsp;</div>
        <div class="col-12"><div class="text-center"><a href="#" class="btn btn-primary text-center">LOAD MORE <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-double-down" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M1.646 6.646a.5.5 0 0 1 .708 0L8 12.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
          <path fill-rule="evenodd" d="M1.646 2.646a.5.5 0 0 1 .708 0L8 8.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
        </svg></a></div></div>
        
      </div>
</div>
      <br><br>