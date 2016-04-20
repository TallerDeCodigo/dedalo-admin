<?php get_header(); ?>


<!--social Login buttons-->
<!-- <div class="fb-login-button" data-max-rows="2" data-size="medium" data-show-faces="false" data-auto-logout-link="true" ></div>
	<div > -->
		<button type="submit">login con facebook</buttom>
	</div>
	<div class="twitter_button">
		<img src="<?php echo THEMEPATH; ?>images/sign-in-with-twitter-gray.png">
	</div>

<section id="centrar">

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

<form method="post" action="<?php echo bloginfo('url')?>/signup" id="registro">
	<input type="submit" value="Regístrate">
</form>
</section>

<style>
	label{display:none;}
	/*#centrar{width:20%;border:1px solid red;margin:0 auto;text-align: center}
	#registro{position:relative;top:-72px;left:100px;}
	#testform{padding:20px;background-color: #000;}
	.fb-login-button{margin:20px 0 0 10px;} 
	.twitter_button{margin:20px 0 20px 10px;}
	#testform{margin:20px auto;}
	input{display: block;  border-bottom:1px solid #fff;border-style:none;text-align:center;margin:10px; padding:3px;background:none;color:#666;}
	input[type=submit]{width:80px; background:none; border:none}*/
</style>
<?php get_sidebar(); ?>
<?php get_footer(); ?>