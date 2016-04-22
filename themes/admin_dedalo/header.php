<!doctype html>
	<head>
		<meta charset="utf-8">
		<title><?php print_title(); ?></title>
		<link rel="shortcut icon" href="<?php echo THEMEPATH; ?>images/favicon.ico">
		<meta name="description" content="<?php bloginfo('description'); ?>">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="cleartype" content="on">
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link href='https://fonts.googleapis.com/css?family=Roboto:400,400italic,500,500italic,700,700italic,300italic,300' rel='stylesheet' type='text/css'>
		<script type="text/javascript" src="<?php echo THEMEPATH; ?>js/jquery-1.12.2.min.js"></script>
		<script type="text/javascript" src="<?php echo THEMEPATH; ?>js/jquery.validate.min.js"></script>
		<script src="<?php echo THEMEPATH; ?>oauthio/dist/oauth.js"></script>
		<script type="text/javascript" src="<?php echo THEMEPATH; ?>js/script.js"></script>
		<!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
		<?php wp_head(); ?>
	</head>

	<body>

	<div id="fb-root"></div>
	<script>
	  window.fbAsyncInit = function() {
	    FB.init({
	      appId      : '1066203396755847',
	      xfbml      : true,
	      version    : 'v2.6'
	    });
	  };

	  (function(d, s, id){
	     var js, fjs = d.getElementsByTagName(s)[0];
	     if (d.getElementById(id)) {return;}
	     js = d.createElement(s); js.id = id;
	     js.src = "//connect.facebook.net/en_US/sdk.js";
	     fjs.parentNode.insertBefore(js, fjs);
	   }(document, 'script', 'facebook-jssdk'));

	</script><!--FACEBOOK-->

		<div class="container">
			<div class="header clearfix">
				<div class="contenedor clearfix">
					<div class="logo">
						<a href="<?php echo site_url() ?>"><h1>DEDALO</h1></a>
					</div><!-- logo -->
					<div class="login">
						<?php if(is_user_logged_in()){ ?>
							<a href="<?php echo wp_logout_url(home_url());?>">LOGOUT</a>
							<?php } else { ?><a href="<?php echo bloginfo('url'); ?>/login">LOGIN</a><?php } ?>
							<a class="profilepic" href=""><img src="<?php echo THEMEPATH; ?>/images/profilepic.png"></a>
					</div><!-- login -->
				</div><!-- contenedor -->
			</div><!--header-->
			