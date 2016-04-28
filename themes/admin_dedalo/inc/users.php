<?php


// CUSTOM USER CONFIGURATIONS /////////////////////////////////////////////////////////



	$administrator = get_role('administrator');
	add_role( 'developer', 'Developer', $administrator->capabilities );

	$administrator = get_role('administrator');
	add_role( 'maker', 'Maker', $administrator->capabilities );

	$editor = get_role('editor');
	add_role( 'dedalo_user', 'Dedalo_user', $editor->capabilities );


	remove_action( 'admin_color_scheme_picker', 'admin_color_scheme_picker' );


	add_filter('user_contactmethods', function ( $contactmethods ) {
		unset($contactmethods['url']);
		unset($contactmethods['aim']);
		unset($contactmethods['yim']);
		unset($contactmethods['jabber']);
		$contactmethods['twitter']  = 'Twitter';
		$contactmethods['facebook'] = 'Facebook';
		return $contactmethods;
	});


	add_action('admin_menu', function() use (&$current_user){
		if ( in_array('developer', $current_user->roles) ){
			add_options_page(__('Todos los ajustes'), __('Todos los ajustes'), 'developer', 'options.php');
		}
	});



// CREATE DEFAULT USERS ///////////////////////////////////////////////////////////////


	// Agregar usuarios Colaboradores
	// add_action('init', function(){
	// 	$users = array('prisca', 'andrea', 'toumani', 'jazmina');
	// 	array_map('create_usuario_colaborador', $users);
	// });


	/**
	 * Crear un nuevo usuario colaborador
	 * @param  string $user username
	 */
	function create_usuario_colaborador($user){
		$password = wp_generate_password();
		$user_id  = wp_create_user( $user, $password, "$user@limulus.mx" );
		if ( is_int($user_id) ){
			set_colaborador_role( $user_id );
			wp_new_user_notification( $user_id, $password );
		}
	}


	/**
	 * Set user role as developer (super admin)
	 * @param int $user_id
	 */
	function set_colaborador_role($user_id){
		$wp_user = get_user_by( 'id', $user_id );
		$wp_user->set_role( 'colaborador' );
	}


	//Agrega campo de colaborador a los usuarios

	add_action( 'show_user_profile', 'campos_personalizados_autores' );
	add_action( 'edit_user_profile', 'campos_personalizados_autores' );


	function campos_personalizados_autores ( $user ) {
		$meta = get_the_author_meta( 'es_colaborador', $user->ID );
		$meta_socio = get_the_author_meta( 'es_socio', $user->ID );
		$check = $meta ? 'checked' : '';
		$check_socio = $meta_socio ? 'checked' : '';
		?>
		<script type="text/javascript">
			document.getElementById('your-profile').setAttribute('enctype','multipart/form-data');
		</script>
		<h3>Datos extra: </h3>
		<table class="form-table">
			
			
			<tr>
				<th><label for="twitter">Foto usuario</label></th>
				<td>
					<input type="text" name="foto_user" id="foto_user" value="<?php echo esc_attr( get_the_author_meta( 'foto_user', $user->ID ) ); ?>" class="regular-text" /><br />
					<span class="description">url de la imagen</span>

				</td>
			</tr>

			<tr>
				<th><label for="bio_en">Semblanza Biográfica</label></th>
				<td>
					<textarea rows="3" id="bio_es" name="_bio_es"><?php echo esc_attr( get_the_author_meta( '_bio_es', $user->ID ) ); ?></textarea>

				</td>
			</tr>
		</table>
	<?php }

	add_action( 'personal_options_update', 'guarda_datos_extra_perfil_autor' );
	add_action( 'edit_user_profile_update', 'guarda_datos_extra_perfil_autor' );

	function guarda_datos_extra_perfil_autor( $user_id ) {

		if ( !current_user_can( 'edit_user', $user_id ) )
			return false;

		if ( isset($_POST['_bio_es']) ){
			update_user_meta( $user_id, '_bio_es', $_POST['_bio_es'] );
		}

		if ( isset($_POST['foto_colaborador']) ){
			update_user_meta( $user_id, 'foto_colaborador', $_POST['foto_colaborador'] );
		}

	}


function add_user_category_menu() {
    add_submenu_page( 'users.php' , 'User Category', 'User Category' , 'add_users',  'edit-tags.php?taxonomy=user_category' );
}
add_action(  'admin_menu', 'add_user_category_menu' );

add_action( 'show_user_profile', 'show_user_category' );
add_action( 'edit_user_profile', 'show_user_category' );
function show_user_category( $user ) {
 
    //get the terms that the user is assigned to 
    $assigned_terms = wp_get_object_terms( $user->ID, 'user_category' );
    $assigned_term_ids = array();
    foreach( $assigned_terms as $term ) {
        $assigned_term_ids[] = $term->term_id;
    }
 
    //get all the terms we have
    $user_cats = get_terms( 'user_category', array('hide_empty'=>false) );
 
    echo "<h3>User Category</h3>";
 
     //list the terms as checkbox, make sure the assigned terms are checked
    foreach( $user_cats as $cat ) { ?>
        <input type="checkbox" id="user-category-<?php echo $cat->term_id ?>" <?php if(in_array( $cat->term_id, $assigned_term_ids )) echo 'checked=checked';?> name="user_category[]"  value="<?php echo $cat->term_id;?>"/> 
        <?php
    	echo '<label for="user-category-'.$cat->term_id.'">'.$cat->name.'</label>';
    	echo '<br />';
    }
}

add_action( 'personal_options_update', 'save_user_category' );
add_action( 'edit_user_profile_update', 'save_user_category' );
function save_user_category( $user_id ) {

 	if(isset($_POST['foto_user']))
 		update_user_meta($user_id, 'foto_user', $_POST['foto_user']);
 	if(isset($_POST['_bio_es']))
 		update_user_meta($user_id, '_bio_es', $_POST['_bio_es']);

 	if(isset($_POST['user_category'])){
 		$user_terms = $_POST['user_category'];
		$terms = array_unique( array_map( 'intval', $user_terms ) );
		wp_set_object_terms( $user_id, $terms, 'user_category', false );
	 
		//make sure you clear the term cache
		clean_object_term_cache($user_id, 'user_category');
 	}
 	
}
