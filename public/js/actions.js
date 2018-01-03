$(document).ready(function(){

});

$('#btnRegister').click(function(){
	$('.registerModal').addClass('modal-active');
	bodyDisableScroll();
});

$('.modal-closer').click(function(){
	$(this).closest('.mymodal').removeClass('modal-active');
	bodyEnableScroll();
});

function bodyDisableScroll(){
	$('body').addClass('modal-opened');
}

function bodyEnableScroll(){
	$('body').removeClass('modal-opened');
}