$(function(){
   var date = $('#finish_adate').datepicker({ dateFormat: 'yy-mm-dd' }).val();
	
	CKEDITOR.replace('title', {
    customConfig: base_url + 'public/ckeditor/custom-popup-config.js'
});
    
    CKEDITOR.config.height = 200;
	CKEDITOR.config.language = 'th';


	
	
	
	
});

$('#formGuide').on('submit', function(e){
	e.preventDefault();
	var detailWithCKEditor = CKEDITOR.instances.title.getData();
	$('#hiddentitleWithCKEditor').val(detailWithCKEditor);
	var oldSubmit = $('#btn-submit').html();
	$('#btn-submit').html("<i class='fa fa-spinner fa-pulse  fa-spin'></i>");
	$('#btn-submit').prop('disabled',true);
	var sendURL="cmd=formGuide&"+$('#formGuide').serialize();
	//alert(sendURL);exit();
	$.ajax({	type: "POST",	url:  base_url + "Popup/formAdd/",	data: sendURL,
		success: function(msg)
			{

				if (msg == "true") {
				$('#btn-submit').html(oldSubmit);				
					showSuccessMessage("บันทึกข้อมูลสำเร็จ");
                         $("button.confirm").click(function () {
                              $('#myModal1').modal('toggle');
                              location.reload();
                        });
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


$( "#loadNewsList" ).delegate( ".deleteNews", "click", function() {
	
	if(confirm('ต้องการลบข้อมูล?')){
		$('#loadAndDisable').addClass('ld-loading');
	var sendURL="cmd=deleteLanna&popup_id=" + $(this).data('id');
	//alert(sendURL);
	$.ajax({	type: "POST",	url:  base_url + "Popup/deletenews/",	data: sendURL,
			success: function(msg)
				{
					showSuccessMessage("ลบข้อมูลเรียบร้อย");
                         $("button.confirm").click(function () {
                              $('#myModal1').modal('toggle');
                              location.reload();
                        });
					
				},
		error: function()
				{
					toastr.error('ผิดพลาด !!!');
				}
					
        });
	}
	return false;
});







