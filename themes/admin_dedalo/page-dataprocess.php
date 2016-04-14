<?php get_header(); ?>

<style>
	#resultado{margin:20px;border:1px solid #000;width:20%;}
	.campos{display:block;margin:20px;padding:10px;}
</style>


<section id="resultado">
<?php 
/*retrieve user data from login*/
	$nombre = $_POST["fname"];
	$apellido = $_POST["lname"];
	$correo = $_POST["correo"];
	$pword = $_POST["contra"];
	$id = $_POST["_id"];

/*create or insert user in wp_db*/
	//$website = "http://localhost/dedalo/dataprocess";
	$usrdata = array(
					'user_login'=>$id,
					'first_name'=>$nombre,
					'last_name' =>$apellido,
					'user_email'=>$correo,
					'user_pass' =>$password=random_password(8)
		);

	$user_id = wp_insert_user($usrdata);

	if(!is_wp_error($user_id)){
		echo "Usuario creado: ".$user_id; 
	}else if(username_exists($id)){
		echo "lo sentimos, ese nombre de usuario ya existe";
	}else if(email_exists($correo)){
		echo "esa direcci'on de correo ya existe";
	}else{
		echo "ha ocurrido un error, por favor intentalo de nuevo";
	}
?>

<?php
function random_password( $length = 8 ) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
    $password = substr( str_shuffle( $chars ), 0, $length );
    return $password;
}
?>


</section>

<?php get_sidebar(); ?>
<?php get_footer(); ?>