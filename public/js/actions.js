$(document).ready(function(){
	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

	// accordion for main_content left_nav
	var acc = document.getElementsByClassName("postcomments_toggler");
	var i;
	for (i = 0; i < acc.length; i++) {
	  acc[i].onclick = function() {
	    this.classList.toggle("active");
	    // var panel = $(this).closest('.box').find('.form');
	    var panel = this.nextElementSibling;
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

$('.btnRegister').click(function(){
	$('.registerModal').addClass('modal-active');
	bodyDisableScroll();
	$('#register_name').focus();
});
$('.btnLogin').click(function(){
	$('.loginModal').addClass('modal-active');
	bodyDisableScroll();
	$('#loginUsername').focus();
});

$('.modal-closer').click(function(){
	$(this).closest('.mymodal').removeClass('modal-active');
	bodyEnableScroll();
});

$('#frmLogin').on('submit', function(e){
	e.preventDefault();
	var request = $.ajax({
		url: "/login",
		type: "POST",           
		data: new FormData(this),
		contentType: false,       
		cache: false,      
		processData:false,       
		beforeSend: function(data){
			$('.loginbutton').addClass('button_disabled');
			$('.loginbutton').attr('disabled');
		},
		success: function(data){
			if(request.responseText == 1){
				location.reload();
			}else{
				$('.loginerror').css('display', 'block');
			}
			$('.loginbutton').removeClass('button_disabled');
			$('.loginbutton').removeAttr('disabled');
		},
		error: function(data){
			var errors = "";
			for(datos in data.responseJSON){
				errors += data.responseJSON[datos]+'\n';
			}
			alert(errors);
			$('.loginbutton').removeClass('button_disabled');
			$('.loginbutton').removeAttr('disabled');
		}
	});
});

$('.btnLogout').click(function(){
	$('#frmLogout').submit();
});

$(document).keyup(function(e) {
    if(e.keyCode == 27){ // if escape key is pressed
    	$('.mymodal').removeClass('modal-active');
		bodyEnableScroll();
    }
});

// wew

function bodyDisableScroll(){
	$('body').addClass('modal-opened');
}

function bodyEnableScroll(){
	$('body').removeClass('modal-opened');
}

function viewImage(imagePath){
	bodyDisableScroll();
	$('.photoModal').addClass('modal-active');
	$('.photoView').attr('src', imagePath);
}