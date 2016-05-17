<?php
	
	/**
	 * Install and setup database tables for caegory interactions operations
	 * Executed on switch theme
	 */
	function dedalo_follow_categories_install() {
	   global $wpdb;

	   $table_name = $wpdb->prefix . "3d_categories";

	   $sql = "CREATE TABLE $table_name (
				  user_id bigint(20) NOT NULL,
				  cat_id bigint(20) NOT NULL,
				  PRIMARY KEY (user_id, cat_id)
			    );";

	   require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	   dbDelta( $sql );
	}

	add_action( 'after_switch_theme', 'dedalo_follow_categories_install' );

	/** 
	 * Follow category
	 * @param String $user_login
	 * @param Integer $cat_id
	 * @return Boolean $followed
	 */
	function dedalo_follow_category($user_login = null, $cat_id = NULL) {
		global $wpdb;
		if(!$user_login){
			global $current_user;
		}else{
			$user = get_user_by('login', $user_login);
			$current_user = $user;
		}

		if($current_user->user_status == 0)
			update_user_status_cat($current_user->ID);

		$table_name = $wpdb->prefix . "3d_categories";

		if($cat_id){
			if($wpdb->insert(
				$table_name,
				array(
					'user_id' => $current_user->ID,
					'cat_id'  => $cat_id
				),
				array(
					'%d',
					'%d'
				)
			))
				return TRUE;
			return FALSE;
		}
		return FALSE;
	}

	/** 
	 * Unfollow category
	 * @param String $user_login
	 * @param Integer $cat_id
	 * @return Boolean $followed
	 */
	function dedalo_unfollow_category($user_login = null, $cat_id = NULL) {
		global $wpdb;
		if(!$user_login){
			global $current_user;
		}else{
			$user = get_user_by('login', $user_login);
			$current_user = $user;
		}

		$table_name = $wpdb->prefix . "3d_categories";
		if($cat_id){
			if($wpdb->delete(
				$table_name,
				array(
					'user_id' => $current_user->ID,
					'cat_id' => $cat_id
				),
				array(
					'%d',
					'%d'
				)
			))
				return TRUE;
			return FALSE;
		}
		return FALSE;
	}

	/** 
	 * Update user status first time a category is followed
	 * @param Integer $user_id
	 * @return Boolean $updated
	 */
	function update_user_status_cat($user_id){
		global $wpdb;

		if($wpdb->update("{$wpdb->prefix}users",
			array(
				'user_status'   => 1
			),
			array( 'ID' => $user_id ),
			array('%d')
		))
			return TRUE;
		return FALSE;
	}

	/** 
	 * Check if user is following category
	 * @param String $user_login
	 * @param Integer $cat_id
	 * @return Boolean $is_following
	 */
	function is_following_cat($user_login = NULL, $cat_id = NULL){
		global $wpdb;
		$user = get_user_by('login', $user_login);
		$exists = 	$wpdb->get_results(
						$wpdb->prepare(	"SELECT count(*) as _exists 
										 FROM {$wpdb->prefix}3d_categories 
										 WHERE user_id=%d AND cat_id = %d", 
										 $user->ID, 
										 $cat_id
										)
					);
		return (!empty($exists) AND $exists[0]->_exists) ? TRUE : FALSE; 
	}