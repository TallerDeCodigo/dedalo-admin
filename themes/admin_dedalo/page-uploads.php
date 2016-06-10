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
		$fileUpload			= (isset($_GET['file']) AND $_GET['file'] != "") ? $_GET['file'] : NULL;
		$price				= (isset($_GET['costo']) AND $_GET['costo'] != "") ? $_GET['costo'] : NULL;
		
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


		$catName = get_cat_name($category);
		$subCatName = get_cat_name($subCategory);

		wp_set_object_terms( $insertID, [$catName, $subCatName], 'category');
		wp_set_object_terms( $insertID, $tool, 'design-tools');
		wp_set_object_terms( $insertID, $license, 'license');
		



		// if($insertID){
		// 	update_post_meta($insertID, 'license', $license);
		// 	print_r(add_post_meta($insertID,'license', $license, true));
		// }
		// print_r("CAT ".$category . " ");
		// print_r("SCAT ".$subCategory . " ");
		// print_r("TOOL ".$tool . " ");
		// print_r("LICENSE ".$license . " ");
		// print_r("FILEUP ".$fileUpload . " ");
		 print_r("INSERT ID ".$insertID);

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
					    Drop files here...
					    <div id="clickHere">
					        or click here..
					        <input type="file" name="file" id="file" />
					    </div>
					</div>
				<input type="submit" id="go" name="submit" value="Send">
			</fieldset>
		</form>
	</section>
<?php get_sidebar(); ?>
<?php get_footer(); ?>