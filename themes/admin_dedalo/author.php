<?php get_header(); ?>
	
	<div class="search">
		<form id="searchform" role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
		   
		        <span class="screen-reader-text"><?php echo _x( '', 'label' ) ?></span>
		        <input type="text" class="search-field"
		            placeholder="<?php echo esc_attr_x( 'Buscar...', 'placeholder' ) ?>"
		            value="<?php echo get_search_query() ?>" name="s"
		            title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
		    
		</form>
	</div>
		
		<div class="contenedor clearfix">
		<?php 
			$args = array(
					'post_type'			=> 'productos',
					'posts_per_page' 	=> 8,
				);

			$productos = get_posts($args);
			if($productos):
		?>
		<h3>DESTACADOS</h3>
		<section class="destacados seccion_home clearfix grid">
		<?php 
			foreach($productos as $post): setup_postdata($post);
		?>
			<article class="producto clearfix">
				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('dedalo_thumb'); ?></a>
				<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
				<h5><a href=""><?php echo get_the_author(); ?></a></h5>
				<p class="excerpt"><?php the_excerpt(); ?></p>
				<?php if(get_post_meta($post->ID, 'precio_producto', true)){ ?>
				<span class="precio">$ <?php echo get_post_meta($post->ID, 'precio_producto', true); ?></span>
				<?php } ?>
			</article>
		<?php endforeach; wp_reset_postdata(); ?>

		</section>
		<?php endif; ?>
		
		<h3>NOTICIAS</h3>

		<section class="notas seccion_home 	clearfix grid">
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
		</section><!-- notas -->
		
		<?php /*
		<h3>MARCAS</h3>
		<section class="notas seccion_home clearfix grid">
			<article class="producto clearfix">
				<a href=""><img src="<?php echo THEMEPATH; ?>/images/brand.png"></a>
				<h4><a href="">Nombre marca</a></h4>
			</article>
			<article class="producto clearfix">
				<a href=""><img src="<?php echo THEMEPATH; ?>/images/brand.png"></a>
				<h4><a href="">Nombre marca</a></h4>
			</article>
			<article class="producto clearfix">
				<a href=""><img src="<?php echo THEMEPATH; ?>/images/brand.png"></a>
				<h4><a href="">Nombre marca</a></h4>
			</article>
			<article class="producto clearfix">
				<a href=""><img src="<?php echo THEMEPATH; ?>/images/brand.png"></a>
				<h4><a href="">Nombre marca</a></h4>
			</article>
		</section><!-- notas -->
	
		*/ ?>
	</div>

	
	<?php get_sidebar(); ?>
	<?php get_footer(); ?>