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
		*
		*
		*	slect category
		*
		*
	*/

	$('#drop1 select').attr('name', 'mainCat');

	$('#drop1 select').change(function(){
		$('#drop1 select option:selected').each(function(){
			$('')
		 $(this).attr('name', 'subCat');
			vv = $(this).val();
			console.log(vv);
		 var temp = '.drop' + vv;
		 //console.log(temp);
		 $('.show').addClass('hidden');
		 $('.show').children('select').attr('name', 'notThis');

		 $(temp).removeClass('hidden');
		 $(temp).children('select').attr('name','subCat');

		});
	}).change();

	$('.checks').is(':checked',function(){

	});




	/*					*
		DRAG AND DROP
	 *					*/

	// $('#upFile').hide();


	var isAdvancedUpload = function()
				{
					var div = document.createElement( 'div' );
					return ( ( 'draggable' in div ) || ( 'ondragstart' in div && 'ondrop' in div ) ) && 'FormData' in window && 'FileReader' in window;
				}();


			// applying the effect for every form
			var forms = document.querySelectorAll( '.box' );
			Array.prototype.forEach.call( forms, function( form ){

				var input		 = form.querySelector( 'input[type="file"]' ),
					label		 = form.querySelector( 'label' ),
					errorMsg	 = form.querySelector( '.box__error span' ),
					restart		 = form.querySelectorAll( '.box__restart' ),
					droppedFiles = false,
					showFiles	 = function( files ){
						label.textContent = files.length > 1 ? ( input.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', files.length ) : files[ 0 ].name;
						$('.box label').show();
						$('input[type=file]').css('z-index','-1');
					},
					triggerFormSubmit = function()
					{
						var event = document.createEvent( 'HTMLEvents' );
						event.initEvent( 'submit', true, false );
						form.dispatchEvent( event );
						console.log('adios');
					};


				// drag&drop files if the feature is available
				if( isAdvancedUpload )
				{
					form.classList.add( 'has-advanced-upload' ); // letting the CSS part to know drag&drop is supported by the browser

					[ 'drag', 'dragstart', 'dragend', 'dragover', 'dragenter', 'dragleave', 'drop' ].forEach( function( event )
					{
						form.addEventListener( event, function( e )
						{
							// preventing the unwanted behaviours
							e.preventDefault();
							e.stopPropagation();
						});
					});
					[ 'dragover', 'dragenter' ].forEach( function( event )
					{
						form.addEventListener( event, function()
						{
							form.classList.add( 'is-dragover' );
						});
					});
					[ 'dragleave', 'dragend', 'drop' ].forEach( function( event )
					{
						form.addEventListener( event, function()
						{
							form.classList.remove( 'is-dragover' );
						});
					});
					form.addEventListener( 'drop', function( e )
					{
						droppedFiles = e.dataTransfer.files; // the files that were dropped
						showFiles( droppedFiles );

						
						triggerFormSubmit();

										});
				}


				// if the form was submitted
				// form.addEventListener( 'submit', function( e )
				// {
				// 	// preventing the duplicate submissions if the current one is in progress
				// 	if( form.classList.contains( 'is-uploading' ) ) return false;

				// 	form.classList.add( 'is-uploading' );
				// 	form.classList.remove( 'is-error' );

				// 	if( isAdvancedUpload ) // ajax file upload for modern browsers
				// 	{
				// 		e.preventDefault();

				// 		// gathering the form data
				// 		var ajaxData = new FormData( form );
				// 		if( droppedFiles )
				// 		{
				// 			Array.prototype.forEach.call( droppedFiles, function( file )
				// 			{
				// 				ajaxData.append( input.getAttribute( 'name' ), file );
				// 			});
				// 		}

				// 		// ajax request
				// 		var ajax = new XMLHttpRequest();
				// 		ajax.open( form.getAttribute( 'method' ), form.getAttribute( 'action' ), true );

				// 		ajax.onload = function()
				// 		{
				// 			form.classList.remove( 'is-uploading' );
				// 			if( ajax.status >= 200 && ajax.status < 400 )
				// 			{
				// 				var data = JSON.parse( ajax.responseText );
				// 				form.classList.add( data.success == true ? 'is-success' : 'is-error' );
				// 				if( !data.success ) errorMsg.textContent = data.error;
				// 			}
				// 			else alert( 'Error. Please, contact the webmaster!' );
				// 		};

				// 		ajax.onerror = function()
				// 		{
				// 			form.classList.remove( 'is-uploading' );
				// 			alert( 'Error. Please, try again!' );
				// 		};

				// 		ajax.send( ajaxData );
				// 	}
				// 	else // fallback Ajax solution upload for older browsers
				// 	{
				// 		var iframeName	= 'uploadiframe' + new Date().getTime(),
				// 			iframe		= document.createElement( 'iframe' );

				// 			$iframe		= $( '<iframe name="' + iframeName + '" style="display: none;"></iframe>' );

				// 		iframe.setAttribute( 'name', iframeName );
				// 		iframe.style.display = 'none';

				// 		document.body.appendChild( iframe );
				// 		form.setAttribute( 'target', iframeName );

				// 		iframe.addEventListener( 'load', function()
				// 		{
				// 			var data = JSON.parse( iframe.contentDocument.body.innerHTML );
				// 			form.classList.remove( 'is-uploading' )
				// 			form.classList.add( data.success == true ? 'is-success' : 'is-error' )
				// 			form.removeAttribute( 'target' );
				// 			if( !data.success ) errorMsg.textContent = data.error;
				// 			iframe.parentNode.removeChild( iframe );
				// 		});
				// 	}
				// });


				// restart the form if has a state of error/success
				Array.prototype.forEach.call( restart, function( entry )
				{
					entry.addEventListener( 'click', function( e )
					{
						e.preventDefault();
						form.classList.remove( 'is-error', 'is-success' );
						input.click();
						console.log('error');
					});
				});

				// // Firefox focus bug fix for file input
				// input.addEventListener( 'focus', function(){ input.classList.add( 'has-focus' ); });
				// input.addEventListener( 'blur', function(){ input.classList.remove( 'has-focus' ); });

				input.addEventListener( 'blur', function(){ 
						$('.box label').hide();
						$('input[type=file]').css('width','300px');
						$('input[type=file]').css('height','20px');
						$('input[type=file]').css('opacity','1');
						$('input[type=file]').css('z-index','2');
						console.log('ahora');
					 });
			});

})(jQuery);
