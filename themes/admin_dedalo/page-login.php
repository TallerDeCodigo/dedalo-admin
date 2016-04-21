<?php get_header(); ?>
<!--social Login buttons-->
	<section id="centrar" class="popup">
		<!-- <div class="close">
			<button>close</button>
		</div>	 -->
		<div class="fb_btn">
			<button type="submit">Sign in with Facebook</buttom>
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
		</div>
		
		<form method="post" action="<?php echo bloginfo('url')?>/signup" id="registro">
			<input type="submit" value="Register">
		</form>
	</section>
	<!--end centrar-->

	<style>
		label{display:none;}
		.popup{background-color:#191919;width:40%;height:500px;border-radius:5px;padding:150px 60px;z-index:200;position:absolute;}
		/*.close button{background-color:transparent;border-style: none;color:#606060; }*/
		.fb_btn, .twitter_button{width:50%;}
		.fb_btn button{width:100%;height:30px;border-style:none;padding-left:10px;border-bottom:1px solid white;margin-bottom:20px;margin-top:20px;background-color:transparent;color:#fff;text-align: left}
		.twitter_button button{width:100%;height:30px;border-style:none;padding-left:10px;border-bottom:1px solid white;margin-bottom:20px;background-color:transparent;color:#fff;text-align: left}
		.forma{float:right;margin-top:-100px;}
		#registro input{border-style: none;text-align:left;padding-left:10px;border-bottom:1px solid #fff;width:50%;height:30px;background-color: transparent;color:#fff;}
		.login-username input{border-style: none;text-align:left;padding-left:10px;border-bottom:1px solid #fff;width:100%;height:30px;background-color: transparent;color:#fff;margin-bottom:6px;}
		.login-password input{border-style: none;text-align:left;padding-left:10px;border-bottom:1px solid #fff;width:100%;height:30px;background-color: transparent;color:#fff;margin-bottom:6px;}
		.login-submit input{border-style: none;text-align:left;padding-left:10px;border-bottom:1px solid #fff;width:100%;height:30px;background-color: transparent;color:#fff;}
	</style>
<?php get_sidebar(); ?>
<?php get_footer(); ?>