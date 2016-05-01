<aside id="main_sidebar">
	


		<?php 
			$args = array(
					'post_type'			=> 'productos',
					'posts_per_page' 	=> 4,
					'offset' => 2
				);

			$productos = get_posts($args);
			if($productos):
		?>
		<h3>FEATURED</h3>
		<section class="destacados clearfix grid">
		<?php 
			foreach($productos as $post): setup_postdata($post);
		?>
			<article class="producto clearfix">
				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail'); ?></a>
				<div class="clearfix post_info_feed">
					<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
					<h5><a href="<?php echo $userURL; ?>"><?php echo get_the_author(); ?></a></h5>
					<?php if(get_post_meta($post->ID, 'precio_producto', true)){ ?>
					<span class="precio">$ <?php echo get_post_meta($post->ID, 'precio_producto', true); ?></span>
					<?php } ?>
				</div>
				
			</article>
		<?php endforeach; wp_reset_postdata(); ?>

		</section>
		<?php endif; ?>
	
	<h3>NEWS</h3>

		<section class="notas clearfix grid">
		<?php 
			$args = array(
					'post_type' => 'post',
					'posts_per_page' => 4,
					'exclude' => $post->ID
				);

			$posts = get_posts($args);
			foreach($posts as $post): setup_postdata($post);
		?>
			<article class="noticia clearfix">
				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail'); ?></a>
				<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
			</article>
		<?php endforeach; wp_reset_postdata(); ?>
		</section><!-- notas -->
<h3>MAKERS</h3>
		<section class="brands seccion_home clearfix grid">
		<?php 
			$args = array(
					'fields' => 'display_name',
				);
			$users = get_users($args);
			foreach ($users as $userID):
				$user = get_user_by('id', $userID);
				// echo '<pre>';
				// print_r($user);
				// echo '</pre>';
		?>
			<article class="brand clearfix">
				<a href="<?php echo site_url('maker').'/'.$user->user_nicename; ?>">
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
			</article>
		<?php endforeach; ?>
		</section><!-- notas -->


</aside><!-- main_sidebar -->