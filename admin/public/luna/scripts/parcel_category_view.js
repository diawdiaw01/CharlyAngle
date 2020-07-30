$('#addParcelCategory').on('submit', function(e){
	e.preventDefault();
	$('.respond_spin').removeClass('none');
	var sendURL="cmd=addParcelCategory&"+$('#addParcelCategory').serialize();
		$.ajax({	type: "POST",	url:  base_url + "Parcel/addcategory/",	data: sendURL,
			success: function(msg)
				{
					if (msg == "true") {					
					$('#title').val('');
					$('.respond_spin').addClass('none');
					$('#addModal').modal('hide');
					loadPacelCategory();
					toastr.success('บันทึกเรียบร้อยแล้ว');
					}else{
						toastr.warning(msg);
					}
				},
		error: function()
				{
					toastr.error('มีปัญหากับการเชื่อมต่อ');
					$('.respond_spin').addClass('none');
					toastr.success('บันทึกเรียบร้อยแล้ว');
				}
					
        });
});

$('#editParcelCategory').on('submit', function(e){
	e.preventDefault();
	$('.respond_spin').removeClass('none');
	var sendURL="cmd=editParcelCategory&"+$('#editParcelCategory').serialize();
		$.ajax({	type: "POST",	url:  base_url + "Parcel/editcategory/",	data: sendURL,
			success: function(msg)
				{
					if (msg == "true") {					
					$('#title_edit').val('');
					$('.respond_spin').addClass('none');
					$('#editModal').modal('hide');
					loadPacelCategory();
					toastr.success('แก้ไขเรียบร้อยแล้ว');
					}else{
						toastr.warning(msg);
					}
				},
		error: function()
				{
					toastr.error('มีปัญหากับการเชื่อมต่อ');
					$('.respond_spin').addClass('none');
					toastr.success('บันทึกเรียบร้อยแล้ว');
				}
					
        });
});



$('#deleteParcelCategory').on('submit', function(e){
	e.preventDefault();
	$('.respond_spin').removeClass('none');
	var sendURL="cmd=deleteParcelCategory&"+$('#deleteParcelCategory').serialize();
		$.ajax({	type: "POST",	url:  base_url + "Parcel/deletecategory/",	data: sendURL,
			success: function(msg)
				{
					if (msg == "true") {					
					$('.respond_spin').addClass('none');
					$('#deleteModal').modal('hide');
					loadPacelCategory();
					toastr.success('ลบเรียบร้อยแล้ว');
					}else{
						toastr.warning(msg);
					}
				},
		error: function()
				{
					toastr.error('มีปัญหากับการเชื่อมต่อ');
					$('.respond_spin').addClass('none');
					toastr.success('บันทึกเรียบร้อยแล้ว');
				}
					
        });
});

$(function(){
	loadPacelCategory();
	toastr.options = {
            "debug": false,
            "newestOnTop": false,
            "positionClass": "toast-bottom-right",
            "closeButton": true,
            "progressBar": true
        };
		
		$('#editModal').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget);
			var editText = button.data('edit');
			var editID = button.data('id');
			var modal = $(this);
			modal.find('.modal-body #title_edit').val(editText);
			modal.find('.modal-footer #edit_parcel_category_id').val(editID);
		})
		
		$('#deleteModal').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget);
			var editText = button.data('delete');
			var editID = button.data('id');
			var modal = $(this);
			modal.find('.modal-body .delete_text').html(editText);
			modal.find('.modal-footer #delete_parcel_category_id').val(editID);
		})

});


function loadPacelCategory() {
	//$('#respond_spin').removeClass('none');
	var sendURL="cmd=loadCategoryList&"+$('#loadPacelCategory').serialize();
		$.ajax({	type: "POST",	url:  base_url + "Parcel/loadPacelCategory/",	data: sendURL,
			success: function(msg)
				{
					$('#loadPacelCategory').html(msg);
					$("#loadPacelCategory").sortable({		
						update: function( event, ui ) {
							updateOrder();
						}
					}); 
				},
		error: function()
				{
					toastr.error('มีปัญหากับการเชื่อมต่อ loadCategoryList');
				}
					
        });
}



function updateOrder() {	
	var item_order = new Array();
	$('#loadPacelCategory tr').each(function() {
		item_order.push($(this).data("id"));
	});
	var sendURL="cmd=loadAdminList&ordered=" + item_order;
	//alert(sendURL);
		$.ajax({	type: "POST",	url:  base_url + "Parcel/updateorder/",	data: sendURL,
			success: function(msg)
				{
					//alert(msg);
					loadPacelCategory();
					toastr.success('เรียงลำดับแล้ว');
				},
		error: function()
				{
					toastr.error('มีปัญหากับการเชื่อมต่อ loadPosition('+catID+')');
				}
					
        });
	
}