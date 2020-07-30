$(function(){
    CKEDITOR.replace('detailEdit');
    CKEDITOR.config.height = 500;
	CKEDITOR.config.language = 'th';
    
    museumPhotoList();
    //showSuccessMessage("บันทึกข้อมูลสำเร็จ");
    
    $('#file_upload_coverEdit').uploadifive({
		'auto'             : true,
		'buttonText'   : '<i class="fas fa-cloud-upload-alt"></i> เลือกรูปภาพ',
		'multi'        : true,
		'dnd'          : false,
		'buttonClass'  : 'uploadclass',
		'removeCompleted' : true,
		'checkScript'      : base_url + 'public/uploadifive/check-exists.php',
		'queueID'          : 'queue_coverEdit',
		'formData'         : {'stf_id' : '1'},
		'uploadScript'     : base_url + 'public/uploadifive/uploadifive-structure.php',
		'onUploadComplete': function(file, data) {
            //alert(data);
			location.reload();
		},
		'onAddQueueItem' : function(file) {
			$('#checkqueEdit').val('yes');
		},
		'onCancel'     : function() {
            $('#checkqueEdit').val('no');
        }
	});
    
    /*
    config.allowedContent = true;
    */
    
    $('#file_upload').uploadifive({
		'auto'             : true,
		'buttonText'   : 'เลือกรูปภาพ',
		'multi'        : true,
		'dnd'          : false,
		'buttonClass'  : 'uploadclass',
		'removeCompleted' : true,
		'checkScript'      : base_url + 'assets/plugins/uploadifive/check-exists.php',
		'queueID'          : 'queue',
		'uploadScript'     :base_url + 'public/uploadifive/uploadifive-aboutus.php',
		'onUploadComplete': function(file, data) {
			var setURL = 'http://art-culture.cmu.ac.th/2019/public/img/uploadfile/' + data;
			var setHtml = '<img class="img-fluid" src="' + setURL + '" alt="" >';
            alert(setHtml);
			CKEDITOR.instances.detailEdit.insertHtml(setHtml);
		},
		'onAddQueueItem' : function(file) {
			$('#checkque').val('yes');
		}
	});
    
    
    });
    
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
    
    $('#formGuideEdit').on('submit', function(e){
	e.preventDefault();
	var detailWithCKEditorEdit = CKEDITOR.instances.detailEdit.getData();
	$('#hiddendetailWithCKEditorEdit').val(detailWithCKEditorEdit);
	var oldSubmit = $('#btn-submitEdit').html();
	$('#btn-submitEdit').html("<i class='fa fa-spinner fa-pulse  fa-spin'></i>");
	$('#btn-submitEdit').prop('disabled',true);
	var sendURL="cmd=formGuideEdit&"+$('#formGuideEdit').serialize();
	$.ajax({	type: "POST",	url:  base_url + "Aboutus/formEdit/",	data: sendURL,
		success: function(msg)
			{
                //alert(msg);
				if (msg == "true") {
				$('#btn-submitEdit').html(oldSubmit);
				$('#btn-submitEdit').prop('disabled',false);

					showSuccessMessage("บันทึกข้อมูลสำเร็จ");
                         $("button.confirm").click(function () {
                              //$('#myModalEdit').modal('toggle');
							 // loadNewsList();
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
	var sendURL="cmd=deleteGallery&gallery_id=" + $(this).data('id') + "&image=" + $(this).data('image');
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
    
    
