$('.btnlogout').click(function(){
	$('#formLogout').submit();
});

$('.btndelete').click(function(){
	var url = $(this).data('url');
	$('#formDelete').attr('action', url);
});

$('.initiateDelete').click(function(){
	$('#formDelete').submit();
});