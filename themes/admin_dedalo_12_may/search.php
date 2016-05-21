<?php 
	get_header(); 
	if(isset($_GET['s'])){
		$query = $_GET['s'];
		
	}
?>
		
	<div class="contenedor clearfix">
		<section class="search_results clearfix">

			<div class="search_left">
				<h2><?php echo $query; ?></h2> 
			</div>
			<div class="search_right">
				<?php 
					if(have_posts()): 
						while(have_posts()): 
							the_post(); 
				?>
					<article class="noticia clearfix">
						<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('dedalo_thumb'); ?></a>
						<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
						<p class="excerpt"><?php the_excerpt(); ?></p>
					</article>
				<?php endwhile; endif; wp_reset_postdata(); ?>
			</div>
		</section><!-- notas -->
	</div>

	<?php get_footer(); ?>