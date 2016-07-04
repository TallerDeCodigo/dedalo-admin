<?php get_header(); the_post(); ?>

<section id="privacy">
	<section class="page_content">
		<h2><?php the_title(); ?></h2>
		<span><?php echo date("F j, Y"); ?></span>
		<?php the_content(); ?>
	</section>
</section>

<?php get_sidebar(); ?>
<?php get_footer(); ?>