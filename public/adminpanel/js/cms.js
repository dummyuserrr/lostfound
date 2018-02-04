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

$('.userRoleSelector').change(function(){
	var active = $(this).find(':selected').val();
	var id = $(this).data('id')
	var url = '/admin-panel/users/'+id+'/change-role/'+active;
	window.location.assign(url);
});