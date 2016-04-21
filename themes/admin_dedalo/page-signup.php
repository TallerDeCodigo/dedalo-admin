<?php
	if(!empty($_POST) AND isset($_POST['correo']) AND isset($_POST['nick'])){

		custom_create_user();//ESTE CREA AL USUARIO DESDE LA FORMA
		wp_redirect('http://localhost/dedalo/login'); //*cambiar por http://localhost:8888/dedalo para que funcione en rizika-II*//
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

<form method="post" action="" id="signupForm">
	<input name="nick" 		  type="text" 		placeholder="user name">
	<input name="nombre" 	  type="text" 		placeholder="first name">
	<input name="apellido" 	  type="text" 		placeholder="last name">
	<input name="correo" 	  type="email" 		placeholder="email">
	<input name="pass" 		  type="password"	class="pass" 	    placeholder="password">
	<input name="confirmPass" type="password" 	id="confirmPass" placeholder="confirm password">
	<input type="submit" value="Send" class="exit">
</form>

	<style type="text/css">
		/*.boxalert{width:40%;margin:0 auto;background-color:#727272;z-index: 20;color:#000;font-size:2em;text-align: center}*/
		#signupForm{background-color:#191919;width:40%;height:500px;padding:150px 60px;z-index:200;position:absolute;text-align: center;border-radius: 5px}
		#signupForm input{border-style: none;text-align:left;padding-left:10px;border-bottom:1px solid #fff;width:40%;height:30px;background-color: transparent;color:#fff;margin-bottom:20px;}
		#signupForm input:last-child{width:80.55%;}
	</style>
<?php get_sidebar(); ?>
<?php get_footer(); ?>