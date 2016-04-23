<?php
	if(!empty($_POST) AND isset($_POST['correo']) AND isset($_POST['nick'])){
		custom_create_user();//ESTE CREA AL USUARIO DESDE LA FORMA
		
		/*
			*	cambiar por http://localhost:8888/dedalo/login para redireccionar en rizika-II
			*	cambiar por http://localhost/dedalo/login para redireccionar en rogue1
			*	cambiar por http://3dedalo.org/login para redireccionar en 3dedalo.org
		*/
		wp_redirect('http://3dedalo.org/login');
				                                   				
		$to = $_POST['correo'];
		$headers[] = 'Content-Type: text/html; charset=UTF-8';											
		$subject = "Confirm your account at 3Dedalo.org";
		$mensaje = "Please confirm your account at" ." ". "<a href='http://3dedalo.org/login'>3Dedalo</a>";
		/*
		 	*	MAIL DE CONFIRMACION 
		*/
		wp_mail($to,$subject,$mensaje, $headers);
	
	}//end if
?>

<?php get_header(); ?>
<div class="empty">
	<!--this div is empty to adjust body height whle login and signup-->
</div>	
<form method="post" action="" id="signupForm">
	<input name="nick" 		  type="text" 		placeholder="user name">
	<input name="nombre" 	  type="text" 		placeholder="first name">
	<input name="apellido" 	  type="text" 		placeholder="last name">
	<input name="correo" 	  type="email" 		placeholder="email">
	<input name="pass" 		  type="password"	class="pass" 	    placeholder="password">
	<input name="confirmPass" type="password" 	id="confirmPass" placeholder="confirm password">
	<input type="submit" value="Send" class="exit">
</form>
<!--
	+
		+	VALIDACION DE FORMA
	+
-->
	<script>
		$("#signupForm").validate({
			rules:{
				nick:'required',
				nombre:'required',
				correo:{
					required:true,
					email:true
					},
				pass:'required',
				confirmPass:{
					equalTo:'.pass'
					}
				},
			messages:{
				nick:'This field is required for you to log into to your account.',
				nombre:{
					required:'Please input your name so we can know who you are.',
					name:'Tu nombre no es real'
					},
				correo:{
					required:'This field is required so we can contact to you.',
					email:'Your mail address must be in the format name@domain.com.'
				},
				pass:'your password must contain alphanumeric values.',
				confirmPass:{
					equalTo:'Your password does not match.'
				}
			}

		});
	</script>
<?php get_sidebar(); ?>
<?php get_footer(); ?>