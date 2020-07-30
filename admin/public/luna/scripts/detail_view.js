$(function(){
	$('#showNexPregress').html($('#hiddenNextProgress').html());
	if ($('#showNexPregress').html() == "") {
		$('#mainNextProgress').addClass('none');
		$('#howLong1').addClass('none');
	}
	
	$('#showParcelListByEmpID').click(function(e){
		e.preventDefault();
		alert('ดูรายการที่เคยขอจัดซื้อจัดจ้างทั้งหมดของ\n\n '+ $(this).html() + '\n\n in the future...');
		return false;
	});
    });



