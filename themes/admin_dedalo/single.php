	<?php get_header(); ?>	

	<?php if(have_posts()): while(have_posts()): the_post(); ?>
		<div class="contenedor clearfix">

			<article <?php echo post_class('clearfix'); ?>>
				<div class="head_producto clearfix">
					<h2><?php the_title(); ?></h2>
					<h3 class="author"><?php echo get_the_author(); ?></h3>
				</div>
				<section class="info_producto clearfix">
					<section class="description">
						<?php the_content(); ?>
					</section>
					
				</section><!-- producto info -->
			</article>
		</div>
			
		
	<?php endwhile; endif; ?>

	<?php get_sidebar(); ?>
	<?php get_footer(); ?>