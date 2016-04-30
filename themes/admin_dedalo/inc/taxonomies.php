<?php


// TAXONOMIES ////////////////////////////////////////////////////////////////////////


	add_action( 'init', 'custom_taxonomies_callback', 0 );

	function custom_taxonomies_callback(){

		// Design Tools
		if( ! taxonomy_exists('design-tools')){

			$labels = array(
				'name'              => 'Design tools',
				'singular_name'     => 'Design tool',
				'search_items'      => 'Buscar',
				'all_items'         => 'Todas',
				'edit_item'         => 'Editar Design tool',
				'update_item'       => 'Actualizar Design tool',
				'add_new_item'      => 'Nueva Design tool',
				'new_item_name'     => 'Nombre Nueva Design tool',
				'menu_name'         => 'Design tools'
			);

			$args = array(
				'hierarchical'      => false,
				'labels'            => $labels,
				'show_ui'           => true,
				'show_admin_column' => true,
				'show_in_nav_menus' => true,
				'query_var'         => true,
				'rewrite'           => array( 'slug' => 'design-tools' ),
			);

			register_taxonomy( 'design-tools', 'productos', $args );
		}

		// License
		if( ! taxonomy_exists('license')){

			$labels = array(
				'name'              => 'License',
				'singular_name'     => 'License',
				'search_items'      => 'Buscar',
				'all_items'         => 'Todas',
				'edit_item'         => 'Editar License',
				'update_item'       => 'Actualizar License',
				'add_new_item'      => 'Nueva License',
				'new_item_name'     => 'Nombre Nueva License',
				'menu_name'         => 'License'
			);

			$args = array(
				'hierarchical'      => true,
				'labels'            => $labels,
				'show_ui'           => true,
				'show_admin_column' => true,
				'show_in_nav_menus' => true,
				'query_var'         => true,
				'rewrite'           => array( 'slug' => 'license' ),
			);

			register_taxonomy( 'license', 'productos', $args );
		}

		if( ! taxonomy_exists('user_category')){

			$labels = array(
				'name' => 'User Category',
				'singular_name' => 'User Category',
				'search_items' => 'Search User Categories',
				'all_items' => 'All User Categories',
				'parent_item' => 'Parent User Category',
				'parent_item_colon' => 'Parent User Category',
				'edit_item' => 'Edit User Category',
				'update_item' => 'Update User Category',
				'add_new_item' => 'Add New User Category',
				'new_item_name' => 'New User Category Name',
				'menu_name' => 'User Category'
			);
		 
			$args = array(
				'hierarchical' => true,
				'labels' => $labels,
				'show_ui' => true,
				'show_admin_column' => true,
				'query_var' => true,
				'rewrite' => array( 'slug' => 'user_category')
			);

			register_taxonomy( 'user_category' , 'user' , $args );
		}		
		
		// TERMS
		if ( ! term_exists( 'creative-commons', 'license' ) ){
			wp_insert_term( 'Creative Commons', 'license', array('slug' => 'creative-commons') );
		}

		/* // SUB TERMS CREATION
		if(term_exists('parent-term', 'category')){
			$term = get_term_by( 'slug', 'parent-term', 'category');
			$term_id = intval($term->term_id);
			if ( ! term_exists( 'child-term', 'category' ) ){
				wp_insert_term( 'A child term', 'category', array('slug' => 'child-term', 'parent' => $term_id) );
			}
			
		} */
	}
