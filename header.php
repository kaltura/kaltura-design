<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>
<link rel="stylesheet" href="<?php bloginfo( 'template_url' ); ?>/grid.css" />
<link rel="stylesheet" href="<?php bloginfo( 'template_url' ); ?>/kaltura-style.css" />
<!--[if IE]>
<link rel="stylesheet" href="<?php bloginfo( 'template_url' ); ?>/kaltura-ie.css" />
<![endif]-->
<!--[if lt IE 9]>
<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
</head>

<body <?php body_class(); ?>>
<header id="kaltura-masthead" class="container_3">
	<div id="kaltura-logo">
		<a href="../../../../../"><img src="<?php bloginfo( 'template_directory' ); ?>/kaltura-images/html5video-logo.png" height="60" width="228"></a>
	</div>
	<nav id="kaltura-top-menu">
		<ul>
			<li><a href="http://kaltura.com/" class="alwaysunvisited">Kaltura.com</a></li>
			<li>|</li>
			<li><a href="http://kaltura.org/" class="alwaysunvisited">Kaltura.org</a></li>
		</ul>
	</nav>
	<div class="clear">&nbsp;</div>
	<nav id="kaltura-masthead-menu">
		<ul>
			<!--
			<li><a href="../../../../../EmbedWizard/">Embed Wizard</a></li>
			-->
			<li><a class="player-comparison" href="http://html5video.org/wiki/HTML5_Player_Comparison">HTML5 Player Comparison</a></li>
			<li><a class="html5-demos" href="http://html5video.org/wiki/HTML5_Demos">HTML5 Demos</a></li>
			<li><a href="../../../../../wiki/">Wiki</a></li>
			<li><a class="news-page-link" href="../../../../../blog/news/">News</a></li>
			<li><a target="_blank" href="http://www.kaltura.org/forums/html5-video/html5-video">Forum</a></li>
			<li><a target="_blank" href="https://github.com/kaltura/mwEmbed/issues">Bug Tracker</a></li>
			<li><a target="_blank" href="https://github.com/kaltura/mwEmbed">Code</a></li>
		</ul>
	</nav>
</header>
<div class="clear">&nbsp;</div>
<header id="kaltura-content-menu-header">
	<nav id="kaltura-content-menu" class="container_3">
			  <?php /*  Allow screen readers / text browsers to skip the navigation menu and get right to the good stuff */ ?>
				<div class="skip-link screen-reader-text"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'twentyten' ); ?>"><?php _e( 'Skip to content', 'twentyten' ); ?></a></div>
				<?php /* Our navigation menu.  If one isn't filled out, wp_nav_menu falls back to wp_page_menu.  The menu assiged to the primary position is the one used.  If none is assigned, the menu with the lowest ID is used.  */ ?>
				<?php wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary' ) ); ?>
	</nav>
</header>
<div class="clear">&nbsp;</div>
<div id="kaltura-content" class="container_3">
