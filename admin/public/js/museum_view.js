$(function(){

loadNewsList();



	
	

	
	
	
	
	






 $('#myModalEdit').on('show.bs.modal', function (event) {
	
        var button = $(event.relatedTarget);
        var modal = $(this);
		modal.find('.modal-body #editID').val(button.data('id'));
		museumPhotoList();
        modal.find('.modal-body #titleEdit').val(button.data('title'));
		modal.find('.modal-header #modaltitlespan').html(button.data('title'));
		modal.find('.modal-body #youtubeEdit').val('');
		modal.find('.modal-body #youtube_vidEdit').val('');
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
		'formData'         : {'museum_id' : $('#editID').val()},
		'uploadScript'     : base_url + 'public/uploadifive/uploadifive-museum-fileEdit.php',
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
		'formData'         : {'museum_id' : $('#editID').val()},
		'uploadScript'     : base_url + 'public/uploadifive/uploadifive-museum.php',
		'onUploadComplete': function(file, data) {
			museumPhotoList();
		},
		'onAddQueueItem' : function(file) {
			$('#checkqueEdit').val('yes');
		},
		'onCancel'     : function() {
            $('#checkqueEdit').val('no');
        }
	});
	
	
});
		
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


function museumPhotoList() {
	var sendURL="cmd=newsPhotoList&museum_id=" + $('#editID').val();
	//alert(sendURL);
		$.ajax({	type: "POST",	url:  base_url + "Museum/museumPhotoList" ,	data: sendURL,
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
					toastr.error('Disconnect museumPhotoList');
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
	var sendURL="cmd=updateOrder&ordered=" + item_order + "&museum_id=" + $('#editID').val();
	//alert(sendURL);
		$.ajax({	type: "POST",	url:  base_url + "Museum/updateorder/",	data: sendURL,
			success: function(msg)
				{
					//alert(msg);
					museumPhotoList();
					toastr.success('เรียงลำดับเรียบร้อยแล้ว');
					
				},
		error: function()
				{
					toastr.error('ผิดพลาด !!!');
				}
					
        });
	
}

$( "#newsPhotoList" ).delegate( ".deleteGallery", "click", function() {
	
	if(confirm('ต้องการลบรูปภาพ')){
		$('#loadAndDisable').addClass('ld-loading');
	var sendURL="cmd=deleteGallery&gallery_id=" + $(this).data('id');
	//alert(sendURL);
	$.ajax({	type: "POST",	url:  base_url + "Museum/deleteGallery/",	data: sendURL,
			success: function(msg)
				{
					museumPhotoList();
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


$('#myModalEdit').on('hide.bs.modal', function (event) {
	CKEDITOR.instances.detailEdit.destroy();
loadNewsList();
	
 })


$('#formGuideEdit').on('submit', function(e){
	e.preventDefault();
	var detailWithCKEditorEdit = CKEDITOR.instances.detailEdit.getData();
	$('#hiddendetailWithCKEditorEdit').val(detailWithCKEditorEdit);
	var oldSubmit = $('#btn-submitEdit').html();
	$('#btn-submitEdit').html("<i class='fa fa-spinner fa-pulse  fa-spin'></i>");
	$('#btn-submitEdit').prop('disabled',true);
	var sendURL="cmd=formGuideEdit&"+$('#formGuideEdit').serialize();
	$.ajax({	type: "POST",	url:  base_url + "Museum/formEdit/",	data: sendURL,
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


function loadNewsList() {
	var sendURL="cmd=loadNewsList";
	//alert(sendURL);
		$.ajax({	type: "POST",	url:  base_url + "Museum/loadMuseumList" ,	data: sendURL,
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


