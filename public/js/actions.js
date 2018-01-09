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

	tippy('.deletebutton', {
		position: 'top',
		arrow: true,
	});
}); // end ready

var commentDeleteTarget = 0;

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

$('.deletebutton').click(function(){
	$('.deleteModal').addClass('modal-active');
	bodyDisableScroll();
});

$('.deletelink').click(function(){
	$('.deleteModal').addClass('modal-active');
	bodyDisableScroll();
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

function setDeleteTarget(id){
	$('#deleteForm').attr('action', '/lost-something/'+id+'/delete');
}

function setCommentDeleteTarget(lostItemID, commentID){
	commentDeleteTarget = commentID;
	$('#deleteFormComment').attr('action', '/lost-something/'+lostItemID+'/comment/'+commentID+'/delete'); 
}

function initiateDelete(){
	$('#deleteFormComment').submit();
}

function closeModal(){
	$('.mymodal').removeClass('modal-active');
	bodyEnableScroll();
}