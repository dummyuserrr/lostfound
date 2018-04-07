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

$('.btnApproveUser').click(function(){
	var url = $(this).data('url');
	$('#formUpdateData').attr('action', url);
	$('#formUpdateData').submit();
});	

$('.userView').click(function(){
	var name = $(this).data('name');
	var email = $(this).data('email');
	var mobile = $(this).data('mobile');
	var address = $(this).data('address');
	var image = $(this).data('image');
	var selfie = $(this).data('selfie');

	var v = $('#userViewModal');
	v.find('#name').val(name);
	v.find('#email').val(email);
	v.find('#mobile').val(mobile);
	v.find('#address').val(address);
	v.find('#image').attr('src', '/'+image);
	v.find('#selfie').attr('src', '/'+selfie);
});