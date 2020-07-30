<section class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
					<div class="panel panel-filled panel-c-success">

                        <div class="panel-body">
                            <form action="" id="formGuideEdit" name="formGuideEdit" method="post" enctype="multipart/form-data">
                            <h1 class="text-accent"><?=$detail->menusub_name?></h1>      
                            

                 
						
                        <div class="row clearfix">
                            <div class="col-sm-12">
								<label class="card-inside-title"><i class="fas fa-feather"></i> ข้อความ</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <textarea id="detailEdit" placeholder="write a message..." name="detailEdit"><?=$detail->menusub_detail?></textarea>
										<input type="hidden" name="hiddendetailEdit" id="hiddendetailWithCKEditorEdit">
                                        <label class="card-inside-title" style="margin-top:5px;"><i class="fas fa-image"></i> Upload รูปภาพลงในข้อความ</label>
                                        <input id="file_upload" name="file_upload" type="file" multiple="true" style="left: 0;">
								<div id="queue" ></div>
                                    </div>
                                </div>
                            </div>
                        </div>
						<hr>
						<div class="clearfix">&nbsp;</div>
			
                        <button type="submit" class="btn btn-success btn-lg" id="btn-submitEdit">Submit</button>
                        <input type="hidden" id="checkqueEdit" value="no">
<input type="hidden" id="checkqueFileEdit" value="no">
<input type="hidden" id="editID" name="editID" value="<?=$editID?>">
                            </form>
                            
						<div class="clearfix">&nbsp;</div>
                        
                        
                        
                        
                        
                        

                        
                        
                        
                        </div>
                
                    </div>
				
					
					
                </div>
            </div>
	    
	   

        </div>
    </section>

