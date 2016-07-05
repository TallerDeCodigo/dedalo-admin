<?php get_header(); ?>
<div class="darks">
	<div class="toper contenedor clearfix">
			<div class="account">
				<?php $userID = get_current_user_id(); ?>
				<a class="face-id" href="#"><img src="<?php echo get_user_meta($userID, 'foto_user', true); ?>"></a>
				<h2><?php echo get_user_meta($userID, 'first_name', true);?></h2>
			</div>
			<div class="account-menu">
				<div>
					<a href="<?php echo site_url() ?>/dashboard/"><div class="selected1">DASHBOARD</div></a>
					<a href="<?php echo site_url() ?>/account/"><div>ACCOUNT</div></a>
					<a href=""><div>PRODUCTS</div></a>
					<a href=""><div>SALES</div></a>
					<a href=""><div>FOLLOWING</div></a>
				</div>
			</div>
				
	</div>
	<div class="dashboard contenedor clearfix">
		
		<div class="column">
			<p>Choose from categories to follow</p>
			<p id="dashboard1">
<?php
	global $current_user;
    $current_user = wp_get_current_user();

	$args = array('child_of'=>0,'hide_empty'=>0);
	$categories = get_categories($args);

	for($i=0; $i<count($categories); $i++){

		$is_following = is_following_cat($user_login, $categories[$i]->term_id);
		$following_class = ($is_following) ? "choosed unfollow_category" : "follow_category";
		
		echo("<a class='cat-choose ".$following_class." ' data-user='".$current_user->user_login."' data-id='" . $categories[$i]->term_id . "' href='#'>" . $categories[$i]->name . "</a>");
 		};
?>
			</p>
		</div>


		<div class="column">
			<p>Choose from users to follow</p>
			<p id="dashboard2">
				<?php 
					$args = array(
							'fields' => 'display_name',
						);
					$users = get_users($args);
					foreach ($users as $userID):
						$user = get_user_by('id', $userID);
					$is_following = is_following_user($user, $categories[$i]->term_id);
				?>
					<a class="usuario">
						<?php 
							if(get_the_author_meta('foto_user', $userID) != ''){
							?>
								<img src="<?php echo get_the_author_meta('foto_user', $userID); ?>">
							<?php
								} else {
							?>
								<img src="<?php echo THEMEPATH; ?>/images/profilepic.png">
						<?php } ?>
					</a>
				<?php endforeach; ?>
			</p>
		</div>
		<a class="more"><i class="material-icons">refresh</i> MORE</a>
	</div>
</div>
<?php get_footer(); ?>