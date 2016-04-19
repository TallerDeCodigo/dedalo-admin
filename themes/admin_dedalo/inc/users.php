<?php


// CUSTOM USER CONFIGURATIONS /////////////////////////////////////////////////////////



	$administrator = get_role('administrator');
	add_role( 'developer', 'Developer', $administrator->capabilities );

	$editor = get_role('editor');
	add_role( 'colaborador', 'Colaborador', $editor->capabilities );


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
