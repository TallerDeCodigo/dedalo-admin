<?php
	if(!empty($_POST) AND isset($_POST['correo']) AND isset($_POST['nick'])){
		custom_create_user();//ESTE CREA AL USUARIO DESDE LA FORMA		
		/*
			*	cambiar por http://localhost:8888/dedalo/login para redireccionar en rizika-II
			*	cambiar por http://localhost/dedalo/login para redireccionar en rogue1
			*	cambiar por http://3dedalo.org/login para redireccionar en 3dedalo.org
		*/
		wp_redirect('http://3dedalo.org');
				                                   				
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
<!doctype html>
	<head>
		<meta charset="utf-8">
		<title><?php print_title(); ?></title>
		<link rel="shortcut icon" href="<?php echo THEMEPATH; ?>images/favicon.ico">
		<meta name="description" content="<?php bloginfo('description'); ?>">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="cleartype" content="on">
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link href='https://fonts.googleapis.com/css?family=Roboto:400,400italic,500,500italic,700,700italic,300italic,300' rel='stylesheet' type='text/css'>
		<script type="text/javascript" src="<?php echo THEMEPATH; ?>js/jquery-1.12.2.min.js"></script>
		<script type="text/javascript" src="<?php echo THEMEPATH; ?>js/jquery.validate.min.js"></script>
		<script src="<?php echo THEMEPATH; ?>oauthio/dist/oauth.js"></script>
		<script type="text/javascript" src="<?php echo THEMEPATH; ?>js/script.js"></script>
		<!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
		
		<?php wp_head(); ?>
	</head>

	<body>
	<div id="fb-root"></div>
	<script>
	  window.fbAsyncInit = function() {
	    FB.init({
	      appId      : '1066203396755847',
	      xfbml      : true,
	      version    : 'v2.6'
	    });
	  };

	  (function(d, s, id){
	     var js, fjs = d.getElementsByTagName(s)[0];
	     if (d.getElementById(id)) {return;}
	     js = d.createElement(s); js.id = id;
	     js.src = "//connect.facebook.net/en_US/sdk.js";
	     fjs.parentNode.insertBefore(js, fjs);
	   }(document, 'script', 'facebook-jssdk'));
	</script><!--FACEBOOK-->


<!--
	FORMAS
-->
		<div class="container">
			<div class="header clearfix">

				<section id="centrar" class="popup">
		
					<div class="fb_btn">
						<button type="submit" id="fb">Sign in with Facebook</button>
					</div>
					
					<div class="twitter_button">
						<button>Sign in with Twitter</button>
						
					</div>


					<div class="forma">
					  	<?php 
						  	$redir = site_url('');
							$args = array(
								'echo'           => true,
								'remember'       => true,
								'redirect'       => $redir,
								'form_id'        => 'loginform',
								'id_username'    => 'user_login',
								'id_password'    => 'user_pass',
								'id_remember'    => 'rememberme',
								'id_submit'      => 'wp-submit',
								'label_username' => __( 'Username' ),
								'label_password' => __( 'Password' ),
								'label_remember' => __( 'Remember Me' ),
								'label_log_in'   => __( 'Log In' ),
								'value_username' => '',
								'value_remember' => false
								);
							wp_login_form($args);
						?>
					</div><!--end wp_login_form-->
					
	
				<button id="sign_up">Register</button>
					
				</section>

<!--
	SIGNUP FORM
-->
				<form method="post" action="" id="signupForm">
					<input name="nick" 		  type="text" 		placeholder="user name">
					<input name="nombre" 	  type="text" 		placeholder="first name">
					<input name="apellido" 	  type="text" 		placeholder="last name">
					<input name="correo" 	  type="email" 		placeholder="email">
					<input name="pass" 		  type="password"	class="pass" 	    placeholder="password">
					<input name="confirmPass" type="password" 	id="confirmPass" placeholder="confirm password">
					<input type="submit" value="Send" class="exit">
				</form>

				<div class="contenedor clearfix">
					<div class="logo">
						<a href="<?php echo site_url() ?>"><h1>DEDALO</h1></a>
					</div><!-- logo -->
					<div class="login">
						<!-- <button id="btnTest">testbtn</button> -->
						<?php 
							if(is_user_logged_in()){ 
								$userID = get_current_user_id();
						?>
							<a href="">Welcome, <?php echo get_user_meta($userID, 'first_name', true);?></a>
						<?php 
							
							if(get_user_meta($userID, 'foto_user', true)){
						?>
							<a class="profilepic" href=""><img src="<?php echo get_user_meta($userID, 'foto_user', true); ?>"></a>
						<?php } else { ?>
							<a class="profilepic" href=""><img src="<?php echo THEMEPATH; ?>/images/profilepic.png"></a>
						<?php 
							} 
						} else { 
						?>
							<a href="#"id="btnTest">LOGIN</a>
							<a class="profilepic" href=""><img src="<?php echo THEMEPATH; ?>/images/profilepic.png"></a>
						<?php } ?>
					</div><!-- login -->
				</div><!-- contenedor -->
			</div><!--header-->

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
			