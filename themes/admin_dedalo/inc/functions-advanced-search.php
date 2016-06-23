<?php

	/** 
	 * Advanced search
	 * @version 1.1
	 * @param String $user_login
	 * @param Integer $cat_id
	 * @return Boolean $followed
	 */
	function exec_advanced_search($offset = 0, $args = array() ) {
		$final_array = array();
		extract($args);
		$keywords = json_decode(stripslashes($keywords));
		$offered = search_dedalo($keywords, NULL, $filter);
		$final_array["offered"] = $offered;
		/*** Assign response ***/
		$final_array["response"] = TRUE;

		/**+ Upload image as message ***/
		// $response = save_search_upload();

		// file_put_contents(
		// 	'/var/log/php.log',
		// 	var_export( $final_array, true ) . PHP_EOL,
		// 	FILE_APPEND
		// );
		return $final_array;
	}

	/*
	 * Search website wrapper function for the API
	 * @param String/Array @search_term
	 * @param Int @offset
	 * @return associative Array of the results by type
	 */
	function search_dedalo($search_term = NULL, $offset = 0, $filter = "none"){
		global $wpdb;
		$final_array = array();

		$post_type_query = " AND (post_type = 'productos' OR post_type = 'post') ";
		$keyword_query = " WHERE concat( post_title, post_content ) LIKE '%{$search_term}%' ";

		if($filter !== "none"){
			$post_type_query = " AND (post_type = '{$filter}') ";
		}

		if(is_array($search_term)){
			$keyword_query = "";
			foreach ($search_term as $index => $each_term) {
				$keyword_query .= (!$index) ? " WHERE ( concat( post_title, post_content ) LIKE '%{$each_term}%' "
											: " OR concat( post_title, post_content ) LIKE '%{$each_term}%' ";
				if($index == count($search_term)-1)
					$keyword_query .= ")";
			}
		}

		$results = $wpdb->get_results(
									"SELECT wpp.ID  post_id, wpp.post_type  type, wpp.post_title name, post_date  fecha,
										wpm2.post_id attachment_id, u.display_name maker_name, u.ID maker_id
									  FROM wp_posts AS wpp 
									  INNER JOIN wp_users AS u  
									   ON wpp.post_author = u.ID
									  LEFT JOIN wp_postmeta wpm1
									   ON wpm1.meta_key = '_thumbnail_id' AND wpm1.post_id = wpp.ID
									  LEFT JOIN wp_postmeta wpm2
									   ON wpm2.meta_key = '_wp_attached_file' AND wpm2.post_id = wpm1.meta_value
									 	{$keyword_query}
									  {$post_type_query}
									  AND post_status = 'publish'
									 ORDER BY fecha DESC LIMIT 0, 10
									;
									", OBJECT
		);
		foreach ($results as $each_result) {
			$profile_pic = get_user_meta($each_result->maker_id, "foto_user", TRUE);
			$attachment_url = wp_get_attachment_image_src( $each_result->attachment_id, "large");
			$final_array['pool'][] = array(
											"ID" 		=> $each_result->post_id,
											"name" 		=> $each_result->name,
											"type" 		=> $each_result->type,
											"thumb_url" => $attachment_url[0],
											"designer_brand" => array(
																	"ID" => $each_result->maker_id,
																	"name" => $each_result->maker_name,
																	"profile_pic" => ($profile_pic != '') ? $profile_pic : NULL
																),
											$each_result->type	=> TRUE,
										);
		}
		$final_array['count'] = count($final_array['pool']);
		return $final_array;
	}


	function search_makers($search_term = NULL){
		global $wpdb;
		$results = $wpdb->get_results(
									"SELECT u.ID AS post_id, u.ID AS user_id, 'user' AS tipo, user_registered AS fecha 
									 FROM wp_users AS u INNER JOIN wp_usermeta AS um ON u.ID = um.user_id 
									WHERE (u.display_name LIKE '%$search_term%' OR user_login LIKE '%$search_term%'
									 OR (meta_key =  'first_name' AND meta_value LIKE  '%$search_term%') 
									 OR (meta_key =  'last_name' AND meta_value LIKE  '%$search_term%'))
									AND (meta_key =  'wp_capabilities' AND meta_value LIKE '%maker%')
									GROUP BY ID LIMIT 0, 10
									;
									", OBJECT
		);

		wp_send_json_success($results);
	}

	/*
	 * Save event uploads
	 * @param $user The user uploading the object
	 * @param $ajax Wheather to use as API call (FALSE) or an ajax call
	 * @return JSON success plus the image url
	 */
	function save_search_upload($user_login, $image_temp, $image_name, $event_id) {
		if(!$user_login){
			global $current_user;
		}else{
			$current_user = get_user_by('slug', $user_login);
		}
		global $wpdb;

		$finfo = new finfo(FILEINFO_MIME_TYPE);
		    if (false === $ext = array_search(
		        $finfo->file($image_temp),
		        array(
		            'jpg' => 'image/jpeg',
		            'png' => 'image/png',
		            'gif' => 'image/gif',
		        ),
		        true
		    )) {
		        throw new RuntimeException('Invalid file format.');
		   		wp_send_json_error('Invalid file format.');
		    }
		
		$wp_upload_dir = wp_upload_dir();
		$extension = get_extension_fromMIMEtype($_FILES['file']['type']);
		$img = $wp_upload_dir['path']."/".md5($image_name).".".$extension;
		if(!move_uploaded_file($image_temp, $img) )
		{
			throw new RuntimeException('Failed to move uploaded file.');
			exit;
		}	

		$attachment = array(
			'post_status'    => 'private',
			'post_mime_type' => "image/{$extension}",
			'post_type'      => 'attachment',
			'post_parent'    => $event_id,
			'post_title'     => $image_name,

		);

		$dir = substr($wp_upload_dir['subdir'], 1);
		
		$attach_id = wp_insert_attachment( $attachment, $img);
		if($attach_id){
			// you must first include the image.php file for the function wp_generate_attachment_metadata() to work
			require_once(ABSPATH . 'wp-admin/includes/image.php');
			$attach_data = wp_generate_attachment_metadata( $attach_id, $img );
			$_POST['attach_id'] = $attach_id;
			wp_update_attachment_metadata( $attach_id, $attach_data );
			set_post_thumbnail( '', $attach_id );
			registra_actividad($event_id, $current_user->ID, 'media', $attach_id);
			$img_url2 = museo_get_attachment_url($attach_id, 'agenda-feed');

		}
		return $img_url2[0];
		exit;
	}