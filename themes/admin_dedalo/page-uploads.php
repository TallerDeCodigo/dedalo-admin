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
		$fileUpload			= (isset($_FILES['file']) AND $_FILES['file'] != "") ? $_FILES['file'] : NULL;
		$price				= (isset($_GET['costo']) AND $_GET['costo'] != "") ? $_GET['costo'] : NULL;
		$tst				= $_GET['_wp_http_referer'];
		echo($fileUpload);
		//print_r("este es file upload " .$fileUpload);
		$insertData = array(
						'post_type'		=>'productos',
						'post_title'	=>$title,
						'post_content'	=>$description,
						'meta_input'	=>array(
											'file_for_download'=>$fileurl,
											'precio_producto'=>$price,
											'_wp_attached_file'=>$fileUpload,
											'license'=>$license
											)
						);
		$insertID = wp_insert_post($insertData);
		//print_r($_GET['_wp_http_referer'] . " ");

		$catName = get_cat_name($category);
		$subCatName = get_cat_name($subCategory);

		wp_set_object_terms( $insertID, [$catName, $subCatName], 'category');
		wp_set_object_terms( $insertID, $tool, 'design-tools');
		wp_set_object_terms( $insertID, $license, 'license');
		


		//carga imagen a media library y la signa como thumbnail al post
		require_once( ABSPATH . 'wp-admin/includes/image.php' );
		require_once( ABSPATH . 'wp-admin/includes/file.php' );
		require_once( ABSPATH . 'wp-admin/includes/media.php' );
		// Let WordPress handle the upload
		$attachment_id = media_handle_upload('file', $insertID );
		if ( is_wp_error( $attachment_id ) ) {
			wp_send_json_error();
		}else {
			add_post_meta($insertID, '_thumbnail_id', $attachment_id);
			$metadata = wp_get_attachment_metadata( $attachment_id );
			// $new_imagemeta = array(
			// 					"aperture"=> 0,
			// 					"credit"=> "",
			// 					"camera"=> "",
			// 					"caption"=> "",
			// 					"created_timestamp"=> 0,
			// 					"copyright"=> "",
			// 					"focal_length"=> 0,
			// 					"iso"=> 0,
			// 					"shutter_speed"=> 0,
			// 					"title"=> $project_data['event_title'],
			// 					"orientation"=> 0
			// 				);
			// $metadata['image_meta'] = $new_imagemeta;
			// wp_update_attachment_metadata($attachment_id, $metadata);
		}

		// $filename should be the path to a file in the upload directory.
		// $filename = '/dedalo/wp-content/uploads/' . date('Y') .'/'. date('m') .'/'. $fileUpload;
		// //print_r($filename);
		// // The ID of the post this attachment is for.
		// $parent_post_id = $insertID;

		// // Check the type of file. We'll use this as the 'post_mime_type'.
		// $filetype = wp_check_filetype( basename( $filename ), null );

		// // Get the path to the upload directory.
		// $wp_upload_dir = wp_upload_dir();

		// // Prepare an array of post data for the attachment.
		// $attachment = array(
		// 	'guid'           => $wp_upload_dir['url'] . '/' . basename( $filename ), 
		// 	'post_mime_type' => $filetype['type']
		// );

		// // Insert the attachment.
		// $attach_id = wp_insert_attachment( $attachment, $filename, $parent_post_id );
		// //print_r('attach id '.$attach_id);
		// // Make sure that this file is included, as wp_generate_attachment_metadata() depends on it.
		// require_once( ABSPATH . 'wp-admin/includes/image.php' );

		// // Generate the metadata for the attachment, and update the database record.
		// $attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
		// wp_update_attachment_metadata( $attach_id, $attach_data );

		// set_post_thumbnail( $parent_post_id, $attach_id );

	}


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
				<input type="radio" class="checks" id="tinkercad" <?php if(isset($_GET['tools']) AND $_GET['tools']== "tinkercad") : echo "checked = 'checked'"; endif; ?> name="tools" value="tinkercad"<?php echo $toolMarked; ?>>

				<label for="blender">Blender</label>
				<input type="radio" class="checks" id="blender" <?php if(isset($_GET['tools']) AND $_GET['tools']== "blender") : echo "checked = 'checked'"; endif; ?> name="tools" value="Blender"<?php echo $toolMarked; ?>>

				<label for="other">Other</label>
				<input type="radio" class="checks" id="other"  <?php if(isset($_GET['tools']) AND $_GET['tools']== "other") : echo "checked = 'checked'"; endif; ?> name="tools" value="other"<?php echo $toolMarked; ?>><br><br>

				<p>License</p>
				<label for="cc">Creative Commons</label>
				<input type="checkbox" id="cc" class="checks" name="cc" value="Creative Commons" <?php echo $license_checked; ?>><br>

				<input type="text" class="textField" placeholder="Costo" name="costo">
					<div id="drop-zone">
					    Drop files here
					    <div id="clickHere">
					        or click here
					        <input type="file" name="file" id="file" accept="image/*" />
					        <?php wp_nonce_field( 'artist_image_upload', 'artist_image_upload_nonce' ); ?>
					    </div>
					</div>
				<input type="submit" id="go" name="submit" value="Send">
			</fieldset>
		</form>
	</section>
<?php get_sidebar(); ?>
<?php get_footer(); ?>