<?php


// DEFINIR LOS PATHS A LOS DIRECTORIOS DE JAVASCRIPT Y CSS ///////////////////////////



	define( 'JSPATH', get_template_directory_uri() . '/js/' );

	define( 'CSSPATH', get_template_directory_uri() . '/css/' );

	define( 'THEMEPATH', get_template_directory_uri() . '/' );
	
	define( 'SITEURL', site_url('/') );
	


// FRONT END SCRIPTS AND STYLES //////////////////////////////////////////////////////



	add_action( 'wp_enqueue_scripts', function(){

		// scripts
		wp_enqueue_script( 'plugins', JSPATH.'plugins.js', array('jquery'), '1.0', true );
		wp_enqueue_script( 'functions', JSPATH.'functions.js', array('plugins'), '1.0', true );

		// localize scripts
		wp_localize_script( 'functions', 'ajax_url', admin_url('admin-ajax.php') );

		// styles
		wp_enqueue_style( 'styles', get_stylesheet_uri() );

	});



// ADMIN SCRIPTS AND STYLES //////////////////////////////////////////////////////////



	add_action( 'admin_enqueue_scripts', function(){

		// scripts
		wp_enqueue_script( 'admin-js', JSPATH.'admin.js', array('jquery'), '1.0', true );

		// localize scripts
		wp_localize_script( 'admin-js', 'ajax_url', admin_url('admin-ajax.php') );

		// styles
		wp_enqueue_style( 'admin-css', CSSPATH.'admin.css' );

	});



// FRONT PAGE DISPLAYS A STATIC PAGE /////////////////////////////////////////////////



	/*add_action( 'after_setup_theme', function () {
		
		$frontPage = get_page_by_path('home', OBJECT);
		$blogPage  = get_page_by_path('blog', OBJECT);
		
		if ( $frontPage AND $blogPage ){
			update_option('show_on_front', 'page');
			update_option('page_on_front', $frontPage->ID);
			update_option('page_for_posts', $blogPage->ID);
		}
	});*/



// REMOVE ADMIN BAR FOR NON ADMINS ///////////////////////////////////////////////////



	add_filter( 'show_admin_bar', function($content){
		return ( current_user_can('administrator') ) ? $content : false;
	});



// CAMBIAR EL CONTENIDO DEL FOOTER EN EL DASHBOARD ///////////////////////////////////



	add_filter( 'admin_footer_text', function() {
		echo 'Creado por <a href="http://tallerdecodigo.com">TDC</a>. ';
		echo 'Powered by <a href="http://www.wordpress.org">WordPress</a>';
	});



// POST THUMBNAILS SUPPORT ///////////////////////////////////////////////////////////



	if ( function_exists('add_theme_support') ){
		add_theme_support('post-thumbnails');
	}

	if ( function_exists('add_image_size') ){
		
		add_image_size( 'dedalo_full', 900, 700, true );
		add_image_size( 'dedalo_thumb', 705, 540, true );
		
		// cambiar el tamaño del thumbnail
		/*
		update_option( 'thumbnail_size_h', 100 );
		update_option( 'thumbnail_size_w', 200 );
		update_option( 'thumbnail_crop', false );
		*/
	}



// POST TYPES, METABOXES, TAXONOMIES AND CUSTOM PAGES ////////////////////////////////



	require_once('inc/post-types.php');


	require_once('inc/metaboxes.php');


	require_once('inc/taxonomies.php');


	require_once('inc/pages.php');


	require_once('inc/users.php');
	
	
// MODIFICAR EL MAIN QUERY ///////////////////////////////////////////////////////////



	add_action( 'pre_get_posts', function($query){

		if ( $query->is_main_query() and ! is_admin() ) {

		}
		return $query;

	});



// THE EXECRPT FORMAT AND LENGTH /////////////////////////////////////////////////////



	add_filter('excerpt_length', function($length){
		return 10;
	});


	add_filter('excerpt_more', function(){
		return ' &raquo;';
	});



// REMOVE ACCENTS AND THE LETTER Ñ FROM FILE NAMES ///////////////////////////////////



	add_filter( 'sanitize_file_name', function ($filename) {
		$filename = str_replace('ñ', 'n', $filename);
		return remove_accents($filename);
	});



// HELPER METHODS AND FUNCTIONS //////////////////////////////////////////////////////



	/**
	 * Print the <title> tag based on what is being viewed.
	 * @return string
	 */
	function print_title(){
		global $page, $paged;

		wp_title( '|', true, 'right' );
		bloginfo( 'name' );

		// Add a page number if necessary
		if ( $paged >= 2 || $page >= 2 ){
			echo ' | ' . sprintf( __( 'Página %s' ), max( $paged, $page ) );
		}
	}



	/**
	 * Imprime una lista separada por commas de todos los terms asociados al post id especificado
	 * los terms pertenecen a la taxonomia especificada. Default: Category
	 *
	 * @param  int     $post_id
	 * @param  string  $taxonomy
	 * @return string
	 */
	function print_the_terms($post_id, $taxonomy = 'category'){
		$terms = get_the_terms( $post_id, $taxonomy );

		if ( $terms and ! is_wp_error($terms) ){
			$names = wp_list_pluck($terms ,'name');
			echo implode(', ', $names);
		}
	}



	/**
	 * Regresa la url del attachment especificado
	 * @param  int     $post_id
	 * @param  string  $size
	 * @return string  url de la imagen
	 */
	function attachment_image_url($post_id, $size){
		$image_id   = get_post_thumbnail_id($post_id);
		$image_data = wp_get_attachment_image_src($image_id, $size, true);
		echo isset($image_data[0]) ? $image_data[0] : '';
	}



	/*
	 * Echoes active if the page showing is associated with the parameter
	 * @param  string $compare, Array $compare
	 * @param  Bool $echo use FALSE to use with php, default is TRUE to echo value
	 * @return string
	 */
	function nav_is($compare = array(), $echo = TRUE){

		$query = get_queried_object();
		$inner_array = array();
		if(gettype($compare) == 'string'){
			
			$inner_array[] = $compare;
		}else{
			$inner_array = $compare;
		}

		foreach ($inner_array as $value) {
			if( isset($query->slug) AND preg_match("/$value/i", $query->slug)
				OR isset($query->name) AND preg_match("/$value/i", $query->name)
				OR isset($query->rewrite) AND preg_match("/$value/i", $query->rewrite['slug'])
				OR isset($query->post_name) AND preg_match("/$value/i", $query->post_name)
				OR isset($query->post_title) AND preg_match("/$value/i", remove_accents(str_replace(' ', '-', $query->post_title) ) ) )
			{
				if($echo){
					echo 'active';
				}else{
					return 'active';
				}
				return FALSE;
			}

		}
		return FALSE;
	}
	/**
	 *
	 *
	 *
	 *
	 * Create user in wordpress
	 * @param Array 
	 *
	 *
	 *
	 *
	 *
	 *
	 */

	function createUser($params = NULL, $autologin = FALSE){
		extract($params);

		$usrdata = array(
						'user_login'=>$alias,
						'first_name'=>$name,
						'user_email'=>$mail,
						'user_pass' =>random_password(8)
			);

		$user_id = wp_insert_user($usrdata);
		
		$wpUser = get_user_by('email',$mail);

		if ($wpUser) {				
			wp_set_auth_cookie($wpUser->ID,TRUE,0);
			wp_set_current_user($wpUser->ID);		/*ESTO HACE LOGIN EN WP*/	

													/*enviar mail de confirmacion*/
			//wp_new_user_notificartion($user_id,"user");
		}

		// if (!is_wp_error($user_id)) {
		// 	echo "not error";
		// }

	}/* end createUser AQUI SE CREAN USUARIOS EN WP  */


	add_action( 'wp_ajax_dedalo_createuser', 'dedalo_createuser' );			/*ACTION 						*/
	add_action( 'wp_ajax_nopriv_dedalo_createuser', 'dedalo_createuser' );	/*HOOKS para dedalo_create_user*/
	function dedalo_createuser() {
	    echo (createUser($_POST, TRUE) == TRUE) ? wp_send_json_success() : wp_send_json_error(); /*REGRESA A CREATEUSER PARA GENERAR UN NUEVO USUARIO*/

		switch (createUser($_POST, TRUE)) {
			case TRUE:
				wp_send_json_success();
				break;
			case 300:
			echo	wp_send_json_error("Lo sentimos, ese nombre de usuario ya existe");
				break;
			case 310:
			echo	wp_send_json_error("Esa dirección de correo ya existe");
				break;
			case 320:
			echo	wp_send_json_error("Ha ocurrido un error, intentalo de nuevo");
				break;
			default:
				# code...
				break;
		}		

	}//end dedalo_create_user

	function random_password( $length = 8 ) {
	    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
	    $password = substr( str_shuffle( $chars ), 0, $length );
	    return $password;
	}//end random_password


	function envia_mail_registro($user_id, $args){
		$mensaje   = "Hola {$args['user_login']},  \n\n Bienvenido a 3Dedalo, para confirmar tu registro haz click en el siguiente link: \n";
		$link 	   = "http://localhost/dedalo/?conf=".get_user_meta($user_id, 'user_pass', true);
		$mensaje  .= "<a style='color: #fff; background-color: #48c; font-size: 14px; font-family: Helvetica,Arial,sans-serif; display: block; width: 120px; padding: 10px; margin: auto; text-align: center; text-decoration: none; letter-spacing: 0.6px; font-weight: 100; border-radius: 2px;' href='$link'>Ir a 3Dedalo</a>";
		$mensaje  .= "<small style='display: block; margin 10px 0 0 0;'>Si no has registrado tu email en 3Dedalo o no identificas la razón de este correo, por favor ignóralo. Para mayor 	información por favor visita nuestro <a href='http://localhost/dedalo/aviso-de-privacidad/'>Aviso de privacidad</a></small>";
		$headers[] = 'From: 3Dedalo <3dedalo@mail.com>';
		wp_mail( $args['user_email'], '3Dedalo, por favor confirma tu email', $mensaje, $headers );
	}
/*
	 +
		 +
			 + CUNSTOM CREATE USER 	genera usuario a partir de forma en page-signup.php
		 +
	 +
*/
	function custom_create_user(){
	
		$aidi=$_POST["nick"];
		$name=$_POST["nombre"];
		$last=$_POST["apellido"];
		$mail=$_POST["correo"];
		$pass=$_POST["pass"];

		$usrdata = array(
			'user_login'=>$aidi,
			'first_name'=>$name,
			'last_name' =>$last,
			'user_email'=>$mail,
			'user_pass' =>$pass,
			'remember'=> true
			);

		$user_id = wp_insert_user($usrdata);
		$wpUser = get_user_by('email', $mail);
		
		if (!is_wp_error($user_id)) {
			if (username_exists($_POST['nombre'])) {
				return;
				//$error1 = echo "That username already exists";
			}else if (email_exists($_POST['correo'])) {
				return; 
				//$error2 = echo "That email already exists";
			}else{
				return; 
				//$error3 = echo "Something went wrong, please try again";
			}
		}
}//end FUNCION CUSTOM_CREATE_USER

