<section class="content">
	<div class="container-fluid">
		<div class="row">

                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-heading">
				<div class="header-title text-center">
                            <h1 class="text-accent"> <?=$title?></h1>
				</div><a href="#" class="btn btn-accent" data-category-id="<?=$this->uri->segment(3)?>" data-toggle="modal" data-target="#myModal1"><i class="fas fa-plus-circle"></i> เพิ่มข้อมูลใหม่</a>
                        </div>
						
<div class="panel panel-filled panel-c-success">
			
                        <div class="panel-body">
                            <table class="table table-vertical-align-middle table-bordered" id="tableExample2">
                                <thead>
                                <tr>
									<th class="text-center" style=" width: 3%;">#</th>
                                    <th  class="text-center"> รายการ</th>
									<th class="text-center" style=" width: 10%;">เพิ่มเมื่อ</th>
                                    <th class="text-center" style=" width: 10%;">สิ้นสุด</th>
									<th class="text-center" style=" width: 15%;">เพิ่มโดย</th>
                                </tr>
                                </thead>
								<tbody id="loadNewsList">
                                    <?
                                    foreach($detail as $key => $value){
                                        $link = explode("http://art-culture.cmu.ac.th/News/detail/", $value->link);
                                    ?>
									<tr>
                                        <td><?=$key+1?><br><br>
                                        <a href="#" class="editPopup text-warning" title="แก้ไข" data-id="<?=$value->popup_id?>" data-toggle="modal" data-target="#myModal1Edit"><i class="far fa-edit"></i></a>
                                        <br><br>
                                        <a href="#" class="deleteNews text-danger"  title="ลบ" data-id="<?=$value->popup_id?>"><i class="fas fa-trash-alt"></i></a>
                                        </td>
                                        <td>
                                        	<img src="<?=base_url()?>../public/img/uploadfile/<?=loadNewsCover($link[1])->image?>" style=" width: 50%;"  class="img-responsive">
                                        <?=loadNewsData($link[1])->title?><br>
                                        <?=$value->title?>
                                        <br>
                                        <a href="<?=$value->link?>" target="_bliank"><?=$value->link?></a></td>
                                        <td class="text-center"><?=TdateShortNoTime($value->add_adate)?></td>
                                        <td class="text-center"><?=TdateShortNoTime($value->finish_adate)?></td>
                                        <td class="text-center"><?=loadDepartmentSession($value->cmuitaccount)?></td>
                                    </tr>
                                    <? }?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                        </div>
                    </div>
                </div>
            </div>

	</div>
	<script>
		var news_category_id = <?=$this->uri->segment(3)?>;
	</script>
</section>
<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
<form action="" id="formGuide" name="formGuide" method="post" enctype="multipart/form-data">
	<div class="modal-header text-center">
	    <h4 class="modal-title">เพิ่มข้อมูล <?=$title?></h4>
	</div>
	<div class="modal-body">

						<div class="row clearfix">
                            <div class="col-sm-12">
								<label class="card-inside-title"><i class="fas fa-link"></i> Link ข่าว</label> <small class="text-accent">(วางลิงค์แล้วระบบจะเพิ่มชื่อข่าวให้อัตโนมัติ)</small>
                                <div class="form-group">
                                    <div class="form-line">
                                       <input type="text" name="link" id="link" required class="form-control" placeholder="วางลิงค์ที่นี่">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-sm-12">
								<label class="card-inside-title"><i class="far fa-hand-point-up"></i> แสดงปุ่ม "รายละเอียดเพิ่มเติม" </label>
                                <small class="text-accent"> (ผู้ใช้สามารถคลิกเข้าไปอ่านข่าวข้างในได้)</small>
                                <div class="form-group">
                                    <div class="form-check">
                                                <input class="form-check-input" type="radio" name="is_read" id="exampleRadios1" value="y" >
                                                <label class="form-check-label" for="exampleRadios1">
                                                  แสดง
                                                </label>
                                              </div>
                                              <div class="form-check">
                                                <input class="form-check-input" type="radio" name="is_read" checked id="exampleRadios2" value="n">
                                                <label class="form-check-label" for="exampleRadios2">
                                                  ไม่แสดง
                                                </label>
</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row clearfix">
                            <div class="col-sm-12">
								<label class="card-inside-title"><i class="fas fa-pen"></i> ข้อความเพิ่มเติม</label>
                                <div class="form-group">
                                    <div class="form-line">
                                       <textarea name="title" id="title" class="form-control"></textarea>
                                       <input type="hidden" name="hiddentitle" id="hiddentitleWithCKEditor">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-sm-12">
								<label class="card-inside-title"><i class="far fa-calendar-alt"></i> แสดงถึงวันที่</label>
                                <div class="form-group">
                                    <div class="form-line">
                                       <input type="text" name="finish_adate" readonly id="finish_adate" class="form-control" placeholder="เลือกวันที่ ">
                                    </div>
                                </div>
                            </div>
                        </div>

	</div>
	<div class="modal-footer">
	    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
	    <button type="submit" class="btn btn-accent pull-right" id="btn-submit">Submit</button>
	</div>
</form>
    </div>
</div>
</div>








<div class="modal fade" id="myModal1Edit" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
<form action="" id="formGuideEdit" name="formGuideEdit" method="post" enctype="multipart/form-data">
	<div class="modal-header text-center">
	    <h4 class="modal-title">แก้ไข <?=$title?></h4>
	</div>
	<div class="modal-body">
	    
						

						
						<div class="row clearfix">
                            <div class="col-sm-12">
								<label class="card-inside-title"><i class="fas fa-link"></i> Link ข่าว</label> <small class="text-accent">(วางลิงค์แล้วระบบจะเพิ่มชื่อข่าวให้อัตโนมัติ)</small>
                                <div class="form-group">
                                    <div class="form-line">
                                       <input type="text" name="linkEdit" id="linkEdit" required class="form-control" placeholder="วางลิงค์ที่นี่">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row clearfix">
                            <div class="col-sm-12">
								<label class="card-inside-title"><i class="far fa-hand-point-up"></i> แสดงปุ่ม "รายละเอียดเพิ่มเติม" </label>
                                <small class="text-accent"> (ผู้ใช้สามารถคลิกเข้าไปอ่านข่าวข้างในได้)</small>
                                <div class="form-group">
                                    <div class="form-check">
                                                <input class="form-check-input" type="radio" name="is_readEdit" id="exampleRadios1Edit" value="y" >
                                                <label class="form-check-label" for="exampleRadios1Edit">
                                                  แสดง
                                                </label>
                                              </div>
                                              <div class="form-check">
                                                <input class="form-check-input" type="radio" name="is_readEdit" checked id="exampleRadios2Edit" value="n">
                                                <label class="form-check-label" for="exampleRadios2Edit">
                                                  ไม่แสดง
                                                </label>
</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row clearfix">
                            <div class="col-sm-12">
								<label class="card-inside-title"><i class="fas fa-pen"></i> ข้อความเพิ่มเติม</label>
                                <div class="form-group">
                                    <div class="form-line">
                                       <textarea name="titleEdit" id="titleEdit" class="form-control"></textarea>
                                       <input type="hidden" name="hiddentitleEdit" id="hiddentitleWithCKEditor">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-sm-12">
								<label class="card-inside-title"><i class="far fa-calendar-alt"></i> แสดงถึงวันที่</label>
                                <div class="form-group">
                                    <div class="form-line">
                                       <input type="text" name="finish_adateEdit" readonly id="finish_adateEdit" class="form-control" placeholder="เลือกวันที่ ">
                                    </div>
                                </div>
                            </div>
                        </div>

	</div>
	<div class="modal-footer">
	    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
	    <button type="submit" class="btn btn-accent pull-right" id="btn-submit">Submit</button>
	</div>
</form>
    </div>
</div>
</div>


