$(function(){
	$('.check_position').prop('disabled', true);
	$('.panel-body div.checkbox:eq('+(checkedFind-1)+')').find('input[type=checkbox]').prop('disabled', false);
	$('.panel-body div.checkbox:eq('+checkedFind+')').find('input[type=checkbox]').prop('disabled', false);
	if(checkedFind != 0){
		$('.panel-body div.checkbox:eq('+(checkedFind+1)+')').find('input[type=checkbox]').prop('disabled', false);
	}
	if($('#check'+lastFind).prop('checked') == false) {
		$('.panel-body div.checkbox:eq('+(lastFind)+')').find('input[type=checkbox]').prop('disabled', false);
	}else{
		$('.panel-body div.checkbox:eq('+(lastFind)+')').find('input[type=checkbox]').prop('disabled', true);
	}
	
	
	
	$('.check_position').click(function(){
		var thisischekcbox = $(this);
		thisischekcbox.parent().find('input[type=text]').removeClass('animated tada');
		if(thisischekcbox.prop('checked') == false) {
			thisischekcbox.prop('checked', false);
			$('#checkbox' + (thisischekcbox.data('key')-1)).prop('disabled', false);
			$('#checkbox' + (thisischekcbox.data('key')+1)).prop('disabled', true);
			
			var sendURL="cmd=deleteProgress&status=delete&position_id=" + thisischekcbox.val() + "&document_id=" + edocID + "&following_id=" + followingID + "&checker_emp_id=" + checker_emp_id;
				$.ajax({	type: "POST",	url:  base_url + "Checkpoint/deleteFollowingPositionStage/",	data: sendURL,
					success: function(msg)
						{
							if (msg == "true") {					
							toastr.warning('Checked '+thisischekcbox.data('key')+' = False');
							}else{
								toastr.warning(msg);
							}
						},
				error: function()
						{
							toastr.error('มีปัญหากับการเชื่อมต่อ');
						}
				});
			
			//alert('1');
		}else{
			var ex = thisischekcbox.parent().find('input[type=text]').val();
			
			if (thisischekcbox.data('ref') == 'y' && ex =='') {
				toastr.error('กรุณากรอกเลขเอกสารอ้างอิงจากระบบ E-Document');
				thisischekcbox.prop('checked', false);
				thisischekcbox.parent().find('input[type=text]').css('border','1px solid #DB524B');
				thisischekcbox.parent().find('input[type=text]').addClass('animated tada');
			}else{
			thisischekcbox.prop('checked', true);
			$('#checkbox' + (thisischekcbox.data('key')-1)).prop('disabled', true);
			$('#checkbox' + (thisischekcbox.data('key')+1)).prop('disabled', false);
			
				var sendURL="cmd=addProgress&status=insert&position_id=" + thisischekcbox.val() + "&document_id=" + edocID + "&following_id=" + followingID + "&checker_emp_id=" + checker_emp_id + "&reference=" + ex;
				$.ajax({	type: "POST",	url:  base_url + "Checkpoint/addFollowingPositionStage/",	data: sendURL,
					success: function(msg)
						{
							if (msg == "true") {					
							toastr.success('Checked '+thisischekcbox.data('key')+' = True');
							}else{
								toastr.warning(msg);
							}
						},
				error: function()
						{
							toastr.error('มีปัญหากับการเชื่อมต่อ');
						}
				});
			}
		}
	});
});




$('#bounceNote').on('submit', function(e){
	e.preventDefault();
	$('.respond_spin').removeClass('none');
		var sendURL="cmd=bounceNote&following_id=" + followingID + "&document_id=" + edocID + "&emp_id=" + checker_emp_id + "&" + $('#bounceNote').serialize();
		$.ajax({	type: "POST",	url:  base_url + "Checkpoint/addBounce/",	data: sendURL,
			success: function(msg)
				{
					if (msg == "true") {					
					$('.respond_spin').addClass('none');
					$('#bounceNoteModal').modal('hide');
					toastr.success('บันทึกเรียบร้อยแล้ว <i class="fas fa-sync-alt fa-spin"></i> กำลังเปลี่ยนหน้า กรุณารอสักครู่');
					setTimeout(function(){
						window.location = base_url + "Checkpoint/checking/" + edocID  + "/" + followingID;
						}, 2000);
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


$('#bounceNoteEdit').on('submit', function(e){
	e.preventDefault();
	$('.respond_spin').removeClass('none');
		var sendURL="cmd=bounceNoteEdit&following_id=" + followingID + "&document_id=" + edocID + "&emp_id=" + checker_emp_id;
		$.ajax({	type: "POST",	url:  base_url + "Checkpoint/editBounce/",	data: sendURL,
			success: function(msg)
				{
					if (msg == "true") {					
					$('.respond_spin').addClass('none');
					$('#EditbounceNoteModal').modal('hide');
					toastr.success('แก้ไขเรียบร้อยแล้ว <i class="fas fa-sync-alt fa-spin"></i> กำลังเปลี่ยนหน้า กรุณารอสักครู่');
					setTimeout(function(){
						window.location = base_url + "Checkpoint/checking/" + edocID  + "/" + followingID;
						}, 2000);
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


$('#following_note').blur(function(){
	$('.respond_spin').removeClass('none');
		var sendURL="cmd=updateFollowingNote&following_id=" + followingID + "&document_id=" + edocID + "&emp_id=" + checker_emp_id + "&note=" + $(this).val();
		$.ajax({	type: "POST",	url:  base_url + "Checkpoint/updateFollowingNote/",	data: sendURL,
			success: function(msg)
				{
					if (msg == "true") {					
					$('.respond_spin').addClass('none');
					toastr.success('บันทึกหมายเหตุเรียบร้อยแล้ว');
					}else{
						//toastr.warning(msg);
						$('.respond_spin').addClass('none');
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

/*

$('#checkbox2').click(function(){
	$('.loga').append('<br>');
	if(document.getElementById('checkbox2').checked) {
		toastr.success('Success - checkbox2');
		$('#checkbox2_hidden').removeClass('none');
		$('#checkbox3').prop('disabled', false);
		$('.loga').append('2 checked');
	} else {
		toastr.warning('Warning unchecked2');
		$('#checkbox2_hidden').addClass('none');
		$('#checkbox3').prop('disabled', true);
		$('.loga').append('2 unchecked');
	}
});
$('#checkbox3').click(function(){
	$('.loga').append('<br>');
	if(document.getElementById('checkbox3').checked) {
		toastr.success('Success - checkbox3');
		$('#checkbox3_hidden').removeClass('none');
		$('#checkbox2').prop('disabled', true);
		$('#checkbox4').prop('disabled', false);
		$('.loga').append('3 checked');
	} else {
		toastr.warning('Warning unchecked3');
		$('#checkbox3_hidden').addClass('none');
		$('#checkbox2').prop('disabled', false);
		$('#checkbox4').prop('disabled', true);
		$('.loga').append('3 unchecked');
	}
});
$('#checkbox4').click(function(){
	$('.loga').append('<br>');
	if(document.getElementById('checkbox4').checked) {
		toastr.success('Success - checkbox4');
		$('#checkbox4_hidden').removeClass('none');
		$('#checkbox3').prop('disabled', true);
		$('#checkbox5').prop('disabled', false);
		$('.loga').append('4 checked');
	} else {
		toastr.warning('Warning unchecked4');
		$('#checkbox4_hidden').addClass('none');
		$('#checkbox3').prop('disabled', false);
		$('#checkbox5').prop('disabled', true);
		$('.loga').append('4 unchecked');
	}
});
$('#checkbox5').click(function(){
	$('.loga').append('<br>');
	if(document.getElementById('checkbox5').checked) {
		toastr.success('Success - checkbox5');
		$('#checkbox5_hidden').removeClass('none');
		$('#checkbox4').prop('disabled', true);
		$('#checkbox6').prop('disabled', false);
		$('.loga').append('5 checked');
	} else {
		toastr.warning('Warning unchecked5');
		$('#checkbox5_hidden').addClass('none');
		$('#checkbox4').prop('disabled', false);
		$('#checkbox6').prop('disabled', true);
		$('.loga').append('5 unchecked');
	}
});
$('#checkbox6').click(function(){
	$('.loga').append('<br>');
	if(document.getElementById('checkbox6').checked) {
		toastr.success('Success - checkbox6');
		$('#checkbox6_hidden').removeClass('none');
		$('#checkbox5').prop('disabled', true);
		$('#checkbox7').prop('disabled', false);
		$('.loga').append('6 checked');
	} else {
		toastr.warning('Warning unchecked6');
		$('#checkbox6_hidden').addClass('none');
		$('#checkbox5').prop('disabled', false);
		$('#checkbox7').prop('disabled', true);
		$('.loga').append('6 unchecked');
	}
});
$('#checkbox7').click(function(){
	$('.loga').append('<br>');
	if(document.getElementById('checkbox7').checked) {
		toastr.success('Success - checkbox7');
		$('#checkbox7_hidden').removeClass('none');
		$('#checkbox6').prop('disabled', true);
		$('#checkbox8').prop('disabled', false);
		$('.loga').append('7 checked');
	} else {
		toastr.warning('Warning unchecked7');
		$('#checkbox7_hidden').addClass('none');
		$('#checkbox6').prop('disabled', false);
		$('#checkbox8').prop('disabled', true);
		$('.loga').append('7 unchecked');
	}
});
$('#checkbox8').click(function(){
	$('.loga').append('<br>');
	if(document.getElementById('checkbox8').checked) {
		toastr.success('Success - checkbox8');
		$('#checkbox8_hidden').removeClass('none');
		$('#checkbox7').prop('disabled', true);
		$('#checkbox9').prop('disabled', false);
		$('.loga').append('8 checked');
	} else {
		toastr.warning('Warning unchecked8');
		$('#checkbox8_hidden').addClass('none');
		$('#checkbox7').prop('disabled', false);
		$('#checkbox9').prop('disabled', true);
		$('.loga').append('8 unchecked');
	}
});
$('#checkbox9').click(function(){
	$('.loga').append('<br>');
	if(document.getElementById('checkbox9').checked) {
		toastr.success('Success - checkbox9');
		$('#checkbox9_hidden').removeClass('none');
		$('#checkbox8').prop('disabled', true);
		$('#checkbox10').prop('disabled', false);
		$('.loga').append('9 checked');
	} else {
		toastr.warning('Warning unchecked9');
		$('#checkbox9_hidden').addClass('none');
		$('#checkbox8').prop('disabled', false);
		$('#checkbox10').prop('disabled', true);
		$('.loga').append('9 unchecked');
	}
});
$('#checkbox10').click(function(){
	$('.loga').append('<br>');
	if(document.getElementById('checkbox10').checked) {
		toastr.success('Success - checkbox10');
		$('#checkbox10_hidden').removeClass('none');
		$('#newnumber').removeClass('none');
		$('#checkbox9').prop('disabled', true);
		$('.loga').append('10 checked');
		$('.loga').append('<br>10 show input text');
	} else {
		toastr.warning('Warning unchecked10');
		$('#checkbox10_hidden').addClass('none');
		$('#newnumber').addClass('none');
		$('#checkbox9').prop('disabled', false);
		$('.loga').append('10 unchecked');
		$('.loga').append('<br>10 hide input text');
	}
});
*/
$('#newnumber').blur(function(){
	if(document.getElementById('newnumber').value != "") {
		$('.loga').append('<br>10 type text ' + document.getElementById('newnumber').value);
	}
});


document.addEventListener('DOMContentLoaded', function () {
  if (!Notification) {
    alert('Desktop notifications not available in your browser. Try Chromium.'); 
    return;
  }

  if (Notification.permission !== "granted")
    Notification.requestPermission();
});

function notifyMe() {
  if (Notification.permission !== "granted")
    Notification.requestPermission();
  else {
    var notification = new Notification('ระบบติดตามการจัดซื้อจัดจ้าง', {
      icon: 'https://gap.hrdi.or.th/public/img/logo-hrdi.png',
      body: "แจ้งความประสงค์ขอซื้อ/ขอจ้าง จำนวน 32 รายการ",
    });

    notification.onclick = function () {
      window.open("http://localhost/tracking/Track/detail");      
    };

  }

}

$(function(){
	 toastr.options = {
            "debug": false,
            "newestOnTop": false,
            "positionClass": "toast-bottom-right",
            "closeButton": true,
            "progressBar": true
        };
	//setTimeout(function(){notifyMe(); }, 5000);
	
})