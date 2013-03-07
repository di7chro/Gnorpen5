<!DOCTYPE html>
<html lang="sv-SE">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<title><?php bloginfo('name'); ?> | <?php is_home() ? bloginfo('description') : wp_title(''); ?></title>	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	<script src="<?php bloginfo( 'template_url' ); ?>/js/gnorpen.js"></script>

	 <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,700' rel='stylesheet' type='text/css'>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<?php	wp_head(); ?>
</head>
<body <?php body_class(); ?> onLoad="fixImages();">
	<div class="wrapper">
		<div id="head-container">
			<div id="header-placeholder">
				<div id="logo">
					<a href="<?php echo home_url( '/' ); ?>" title="<?php bloginfo( 'name' ); ?>" rel="home"><img src="<?php bloginfo( 'template_url' ); ?>/logo/logo_swat_2.png" alt="Logo"/></a>
				</div><!-- END LOGO -->
				<div id="sidebar-head">
					<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Sidebar Head') ) : ?> <?php endif; ?>
				</div><!-- END SIDEBAR-HEAD -->
				<nav>
					<?php wp_nav_menu (); ?>
				</nav><!-- END MENY -->
			</div><!-- END HEADER-PLACEHOLDER -->
		</div><!-- END HEAD-CONTAINER -->
