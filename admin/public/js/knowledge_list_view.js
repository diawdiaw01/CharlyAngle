$(function(){
loadNewsList();


 $('#myModal1').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var news_category_id = button.data('category-id');
        var modal = $(this);
       // modal.find('.modal-body .textTitle').html('news_category_id');                                                              
	})
  $('#myModal1').on('hide.bs.modal', function (event) {
        loadNewsList();                                                             
	})

	
	CKEDITOR.replace('detail');
    CKEDITOR.config.height = 300;
	CKEDITOR.config.language = 'th';

	$('#youtube').blur(function(){
	if ( $(this).val() == '') {
		$('#youtubeIFrame').removeClass('embed-responsive embed-responsive-16by9');
		$('#youtubeIFrame').html('');
		$('#youtube_vid').val('');
	}else{
		var youtubeURL = $(this).val();
		var res = youtubeURL.split('watch?v=');
		var youtubeID = res[1];
		var res2 = youtubeID.split('&');
		youtubeID = res2[0];
		if (youtubeID != '') {
			$('#youtubeIFrame').addClass('embed-responsive embed-responsive-16by9');
			$('#youtubeIFrame').html('<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/'+ youtubeID +'?rel=0" allowfullscreen></iframe>');
			$('#youtube_vid').val(youtubeID);
		}else{
			$('#youtubeIFrame').removeClass('embed-responsive embed-responsive-16by9');
			$('#youtubeIFrame').html('');
			$('#youtube_vid').val('');
		}
	}
	});
	
	
	$('#file_upload_cover').uploadifive({
		'auto'             : false,
		'buttonText'   : '<i class="fas fa-cloud-upload-alt"></i> เลือกรูปภาพ',
		'multi'        : true,
		'dnd'          : false,
		'buttonClass'  : 'uploadclass',
		'removeCompleted' : true,
		'checkScript'      : base_url + 'public/uploadifive/check-exists.php',
		'queueID'          : 'queue_cover',
		'formData'         : {'supprtID' : 'someValue'},
		'uploadScript'     : base_url + 'public/uploadifive/uploadifive-guide-cover.php',
		'onUploadComplete': function(file, data) {

		},
		'onAddQueueItem' : function(file) {
			$('#checkque').val('yes');
		},
		'onCancel'     : function() {
            $('#checkque').val('no');
        }
	});
	
	
	
	$('#file_upload').uploadifive({
		'auto'             : false,
		'buttonText'   : '<i class="fas fa-cloud-upload-alt"></i> เลือกไฟล์แนบ',
		'multi'        : false,
		'dnd'          : false,
		'buttonClass'  : 'uploadclass',
		'removeCompleted' : true,
		'checkScript'      : base_url + 'public/uploadifive/check-exists.php',
		'queueID'          : 'queue_file',
		'formData'         : {'supprtID' : 'someValue'},
		'uploadScript'     : base_url + 'public/uploadifive/uploadifive-guide-file.php',
		'onUploadComplete': function(file, data) {
			//alert(data);
			//showAutoCloseTimerMessage();
			//showSuccessMessage("เธเธฑเธเธ—เธถเธเน€เธฃเธตเธขเธเธฃเนเธญเธข");
			//setTimeout(function(){ window.location.href = base_url + 'ITguide/'; }, 2000);
		},
		'onAddQueueItem' : function(file) {
			$('#checkqueFile').val('yes');
		},
		'onCancel'     : function() {
            $('#checkqueFile').val('no');
        }
	});
	
	
});

$('#formGuide').on('submit', function(e){
	e.preventDefault();
	var detailWithCKEditor = CKEDITOR.instances.detail.getData();
	//alert(detailWithCKEditor);exit();
	$('#hiddendetailWithCKEditor').val(detailWithCKEditor);
	var oldSubmit = $('#btn-submit').html();
	$('#btn-submit').html("<i class='fa fa-spinner fa-pulse  fa-spin'></i>");
	$('#btn-submit').prop('disabled',true);
	var sendURL="cmd=formGuide&"+$('#formGuide').serialize();
	//alert(sendURL);exit();
	$.ajax({	type: "POST",	url:  base_url + "Knowledge/formAdd/",	data: sendURL,
		success: function(msg)
			{
				//alert(msg);
				var res = msg.split(":");
				if (res[0] == "true") {
				$('#btn-submit').html(oldSubmit);
				$('#btn-submit').prop('disabled',false);
				if($('#checkque').val() == 'yes' && $('#checkqueFile').val() == 'no'){
					uploadCover(res[1]);
				}else if($('#checkque').val() == 'no' && $('#checkqueFile').val() == 'yes'){
					uploadFiles(res[1]);
				}else if($('#checkque').val() == 'yes' && $('#checkqueFile').val() == 'yes'){
					uploadCover(res[1]);
					uploadFiles(res[1]);

				}else if($('#checkque').val() == 'no' && $('#checkqueFile').val() == 'no'){
					
					showSuccessMessage("บันทึกข้อมูลสำเร็จ");
                         $("button.confirm").click(function () {
                              $('#myModal1').modal('toggle');
							  loadNewsList();
							 //$('#link'+res[1]).trigger('click');
                        });
				}
				
				
				
						
				
				
				}else{
					alert(msg);
				}
			},
	error: function()
			{
				toastr.error('Disconnect Insert');
				$('#btn-submit').html(oldSubmit);
				$('#btn-submit').prop('disabled',false);
			}
				
	});		
});


function uploadCover(getData)
   {
      $('#file_upload_cover').data('uploadifive').settings.formData =
      {
         'news_id'  : getData
      },
      $('#file_upload_cover').uploadifive('upload');
   }
   
   function uploadFiles(getData)
   {
      $('#file_upload').data('uploadifive').settings.formData =
      {
         'news_id'  : getData
      },
      $('#file_upload').uploadifive('upload');
   }



function loadNewsList() {
	var sendURL="cmd=loadNewsList&news_category_id=" + news_category_id + "&knowledge_category_id=" + knowledge_category_id;
	//alert(sendURL);
		$.ajax({	type: "POST",	url:  base_url + "Knowledge/loadNewsList" ,	data: sendURL,
			success: function(msg)
				{
					$('#loadNewsList').html(msg);
				},
		error: function()
				{
					toastr.error('Disconnect loadnewsList');
					$('#loadnewsList').html('<tr><td colspan="4" class="text-center text-danger">error loading data</td></tr>');
				}
					
        });
}



/////////////////////////////////////////////////////////////////////////////////////



$(function(){


 $('#myModalEdit').on('show.bs.modal', function (event) {
	
        var button = $(event.relatedTarget);
        var modal = $(this);
		modal.find('.modal-body #editID').val(button.data('id'));
		newsPhotoList();
        modal.find('.modal-body #titleEdit').val(button.data('title'));
		modal.find('.modal-body #youtubeEdit').val('');
		modal.find('.modal-body #youtube_vidEdit').val('');
        modal.find('.modal-body #finish_adateEdit').val(button.data('finishadate'));
		modal.find('.modal-body #newsFileList').html(button.data('file'));
		$('#youtubeIFrameEdit').removeClass('embed-responsive embed-responsive-16by9');
		$('#youtubeIFrameEdit').html('');
		if(button.data('youtube') != ''){
		modal.find('.modal-body #youtubeEdit').val("https://www.youtube.com/watch?v="+button.data('youtube'));
		$('#youtubeIFrameEdit').addClass('embed-responsive embed-responsive-16by9');
			$('#youtubeIFrameEdit').html('<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/'+ button.data('youtube') +'?rel=0" allowfullscreen></iframe>');
		}
		modal.find('.modal-body #youtube_vidEdit').val(button.data('youtube'));
		modal.find('.modal-body #detailEdit').val(button.data('detail'));
		modal.find('.modal-body #hiddendetailWithCKEditorEdit').val(button.data('detail'));
		CKEDITOR.replace('detailEdit');
		CKEDITOR.config.height = 300;
		CKEDITOR.config.language = 'th';
		
		$('#file_uploadEdit').uploadifive({
		'auto'             : true,
		'buttonText'   : '<i class="fas fa-cloud-upload-alt"></i> เลือกไฟล์แนบ',
		'multi'        : false,
		'dnd'          : false,
		'buttonClass'  : 'uploadclass',
		'removeCompleted' : true,
		'checkScript'      : base_url + 'public/uploadifive/check-exists.php',
		'queueID'          : 'queue_fileEdit',
		'formData'         : {'news_id' : $('#editID').val()},
		'uploadScript'     : base_url + 'public/uploadifive/uploadifive-guide-fileEdit.php',
		'onUploadComplete': function(file, data) {
			$('#newsFileList').html(file.name);
			toastr.success('อัพโหลดไฟล์สำเร็จ');
		},
		'onAddQueueItem' : function(file) {
			$('#checkqueFileEdit').val('yes');
		},
		'onCancel'     : function() {
            $('#checkqueFileEdit').val('no');
        }
		
	});
		
		
		
		$('#file_upload_coverEdit').uploadifive({
		'auto'             : true,
		'buttonText'   : '<i class="fas fa-cloud-upload-alt"></i> เลือกรูปภาพ',
		'multi'        : true,
		'dnd'          : false,
		'buttonClass'  : 'uploadclass',
		'removeCompleted' : true,
		'checkScript'      : base_url + 'public/uploadifive/check-exists.php',
		'queueID'          : 'queue_coverEdit',
		'formData'         : {'news_id' : $('#editID').val()},
		'uploadScript'     : base_url + 'public/uploadifive/uploadifive-guide-cover.php',
		'onUploadComplete': function(file, data) {
			newsPhotoList();
			//alert(data);
			//showAutoCloseTimerMessage();
			//showSuccessMessage("เธเธฑเธเธ—เธถเธเน€เธฃเธตเธขเธเธฃเนเธญเธข");
			//setTimeout(function(){ window.location.href = base_url + 'ITguide/'; }, 2000);
		},
		'onAddQueueItem' : function(file) {
			$('#checkqueEdit').val('yes');
		},
		'onCancel'     : function() {
            $('#checkqueEdit').val('no');
        }
	});
		
	})
 $('#myModalEdit').on('hide.bs.modal', function (event) {
	CKEDITOR.instances.detailEdit.destroy();
	loadNewsList();
	
 })
	
	

	$('#youtubeEdit').blur(function(){
	if ( $(this).val() == '') {
		$('#youtubeIFrameEdit').removeClass('embed-responsive embed-responsive-16by9');
		$('#youtubeIFrameEdit').html('');
		$('#youtube_vidEdit').val('');
	}else{
		var youtubeURL = $(this).val();
		var res = youtubeURL.split('watch?v=');
		var youtubeID = res[1];
		var res2 = youtubeID.split('&');
		youtubeID = res2[0];
		if (youtubeID != '') {
			$('#youtubeIFrameEdit').addClass('embed-responsive embed-responsive-16by9');
			$('#youtubeIFrameEdit').html('<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/'+ youtubeID +'?rel=0" allowfullscreen></iframe>');
			$('#youtube_vidEdit').val(youtubeID);
		}else{
			$('#youtubeIFrameEdit').removeClass('embed-responsive embed-responsive-16by9');
			$('#youtubeIFrameEdit').html('');
			$('#youtube_vidEdit').val('');
		}
	}
	});
	
	
	
	
	
	
	
	
	
});

$('#formGuideEdit').on('submit', function(e){
	e.preventDefault();
	var detailWithCKEditorEdit = CKEDITOR.instances.detailEdit.getData();
	$('#hiddendetailWithCKEditorEdit').val(detailWithCKEditorEdit);
	var oldSubmit = $('#btn-submitEdit').html();
	$('#btn-submitEdit').html("<i class='fa fa-spinner fa-pulse  fa-spin'></i>");
	$('#btn-submitEdit').prop('disabled',true);
	var sendURL="cmd=formGuideEdit&"+$('#formGuideEdit').serialize();
	$.ajax({	type: "POST",	url:  base_url + "Knowledge/formEdit/",	data: sendURL,
		success: function(msg)
			{
				if (msg == "true") {
				$('#btn-submitEdit').html(oldSubmit);
				$('#btn-submitEdit').prop('disabled',false);

					showSuccessMessage("บันทึกข้อมูลสำเร็จ");
                         $("button.confirm").click(function () {
                              $('#myModalEdit').modal('toggle');
							  loadNewsList();
                        });
				}else{
					alert(msg);
				}
			},
	error: function()
			{
				toastr.error('Disconnect Update');
				$('#btn-submitEdit').html(oldSubmit);
				$('#btn-submitEdit').prop('disabled',false);
			}
				
	});		
});





function uploadCoverEdit(getData)
   {
      $('#file_upload_cover').data('uploadifive').settings.formData =
      {
         'news_id'  : getData
      },
      $('#file_upload_cover').uploadifive('upload');
   }
   
   function uploadFilesEdit(getData)
   {
      $('#file_uploadEdit').data('uploadifive').settings.formData =
      {
         'news_id'  : getData
      },
      $('#file_uploadEdit').uploadifive('upload');
   }
   
   function newsPhotoList() {
	var sendURL="cmd=newsPhotoList&news_id=" + $('#editID').val();
	//alert(sendURL);
		$.ajax({	type: "POST",	url:  base_url + "Knowledge/newsPhotoList" ,	data: sendURL,
			success: function(msg)
				{
					$('#newsPhotoList').html(msg);
					$("#newsPhotoList").sortable({		
						update: function( event, ui ) {
							updateOrder();
						}
					});
					$('#loadAndDisable').removeClass('ld-loading');
				},
		error: function()
				{
					toastr.error('Disconnect loadnewsList');
					$('#loadnewsList').html('<tr><td colspan="4" class="text-center text-danger">error loading data</td></tr>');
				}
					
        });
}

function updateOrder() {
	$('#loadAndDisable').addClass('ld-loading');
	var item_order = new Array();
	$('#newsPhotoList div').each(function() {
		item_order.push($(this).data("id"));
	});
	var sendURL="cmd=updateOrder&ordered=" + item_order + "&news_id=" + $('#editID').val();
	//alert(sendURL);
		$.ajax({	type: "POST",	url:  base_url + "News/updateorder/",	data: sendURL,
			success: function(msg)
				{
					//alert(msg);
					newsPhotoList();
					toastr.success('เรียงลำดับเรียบร้อยแล้ว');
					
				},
		error: function()
				{
					toastr.error('ผิดพลาด !!!');
				}
					
        });
	
}

$( "#loadNewsList" ).delegate( ".deleteNews", "click", function() {
	
	if(confirm('ต้องการลบข้อมูล?')){
		$('#loadAndDisable').addClass('ld-loading');
	var sendURL="cmd=deleteLanna&news_id=" + $(this).data('id');
	//alert(sendURL);
	$.ajax({	type: "POST",	url:  base_url + "News/deletenews/",	data: sendURL,
			success: function(msg)
				{
					loadNewsList();
					toastr.warning('ลบเรียบข้อมูลร้อยแล้ว');
					
				},
		error: function()
				{
					toastr.error('ผิดพลาด !!!');
				}
					
        });
	}
	return false;
});



$( "#newsPhotoList" ).delegate( ".deleteGallery", "click", function() {
	
	if(confirm('ต้องการลบรูปภาพ')){
		$('#loadAndDisable').addClass('ld-loading');
	var sendURL="cmd=deleteGallery&gallery_id=" + $(this).data('id');
	//alert(sendURL);
	$.ajax({	type: "POST",	url:  base_url + "News/deleteGallery/",	data: sendURL,
			success: function(msg)
				{
					newsPhotoList();
					toastr.warning('ลบรูปภาพเรียบร้อยแล้ว');
					
				},
		error: function()
				{
					toastr.error('ผิดพลาด !!!');
				}
					
        });
	}
	return false;
});



$( function() {
    var date = $('#finish_adateEdit').datepicker({ dateFormat: 'yy-mm-dd' }).val();
   var date = $('#finish_adate').datepicker({ dateFormat: 'yy-mm-dd' }).val();
   
   $('#Editnews_category_id').change(function(){
    $('#editNewsCatID').removeClass('none');
    var sendURL="cmd=editNewsCateogryID&Editnews_category_id=" + $(this).val() +  "&news_id=" + $('#editID').val();
    //alert(sendURL);
	$.ajax({	type: "POST",	url:  base_url + "Knowledge/updateCategoryID/",	data: sendURL,
			success: function(msg)
				{
                    if(msg == "true"){
                        toastr.warning('ย้ายหมวดหมู่แล้ว');
					 }else{
                        toastr.error('ไม่สามารถย้ายหมวดหมู่ได้ !!! ' + msg);
                     }
                      $('#editNewsCatID').addClass('none');
				},
		error: function()
				{
                    $('#editNewsCatID').addClass('none');
					toastr.error('ผิดพลาด !!!');
				}
					
        });
   });
   
  } );





