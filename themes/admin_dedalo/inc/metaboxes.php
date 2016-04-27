<?php


// CUSTOM METABOXES //////////////////////////////////////////////////////////////////



	add_action('add_meta_boxes', function(){

		add_meta_box( 'technical_info', 'Información técnica', 'show_informacion_tecnica', 'productos', 'advanced', 'high' );
		add_meta_box( 'general_info', 'Información general', 'show_general_info', 'productos', 'side', 'high' );
		add_meta_box( 'printer_info', 'Información impresora', 'show_printer_info', 'productos', 'side', 'high' );
		
	});



// CUSTOM METABOXES CALLBACK FUNCTIONS ///////////////////////////////////////////////


	function show_informacion_tecnica($post){
		$info_tecninca = get_post_meta($post->ID, 'info_tecninca', true);
		$notas_tecnicas = get_post_meta($post->ID, 'notas_tecnicas', true);
		wp_nonce_field(__FILE__, 'technical_info_nonce');
		echo "<label>Texto técnico:</label><br />";
		echo "<textarea rows='8' class='large-text' name='info_tecninca'>$info_tecninca</textarea>";
		echo "<br/><br/>";
		echo "<label>Notas técnicas:</label><br />";
		echo "<textarea rows='8' class='large-text' name='notas_tecnicas'>$notas_tecnicas</textarea>";
		echo "<br/><br/>";
	}

	function show_printer_info($post){
		$printer_type = get_post_meta($post->ID, 'printer_type', true);
		$supports_rafts = get_post_meta($post->ID, 'supports_rafts', true);
		$infill = get_post_meta($post->ID, 'infill', true);
		$resolution = get_post_meta($post->ID, 'resolution', true);
		wp_nonce_field(__FILE__, 'printer_info_nonce');
		echo "<p><label>Tipo de impresora: </label><br />";
		echo "<input type='text' name='printer_type' class='widefat' value='$printer_type' /></p>";
		echo "<p><label>¿Soporta rafts?: </label><br />";
		echo "<input type='text' name='supports_rafts' class='widefat' value='$supports_rafts' /></p>";
		echo "<p><label>Infill: </label><br />";
		echo "<input type='text' name='infill' class='widefat' value='$infill' /></p>";
		echo "<p><label>Resolución: </label><br />";
		echo "<input type='text' name='resolution' class='widefat' value='$resolution' /></p>";
		
	}

	function show_general_info($post){
		$precio_producto 	= get_post_meta($post->ID, 'precio_producto', true);
		$file_type 			= get_post_meta($post->ID, 'file_type', true);
		$file_for_download 	= get_post_meta($post->ID, 'file_for_download', true);
		$file_featured 		= get_post_meta($post->ID, 'file_featured', true);
		// $file_featured_sel 	= get_post_meta($post->ID, 'file_featured', true);
		file_put_contents(
			'/logs/php.log',
			var_export( $file_featured, true ) . PHP_EOL,
			FILE_APPEND
		);
		wp_nonce_field(__FILE__, 'general_info_nonce');
		echo "<p><label>Precio del producto: </label><br />";
		echo "<input type='text' name='precio_producto' class='widefat' value='$precio_producto' /></p>";
		echo "<p><label>Tipo de archivo: </label><br />";
		echo "<input type='text' name='file_type' class='widefat' value='$file_type' /></p>";
		echo "<p><label>Archivo de descarga: </label><br />";
		echo "<input type='text' name='file_for_download' class='widefat' value='$file_for_download' /></p>";
		echo "<input type='checkbox' name='file_featured' checked='$file_featured' />";
		echo "<label>Featured product</label>";
		
	}



// SAVE METABOXES DATA ///////////////////////////////////////////////////////////////



	add_action('save_post', function($post_id){


		if ( ! current_user_can('edit_page', $post_id)) 
			return $post_id;


		if ( defined('DOING_AUTOSAVE') and DOING_AUTOSAVE ) 
			return $post_id;
		
		
		if ( wp_is_post_revision($post_id) OR wp_is_post_autosave($post_id) ) 
			return $post_id;


		if ( isset($_POST['info_tecninca']) and check_admin_referer(__FILE__, 'technical_info_nonce') ){
			update_post_meta($post_id, 'info_tecninca', $_POST['info_tecninca']);
			update_post_meta($post_id, 'notas_tecnicas', $_POST['notas_tecnicas']);
		}

		if ( isset($_POST['printer_type']) and check_admin_referer(__FILE__, 'printer_info_nonce') ){
			update_post_meta($post_id, 'printer_type', $_POST['printer_type']);
			update_post_meta($post_id, 'supports_rafts', $_POST['supports_rafts']);
			update_post_meta($post_id, 'infill', $_POST['infill']);
			update_post_meta($post_id, 'resolution', $_POST['resolution']);
		}

		if ( isset($_POST['precio_producto']) and check_admin_referer(__FILE__, 'general_info_nonce') ){
			update_post_meta($post_id, 'precio_producto', $_POST['precio_producto']);
			update_post_meta($post_id, 'file_type', $_POST['file_type']);
			update_post_meta($post_id, 'file_for_download', $_POST['file_for_download']);
			if ( isset($_POST['file_featured']) ){
				update_post_meta($post_id, 'file_featured', $_POST['file_featured']);
			} else if ( ! defined('DOING_AJAX') ){
				delete_post_meta($post_id, 'file_featured');
			}
		}


		// Guardar correctamente los checkboxes
		/*if ( isset($_POST['_checkbox_meta']) and check_admin_referer(__FILE__, '_checkbox_nonce') ){
			update_post_meta($post_id, '_checkbox_meta', $_POST['_checkbox_meta']);
		} else if ( ! defined('DOING_AJAX') ){
			delete_post_meta($post_id, '_checkbox_meta');
		}*/


	});



// OTHER METABOXES ELEMENTS //////////////////////////////////////////////////////////
