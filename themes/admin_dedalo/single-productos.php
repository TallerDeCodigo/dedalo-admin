	<?php get_header(); ?>	

	<?php if(have_posts()): while(have_posts()): the_post(); ?>
		<div class="contenedor clearfix">

			<article <?php echo post_class('clearfix'); ?>>
				<div class="head_producto clearfix">
					<h2><?php the_title(); ?></h2>
					<?php
						$userID = $post->post_author;
						$userURL = get_author_posts_url($userID);

						if(get_the_author_meta('foto_user', $userID) != ''){
					?>
						<a href="<?php echo $userURL; ?>"><img src="<?php echo get_the_author_meta('foto_user', $userID); ?>"><h3 class="author"><?php echo get_the_author(); ?></h3></a>
					<?php
						} else {
					?>
						<a href=""><img src="<?php echo THEMEPATH; ?>/images/profilepic.png"> <h3 class="author"><?php echo get_the_author(); ?></h3></a>
					<?php } ?>
				</div>

				<section class="clearfix">
					<section class="slider_producto cycle-slideshow" 
				    data-cycle-swipe=true
				    data-cycle-slides="> div"
				    data-cycle-swipe-fx=scrollHorz
				    data-cycle-timeout=5000
				    data-cycle-prev=".prev"
				    data-cycle-next=".next"
				    data-cycle-pager="#per-slide-template"
				    data-cycle-auto-height=container
				    >
					<?php 
						$args = array(
								'post_type'			=> 'attachment',
								'post_parent'		=> $post->ID,
								'posts_per_page'	=> -1,
								'post_mime_type'	=> 'image' 
							);

						$imagenes = get_posts($args);
						foreach($imagenes as $imagen):
						$src = wp_get_attachment_image_src($imagen->ID, 'full');
						$thumb = wp_get_attachment_image_src($imagen->ID, 'dedalo_thumb');
				
					?>
						<div class="slide" data-cycle-pager-template="<a href=#><img src='<?php echo $thumb[0];?>'></a>">
							<img src="<?php echo $src[0]; ?>">
						</div>
					<?php
						endforeach;
					?>
					</section>
					<div id=per-slide-template class="center external"></div>
				</section>
				
				<section class="info_producto clearfix">
					<section class="description">
						<?php the_content(); ?>
					</section>
					<section class="precio_down">
						<?php 
							if(get_post_meta($post->ID, 'precio_producto', true)){
								echo '<span class="meta precio"><i class="material-icons">attach_money</i>'.get_post_meta($post->ID, "precio_producto", true).'</span>';
							}
						?>
						<?php 
							if(get_post_meta($post->ID, 'file_for_download', true)){
								echo '<span class="meta download"><a href="'.get_post_meta($post->ID, "file_for_download", true).'"><i class="material-icons">file_download</i>Download</a></span>';
							}
						?>
					</section>
				</section><!-- producto info -->
			</article>
		</div>
			<article <?php echo post_class('clearfix'); ?>>
				<section class="info_producto clearfix">
					<section class="meta_info">
						<div class="contenedor clearfix">
							<section class="info_meta technical">
								<span class="meta"><i class="material-icons">info</i>Technical Info</span> 
								<?php 
									if(get_post_meta($post->ID, 'info_tecninca', true)){
										echo get_post_meta($post->ID, 'info_tecninca', true);
									}
								?>
							</section>
							
							<section class="info_meta printer">
								 <span class="meta"><i class="material-icons">print</i>Printer Settings</span> 
								<?php 
									if(get_post_meta($post->ID, 'print_type', true)){
										echo '<span class="meta_child"><b>Printer type: </b> '.get_post_meta($post->ID, 'print_type', true).'</span>';
									}
								?>
								<?php 
									if(get_post_meta($post->ID, 'supports_rafts', true)){
										echo '<span class="meta_child"><b>Supports rafts: </b> '.get_post_meta($post->ID, 'supports_rafts', true).'</span>';
									}
								?>
								<?php 
									if(get_post_meta($post->ID, 'infill', true)){
										echo '<span class="meta_child"><b>Infill: </b> '.get_post_meta($post->ID, 'infill', true).'</span>';
									}
								?>
								<?php 
									if(get_post_meta($post->ID, 'resolution', true)){
										echo '<span class="meta_child"><b>Resolution: </b> '.get_post_meta($post->ID, 'resolution', true).'</span>';
									}
								?>
							</section>
							<section class="info_meta notes">
								 <span class="meta"><i class="material-icons">mode_edit</i>Notes</span> 
								<?php 
									if(get_post_meta($post->ID, 'notas_tecnicas', true)){
										echo '<span class="meta_child notes">'.get_post_meta($post->ID, 'notas_tecnicas', true).'</span>';
									}
								?>
							</section><!-- printer -->
						</div><!-- contenedpr -->

					</section><!-- meta_info -->
					<div class="contenedor">
						<section class="extra_info clearfix">
						<div class="tags">
							<i class="material-icons">label</i><h5>Tags</h5>
							<?php the_tags('', ''); ?>
						</div><!-- tags -->
						<div class="dtools">
							<i class="material-icons">build</i><h5>Design Tools</h5>
							<?php 
								$dtools = get_the_terms($post->ID, 'design-tools');
								if($dtools){
									foreach($dtools as $term):
										$term_link = get_term_link( $term );
										//print_r($term);
										echo '<a href="'.$term_link.'">'.$term->name.'</a>';
									endforeach;
								}
							?>
						</div><!-- tags -->
						<div class="license_type">
							
						</div>

						</section><!-- tags extra_info -->

					</div><!-- contenedor -->
				
			</article>
		
	<?php endwhile; endif; ?>

	<?php get_sidebar(); ?>
	<?php get_footer(); ?>