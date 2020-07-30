$('#addPosition').on('submit', function(e){
	e.preventDefault();
	$('.respond_spin').removeClass('none');
	var sendURL="cmd=addPosition&"+$('#addPosition').serialize();
	//alert(sendURL);
		$.ajax({	type: "POST",	url:  base_url + "Position/addposition/",	data: sendURL,
			success: function(msg)
				{
					if (msg == "true") {					
					$('#title').val('');
					$('#how_long').val('');
					$('.respond_spin').addClass('none');
					$('#addModal').modal('hide');
					loadPosition($('#parcel_category_id').val());
					toastr.success('บันทึกเรียบร้อยแล้ว');
					}else{
						toastr.warning(msg);
					}
				},
		error: function()
				{
					toastr.error('มีปัญหากับการเชื่อมต่อ');
					$('.respond_spin').addClass('none');
					//toastr.success('บันทึกเรียบร้อยแล้ว');
				}
					
        });
});

$('#editPosition').on('submit', function(e){
	e.preventDefault();
	$('.respond_spin').removeClass('none');
	var sendURL="cmd=editPosition&"+$('#editPosition').serialize();
	//alert(sendURL);
		$.ajax({	type: "POST",	url:  base_url + "Position/editposition/",	data: sendURL,
			success: function(msg)
				{
					//alert(msg);
					if (msg == "true") {					
					$('#title_edit').val('');
					$('#how_long').val('');
					$('.respond_spin').addClass('none');
					$('#editModal').modal('hide');
					loadPosition($('#parcel_category_id').val());
					toastr.success('แก้ไขเรียบร้อยแล้ว');
					}else{
						toastr.warning(msg);
					}
				},
		error: function()
				{
					toastr.error('มีปัญหากับการเชื่อมต่อ');
					$('.respond_spin').addClass('none');
					//toastr.success('บันทึกเรียบร้อยแล้ว');
				}
					
        });
});



$('#deletePosition').on('submit', function(e){
	e.preventDefault();
	$('.respond_spin').removeClass('none');
	var sendURL="cmd=deletePosition&"+$('#deletePosition').serialize();
		$.ajax({	type: "POST",	url:  base_url + "Position/deleteposition/",	data: sendURL,
			success: function(msg)
				{
					if (msg == "true") {					
					$('.respond_spin').addClass('none');
					$('#deleteModal').modal('hide');
					loadPosition($('#parcel_category_id').val());
					toastr.success('ลบเรียบร้อยแล้ว');
					}else{
						toastr.warning(msg);
					}
				},
		error: function()
				{
					toastr.error('มีปัญหากับการเชื่อมต่อ');
					$('.respond_spin').addClass('none');
					//toastr.success('บันทึกเรียบร้อยแล้ว');
				}
        });
});



$(function(){
	
	

	toastr.info('กรุณาเลือกประเภทการจัดซื้อ/จัดจ้าง');
	loadParcelCategory();
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
		
		$( "#loadParcelCategory" ).change(function() {
			if ($(this).val() != '') {
				$('#add-btn').removeClass('none');
				loadPosition($(this).val());
				$('#parcel_category_id').val($(this).val());
			}else{
				$('#add-btn').addClass('none');
				$('#loadPosition').html('');
			}
		});
		
		
		$('#addModal').on('show.bs.modal', function (event) {
			loadAdminList();
			var modal = $(this);
			modal.find('.modal-body #is_reference').prop('checked', false);
		})
		
		$('#editModal').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget);
			var editText = button.data('edit');
			var editID = button.data('id');
			var emp_id = button.data('emp-id');
			var emp_id2 = button.data('emp-id2');
			var how_long = button.data('how-long');
			var isRef = button.data('is-ref');
			var modal = $(this);
			modal.find('.modal-body #title_edit').val(editText);
			modal.find('.modal-body #how_long_edit').val(how_long);
			modal.find('.modal-footer #edit_position_id').val(editID);
			if (isRef == 'y') {
				modal.find('.modal-body #is_reference_edit').prop('checked', true);
				modal.find('.modal-body #is_reference_edit').val('y');
			}else{
				modal.find('.modal-body #is_reference_edit').prop('checked', false);
				modal.find('.modal-body #is_reference_edit').val('n');
			}
			loadAdminListEdit(emp_id);
			loadAdminListEdit2(emp_id2);
		})
		
		$('#deleteModal').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget);
			var editText = button.data('delete');
			var editID = button.data('id');
			var modal = $(this);
			modal.find('.modal-body .delete_text').html(editText);
			modal.find('.modal-footer #delete_position_id').val(editID);
		})
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

function loadPosition(catID) {
	$('.loader-spin').removeClass('none');
	var sendURL="cmd=loadPosition&parcel_category_id=" + catID;
		$.ajax({	type: "POST",	url:  base_url + "Position/loadPosition/",	data: sendURL,
			success: function(msg)
				{
					$('#loadPosition').html(msg);
					$('.loader-spin').addClass('none');
					$("#loadPosition").sortable({		
						update: function( event, ui ) {
							updateOrder();
						}
					}); 
				},
		error: function()
				{
					toastr.error('มีปัญหากับการเชื่อมต่อ loadPosition('+catID+')');
				}
					
        });
}


function updateOrder() {	
	var item_order = new Array();
	$('#loadPosition tr').each(function() {
		item_order.push($(this).data("id"));
	});
	var catID = $('#parcel_category_id').val();
	var sendURL="cmd=loadAdminList&ordered=" + item_order + "&catID=" + catID;
	//alert(sendURL);
		$.ajax({	type: "POST",	url:  base_url + "Position/updateorder/",	data: sendURL,
			success: function(msg)
				{
					//alert(msg);
					loadPosition(catID);
					toastr.success('เรียงลำดับแล้ว');
				},
		error: function()
				{
					toastr.error('มีปัญหากับการเชื่อมต่อ loadPosition('+catID+')');
				}
					
        });
	
}

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


function loadAdminListEdit(selectedID) {
	$('.loader-spin').removeClass('none');
	var sendURL="cmd=loadAdminList&selectedID=" + selectedID;
	//alert(sendURL);
		$.ajax({	type: "POST",	url:  base_url + "Position/loadAdminList/",	data: sendURL,
			success: function(msg)
				{
					$('#loadAdminList_edit').html(msg);
					$('.loader-spin').addClass('none');
				},
		error: function()
				{
					toastr.error('มีปัญหากับการเชื่อมต่อ loadPosition('+catID+')');
				}
					
        });
}

function loadAdminListEdit2(selectedID) {
	$('.loader-spin').removeClass('none');
	var sendURL="cmd=loadAdminList&selectedID=" + selectedID;
	//alert(sendURL);
		$.ajax({	type: "POST",	url:  base_url + "Position/loadAdminList/",	data: sendURL,
			success: function(msg)
				{
					$('#loadAdminList2_edit').html(msg);
					$('.loader-spin').addClass('none');
				},
		error: function()
				{
					toastr.error('มีปัญหากับการเชื่อมต่อ loadPosition('+catID+')');
				}
					
        });
}