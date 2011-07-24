<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.  Calls sidebar-footer.php for bottom widgets.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?>
</div> <!-- END Content Div Hack -->
</content>
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
		<span class="kaltura-partners">Our Partners:</span>
		<div class="clear">&nbsp;</div>
		<table class="kaltura-partners" >
			<tr>
				<td>
					<a href="http://www.wikimedia.org/"><img alt="Wikimedia" src="<?php bloginfo( 'template_url' ); ?>/kaltura-images/wikimedia-logo.png" /></a>
				</td>
				<td>
					<a href="http://www.mozilla.org/"><img alt="Mozilla" src="<?php bloginfo( 'template_url' ); ?>/kaltura-images/mozilla-logo.png" /></a>
				</td>
				<td>
					<a href="http://openvideoalliance.org/"><img alt="The Open Video Alliance" src="<?php bloginfo( 'template_url' ); ?>/kaltura-images/ova-logo.png" /></a>
				</td>
			</tr>
		</table>
		<div class="clear">&nbsp;</div>
		<hr class="kaltura-footer-rule" />
		<div id="kaltura-copyright" class="container_3">
			<div id="kaltura-footer-logo">
				<a href="http://corp.kaltura.com"><img src="<?php bloginfo( 'template_url' ); ?>/kaltura-images/kaltura-footer-logo.png" width="120" height="65"></a>
			</div>
			<p>Copyright &copy; 2011 Kaltura Inc.<br/>All Rights Reserved.  Designed Trademarks and brands are the property of their respective owners.  Use of this web site constitutes acceptance of <a href="http://corp.kaltura.com/tandc">Terms of Use</a> and <a href="http://corp.kaltura.com/privacy">Privacy Policy</a>.  User submitted media on this site is licensed under:  Creative Commons Attribution-Share Alike 3.0 Unported License.</p>
		</div>
		<div class="clear">&nbsp;</div>
	</div>
</footer>

<!-- jQuery might come in handy
<script type="text/javascript" src="http://html5video.org/testswarm/mwEmbed/r2244/mwEmbedLoader.php"></script>
-->
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script src="http://html5.kaltura.org/js"></script>

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
