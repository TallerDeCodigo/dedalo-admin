<?php
	if(!empty($_POST) AND isset($aidi) AND isset($name) AND isset($mail)){


		$result = createUser($_POST, TRUE);
		function redirect(){
			header('Location: ',site_url());
		}
		redirect();


	}else if(!empty($_POST) AND !NULL=='mail' AND !NULL=='contra'){

	$email = $_POST["mail"];
    $pass  = $_POST["contra"];	

	$usrdataLogin = array(
		'user_email'=>$email,
		'user_pass' =>$pass
	);

	$user = get_user_by('email', $email);

	wp_signon($usrdataLogin, false);

	// if(!is_wp_error($user)){
	// 	get_currentuserinfo();
	// 	 wp_set_current_user($user->ID);
	// 	 wp_redirect(site_url());	 
	// }
}
?>