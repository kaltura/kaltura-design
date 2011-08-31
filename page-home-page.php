<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Home Page
*/
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed. test 
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
<link rel="stylesheet" href="<?php bloginfo( 'template_url' ); ?>/kaltura-front.css" />
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
		<a href="../../"><img alt="HTML5 Video" src="<?php bloginfo( 'template_directory' ); ?>/kaltura-images/html5video-logo.png" height="60" width="228"></a>
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
			<li><a href="../../EmbedWizard/">Embed Wizard</a></li>
			-->
			<li><a class="player-comparison" href="http://html5video.org/wiki/HTML5_Player_Comparison">HTML5 Player Comparison</a></li>
			<li><a class="html5-demos" href="http://html5video.org/blog/html5_demos/">HTML5 Demos</a></li>
			<li><a href="../../wiki/">Wiki</a></li>
			<li><a href="../../blog/news/">News</a></li>
			<li><a target="_blank" href="http://www.kaltura.org/forums/html5-video/html5-video">Forum</a></li>
			<li><a target="_blank" href="http://www.kaltura.org/project/issues/2720">Bug Tracker</a></li>
			<li><a target="_blank" href="http://code.html5video.org/projects/html5video/repository/show/trunk/mwEmbed">Code</a></li>
		</ul>
	</nav>
</header>
<div class="clear">&nbsp;</div>
<header id="kaltura-content-menu-header">
	<div id="kaltura-content-menu" class="container_3">
		<div id="kaltura-video" style="width:480px;height:302px"></div>

		<div id="video-credit"><span><a href="http://www.sitasingstheblues.com/">Sita Sings the Blues</a> by Nina Paley</span></div>
		<div class="what-is">
			<h1>What is HTML5 Video?</h1>
			<p>
				HTML5 is a set of web standards being developed by the "Web Hypertext Application Technology Working Group"
			</p>
			<p>
				The HTML5 standard includes many new features for more dynamic web applications and interfaces. One such component being specified and implemented is the &lt;video&gt; element.
			</p>
			<p> Using an HTML5 Javascript Library, your videos can be played back on the latest mobile devices and even on older browsers that require Flash.</p>
			<div class="kaltura-button-front2 button">
				<a href="http://html5video.org/wiki/Getting_Started_-_Navigating_HTML5"><span>Getting Started</span></a>
			</div>
			<div class="kaltura-button-front3 button">
				<a target="_blank" href="http://site.kaltura.com/HTML5Video.orgContactUs.html"><span>Contact us</span></a>
			</div>
		</div>
		<div id="kaltura-content-menu-shapes"></div>
	</div>
</header>
<div class="clear">&nbsp;</div>
<div id="kaltura-content" class="container_3">
	<div class="container_3">
		<div class="grid_1 kaltura-front-feed">
			<h2 class="kaltura-front-feed-header">HTML5 News</h2>
			<?php global $post; $myposts = get_posts('category_name=news&numberposts=5'); ?>
			<ul class="posts">
			<?php foreach($myposts as $post): ?>
			<?php setup_postdata($post); ?>
				<li>
					<div class="front-time"><a href="<?php the_permalink(); ?>"><?php the_time('F j, Y'); ?></a></div>
					<div class="front-entry">
						<?php the_content('Read more &raquo;'); ?>
					</div>
				</li>
			<?php endforeach; ?>
			</ul>
			<div class="kaltura-button1"><a href="../../../blog/news/">More news &raquo;</a></div>
		</div>
		<div class="grid_1 kaltura-front-feed">
			<h2 class="kaltura-front-feed-header">Recent Blog Posts</h2>
			<?php global $post; $myposts = get_posts('cat=-4&numberposts=4'); ?>
			<ul class="posts">
			<?php foreach($myposts as $post): ?>
			<?php setup_postdata($post); ?>
				<li>
					<div class="front-time"><a href="<?php the_permalink(); ?>"><?php the_time('F j, Y'); ?></a></div>
					<div class="front-entry">
						<p><strong><?php the_title(); ?></strong></p>
						<?php the_excerpt(); ?>
					</div>
				</li>
			<?php endforeach; ?>
			</ul>
			<div class="kaltura-button1"><a href="../../../blog/">More posts &raquo;</a></div>
		</div>
		<div class="grid_1 kaltura-front-sidebar">
			<?php get_sidebar(); ?>
		<!--	
			<span class="follow-us">Follow us:</span> 
			<a href="<?php bloginfo('rss2_url'); ?>" class="follow-icon rss">Rss Feed</a>
			<div class="stay-updated">
				<h2>Stay Updated</h2>
				<input name="stay-updated-email" type="text" />
				<a href="" class="signup-button" onclick="return stayUpdated();"></a>
				<p>
					Send us your email and we'll keep you up to date with the latest HTML5 Video news
				</p>
			</div> -->
		</div>
	</div>
</div>
<div class="clear">&nbsp;</div>
<footer id="kaltura-footer">
	<div class="container_3">
		<div id="kaltura-footer-remarks">
			<p>Kaltura is the world's first Open Source Online Video Platform, providing both enterprise level commercial software and services for video publishing, management, syndication and monitization, fully supported and maintained by Kaltura, as well as free open-source community supported solutions.</p>
		</div>
		<div id="kaltura-footer-social">
			<span>Stay in Touch</span><br />
			<a href="http://twitter.com/kaltura"><img alt="Twitter" src="<?php bloginfo( 'template_url' ); ?>/kaltura-images/kaltura-icon-twitter.png"></a>
			<a href="http://www.kaltura.org/kaltura-channel-freenode-irc-online-chat"><img alt="Freenode IRC" src="<?php bloginfo( 'template_url' ); ?>/kaltura-images/kaltura-icon-chat.png"></a>
			<a href="http://www.linkedin.com/company/kaltura"><img alt="LinkedIn" src="<?php bloginfo( 'template_url' ); ?>/kaltura-images/kaltura-icon-linkedin.png"></a>
			<a href="http://www.facebook.com/groups/kaltura"><img alt="Facebook" src="<?php bloginfo( 'template_url' ); ?>/kaltura-images/kaltura-icon-facebook.png"></a>
		</div>
		<div class="clear">&nbsp;</div>
		<hr class="kaltura-footer-rule" />
		<div class="clear">&nbsp;</div>
		<nav class="kaltura-partners">
			<div class="grid_1">
				<ul>
					<li>
							<a href="../../"><img class="footer-html5-logo" alt="HTML5 Video" src="<?php bloginfo( 'template_url' ); ?>/kaltura-images/html5video-logo-footer.png" /></a>
					</li>
					<li>
							<a href="http://corp.kaltura.com/"><img alt="Kaltura" src="<?php bloginfo( 'template_url' ); ?>/kaltura-images/kaltura-footer-logo.png" /></a>
					</li>
				</ul>
			</div>
			<div class="kaltura-vertical-rule">&nbsp;</div>
			<div class="grid_2">
				<ul>
					<li>
							Our Partners
					</li>
					<li>
							<a href="http://www.wikimedia.org/"><img alt="Wikimedia" src="<?php bloginfo( 'template_url' ); ?>/kaltura-images/wikimedia-logo.png" /></a>
					</li>
					<li>
							<a href="http://www.mozilla.org/"><img class="footer-mozilla-logo" alt="Mozilla" src="<?php bloginfo( 'template_url' ); ?>/kaltura-images/mozilla-logo.png" /></a>
					</li>
					<li>
							<a href="http://openvideoalliance.org/"><img alt="The Open Video Alliance" src="<?php bloginfo( 'template_url' ); ?>/kaltura-images/ova-logo.png" /></a>
					</li>
				</ul>
			</div>
		</nav>
		<div class="clear">&nbsp;</div>
		<hr class="kaltura-footer-rule" />
		<div id="kaltura-copyright" class="container_3">
			<p>Copyright &copy; 2011 Kaltura Inc.<br/>All Rights Reserved.  Designed Trademarks and brands are the property of their respective owners.  Use of this web site constitutes acceptance of <a href="http://corp.kaltura.com/tandc">Terms of Use</a> and <a href="http://corp.kaltura.com/privacy">Privacy Policy</a>.  User submitted media on this site is licensed under:  Creative Commons Attribution-Share Alike 3.0 Unported License.</p>
		</div>
		<div class="clear">&nbsp;</div>
	</div>
</footer>

<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script src="http://html5.kaltura.org/js"></script>
<script>
	mw.setConfig("forceMobileHTML5", true);
	kalturaIframeEmbed( 'kaltura-video', { 
		'wid' : '_243342', 
		'uiconf_id' : '5349042', 
		'entry_id' : '0_ntovmku5'
	});
</script>
	<script type="text/javascript">
			// let's make some pretty shields in the background of the top highlight area
			$(document).ready(function () {
				var numberOfShapes = 6,
				maxShapeSize = .6,
				minShapeSize = 0.05,
				maxRange = 120,
				width = 1000,
				height = 400;
				
				var shapeSizeFactor = ( maxShapeSize - minShapeSize ) / numberOfShapes;
				var rangeSizeFactor = maxRange / numberOfShapes;
				for (i=1;i<=numberOfShapes;i++) 
				{	
					parallax = maxRange - Math.floor( ( i * rangeSizeFactor ) );
					size = 100 * ( minShapeSize + ( i * shapeSizeFactor ));
					size = size+"%";
					xpos = 960 - Math.floor(Math.random()*width);
					ypos = 360 - Math.floor(Math.random()*height);
					$('#kaltura-content-menu-shapes').prepend('<img id="shape'+i+'" src="<?php bloginfo( "template_directory" ); ?>/kaltura-images/html5-badge-shape.svg" />');
					$('#shape'+i).css({'width' : size , 'height' : size, 'position' : 'absolute', 'opacity' : .02 + Math.random()*.15, 'top' : ypos, 'left' : xpos });
					$('#shape'+i).plaxify({"xRange":10+parallax,"yRange":10+parallax});
				}
				$('#kaltura-content-menu-shapes').append('<img id="topShape" src="<?php bloginfo( "template_directory" ); ?>/kaltura-images/html5-badge-shape.svg" />');
					$('#topShape').css({'width' : '70%' , 'height' : '70%', 'position' : 'absolute', 'opacity' : .12, 'top' : '100px', 'left' : '591px' });
				$('#topShape').plaxify({"xRange":20,"yRange":20, "invert":true});
				$.plax.enable();
			});
		</script>
		<!--
		<script type="text/javascript">
		function stayUpdated() {
			var url = "<?php echo site_url('/wp-content/plugins/email_plugin/register.php'); ?>";
			var $email = jQuery('input[name=stay-updated-email]');
			if ($email.attr('disabled'))
				return false;
			if ($email.val().indexOf('@') == -1) {
				$email.addClass('invalid');
				return false;
			}
			var email = $email.val();
			$email.removeClass('invalid');
			$email.val('Please wait...');
			$email.attr('disabled', true);
			jQuery.ajax({
				url: url,
				data: { email: email },
				success: function (data) {
					if (data != 'ok') {
						this.error();
						return;
					}
					
					$email.val('Email submitted successfully!');
				},
				error: function () {
					$email.val(email);
					$email.removeAttr('disabled');
					alert('An error occured, please try again');
				}
			});

			return false;
		}
		</script>
		-->
<!--
<?php
	/* A sidebar in the footer? Yep. You can can customize
	 * your footer with four columns of widgets.
	 */
	get_sidebar( 'footer' );
?>
-->

<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>
</body>
</html>
