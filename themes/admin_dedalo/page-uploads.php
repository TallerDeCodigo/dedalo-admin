<?php get_header(); 

?>

	<section id="uploads">
		<form id="upfiles" method="post" action="" enctype="multipart/form-data">
			<fieldset class="fields l">
				<input type="text" class="textField" placeholder="Title"><br>
				<?php
					$args = array(
									'show_count'=>'0',
									'parent'=>'0',
									'hierarchical'=>'1',
									'hide_empty'=>'0',
									'exclude'=>'1,9',
									'echo'=>'0'
								 );
					echo "<div id='drop1'>";
					echo wp_dropdown_categories($args);
					echo "</div>";
				//print_r( wp_list_categories($args));

					//obtiene las categorias parent
				$catList = get_categories($args);

				for($i=0; $i<count($catList);$i++){
					//obtiene los ids de cada category parent
					

					$args2 = array(
								'show_count'=>'0',
								'parent'=>$catList[$i]->cat_ID,
								'hierarchical'=>'1',
								'hide_empty'=>'0',
								'exclude'=>'9'
								);
					$catList[$i]->cat_ID;
					echo "<div class='hidden show drop" . $catList[$i]->cat_ID . "'>";
						wp_dropdown_categories( $args2 );
					echo "</div>";
					}
				?>


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

					<div class="box__input">
				    	<input class="box__file" type="file" name="files[]" id="file" data-multiple-caption="{count} files selected" multiple />
				    	<label for="file"><strong>Choose file</strong><span class="box__dragndrop"> or drag it here</span>.</label>
				    	<button class="box__button" type="submit">Upload</button>
				  	</div>
				  	<div class="box__uploading">Uploading&hellip;</div>
				  	<div class="box__success">Done!</div>
				  	<div class="box__error">Error! <span></span>.</div>

				<input type="submit" id="go" name="submit" value="Send">
			</fieldset>
		</form>
	</section>
<?php get_sidebar(); ?>
<?php get_footer(); ?>