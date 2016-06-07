<?php get_header(); 

?>

	<section id="uploads">
		<form id="upfiles" method="post" action="" enctype="multipart/form-data">
			<fieldset class="fields l">
				<input type="text" class="textField" placeholder="Title"><br>
				<?php
				
				// $subArgs = array(
				// 				'child_of'=>'13','hide_empty'=>'0','echo'=>'0');
				// $subcats = wp_list_categories($subArgs);

				$args = array(
									'show_count'=>'0',
									'parent'=>'0',
									'hierarchical'=>'1',
									'hide_empty'=>'0',
									'exclude'=>'1' ); ?>
				
				<?php wp_dropdown_categories( $args );?><br>
				<?php wp_dropdown_categories();?><br>

				<textarea placeholder="Write a description" class="textField" rows="10"></textarea>
			</fieldset>

			<fieldset class="fields r">
				<input type="text" class="textField" placeholder="Model file URL">
				<p>Design tools</p>
				<label for="tinkercad">Tinkercad</label>
				<input type="checkbox" class="checks" id="tinkercad">

				<label for="blender">Blender</label>
				<input type="checkbox" class="checks" id="blender">

				<label for="other">Other</label>
				<input type="checkbox" class="checks" id="other"><br><br>

				<p>License</p>
				<label for="cc">Creative Commons</label>
				<input type="checkbox" id="cc"><br>
				<!--upload file -->
				<input type="file" id="image" name="image" value="" data-multiple-caption="{count} files selected" multiple><br>
				<input type="submit" id="go" name="submit" value="Send">
			</fieldset>
		</form>
	</section>
<?php get_sidebar(); ?>
<?php get_footer(); ?>