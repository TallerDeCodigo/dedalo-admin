<?php get_header(); ?>

<form method="post" action="" id="signupForm">
	<input name="nick" 		  type="text" 		placeholder="tu nick">
	<input name="nombre" 	  type="text" 		placeholder="tu nombre">
	<input name="apellido" 	  type="text" 		placeholder="tu apellido">
	<input name="correo" 	  type="email" 		placeholder="tu correo">
	<input name="pass" 		  type="password"	class="pass" 	    placeholder="tu contraseña">
	<input name="confirmPass" type="password" 	id="confirmPass" placeholder="otra vez tu contraseña">
	<input type="submit" value="Enviar">
</form>

<script>
	$("#signupForm").validate({
		debug:true,
		rules:{
			nick:"required",
			nombre:"required",
			correo:{
				required: true,
				email: true
			},
			pass:"required",
			confirmPass:{
				required: true,
				equalTo: ".pass"
			}
		},
		messages:{
			nick:"required",
			nombre:"Este campo es obligatorio",
			correo:{
				required:"Este campo es obligatorio",
				email:"Por favor ingresa una dirección válida"
			},
			pass:"Debes especificar un password",
			confirmPass:{
				required: "Tu contraseña no es la misma",
				equalTo: "Los passwords no coinciden"
			}
		},
		submitHandler: function(form) {
		    // do other things for a valid form
		    form.submit();
		}
	});
</script>

<?php
	if(!empty($_POST) AND isset($_POST['correo']) AND isset($_POST['nick'])){



function custom_login(){
	
		$aidi=$_POST["nick"];
		$name=$_POST["nombre"];
		$last=$_POST["apellido"];
		$mail=$_POST["correo"];
	 	$pass=$_POST["pass"];


		$usrdata = array(
			'user_login'=>$aidi,
			'first_name'=>$name,
			'last_name' =>$last,
			'user_email'=>$mail,
			'user_pass' =>$pass,
			'remember'=> true
			);

		$user_id = wp_insert_user($usrdata);
		$user = wp_signon($usrdata);
		

		if(!is_wp_error($user_id)){

			get_currentuserinfo();
			wp_set_current_user($user_id);
			//wp_redirect(site_url());

			echo "<div class='creado'>"."Usuario creado: ".$user_id . "</div>";
		}else if(username_exists($aidi)){
			echo "<div class='errorUser'>" . "error user" . "</div>";
		}else if(email_exists($mail)){
			echo "<div class='errorMail'>" . "error mail" . "</div>";
			};
		}
		custom_login();
	}
?>


<style type="text/css">
	#signupForm{width:172px;margin:0 auto;}
	input{display: block;margin-top:10px;width:170px;padding:5px;background-color:#fff;border-style: none}
	input[type=submit]{margin-bottom:10px;}
</style>
<?php get_sidebar(); ?>
<?php get_footer(); ?>