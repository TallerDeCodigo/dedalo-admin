<?php get_header(); ?>


<!--social Login buttons-->

<form method="post" action="<?php echo bloginfo('url')?>/dataprocess" id="testform">
	<input name="_id" type="text" placeholder="tu id">
	<input name="fname" type="text" placeholder="tu nombre">
	<input name="lname" type="text" placeholder="tu apellido">
	<input name="contra" type="text" placeholder="tu contraseña">
	<input name="correo" type="email" placeholder="correo electrónico">
	<input type="submit" placeholder="enviar" value="enviar"> 
</form>	


<style>
	#testform{margin:50px auto;}
	input{display: block; border:1px solid #000;margin:10px; padding:3px;}
</style>
<?php get_sidebar(); ?>
<?php get_footer(); ?>