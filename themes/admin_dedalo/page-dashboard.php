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
		print_r("<a class='choosed cat-choose unfollow_category follow_category'  data-id='$current_user->ID' href='#'>" . $categories[$i]->name . "</a>");
 		};
?>

				<!-- <a class="choosed cat-choose" href="#">Lorem</a>
				<a class="choosed cat-choose" href="#">Ipsum</a>
				<a class="choosed" href="#">Dolor</a>
				<a class="choosed cat-choose" href="#">Sit</a>
				<a class="choosed" href="#">Amet</a>
				<a class="choosed cat-choose" href="#">Consectetur</a>
				<a class="choosed" href="#">Adipiscing</a>
				<a class="choosed cat-choose" href="#">Integer</a>
				<a class="choosed" href="#">Lorem</a>
				<a class="choosed" href="#">Ipsum</a>
				<a class="choosed" href="#">Dolor</a>
				<a class="choosed cat-choose" href="#">Sit</a>
				<a class="choosed cat-choose" href="#">Amet</a>
				<a class="choosed cat-choose" href="#">Consectetur</a>
				<a class="choosed cat-choose" href="#">Adipiscing</a>
				<a class="choosed" href="#">Integer</a>
				<a class="choosed cat-choose" href="#">Consectetur</a>
				<a class="choosed" href="#">Adipiscing</a>
				<a class="choosed cat-choose" href="#">Integer</a>
				<a class="choosed" href="#">Lorem</a>
				<a class="choosed" href="#">Ipsum</a>
				<a class="choosed" href="#">Dolor</a>
				<a class="choosed cat-choose" href="#">Sit</a>
				<a class="choosed cat-choose" href="#">Amet</a>
				<a class="choosed cat-choose" href="#">Integer</a>
				<a class="choosed" href="#">Lorem</a>
				<a class="choosed" href="#">Ipsum</a>
				<a class="choosed" href="#">Dolor</a> -->
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