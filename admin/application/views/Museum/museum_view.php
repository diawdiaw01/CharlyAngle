<section class="content">
	<div class="container-fluid">
		<div class="row">

                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-heading">
				<div class="header-title text-center">
					<h3 class="text-accent none"> พิพิธภัณฑ์เรือนโบราณล้านนา</h3>
                            <h1 class="text-accent"> พิพิธภัณฑ์เรือนโบราณล้านนา</h1>
				</div>
                        </div>
                        <div class="panel-body">
							
							<div id="loadNewsList">
							</div>

				
                            </div>

                        </div>
                    </div>
                </div>
            </div>

	</div>
</section>





<div class="modal fade" id="myModalEdit" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
<div class="modal-dialog modal-lg" style="width:100%; max-width: 1024px;">

    <div class="modal-content">
<form action="" id="formGuideEdit" name="formGuideEdit" method="post" enctype="multipart/form-data">
	<div class="modal-header text-center">
	    <h4 class="modal-title">แก้ไขข้อมูล <?=$title?></h4><h5 id="modaltitlespan"></h5>
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
								<label class="card-inside-title"><i class="fab fa-youtube"></i> Youtube URL</label>
                                <div class="form-group">
                                    <div class="form-line">
                                       <input type="text" name="youtubeEdit" id="youtubeEdit" class="form-control" placeholder="วางลิงค์ Yotube ที่นี่">
									   <input type="hidden" name="youtube_vidEdit" id="youtube_vidEdit">
                                    </div>
                                </div>
								<div class="col-xs-6">
									<div id="youtubeIFrameEdit">
									</div>
								</div>
                            </div>
                        </div>
						
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
							
						</div>
						<div class="clearfix">&nbsp;</div>
						<div class="row clearfix" >
                            <div class="col-sm-12" id="image_cover_hilight">
								<label class="card-inside-title"><i class="fas fa-paperclip"></i> ไฟล์แนบ</label> <small class="text-muted">1 ไฟล์เท่านั้น (word, excel, pdf)</small>
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