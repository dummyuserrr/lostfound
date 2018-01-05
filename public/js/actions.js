$(document).ready(function(){
	// accordion for main_content left_nav
	var acc = document.getElementsByClassName("postToggler");
	var i;
	for (i = 0; i < acc.length; i++) {
	  acc[i].onclick = function() {
	    this.classList.toggle("active");
	    var panel = $(this).closest('.box').find('.form');
	    if (panel.style.maxHeight){
	      panel.style.maxHeight = null;
	      $(this).find('i').attr('class', 'fa fa-chevron-right');
	    } else {
	      panel.style.maxHeight = panel.scrollHeight + "px";
	      $(this).find('i').attr('class', 'fa fa-chevron-down');
	    } 
	  }
	}
});

$('#btnRegister').click(function(){
	$('.registerModal').addClass('modal-active');
	$('#register_name').focus();
	bodyDisableScroll();
});
$('#btnLogin').click(function(){
	$('.loginModal').addClass('modal-active');
	bodyDisableScroll();
});

$('.modal-closer').click(function(){
	$(this).closest('.mymodal').removeClass('modal-active');
	bodyEnableScroll();
});

$('.post_photos').click(function(){
	alert(1)
});

// wew

function bodyDisableScroll(){
	$('body').addClass('modal-opened');
}

function bodyEnableScroll(){
	$('body').removeClass('modal-opened');
}

function viewImage(imagePath){
	// wala pa
}