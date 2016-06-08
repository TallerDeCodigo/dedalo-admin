var vv;
(function($){

	"use strict";

	$(function(){


		console.log('hello from functions.js');


		/**
		 * Validación de emails
		 */
		window.validateEmail = function (email) {
			var regExp = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
			return regExp.test(email);
		};



		/**
		 * Regresa todos los valores de un formulario como un associative array 
		 */
		window.getFormData = function (selector) {
			var result = [],
				data   = $(selector).serializeArray();

			$.map(data, function (attr) {
				result[attr.name] = attr.value;
			});
			return result;
		}

		/*
		 *
		 *
		 *	Script popup
		 *
		 *
		 */

var login = document.getElementById("centrar");
//console.log(login);
var btn = document.getElementById("btnTest");
//console.log(btn);
// btn.onclick = function(){
// 	console.log("hizo click");
// 	login.style.display = "block";
// }

// window.onclick = function(event){
// 	if (event.target == forma) {	
// 	console.log("hizo click");	
// 	forma.style.display = "none";	
// 	}
// }

var signup = document.getElementById("signupForm");
//console.log(signup);
var btn_sign = document.getElementById("sign_up");
//console.log(btn_sign);
btn_sign.onclick = function(){
	console.log("hizo click");
	signup.style.display = "block";
	login.style.display = "none";
}


		// function poplogin(){
		// 	$(".popup").slideDown("slow");
		// }
		// var pop_w = $(".popup").width()+10;
		// var pop_h = $(".popup").height()+30;
		
		// $(".popup").hide();
		
		// var w = $(this).width();
		// var h = $(this).height();

		// w=(w/2) - (pop_w/1.5);
		// h=(h/3.2) - (pop_h/1.5);
		// $(".popup").css("left", w+"px");
		// $(".popup").css("top", h+"px");

		// setTimeout(poplogin(),500);
/*END LOGIN POPUP*/
		

		/*
		 *
		 *
		 *
		 */
		// function popSubscribe(){
		// 	$("#signupForm").slideDown("slow");
		// }
		// var pop_w = $("#signupForm").width()+10;
		// var pop_h = $("#signupForm").height()+30;
		
		// $("#signupForm").hide();
		
		// var w = $(this).width();
		// var h = $(this).height();

		// w=(w/2) - (pop_w/1.5);
		// h=(h/3.2) - (pop_h/1.5);
		// $("#signupForm").css("left", w+"px");
		// $("#signupForm").css("top", h+"px");

		// setTimeout(popSubscribe(),500);
/*END SUBSCRIBE POPUP*/

/*SET INPUT ATTRIBUTES*/
		$(".login-username input").attr("placeholder", "user name").val();
		$(".login-password input").attr("placeholder", "password").val();
	});

/*set height of invsible div*/
	var header_height	= $(".header").height();
	var footer_height 	= $("footer").height();
	var total_height	= $(window).height();
	var altodeldiv	 	= total_height-(header_height+footer_height)+"px";

	$(".empty").css("height",altodeldiv);


	/*
		*	slect category
	*/

	$('#drop1 select').change(function(){
		$('#drop1 select option:selected').each(function(){
			vv = $(this).val();
			console.log(vv);
		 var temp = '.drop' + vv;
		 //console.log(temp);
		 $('.show').addClass('hidden');
		 $(temp).removeClass('hidden');

		});
	}).change();

	$('#upFile').hide();

	var isAdvancedUpload = function() {
	  var div = document.createElement('div');
	  return (('draggable' in div) || ('ondragstart' in div && 'ondrop' in div)) && 'FormData' in window && 'FileReader' in window;
	}();
	var $form = $('.box__input');


	if (isAdvancedUpload) {

	  var droppedFiles = false;

	  $form.addClass('has-advanced-upload');
	  
	  $form.on('drag dragstart dragend dragover dragenter dragleave drop', function(e) {
	    e.preventDefault();
	    e.stopPropagation();
	  })
	  .on('dragover dragenter', function() {
	    $form.addClass('is-dragover');
	  })
	  .on('dragleave dragend drop', function() {
	    $form.removeClass('is-dragover');
	  })
	  .on('drop', function(e) {
	    droppedFiles = e.originalEvent.dataTransfer.files;
	  });

	}

	$form.on('submit', function(e) {
	  if ($form.hasClass('is-uploading')) return false;

	  $form.addClass('is-uploading').removeClass('is-error');

	  if (isAdvancedUpload) {
	    // ajax for modern browsers
	  } else {
	    // ajax for legacy browsers
	  }
	});

	if (isAdvancedUpload) {
	  e.preventDefault();

	  var ajaxData = new FormData($form.get(0));

	  if (droppedFiles) {
	    $.each( droppedFiles, function(i, file) {
	      ajaxData.append( $input.attr('name'), file );
	    });
	  }

	  $.ajax({
	    url: $form.attr('action'),
	    type: $form.attr('method'),
	    data: ajaxData,
	    dataType: 'json',
	    cache: false,
	    contentType: false,
	    processData: false,
	    complete: function() {
	      $form.removeClass('is-uploading');
	    },
	    success: function(data) {
	      $form.addClass( data.success == true ? 'is-success' : 'is-error' );
	      if (!data.success) $errorMsg.text(data.error);
	    },
	    error: function() {
	      // Log the error, show an alert, whatever works for you
	    }
	  });
	}else {
  var iframeName  = 'uploadiframe' + new Date().getTime();
    $iframe   = $('<iframe name="' + iframeName + '" style="display: none;"></iframe>');

  $('body').append($iframe);
  $form.attr('target', iframeName);

  $iframe.one('load', function() {
    var data = JSON.parse($iframe.contents().find('body' ).text());
    $form
      .removeClass('is-uploading')
      .addClass(data.success == true ? 'is-success' : 'is-error')
      .removeAttr('target');
    if (!data.success) $errorMsg.text(data.error);
    $form.removeAttr('target');
    $iframe.remove();
  });
}

var $input    = $form.find('input[type="file"]'),
    $label    = $form.find('label'),
    showFiles = function(files) {
      $label.text(files.length > 1 ? ($input.attr('data-multiple-caption') || '').replace( '{count}', files.length ) : files[ 0 ].name);
    };

// ...

$input.on('drop', function(e) {
  droppedFiles = e.originalEvent.dataTransfer.files; // the files that were dropped
  showFiles( droppedFiles );
});

//...

$input.on('change', function(e) {
  showFiles(e.target.files);
});

})(jQuery);
