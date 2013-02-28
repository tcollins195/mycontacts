$(function(){
	$('form input[type=text]').first().focus();
	
	//Process the following after the jQuery library has loaded
	$('table tr').click(function(){
		var url = $(this).attr('data-location');
		window.location = url;
	});
});


