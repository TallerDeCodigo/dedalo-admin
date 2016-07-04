<?php get_header(); 

	if( !empty( $_POST ) ){
		$name 		= (isset($_POST['_name']) 	AND $_POST['_name'] != "") 		? $_POST['_name'] : NULL; 
		$email 		= (isset($_POST['mail']) 	AND $_POST['mail'] != "") 		? $_POST['mail'] : NULL;
		$subject 	= (isset($_POST['subject']) AND $_POST['subject'] != "") 	? $_POST['subject']: NULL;
		$message 	= (isset($_POST['message']) AND $_POST['message'] != "")	? $_POST['message']: NULL;
		$headers 	= array($name);

		wp_mail($email, $subject, $message, $headers );
		$args = array(
						'post_title'=>$subject,
						'post_content'=>$message,
						'post_author'=>$name,
						'post_status'=>'draft',
						'post_type'=>'mensajes'
					);
		wp_insert_post($args);

		echo ("<section class='bg' ><p class='mensaje_ok'>".'Tu mensaje ha sido enviado con éxito.<br>Gracias por ponerte en contacto con nosotros'."</p></section>");

	}else{ ?>

		<section id="contacto">
			<section class="contacto">
				<h2 >CONTACT</h2>
				<form  id="contact_form" method="post" action="">
					<input 		type="text" 		class="entrada" name="_name" 	value="" 	placeholder="Name"><br>
					<input 		type="email" 		class="entrada" name="mail" 	value="" 	placeholder="E-mail"><br>
					<input 		type="text" 		class="entrada" name="subject" 	value="" 	placeholder="Subject"><br>
					<textarea	class="entrada" 	name="message"	placeholder="Message"	rows="40"></textarea><br>
					<input 		type="submit" 		class="entrada" value="SEND">
				</form>
				<p><a href="">Terms and conditions</a> | <a href="" >Privacy policies</a></p>
			</section>
		</section>

<?php
	}
?>


<?php get_sidebar(); ?>
<?php get_footer(); ?>