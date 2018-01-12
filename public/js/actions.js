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
	      // $(this).find('i').attr('class', 'fa fa-chevron-right');
	    } else {
	      panel.style.maxHeight = panel.scrollHeight + "px";
	      // panel.style.maxHeight = "99999px";
	      panel.css('display', 'table');
	      $(this).find('i').attr('class', 'fa fa-chevron-down');
	    } 
	  }
	}

	tippy('.deletebutton', {
		position: 'top',
		arrow: true,
	});
	tippy('.post_photos', {
		position: 'top',
		arrow: true,
	});
	tippy('.myaccount_image', {
		position: 'top',
		arrow: true,
	});
}); // end ready

var commentDeleteTarget = 0;
var activeDeleteForm = '';

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
			}else if(request.responseText == 2){
				$('.loginerror').css('display', 'block');
				$('.loginerror').find('.prompt').html('Sorry. Your account has not been verified yet');
			}else{
				$('.loginerror').find('.prompt').html('Wrong username or password. Please try again.');
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

$('.deletebutton').click(function(){
	$('.deleteModal').addClass('modal-active');
	bodyDisableScroll();
});

$('body').on('click','.deletelink', function(){
	// $('.deleteModal').addClass('modal-active');
	// bodyDisableScroll();
	alert(1)
});

$('.comment_form').on('submit', function(e){
	e.preventDefault();
	var me = $(this);
	var request = $.ajax({
		url: $(this).attr('action'),
		type: "POST",           
		data: new FormData(this),
		contentType: false,       
		cache: false,      
		processData:false,       
		beforeSend: function(data){
			me.find('.comment_submit_button').attr('disabled', 'true');
			me.find('textarea').attr('disabled', 'true');
			me.find('.comment_submit_button').addClass('button_disabled');
		},
		success: function(data){
			me.closest('.post_comments').find('.comments_holder').prepend(request.responseText);
			me.find('.comment_submit_button').removeAttr('disabled');
			me.find('textarea').removeAttr('disabled');
			me.find('.comment_submit_button').removeClass('button_disabled');
			me.find('textarea').val('');
			// me.closest('.posts').find('.post_comments').css('maxHeight', '99999px');
		},
		error: function(data){
			var errors = "";
			for(datos in data.responseJSON){
				errors += data.responseJSON[datos]+'\n';
			}
			alert(errors);
			me.find('.comment_submit_button').removeAttr('disabled');
			me.find('textarea').removeAttr('disabled');
			me.find('.comment_submit_button').removeClass('button_disabled');
		}
	});
});

$('#deleteFormComment').on('submit', function(e){
	e.preventDefault();
	var me = $(this);
	var request = $.ajax({
		url: $(this).attr('action'),
		type: "POST",           
		data: new FormData(this),
		contentType: false,       
		cache: false,      
		processData:false,       
		beforeSend: function(data){

		},
		success: function(data){
			if(request.responseText == 1){
				$('.cc'+commentDeleteTarget).remove();
				closeModal();
			}
		},
		error: function(data){
			var errors = "";
			for(datos in data.responseJSON){
				errors += data.responseJSON[datos]+'\n';
			}
			alert(errors);
		}
	});
});

$('.btnMyAccount').click(function(){
	window.location.assign('/my-account');
});

$('.btnMessages').click(function(){
	window.location.assign('/messages');
});

$('#myaccount_image').change(function(){
	changeImagePreview(this);
})

$('#registerForm').on('submit', function(e){
	e.preventDefault();
	var me = $(this);
	var request = $.ajax({
		url: $(this).attr('action'),
		type: "POST",           
		data: new FormData(this),
		contentType: false,       
		cache: false,      
		processData:false,       
		beforeSend: function(data){

		},	
		success: function(data){
			if(request.responseText == 1){
				$('.prompt_message').css('display', 'block');
				$('.prompt_message').find('li').html('Thank you for signing up. Please wait at least 24 hours for the administrator to confirm your account.');
				$('#registerForm')[0].reset();
			}
		},
		error: function(data){
			var errors = "";
			for(datos in data.responseJSON){
				errors += data.responseJSON[datos]+'\n';
			}
			alert(errors);
		}
	});
});
// wew

function redirect(path){
	window.location.assign(path);
}

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

function setDeleteTarget(id){
	$('#deleteForm').attr('action', '/lost-something/'+id+'/delete');
	activeDeleteForm = $('#deleteForm');
}

function setCommentDeleteTarget(lostItemID, commentID){
	commentDeleteTarget = commentID;
	$('#deleteFormComment').attr('action', '/lost-something/'+lostItemID+'/comment/'+commentID+'/delete'); 
	activeDeleteForm = $('#deleteFormComment');
}

function initiateDelete(){
	activeDeleteForm.submit();
}

function closeModal(){
	$('.mymodal').removeClass('modal-active');
	bodyEnableScroll();
}

function changeImagePreview(input) {
    if(input.files && input.files[0]){
        var reader = new FileReader();
        reader.onload = function (e) {
            $('.myaccount_image').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}