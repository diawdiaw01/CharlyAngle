$(function(){
loadEdocSetting();
$('[data-toggle="tooltip"]').tooltip()
setTimeout(function() {
	$('#onlyme').trigger('mouseover');
	setTimeout(function() {
		$('#onlyme').trigger('mouseout');
		}, 4000);
}, 1500);

	
	
	

    });



$('.count').each(function () {
    $(this).prop('Counter',0).animate({
        Counter: $(this).text()
    }, {
        duration: 2000,
        easing: 'swing',
        step: function (now) {
            $(this).text(Math.ceil(now));
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
	//alert('ok');
	$('.loader-spin').removeClass('none');
	var sendURL="cmd=loadEdocSetting";
		$.ajax({	type: "POST",	url:  base_url + "Track/loadEdocTrackingWithMe/",	data: sendURL,
			success: function(msg)
				{
					$('#loadEdocSetting').html(msg);
					$('#tableExample2').DataTable({
					"dom": "<'row'<'col-sm-6'l><'col-sm-6'f>>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
					"lengthMenu": [ [50, 100, 200, -1], [50, 100, 200, "All"] ],
					"iDisplayLength": 50,
				});
					$('.progress-bar').addClass( "progress-bar-success", 2000, "easeInBack" );
					$('.loader-spin').addClass('none');
				},
		error: function()
				{
					toastr.error('มีปัญหากับการเชื่อมต่อ loadEdocSetting');
				}
					
        });
}