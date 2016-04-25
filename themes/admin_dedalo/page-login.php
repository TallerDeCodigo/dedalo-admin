<?php get_header(); ?>
<div class="empty">
	<!--this div is empty-->
</div>	



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
		
		<form method="post" action="<?php echo bloginfo('url')?>/signup" id="registro">
			<input type="submit" value="Register">
		</form>
	</section>
	<!--end centrar-->
<?php get_sidebar(); ?>
<?php get_footer(); ?>