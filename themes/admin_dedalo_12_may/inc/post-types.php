<?php

// CUSTOM POST TYPES /////////////////////////////////////////////////////////////////

	add_action('init', function(){


		// PRODUCTOS
		$labels = array(
			'name'          => 'Productos',
			'singular_name' => 'Producto',
			'add_new'       => 'Nuevo Producto',
			'add_new_item'  => 'Nuevo Producto',
			'edit_item'     => 'Editar Producto',
			'new_item'      => 'Nuevo Producto',
			'all_items'     => 'Todos',
			'view_item'     => 'Ver Producto',
			'search_items'  => 'Buscar Producto',
			'not_found'     => 'No se encontró',
			'menu_name'     => 'Productos'
		);

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'producto' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => 6,
			'taxonomies'         => array( 'category', 'design-tools', 'post_tag' ),
			'supports'           => array( 'title', 'editor', 'thumbnail', 'author')
		);
		register_post_type( 'productos', $args );

		// USER MESSAGES
		$labels = array(
			'name'          => 'Mensajes de usuarios',
			'singular_name' => 'Mensaje',
			'add_new'       => 'Nuevo Mensaje',
			'add_new_item'  => 'Nuevo Mensaje',
			'edit_item'     => 'Editar Mensaje',
			'new_item'      => 'Nuevo Mensaje',
			'all_items'     => 'Todos',
			'view_item'     => 'Ver Mensaje',
			'search_items'  => 'Buscar Mensaje',
			'not_found'     => 'No se encontró',
			'menu_name'     => 'Mensajes de usuarios'
		);

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'mensaje' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => 6,
			'taxonomies'         => array( '' ),
			'supports'           => array( 'title', 'editor', 'thumbnail', 'author')
		);
		register_post_type( 'mensaje', $args );
	});