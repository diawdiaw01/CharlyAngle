$(function(){
$('[data-toggle="tooltip"]').tooltip()

$('#showSync').click(function(){
	$('#spinme').addClass('fa-spin');
	var sendURL="cmd=showSync";
		$.ajax({	type: "POST",	url:  base_url + "Track/checkEdocState/",	data: sendURL,
			success: function(msg)
				{
					if (msg == "true") {
						toastr.success('Sync สำเร็จ');
						loadEdocSetting();
						loadnewincome();
						$('#spinme').removeClass('fa-spin');
					}else{
						toastr.warning(msg);
					}
					
				},
		error: function()
				{
					toastr.error('มีปัญหากับการเชื่อมต่อ showSync ');
				}
					
        });
});

$('#editModal').on('show.bs.modal', function (event) {
			loadParcelCategory();
			var button = $(event.relatedTarget);
			var editID = button.data('id');
			$('#edit_following_id').val(editID);
		})
	loadAdminList();
	loadEdocSetting();
	toastr.options = {
            "debug": false,
            "newestOnTop": false,
            "positionClass": "toast-bottom-right",
            "closeButton": true,
            "progressBar": true
        };
		
	$(".select2_demo_2").select2({
            placeholder: "== กรุณาเลือก ==",
            allowClear: true
        });
	
	

    });


function loadAdminList() {
	$('.loader-spin').removeClass('none');
	var sendURL="cmd=loadAdminList";
		$.ajax({	type: "POST",	url:  base_url + "Position/loadAdminList/",	data: sendURL,
			success: function(msg)
				{
					$('#loadAdminList').html(msg);
					$('#loadAdminList2').html(msg);
					$('.loader-spin').addClass('none');
				},
		error: function()
				{
					toastr.error('มีปัญหากับการเชื่อมต่อ loadPosition('+catID+')');
				}
					
        });
}

$('#updateFollowingCategory').on('submit', function(e){
	e.preventDefault();
	$('.respond_spin').removeClass('none');
	var sendURL="cmd=editParcelCategory&"+$('#updateFollowingCategory').serialize();
		$.ajax({	type: "POST",	url:  base_url + "Checkpoint/updatefollowingcategory/",	data: sendURL,
			success: function(msg)
				{
					//alert(msg);
					if (msg == "true") {					
					$('.respond_spin').addClass('none');
					$('#editModal').modal('hide');
					toastr.success('บันทึกเรียบร้อยแล้ว');
					}else{
						toastr.warning(msg);
					}
					loadEdocSetting();
				},
		error: function()
				{
					toastr.error('มีปัญหากับการเชื่อมต่อ');
					$('.respond_spin').addClass('none');
					toastr.success('บันทึกเรียบร้อยแล้ว');
				}
					
        });
});





function loadParcelCategory() {
	$('.loader-spin').removeClass('none');
	var sendURL="cmd=loadCategoryList";
		$.ajax({	type: "POST",	url:  base_url + "Position/loadParcelCategory/",	data: sendURL,
			success: function(msg)
				{
					$('#loadParcelCategory').html(msg);
					$('.loader-spin').addClass('none');
				},
		error: function()
				{
					toastr.error('มีปัญหากับการเชื่อมต่อ loadCategoryList');
				}
					
        });
}



function loadEdocSetting() {
	$('.loader-spin').removeClass('none');
	var sendURL="cmd=loadEdocSetting";
		$.ajax({	type: "POST",	url:  base_url + "Checkpoint/loadEdocSetting/",	data: sendURL,
			success: function(msg)
				{
					$('#loadEdocSetting').html(msg);
					$('.loader-spin').addClass('none');
				},
		error: function()
				{
					toastr.error('มีปัญหากับการเชื่อมต่อ loadEdocSetting');
				}
					
        });
}