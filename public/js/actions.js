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
	tippy('.markAsFound', {
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

$('.rate-us').click(function(){
	$('.rateUsModal').addClass('modal-active');
	bodyDisableScroll();
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
			}else if(request.responseText == 2){
				$('.loginerror').css('display', 'block');
				$('.loginerror').find('.prompt').html('Sorry. Your account has not been verified yet');
			}else if(request.responseText == 3){
				$('.loginerror').css('display', 'block');
				$('.loginerror').find('.prompt').html('Error. A user is already logged in');
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
	var itemID = $(this).attr('data-itemID');
	var commentID = $(this).attr('data-commentID');
	if($(this).attr('data-type') == 'found'){
		setCommentDeleteTarget_found(itemID, commentID);
	}else{
		setCommentDeleteTarget(itemID, commentID);

	}
	$('.deleteModal').addClass('modal-active');
	bodyDisableScroll();
});

$('.comment_form').on('submit', function(e){
	/**
	 * Checks if a foul word is submitted on comment
	 */
	e.preventDefault();
	var comment = $(this).find('textarea[name="comment"]').val().toLowerCase()
	var foundBadWord = 0
	jQuery.each(badwords, function(index, item) {
		if(comment.includes(item.toLowerCase())){
			foundBadWord = 1
		}
	})
	if(foundBadWord == 1){
		alert('Cannot submit comment. Please avoid using foul words.')
		return;
	}


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
			me.closest('.posts').find('.post_comments').css('max-height', '99999px');
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
$('.btnAdminpanel').click(function(){
	window.location.assign('/admin-panel');
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

$('#frmForgotPassword').submit(function(e){
	e.preventDefault()
	var request = $.ajax({
		url: "/forgot-password",
		type: "POST",           
		data: new FormData(this),
		contentType: false,       
		cache: false,      
		processData:false,       
		beforeSend: function(data){
		},
		success: function(data){
			alert(request.responseText)
		},
		error: function(data){
			var errors = "";
			for(datos in data.responseJSON){
				errors += data.responseJSON[datos]+'\n';
			}
			alert(errors);
			hideLoading()
		}
	});
})

$('.forgotPassword').click(function(){
	$('#frmLogin').css('display', 'none')	
	$('#frmForgotPassword').css('display', 'block')	
})

$('.backToLogin').click(function(){
	$('#frmLogin').css('display', 'block')	
	$('#frmForgotPassword').css('display', 'none')	
})


$('#messageUs').submit(function(e){
	e.preventDefault()
	var request = $.ajax({
		url: "/submit-message",
		type: "POST",           
		data: new FormData(this),
		contentType: false,       
		cache: false,      
		processData:false,       
		beforeSend: function(data){
			showLoading();
		},
		success: function(data){
			if(request.responseText == 1){
				setTimeout(function() {
					hideLoading()
					$('#messageUs')[0].reset()
					$('.messageSent').css('display', 'block')
				}, 500);
			}
		},
		error: function(data){
			var errors = "";
			for(datos in data.responseJSON){
				errors += data.responseJSON[datos]+'\n';
			}
			alert(errors);
			hideLoading()
		}
	});
})

function showLoading(){
    $('.loadingModal').fadeIn();
}
function hideLoading(){
    $('.loadingModal').fadeOut();
}

$('.markAsFound').click(function(){
	var itemID = $(this).attr('data-itemID');
	var type = $(this).attr('data-type');
	if(type == 'lost'){
		$('.frmMarkAsFound').attr('action', '/lost-item/'+itemID+'/mark-as-found');
		$('.markAsFoundModal').addClass('modal-active');
		bodyEnableScroll();
	}else{
		$('.frmMarkAsFound').attr('action', '/found-item/'+itemID+'/mark-as-found');
		$('.markAsFoundModal').addClass('modal-active');
		bodyEnableScroll();
	}
});

$('.star').click(function(){
	$(this).prevAll('.star').addClass('active');
	$(this).addClass('active');
	$(this).nextAll('.star').removeClass('active');

	var rating = $(this).data('rating');
	$('.selected_rating').val(rating);
});

const badwords = ['tae', 'Kantot', 'Puki','Putangina', 'puta', 'binibrocha','bruha', 'engot', 'Tamod','susu', 'titi', 'pakshet','pokpok', 'puke', 'tarantado','tanga', 'Gago', 'Ungas','Leche', 'Hudas', 'Ulol','Bwisit', 'Burat', 'Kupal','Punyeta', 'Pucha', 'Hinayupak',
'Pakshet', 'asshead', 'idiot','asshole', 'asshopper', 'assjacker','asslick', 'asslicker', 'assmonkey','assmunch', 'assmuncher', 'assnigger','asspirate', 'assshit', 'assshole','assshole', 'asswad', 'asswipe','axwound', 'bastard', 'beaner','bitch', 'bitchass', 'bitches','bitchtits', 'bitchy', 'blowjob',
'bollocks', 'bollox', 'boner','brotherfucker', 'bullshit', 'bumblefuck','buttplug', 'butt-pirate', 'buttfucka','cameltoe', 'carpetmuncher', 'chesticle','chinc', 'chink', 'choad','chode', 'clit', 'clitface','clitfuck', 'clusterfuck', 'cock','cockass', 'cockbite', 'cockburger','cockface', 'cockfucker', 'cockhead',
'cockjockey', 'cockknoker', 'cockmaster','cockmongler', 'cockmongruel', 'cockmonkey','cockmuncher', 'cocknose', 'cocknugget','cockshit', 'cocksmith', 'cocksmoke','cocksmoker', 'cocksniffer', 'cocksucker','cockwaffle', 'coochie', 'coochy','coon', 'cooter', 'cracker','cum', 'cumbubble', 'cumdumpster','cumguzzler', 'cumjockey', 'cumslut',
'cumtart', 'cunnie', 'cunnilingus','cunt', 'cuntass', 'cuntface','cunthole', 'cuntlicker', 'cuntrag','cuntslut', 'buttfucker', 'damn','deggo', 'dick', 'dickbag','dickbeaters', 'dickface', 'dickfuck','dickfucker', 'dickhead', 'dickhole','dickjuice', 'dickmilk', 'dickmonger','dicks', 'dickslap', 'dicksucker',
'dicksucking', 'dicktickler', 'dickwad','dickweasel', 'dickweed', 'dickwod','dike', 'dildo', 'dipshit','doochbag', 'dookie', 'douche','douche-fag', 'douchewaffle', 'dumass','dumb ass ', 'dumbass', 'dumbfuck','dumbshit', 'dumshit', 'dyke','Amateur', 'Analphabet', 'Anarchist','Ass', 'Bastard', 'Bitch',
'Butt', 'Cock', 'Cunt','sucker', 'Dogshit'];

$('.frmMessage').submit(function(e){
	var message = $(this).find('textarea[name="message"]').val().toLowerCase()
	var foundBadWord = 0
	jQuery.each(badwords, function(index, item) {
		if(message.includes(item.toLowerCase())){
			foundBadWord = 1
		}
	})
	if(foundBadWord == 1){
		e.preventDefault()
		alert('Cannot submit message. Please avoid using foul words.')
	}
});

$('.form').submit(function(e){
	var otherdetails = $(this).find('textarea[name="otherdetails"]').val().toLowerCase()
	var name = $(this).find('input[name="name"]').val().toLowerCase()
	var place = $(this).find('input[name="place"]').val().toLowerCase()
	var foundBadWord = 0
	jQuery.each(badwords, function(index, item) {
		if(otherdetails.includes(item.toLowerCase()) || name.includes(item.toLowerCase()) || place.includes(item.toLowerCase())){
			foundBadWord = 1
		}
	})
	if(foundBadWord == 1){
		e.preventDefault()
		alert('Cannot submit form. Please avoid using foul words.')
	}
});

$('.slider').change(function(e){
	var value = $(this).val();
	$('.slider_value').html(value+'%');
});

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
function setDeleteTarget_found(id){
	$('#deleteForm').attr('action', '/found-something/'+id+'/delete');
	activeDeleteForm = $('#deleteForm');
}

function setCommentDeleteTarget(lostItemID, commentID){
	commentDeleteTarget = commentID;
	$('#deleteFormComment').attr('action', '/lost-something/'+lostItemID+'/comment/'+commentID+'/delete'); 
	activeDeleteForm = $('#deleteFormComment');
}
function setCommentDeleteTarget_found(foundItemID, commentID){
	commentDeleteTarget = commentID;
	$('#deleteFormComment').attr('action', '/found-something/'+foundItemID+'/comment/'+commentID+'/delete'); 
	activeDeleteForm = $('#deleteFormComment');
}

function initiateDelete(){
	activeDeleteForm.submit();
}

function initiateFound(){
	$('.frmMarkAsFound').submit();
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