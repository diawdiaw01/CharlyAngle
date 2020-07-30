$(function(){


$('#editModal').on('show.bs.modal', function (event) {
			loadParcelCategory();
			var button = $(event.relatedTarget);
			var editID = button.data('id');
			$('#edit_following_id').val(editID);
		})

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
		$.ajax({	type: "POST",	url:  base_url + "Checkpoint/loadEdocSettingWithAccepted/",	data: sendURL,
			success: function(msg)
				{
					$('#loadEdocSetting').html(msg);
					$('#tableExample2').DataTable({
					"dom": "<'row'<'col-sm-6'l><'col-sm-6'f>>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
					"lengthMenu": [ [100, 200, 500, -1], [100, 200, 500, "All"] ],
					"iDisplayLength": 100,
				});
					$('.loader-spin').addClass('none');
				},
		error: function()
				{
					toastr.error('มีปัญหากับการเชื่อมต่อ loadEdocSettingWithAccepted');
				}
					
        });
}