	<?php
		get_header(); 
	?>	

	<?php 
		if(have_posts()): while(have_posts()): the_post(); 
		
	?>
		<div class="contenedor clearfix">
			<article class="noticia single_nota clearfix">

				<div class="head_nota clearfix">
					<h2><?php the_title(); ?></h2>
					<span class="date"><?php the_date(); ?></span>
					<div class="addthis_sharing_toolbox"></div>
				</div><!-- head nota -->
				<div class="content_nota">
					<?php the_post_thumbnail('full', array('class' => 'featured_image')); ?>
					<?php the_content(); ?>

					<div class="comments fb_comments clearfix">
						<h4>COMMENTS</h4>
					</div><!-- comments --> 
				</div><!-- content nota -->
			<?php endwhile; endif;  ?>
				

				<?php 
					$args = array(
							'post_type'			=> 'productos',
							'posts_per_page' 	=> 2,
						);

					$productos = get_posts($args);
				?>
				<section class="destacados seccion_home clearfix grid">
				<?php foreach($productos as $post): setup_postdata($post);?>
					<article class="producto clearfix">
						<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('dedalo_thumb_feed', array('class' => 'thumb')); ?></a>
						<div class="clearfix post_info_feed">
							<?php
								$userID = $post->post_author;
								$userURL = get_author_posts_url($userID);

								if(get_the_author_meta('foto_user', $userID) != ''){
							?>
								<a href="<?php echo $userURL; ?>"><img src="<?php echo get_the_author_meta('foto_user', $userID); ?>"></a>
							<?php
								} else {
							?>
								<a href=""><img src="<?php echo THEMEPATH; ?>/images/profilepic.png"> </a>
							<?php } ?>
							<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
							<h5><a href="<?php echo $userURL; ?>"><?php echo get_the_author(); ?></a></h5>
						</div>
						<?php the_excerpt(); ?>
						<?php if(get_post_meta($post->ID, 'precio_producto', true)){ ?>
						<span class="precio">$ <?php echo get_post_meta($post->ID, 'precio_producto', true); ?></span>
						<?php } ?>
					</article>
				<?php endforeach;  ?>

				</section><!-- destacados productos -->
			</article><!-- single_nota -->
		
		<?php get_sidebar(); ?>
			
		</div><!-- contenedor -->	
	
	<?php get_footer(); ?>