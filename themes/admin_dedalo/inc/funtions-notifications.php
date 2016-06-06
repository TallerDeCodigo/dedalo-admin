<?php

	// CREAR TABLA PARA GUARDAR LA ACTIVIDAD ///////////////////////

	add_action('init', function(){
		global $wpdb;
		$wpdb->query(
			"CREATE TABLE IF NOT EXISTS {$wpdb->prefix}3d_alertas (
				alert_id bigint(20) NOT NULL AUTO_INCREMENT,
				user_id bigint(20) NOT NULL,
				object_id bigint(20) NOT NULL,
				type VARCHAR(40) NOT NULL DEFAULT '',
				message TEXT() NOT NULL,
				status bigint(2) NOT NULL,
				PRIMARY KEY (user_id, object_id, type),
				UNIQUE KEY `activ_id` (`alerta_id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8;"
		);

	});




	/**
	* GUARDAR ALERTA
	*/
	function registra_alerta($user_id, $object_id = '', $user_alert, $type ){
	global $wpdb;
	$table_name = $wpdb->prefix . "3d_alertas";

	$sql = "INSERT INTO {$table_name} 
				(user_id, object_id, type) 
				VALUES (%d,%d,%d,%s)";
				
	$sql = $wpdb->prepare($sql, $user_id, $object_id, $type);

	return $wpdb->query($sql);
	}

	/*
	* Eliminar alerta tipo follow
	*/
	function remueve_alerta($user_id, $type ){
	global $wpdb;
	$table_name = $wpdb->prefix . "3d_alertas";

	$sql = "DELETE FROM {$table_name} 
			 WHERE user_id = %d
				AND type = %s";
				
	$sql = $wpdb->prepare($sql, $user_id, $type);

	return $wpdb->query($sql);
	}


	/**
	* TOTAL DE ALERTAS DEL USUARIO
	*/
	function get_count_alertas_user($user = null){
	global $wpdb;
	if(!$user){
		global $current_user;
	}else{
		$current_user = $user;
	}

	return $wpdb->get_var( $wpdb->prepare(
				"SELECT COUNT(alert_id) FROM wp_3d_alertas WHERE status = %d;",
				$current_user->ID, 0
			));
	}