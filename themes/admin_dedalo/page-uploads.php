<?php
	
	$license_checked 	= '';
	$toolMarked			= '';

	if( !empty($_POST) AND isset($_POST['mainCat']) ){

		$title 				= (isset($_POST['productTitle']) AND $_POST['productTitle'] != "") ? $_POST['productTitle'] : NULL; 
		$category 			= (isset($_POST['mainCat']) AND $_POST['mainCat'] != "") ? $_POST['mainCat'] : NULL;
		$subCategory 		= (isset($_POST['subCat'])AND $_POST['subCat'] != "") ? $_POST['subCat'] : NULL;
		$description 		= (isset($_POST['description']) AND $_POST['description'] != "") ? $_POST['description'] : '';
		$fileurl			= (isset($_POST['modelFileUrl']) AND $_POST['modelFileUrl'] != "") ? $_POST['modelFileUrl'] : NULL;
		$tool 				= (isset($_POST['tools']) AND $_POST['tools'] != "") ? $_POST['tools'] : NULL ;
		$toolMarked			= ($tool == "true") ? "checked" : "";
		$license 			= (isset($_POST["cc"]) AND $_POST["cc"] != "") ? $_POST['cc'] : NULL;
		$license_checked 	= ($license == "true") ? "checked" : "";
		$fileUploadName		= (isset($_FILES['file']) AND $_FILES['file'] != "") ? $_FILES['file'] : NULL;
		$price				= (isset($_POST['costo']) AND $_POST['costo'] != "") ? $_POST['costo'] : NULL;

		$insertData = array(
						'post_type'		=>'productos',
						'post_title'	=>$title,
						'post_content'	=>$description,
						'post_status'   =>'publish',
						'meta_input'	=>array(
											'file_for_download'=>$fileurl,
											'precio_producto'=>$price,
											'_wp_attached_file'=>$fileUploadName,
											'license'=>$license
											)
						);

		$insertID = wp_insert_post($insertData);
		$catName = get_cat_name($category);
		$subCatName = get_cat_name($subCategory);

		wp_set_object_terms( $insertID, [$catName, $subCatName], 'category');
		wp_set_object_terms( $insertID, $tool, 'design-tools');
		wp_set_object_terms( $insertID, $license, 'license');

		//carga imagen a media library y la signa como thumbnail al post
		if ($_FILES['file']['size'] != 0) {
			require_once( ABSPATH . 'wp-admin/includes/image.php' );
			require_once( ABSPATH . 'wp-admin/includes/file.php' );
			require_once( ABSPATH . 'wp-admin/includes/media.php' );
			// Let WordPress handle the upload
			$attachment_id = media_handle_upload('file', $insertID );
			set_post_thumbnail( $insertID, $attachment_id );
			// if ( is_wp_error( $attachment_id ) ) {
			// }else {
			// }
		}
	
	header("Location: ".home_url());
	exit;

	}

?>
<?php get_header();?>
	<section id="uploads">
		<form id="upfiles" method="POST" action="#" enctype="multipart/form-data" name="upfiles">
			<fieldset class="fields l">
				<input type="text" class="textField" placeholder="Title" name="productTitle" required><br>
				<?php
					$args = array(
									'show_count'=>'0',
									'parent'=>'0',
									'hierarchical'=>'1',
									'hide_empty'=>'0',
									'exclude'=>'1,9',
									'echo'=>'0'
									// 'show_option_none'=>'Select category'
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
				<input type="radio" class="checks" id="tinkercad" <?php if(isset($_POST['tools']) AND $_POST['tools']== "tinkercad") : echo "checked = 'checked'"; endif; ?> name="tools" value="tinkercad"<?php echo $toolMarked; ?>>

				<label for="blender">Blender</label>
				<input type="radio" class="checks" id="blender" <?php if(isset($_POST['tools']) AND $_POST['tools']== "blender") : echo "checked = 'checked'"; endif; ?> name="tools" value="Blender"<?php echo $toolMarked; ?>>

				<label for="other">Other</label>
				<input type="radio" class="checks" id="other"  <?php if(isset($_POST['tools']) AND $_POST['tools']== "other") : echo "checked = 'checked'"; endif; ?> name="tools" value="other"<?php echo $toolMarked; ?>><br><br>

				<p>License</p>
				<label for="cc">Creative Commons</label>
				<input type="checkbox" id="cc" class="checks" name="cc" value="Creative Commons" <?php echo $license_checked; ?>><br>

				<input type="text" class="textField" placeholder="Costo" name="costo" onkeypress='return event.charCode >= 36 && event.charCode <= 57'>
					<div id="drop-zone">
					    Drop files here
					    <div id="clickHere">
					        or click here
					        <input type="file" name="file" id="file" multiple="false" />
				        
					    </div>
					</div>
				<?php wp_nonce_field( 'file', 'file_nonce' ); ?>
				<input type="submit" id="go" name="submit" value="Send">
			</fieldset>
		</form>
	</section>
<?php get_sidebar(); ?>
<?php get_footer(); ?>