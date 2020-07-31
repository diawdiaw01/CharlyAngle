$(function(){
	loadNewsList($('#start').val());
	$('#loadMore').click(function(){
		loadNewsList($('#start').val());
		return false;
	});
});

function loadNewsList(strat) {
	var getStart = parseInt($('#start').val());
	var loadMoreOldBTN = $('#loadMore').html();
	 $('#loadMore').html('<div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>');
	var sendURL="cmd=loadNewsList&start=" + strat;
	//alert(sendURL);
		$.ajax({	type: "POST",	url:  base_url + "Home/loadNewsList/" + strat ,	data: sendURL,
			success: function(msg)
				{
					$('#loadContent').append(msg);
					$('#start').val(parseInt(getStart + 8));
					$('#loadMore').html(loadMoreOldBTN);
				},
		error: function()
				{
					$('#loadMore').html(loadMoreOldBTN);
					$('#loadContent').html('<h1>Disconnect</h1>');
				}
					
        });
}