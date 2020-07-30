$(function(){
	loadMonth();
	loadYear();
	setTimeout(function(){
		$('.navigation').fadeOut(500,function(){
			$('#navHamberger').trigger('click')
			$('.navbar-default').fadeOut(500)
			$('#showObject').show();
		})
	 }, 500)
	
	
	$('#showObject').click(function(){
		$('#showObject').fadeOut(200);
		$('.navigation').fadeIn(200,function(){
			$('#navHamberger').trigger('click');
			$('.navbar-default').fadeIn(1000);
			
		});
		return false;
	});
})

$('.count').each(function () {
    $(this).prop('Counter',0).animate({
        Counter: $(this).text()
    }, {
        duration: 3000,
        easing: 'swing',
        step: function (now) {
            $(this).text(Math.ceil(now));
        }
    });
});

function loadMonth() {
	$('.loader-spin').removeClass('none');
	var sendURL="cmd=loadMonth";
		$.ajax({	type: "POST",	url:  base_url + "Report/loadMonth/"+$('#hiddenMonth').val(),	data: sendURL,
			success: function(msg)
				{
					$('#loadMonth').html(msg);
					$('.loader-spin').addClass('none');
				},
		error: function()
				{
					toastr.error('มีปัญหากับการเชื่อมต่อ loadMonth');
				}
					
        });
}

function loadYear() {
	$('.loader-spin').removeClass('none');
	var sendURL="cmd=loadYear";
		$.ajax({	type: "POST",	url:  base_url + "Report/loadYear/"+$('#hiddenYear').val(),	data: sendURL,
			success: function(msg)
				{
					$('#loadYear').html(msg);
					$('.loader-spin').addClass('none');
				},
		error: function()
				{
					toastr.error('มีปัญหากับการเชื่อมต่อ loadYear');
				}
					
        });
}

$('#reportForMonthSearch').click(function(){
	window.location = base_url + "Report/monthly/" + $('#loadMonth').val() + "/" + $('#loadYear').val();
});