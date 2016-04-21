
<script>
	// $("#signupForm").validate({
	// 	debug:true,
	// 	rules:{
	// 		nick:"required",
	// 		nombre:"required",
	// 		correo:{
	// 			required: true,
	// 			email: true
	// 		},
	// 		pass:"required",
	// 		confirmPass:{
	// 			required: true,
	// 			equalTo: ".pass"
	// 		}
	// 	},
	// 	messages:{
	// 		nick:"required",
	// 		nombre:"Este campo es obligatorio",
	// 		correo:{
	// 			required:"Este campo es obligatorio",
	// 			email:"Por favor ingresa una dirección válida"
	// 		},
	// 		pass:"Debes especificar un password",
	// 		confirmPass:{
	// 			required: "Tu contraseña no es la misma",
	// 			equalTo: "Los passwords no coinciden"
	// 		}
	// 	},
	// 	submitHandler: function(form) {
	// 	    // do other things for a valid form
	// 	    form.submit();
	// 	}
	// });
</script><!--VALIDATE-->

<?php
	
	

	if(!empty($_POST) AND isset($_POST['correo']) AND isset($_POST['nick'])){

		custom_create_user();//ESTE CREA AL USUARIO DESDE LA FORMA

	}
function custom_create_user(){
	
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
		$wpUser = get_user_by('email',$mail);
		
		
		//wp_signon(,false);

		if(!is_wp_error($user_id)) {
				echo "<div class='creado'>"."Usuario creado: ".$user_id . "</div>";
				
			} else if(username_exists($aidi)) {
				echo "<div class='errorUser'>" . "error user" . "</div>";
			} else if(email_exists($mail)) {
				echo "<div class='errorMail'>" . "error mail" . "</div>";
		}

}//termina FUNCION CUSTOM LOGIN	



function auto_login($usrdata){
	$mail = $usrdata['user_email'];
	$test = get_user_by('email', $mail);
	if($test){
		wp_set_auth_cookie($test->ID,0,0);
		wp_set_current_user($test->ID);
	}
	// $wpUser = get_user_by('email',$mail);
	// 	if($wpUser){
	// 		
	// 	}

}

?>

<?php get_header(); ?>

<form method="post" action="" id="signupForm">
<!-- 	<button>close<button>
 -->	<input name="nick" 		  type="text" 		placeholder="user name">
	<input name="nombre" 	  type="text" 		placeholder="first name">
	<input name="apellido" 	  type="text" 		placeholder="last name">
	<input name="correo" 	  type="email" 		placeholder="email">
	<input name="pass" 		  type="password"	class="pass" 	    placeholder="password">
	<input name="confirmPass" type="password" 	id="confirmPass" placeholder="confirm password">
	<input type="submit" value="Send" class="exit">
</form>

	<style type="text/css">
		#signupForm{background-color:#191919;width:40%;height:500px;padding:150px 60px;z-index:200;position:absolute;text-align: center;border-radius: 5px}
		#signupForm input{border-style: none;text-align:left;padding-left:10px;border:1px solid #fff;border-radius: 5px;width:40%;height:30px;background-color: transparent;color:#fff;margin-bottom:20px;}
		#signupForm input:last-child{width:80.55%;}
	</style>
<?php get_sidebar(); ?>
<?php get_footer(); ?>