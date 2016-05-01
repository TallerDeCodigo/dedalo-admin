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



</aside><!-- main_sidebar -->