<?php
	
	$license_checked 	= '';
	$toolMarked			= '';

	if(!empty($_GET)){

		$title 				= (isset($_GET['productTitle']) AND $_GET['productTitle'] != "") ? $_GET['productTitle'] : NULL; 
		$category 			= (isset($_GET['mainCat']) AND $_GET['mainCat'] != "") ? $_GET['mainCat'] : NULL;
		$subCategory 		= (isset($_GET['subCat'])AND $_GET['subCat'] != "") ? $_GET['subCat'] : NULL;
		$description 		= (isset($_GET['description']) AND $_GET['description'] != "") ? $_GET['description'] : NULL;
		$fileurl			= (isset($_GET['modelFileUrl']) AND $_GET['modelFileUrl'] != "") ? $_GET['modelFileUrl'] : NULL;
		$tool 				= (isset($_GET['tools']) AND $_GET['tools'] != "") ? $_GET['tools'] : NULL ;
		$toolMarked			= ($tool == "true") ? "checked" : "";
		$license 			= (isset($_GET["cc"]) AND $_GET["cc"] != "") ? $_GET['cc'] : NULL;
		$license_checked 	= ($license == "true") ? "checked" : "";
		$fileUpload			= (isset($_GET['archivo']) AND $_GET['archivo'] != "") ? $_GET['archivo'] : NULL;
		$price				= (isset($_GET['costo']) AND $_GET['costo'] != "") ? $_GET['costo'] : NULL;

		
		$insertData = array(
						'post_type'		=>'productos',
						'post_title'	=>$title,
						'post_content'	=>$description,
						'meta_input'	=>array(
											'file_for_download'=>$fileurl,
											'precio_producto'=>$price,
											'_wp_attached_file'=>$fileUpload,
											'license'=>$license,
											'design-tools'=>$tool )
						);
		$insertID = wp_insert_post($insertData);

		// if($insertID){
		// 	update_post_meta($insertID, 'license', $license);
		// 	print_r(add_post_meta($insertID,'license', $license, true));
		// }
		
		print_r($insertID);
		echo"<div class='successMsg'>";
		print_r('Your file has been uploaded');
		echo "</div>";
	}

	//print_r($fileUpload);
?>
<?php get_header();?>
	<section id="uploads">
		<form id="upfiles" method="get" action="" enctype="multipart/form-data" name="upfiles">
			<fieldset class="fields l">
				<input type="text" class="textField" placeholder="Title" name="productTitle"><br>
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
					echo "<div id=".$catList[$i]->cat_ID ." class='hidden show drop" . $catList[$i]->cat_ID . "'>";
						wp_dropdown_categories( $args2 );
					echo "</div>";
					}
				?>


				<textarea placeholder="Write a description" class="textField" rows="10" name="description"></textarea>
			</fieldset>


			<fieldset class="fields r">

				<input type="text" class="textField" placeholder="Model file URL" name="modelFileUrl">
				<p>Design tools</p>
				<label for="tinkercad">Tinkercad</label>
				<input type="radio" class="checks" id="tinkercad" checked="" name="tools">

				<label for="blender">Blender</label>
				<input type="radio" class="checks" id="blender" checked="" name="tools">

				<label for="other">Other</label>
				<input type="radio" class="checks" id="other" checked="" name="tools"><br><br>

				<p>License</p>
				<label for="cc">Creative Commons</label>
				<input type="checkbox" id="cc" class="checks" name="cc" value="Creative Commons" <?php echo $license_checked; ?>><br>

				<input type="text" class="textField" placeholder="Costo" name="costo">

					<div class="box">
					<div class="box__input">
				    	<input class="box__file" type="file" name="archivo" id="file" data-multiple-caption="{count} files selected" multiple />
				    	<label id="showTitle" for="file"><strong>Choose file</strong><span class="box__dragndrop"> or drag it here</span>.</label>
				    	<!-- <button class="box__button" type="submit">Upload</button> -->
				  	</div>
				  	<div class="box__uploading">Uploading&hellip;</div>
				  	<div class="box__success">Done!</div>
				  	<div class="box__error">Error! <span></span>.</div>
				  	</div>
				<input type="submit" id="go" name="submit" value="Send">
			</fieldset>
		</form>
	</section>
<?php get_sidebar(); ?>
<?php get_footer(); ?>