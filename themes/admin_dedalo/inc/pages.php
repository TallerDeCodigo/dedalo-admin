<?php


// CUSTOM PAGES //////////////////////////////////////////////////////////////////////


	add_action('init', function(){


		// CONTACTO
		if( ! get_page_by_path('upload-model') ){
			$page = array(
				'post_author' => 1,
				'post_status' => 'publish',
				'post_title'  => 'Upload',
				'post_name'   => 'upload-model',
				'post_type'   => 'page'
			);
			wp_insert_post( $page, true );
		}
		
		// Privacy Policies
		if( ! get_page_by_path('privacy-policies') ){
			$page = array(
				'post_author' => 1,
				'post_status' => 'publish',
				'post_title'  => 'Privacy policies',
				'post_name'   => 'privacy-policies',
				'post_type'   => 'page'
			);
			wp_insert_post( $page, true );
		}
		
		// Dashboard
		if( ! get_page_by_path('dashboard') ){
			$page = array(
				'post_author' => 1,
				'post_status' => 'publish',
				'post_title'  => 'Dashboard',
				'post_name'   => 'dashboard',
				'post_type'   => 'page'
			);
			wp_insert_post( $page, true );
		}
	
		// Account
		if( ! get_page_by_path('account') ){
			$page = array(
				'post_author' => 1,
				'post_status' => 'publish',
				'post_title'  => 'Account',
				'post_name'   => 'account',
				'post_type'   => 'page'
			);
			wp_insert_post( $page, true );
		}

		// Terms & Conditions
		if( ! get_page_by_path('terms-and-conditions') ){
			$page = array(
				'post_author' => 1,
				'post_status' => 'publish',
				'post_title'  => 'Terms and Conditions',
				'post_name'   => 'terms-and-conditions',
				'post_type'   => 'page'
			);
			wp_insert_post( $page, true );
		}

		// Sign up
		if( ! get_page_by_path('signup') ){
			$page = array(
				'post_author' => 1,
				'post_status' => 'publish',
				'post_title'  => 'Sign up',
				'post_name'   => 'signup',
				'post_type'   => 'page'
			);
			wp_insert_post( $page, true );
		}

		// Log in
		if( ! get_page_by_path('login') ){
			$page = array(
				'post_author' => 1,
				'post_status' => 'publish',
				'post_title'  => 'Log in',
				'post_name'   => 'login',
				'post_type'   => 'page'
			);
			wp_insert_post( $page, true );
		}


	});
