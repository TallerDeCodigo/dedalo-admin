<?php
	if(!empty($_POST) AND isset($_POST['correo']) AND isset($_POST['nick'])){

		custom_create_user();//ESTE CREA AL USUARIO DESDE LA FORMA
		wp_redirect('http://3dedalo.org/login');  	/*cambiar por http://localhost:8888/dedalo/login para que funcione en rizika-II o 	*/
				                                   		/*cambiar por http://localhost/dedalo/login para que funcione en rogue1				*/
														/*cambiar por http://3dedalo.org/login para que funcione en 3dedalo.org 			*/
		
		$to = $_POST['correo'];
		$headers[] = 'Content-Type: text/html; charset=UTF-8';											
		$subject = "Confirm your account at 3Dedalo.org";
		$mensaje = "Please confirm your account at" ." ". "<a href='http://3dedalo.org/login'>3Dedalo</a>";	
		
		wp_mail($to,$subject,$mensaje, $headers);
	}//end if

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
		$wpUser = get_user_by('email', $mail);
		
}//termina FUNCION CUSTOM_CREATE_USER	
?>

<?php get_header(); ?>
<div class="empty">
	<!--this div is empty-->
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