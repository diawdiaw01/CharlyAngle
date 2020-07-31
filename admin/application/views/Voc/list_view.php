<section class="content">
	<div class="container-fluid">
		<div class="row">

                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-heading">
				<div class="header-title text-center">
                            <h1 class="text-accent"> <?=$title?></h1>
				</div><!--<a href="#" class="btn btn-accent" data-category-id="<?=$this->uri->segment(3)?>" data-toggle="modal" data-target="#myModal1"><i class="fas fa-plus-circle"></i> เพิ่มข้อมูลใหม่</a>-->
                        </div>
						
<div class="panel panel-filled panel-c-success">
			
                        <div class="panel-body">
                            <table class="table table-vertical-align-middle table-bordered" id="tableExample2">
                                <thead>
                                <tr>
									<th class="text-center" style=" width: 3%;">#</th>
                                    <th  class="text-center" style=" width: 50%;"> ชื่อเรื่อง/รายละเอียด</th>
									<th class="text-center">ชื่อ/อีเมล์ ผู้ติดต่อ</th>
                                    <th class="text-center">วันที่/หมายเลข IP</th>
                                </tr>
                                </thead>
								<tbody id="loadDepartmentList">
                                    <?
                                    foreach($detail as $key => $value){
                                    ?>
									<tr><td><?=$key+1?></td><td><strong class="text-accent"><?=$value->title?></strong><br><em><small><?=$value->detail?></small></em></td><td><?=$value->name?><br><a target="_blank" href="mailto:<?=$value->email?>?subject=ตอบกลับ: <?=$value->title?>"><?=$value->email?></a></td>
                                    <td class="text-center"><?=Tdate($value->adate)?><br>IP: <?=$value->ip_address?></td>
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
								<label class="card-inside-title"><i class="fas fa-feather"></i> ชื่อหัวข้อ</label>
                                <div class="form-group">
                                    <div class="form-line">
                                       <input type="text" name="title" id="title" class="form-control" placeholder="ชื่อหัวข้อ" required>
                                    </div>
                                </div>
                            </div>
                        </div>
						
						
						
						<div class="row clearfix">
                            <div class="col-sm-12">
								<!--<label class="card-inside-title"><i class="fab fa-youtube"></i> Youtube URL</label>-->
                                <div class="form-group">
                                    <div class="form-line">
                                       <input type="hidden" name="youtube" id="youtube" class="form-control" placeholder="วางลิงค์ Yotube ที่นี่">
									   <input type="hidden" name="youtube_vid" id="youtube_vid">
                                    </div>
                                </div>
								<!--<div id="youtubeIFrame">
									
								</div>-->
                            </div>
                        </div>
						<!--
                        <div class="row clearfix">
                            <div class="col-sm-12">
								<label class="card-inside-title"><i class="fas fa-feather"></i> รายละเอียด</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <textarea id="detail" placeholder="write a message..." name="detail"></textarea>
										<input type="hidden" name="hiddendetail" id="hiddendetailWithCKEditor">
                                    </div>
                                </div>
                            </div>
                        </div>
						
						

						<div class="row clearfix" >
                            <div class="col-sm-12" id="image_cover_hilight">
								<label class="card-inside-title"><i class="fa fa-picture-o" aria-hidden="true"></i> รูปภาพ </label> <small class="text-muted">เพิ่มได้หลายรูป (jpg, png)</small>
                                <div class="form-group">
                                    <div class="form-line">
                                       <input type="file" name="image_cover" id="file_upload_cover" class="form-control" >
                                    </div>
                                </div>
								<div id="queue_cover" ></div>
                            </div>
                        </div>-->
						
						<div class="row clearfix" >
                            <div class="col-sm-12" id="image_cover_hilight">
								<label class="card-inside-title"><i class="fas fa-paperclip"></i> ไฟล์แนบ</label> <small class="text-muted">1 ไฟล์เท่านั้น (word, excel, pdf)</small>
                                <div class="form-group">
                                    <div class="form-line">
                                       <input type="file" name="file_upload" id="file_upload" class="form-control" >
                                    </div>
                                </div>
								<div id="queue_file" ></div>
                            </div>
                        </div>
						<input type="hidden" id="checkque" value="no">
						<input type="hidden" id="checkqueFile" value="no">
						<input type="hidden" id="news_category_id" name="news_category_id" value="<?=$this->uri->segment(3)?>">
						
	</div>
	<div class="modal-footer">
	    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
	    <button type="submit" class="btn btn-accent pull-right" id="btn-submit">Submit</button>
	</div>
</form>
    </div>
</div>
</div>


<div class="modal fade" id="myModalEdit" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
<div class="modal-dialog modal-lg" style="width:100%; max-width: 1024px;">

    <div class="modal-content">
<form action="" id="formGuideEdit" name="formGuideEdit" method="post" enctype="multipart/form-data">
	<div class="modal-header text-center">
	    <h4 class="modal-title">แก้ไขข้อมูล <?=$title?></h4>
	</div>
	<div class="modal-body">
	    
						
						<div class="row clearfix">
                            <div class="col-sm-12">
								<label class="card-inside-title"><i class="fas fa-feather"></i> ชื่อหัวข้อ</label>
                                <div class="form-group">
                                    <div class="form-line">
                                       <input type="text" name="titleEdit" id="titleEdit" class="form-control" placeholder="ชื่อหัวข้อ" required>
                                    </div>
                                </div>
                            </div>
                        </div>
						
						
						
						<div class="row clearfix">
                            <div class="col-sm-12">
								<!--<label class="card-inside-title"><i class="fab fa-youtube"></i> Youtube URL</label>-->
                                <div class="form-group">
                                    <div class="form-line">
                                       <input type="hidden" name="youtubeEdit" id="youtubeEdit" class="form-control" placeholder="วางลิงค์ Yotube ที่นี่">
									   <input type="hidden" name="youtube_vidEdit" id="youtube_vidEdit">
                                    </div>
                                </div>
								<!--<div id="youtubeIFrameEdit">
									
								</div>-->
                            </div>
                        </div>
						<!--
                        <div class="row clearfix">
                            <div class="col-sm-12">
								<label class="card-inside-title"><i class="fas fa-feather"></i> รายละเอียด</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <textarea id="detailEdit" placeholder="write a message..." name="detailEdit"></textarea>
										<input type="hidden" name="hiddendetailEdit" id="hiddendetailWithCKEditorEdit">
                                    </div>
                                </div>
                            </div>
                        </div>
						<hr>
						

						<div class="row clearfix" >
                            <div class="col-sm-12" id="image_cover_hilight">
								<label class="card-inside-title"><i class="fa fa-picture-o" aria-hidden="true"></i> รูปภาพ</label> <small class="text-muted">เพิ่มได้หลายรูป (jpg, png)</small>
                                <div class="form-group">
                                    <div class="form-line">
                                       <input type="file" name="image_coverEdit" id="file_upload_coverEdit" class="form-control" >
                                    </div>
                                </div>
								<div id="queue_coverEdit" ></div>

                            </div>
							
                        </div>
						<div id="loadAndDisable" style=" width: 100%; float: left; margin-top: 20px;">
							<div class="loader" style="margin-top:200px; z-index: 9999;">
                            <div class="loader-bar"></div>
                        </div>
							<div class="row clearfix" id="newsPhotoList">
							</div>
							
						</div>-->
						<div class="clearfix">&nbsp;</div>
						<div class="row clearfix" >
                            <div class="col-sm-12" id="image_cover_hilight">
								<label class="card-inside-title"><i class="fas fa-paperclip"></i> ไฟล์แนบ</label> <small class="text-muted">1 ไฟล์เท่านั้น</small>
                                <div class="form-group">
                                    <div class="form-line">
                                       <input type="file" name="file_uploadEdit" id="file_uploadEdit" class="form-control" >
                                    </div>
                                </div>
								<div id="queue_fileEdit" ></div>
                            </div>
                        </div>

						<div class="col " id="newsFileList">
							</div>

						<input type="hidden" id="checkqueEdit" value="no">
						<input type="hidden" id="checkqueFileEdit" value="no">
						<input type="hidden" id="editID" name="editID" value="">
						
	</div>
	<div class="modal-footer">
	    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
	    <button type="submit" class="btn btn-accent pull-right" id="btn-submitEdit">Submit</button>
	</div>
</form>
    </div>
</div>
</div>