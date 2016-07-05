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
		 $(this).attr('name', 'subCat');

			vv = $(this).val();
			console.log(vv);
		 var temp = '.drop' + vv;
		 console.log(temp);
		 $('.show').addClass('hidden');
		 $('.show').children('select').attr('name', 'notThis');

		 $(temp).removeClass('hidden');
		 $(temp).children('select').attr('name','subCat');

		});
	}).change();

	$('.checks').is(':checked',function(){

	});

	/*****************************/
	/* ACCOUNT, DASHBOARD Y CART */
	/*****************************/

	$.fn.digits = function(){ 
	    return this.each(function(){ 
	        $(this).text( $(this).text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") ); 
	    })
	}
	$(document).ready(function(){

		$(document).on('click', '.mas', function() {
		    var cantidad = parseInt($(this).parent().find( ".cantidad" ).html(), 10);
		    var multip = $(this).parent().find( ".precio" ).html().replace("$ ", "");
		    multip = parseInt(multip.replace(/,/g, ''), 10);
		    multip = (multip/cantidad)*(cantidad+1);
		    ++cantidad;
		    $(this).parent().find( ".cantidad" ).html( cantidad );
		    $(this).parent().find( ".precio" ).html( "$ " + multip );
		    $(this).parent().find( ".precio" ).digits();
		});

		$(document).on('click', '.menos', function() {
		    var cantidad = parseInt($(this).parent().find( ".cantidad" ).html(), 10);
		    var multip = $(this).parent().find( ".precio" ).html().replace("$ ", "");
		    multip = parseInt(multip.replace(/,/g, ''), 10);
		    multip = (multip/cantidad)*(cantidad-1);
		    --cantidad;
		    if (cantidad != 0) {
		        $(this).parent().find( ".cantidad" ).html( cantidad );
		        $(this).parent().find( ".precio" ).html( "$ " + multip );
		        $(this).parent().find( ".precio" ).digits();
		    }
		});

		$(document).on('click', '.close', function() {
		    $(this).parent().remove();
		    var totitems = $('.actions').length;
		    totitems = totitems + " ITEMS";
		    $("#items").html( totitems ) ;
		});

		$(document).on('click', '.addad', function() {
		    $(this).parent().hide();
		    $('.newad').toggle();
		});

		$(document).on('click', '.addca', function() {
		    $(this).parent().hide();
		    $('.newca').toggle();
		});

		$(document).on('click', '.edit1', function() {
		    $(this).toggleClass( 'colorear' );
		    $('#payment .separator[data-id=' + $(this).data('id') + ']').toggle();
		});

		$(document).on('click', '.edit2', function() {
		    $(this).toggleClass( 'colorear' );
		    $('#shipping .separator[data-id=' + $(this).data('id') + ']').toggle();
		});

		$(document).on('click', '.shipp', function() {
		    $(".shipp i").html( "panorama_fish_eye" );
		    $(this).find( "i" ).html( "adjust" );
		});

		$(document).on('click', '.paym', function() {
		    $(".paym i").html( "panorama_fish_eye" );
		    $(this).find( "i" ).html( "adjust" );
		});

		$(document).on('click', '.more', function() {
		    var extra = ' <a href="#">Lorem</a> <a href="#">Ipsum</a> <a href="#">Dolor</a> <a href="#">Sit</a> <a href="#">Amet</a> <a href="#">Consectetur</a> <a href="#">Adipiscing</a>';
		    $("#dashboard1").append(extra);
		    $("#dashboard1 a").addClass( "choosed" );
		    var extra1 = ' <a><img src="images/users/'+Math.floor((Math.random() * 9) + 1)+'.png"></a> <a><img src="images/users/'+Math.floor((Math.random() * 9) + 1)+'.png"></a> <a><img src="images/users/'+Math.floor((Math.random() * 9) + 1)+'.png"></a> <a><img src="images/users/'+Math.floor((Math.random() * 9) + 1)+'.png"></a> <a><img src="images/users/'+Math.floor((Math.random() * 9) + 1)+'.png"></a>';
		    $("#dashboard2").append(extra1);
		    $("#dashboard2 a").addClass( "usuario" );
		});

		$(document).on('click', '.choosed', function() {
		    if ($(this).hasClass( "cat-choose" )) {
		        $(this).removeClass( "cat-choose" );
		    } else {
		        $(this).addClass( "cat-choose" );
		    }
		});

		$(document).on('click', '.usuario', function() {
		    if ($(this).hasClass( "following" )) {
		        $(this).removeClass( "following" );
		    } else {
		        $(this).addClass( "following" );
		    }
		});





		/* Category follow events */

	    $(document).on('click', '.follow_category', function(e){

	     	e.preventDefault();
	     	var $context    = $(this);
	     	var cat_id      = $(this).data('id');
	     	var user_login  = $(this).data('user');

	     	console.log(cat_id);

	     	var response = $.post('http://localhost/dedalo-admin/rest/v1/'+user_login+'/categories/follow/', {cat_id: cat_id})
	     	.done(function(response){
	     		console.log(response);
		     	e.stopPropagation();
		     	if(response.success){
		     		e.stopPropagation();
		     		$context.removeClass('follow_category').addClass('unfollow_category choosed');
		     		return  console.log('Category followed');
		     	}else{	
		     	return alert('Oops! something happened');
		     	}
	     	})
	     	.fail(function(err){
	     		console.log(err)
	     	});

	     	// var response    = apiRH.makeRequest('http://localhost/dedalo-admin/dashboard/', {'cat_id': cat_id});

	     });

	     $(document).on('click', '.unfollow_category', function(e){
	     	e.preventDefault();
	     	var $context    = $(this);
	     	var cat_id      = $(this).data('id');
	     	var user_login	= $(this).data('user');
	     	var response = $.post('http://localhost/dedalo-admin/rest/v1/'+user_login+'/categories/unfollow/', {cat_id: cat_id})
	     	.done(function( response ){
	     		console.log(response);
	     		e.stopPropagation();
		     	if(response.success){
		     		e.stopPropagation();
		     		$context.removeClass('unfollow_category choosed').addClass('follow_category');
		     		return console.log('Category unfollowed');
		     	}else{
		     		return alert('Oops! something happened');
		     	}
	     	})
	     	 .fail(function(err){
		     	console.log(err);
		     });

	     });

	     /*** User follow events ***/
	     $(document).on('click', '.follow_user', function(e){
	     	var user_id = $(this).data('id');
	     	//var response = apiRH.makeRequest(user+'/follow', {'user_id': user_id});
	     	var user_login = $(this).data('user');

	     	$.post('http://localhost/dedalo-admin/rest/v1/'+user_login+'/follow', {user_id: user_id})
	     	 .done(function( response ){
	     		console.log(response);
	     		e.stopPropagation();
		     	if(response.success){
	     			$(this).removeClass('follow_user').addClass('unfollow_user following');
	     			console.log("You are now following this maker");
	     			return;
	     		}else{
		     		return alert('Oops! something happened');
		     	}
	     	})
	     	 .fail(function(err){
		     	console.log(err);
		     });

	     	
	     });

	     $('body').on('click', '.unfollow_user', function(){
	     	var user_id = $(this).data('id');
	     	var user_login = $(this).data('user');
	     	$.post('http://localhost/dedalo-admin/rest/v1/' +user_login+ '/unfollow', {user_id: user_id})
	     	.done(function( response ){
	     		console.log(response);
		     	if(response.success){
	     		$(this).removeClass('unfollow_user following').addClass('follow_user');
	     		return;
	     	}else{
		     		return alert('Oops! something happened');
		     	}
	     	})
	     	 .fail(function(err){
		     	console.log(err);
		     });
	     	
	     });

	 }); // END document ready


	/*					*
		DRAG AND DROP
	 *					*/



	     var dropZoneId = "drop-zone";
	     var buttonId = "clickHere";
	     var mouseOverClass = "mouse-over";

	     var dropZone = $("#" + dropZoneId);
	     var ooleft = dropZone.offset().left;
	     var ooright = dropZone.outerWidth() + ooleft;
	     var ootop = dropZone.offset().top;
	     var oobottom = dropZone.outerHeight() + ootop;
	     var inputFile = dropZone.find("input");
	     document.getElementById(dropZoneId).addEventListener("dragover", function (e) {
	         e.preventDefault();
	         e.stopPropagation();
	         dropZone.addClass(mouseOverClass);
	         var x = e.pageX;
	         var y = e.pageY;

	         if (!(x < ooleft || x > ooright || y < ootop || y > oobottom)) {
	             inputFile.offset({ top: y - 15, left: x - 100 });
	         } else {
	             inputFile.offset({ top: -400, left: -400 });
	         }

	     }, true);

	     if (buttonId != "") {
	         var clickZone = $("#" + buttonId);

	         var oleft = clickZone.offset().left;
	         var oright = clickZone.outerWidth() + oleft;
	         var otop = clickZone.offset().top;
	         var obottom = clickZone.outerHeight() + otop;

	         $("#" + buttonId).mousemove(function (e) {
	             var x = e.pageX;
	             var y = e.pageY;
	             if (!(x < oleft || x > oright || y < otop || y > obottom)) {
	                 inputFile.offset({ top: y - 15, left: x - 160 });
	             } else {
	                 inputFile.offset({ top: -400, left: -400 });
	             }
	         });
	     }

	     document.getElementById(dropZoneId).addEventListener("drop", function (e) {
	         $("#" + dropZoneId).removeClass(mouseOverClass);
	     }, true);




})(jQuery);

