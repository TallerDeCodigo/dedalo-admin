<?php
	

	add_action('after_switch_theme', function(){
		 global $wpdb;
		$wpdb->query(
			"CREATE TABLE IF NOT EXISTS {$wpdb->prefix}3d_following (
				ID BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
				user_id bigint(20) NOT NULL,
				siguiendo_id bigint(20) NOT NULL,
				tipo VARCHAR(40) NOT NULL DEFAULT '',
				PRIMARY KEY (ID	),
				KEY posicion_name (tipo)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8;"
		);

	});

	/*
	 * Follow user and register
	 * @param $user_id Int
	 * @param $role String
	 * @param $mobile_user Bool
	 */
	function follow_user($user_id = NULL, $follow_id = NULL, $type = 'maker'){
		global $wpdb;
		if($user_id == $follow_id)
			return FALSE;
		$table_name = $wpdb->prefix . "3d_following";
		if($wpdb->insert(
				$table_name,
				array(
					'user_id'      => $user_id,
					'siguiendo_id' => $follow_id,
					'tipo'         => $type,
				),
				array(
					'%d',
					'%d',
					'%s'
				)
			))
		{
			try {
			    // registra_alerta($user_id,'', $follow_id, 'siguiendo' );
			    // registra_actividad($follow_id, $user_id, 'siguiendo' );
			} catch (Exception $e) {
			    echo 'Excepción capturada: ',  $e->getMessage(), "\n";
			    
			}
			return TRUE;
		}return FALSE;
	}

	/*
	 * Unfollow user and register
	 * @param $user_id Int
	 * @param $role String
	 * @param $mobile_user Bool
	 */
	function unfollow_user($user_id = NULL, $follow_id = NULL){
		global $wpdb;

		$table_name = $wpdb->prefix . "3d_following";

		if($wpdb->query( 
						$wpdb->prepare( 
								"DELETE FROM {$table_name}
								 WHERE user_id = %d
									AND siguiendo_id = %d
								;
								"
								, $user_id
								, $follow_id
								, $type
					        )
					))
		{
			try {
			    // remueve_alerta($user_id, $follow_id, 'siguiendo' );
			    // remueve_actividad($follow_id, $user_id, 'siguiendo' );
			} catch (Exception $e) {
			    echo 'Excepción capturada: ',  $e->getMessage(), "\n";
			}
			return TRUE;
		}
		return FALSE;

	}

	/*
	 * Check if a user is following another user
	 * @param Int $user_ID The querying user
	 * @param Int $is_following The user being followed
	 * @return Bool
	 */
	function is_user_following($user_ID, $is_following){
		global $wpdb;
		$resultCount = $wpdb->get_var( $wpdb->prepare(
											"SELECT COUNT(ID) FROM wp_mg_siguiendo WHERE user_id = %d AND siguiendo_id = %d;",
											$user_ID, $is_following
										));
		if($resultCount > 0) 
			return TRUE;
		return FALSE;
	}