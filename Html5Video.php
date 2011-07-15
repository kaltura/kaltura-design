<?php
/**
 * Vector - Modern version of MonoBook with fresh look and many usability
 * improvements.
 *
 * @todo document
 * @file
 * @ingroup Skins
 */

if( !defined( 'MEDIAWIKI' ) ) {
	die( -1 );
}

/**
 * SkinTemplate class for Vector skin
 * @ingroup Skins
 */
class SkinHtml5Video extends SkinTemplate {

	var $skinname = 'html5video', $stylename = 'html5video',
		$template = 'Html5VideoTemplate', $useHeadElement = true;

	/**
	 * Initializes output page and sets up skin-specific parameters
	 * @param $out OutputPage object to initialize
	 */
	public function initPage( OutputPage $out ) {
		global $wgLocalStylePath, $wgRequest;

		parent::initPage( $out );
		
		// Append CSS which includes IE only behavior fixes for hover support -
		// this is better than including this in a CSS fille since it doesn't
		// wait for the CSS file to load before fetching the HTC file.
		$min = $wgRequest->getFuzzyBool( 'debug' ) ? '' : '.min';
		$out->addHeadItem( 'csshover',
			'<!--[if lt IE 7]><style type="text/css">body{behavior:url("' .
				htmlspecialchars( $wgLocalStylePath ) .
				"/{$this->stylename}/csshover{$min}.htc\")}</style><![endif]-->"
		);
		
		$out->addModuleScripts( 'skins.html5video' );
	}

	/**
	 * Load skin and user CSS files in the correct order
	 * fixes bug 22916
	 * @param $out OutputPage object
	 */
	function setupSkinUserCss( OutputPage $out ){
		parent::setupSkinUserCss( $out );
		$out->addModuleStyles( 'skins.html5video' );
	}
}

/**
 * QuickTemplate class for html5video skin
 * @ingroup Skins
 */
class Html5VideoTemplate extends BaseTemplate {

	/* Members */

	/**
	 * @var Skin Cached skin object
	 */
	var $skin;

	/* Functions */

	/**
	 * Outputs the entire contents of the (X)HTML page
	 */
	public function execute() {
		global $wgLang, $wgVectorUseIconWatch;

		$this->skin = $this->data['skin'];

		// Build additional attributes for navigation urls
		//$nav = $this->skin->buildNavigationUrls();
		$nav = $this->data['content_navigation'];
		
		if ( $wgVectorUseIconWatch ) {
			$mode = $this->skin->getTitle()->userIsWatching() ? 'unwatch' : 'watch';
			if ( isset( $nav['actions'][$mode] ) ) {
				$nav['views'][$mode] = $nav['actions'][$mode];
				$nav['views'][$mode]['class'] = rtrim( 'icon ' . $nav['views'][$mode]['class'], ' ' );
				$nav['views'][$mode]['primary'] = true;
				unset( $nav['actions'][$mode] );
			}
		}

		$xmlID = '';
		foreach ( $nav as $section => $links ) {
			foreach ( $links as $key => $link ) {
				if ( $section == 'views' && !( isset( $link['primary'] ) && $link['primary'] ) ) {
					$link['class'] = rtrim( 'collapsible ' . $link['class'], ' ' );
				}
				
				$xmlID = isset( $link['id'] ) ? $link['id'] : 'ca-' . $xmlID;
				$nav[$section][$key]['attributes'] =
					' id="' . Sanitizer::escapeId( $xmlID ) . '"';
				if ( $link['class'] ) {
					$nav[$section][$key]['attributes'] .=
						' class="' . htmlspecialchars( $link['class'] ) . '"';
					unset( $nav[$section][$key]['class'] );
				}
				if ( isset( $link['tooltiponly'] ) && $link['tooltiponly'] ) {
					$nav[$section][$key]['key'] =
						Linker::titleAttrib( $xmlID );
				} else {
					$nav[$section][$key]['key'] =
						Xml::expandAttributes( Linker::tooltipAndAccesskeyAttribs( $xmlID ) );
				}
			}
		}
		$this->data['namespace_urls'] = $nav['namespaces'];
		$this->data['view_urls'] = $nav['views'];
		$this->data['action_urls'] = $nav['actions'];
		$this->data['variant_urls'] = $nav['variants'];

		// Reverse horizontally rendered navigation elements
		if ( $wgLang->isRTL() ) {
			$this->data['view_urls'] =
				array_reverse( $this->data['view_urls'] );
			$this->data['namespace_urls'] =
				array_reverse( $this->data['namespace_urls'] );
			$this->data['personal_urls'] =
				array_reverse( $this->data['personal_urls'] );
		}
		// Output HTML Page
		$this->html( 'headelement' );
?>
<header id="kaltura-masthead" class="container_3">
	<div id="kaltura-logo">
		<img src="<?php echo htmlspecialchars( $this->text('stylepath') ); ?>/html5video/kaltura-images/html5video-logo.png" height="64" width="283">
	</div>
	<nav id="kaltura-top-menu">
		<ul>
			<li><a href="#" class="alwaysunvisited">kaltura.com</a></li>
			<li>|</li>
			<li><a href="#" class="alwaysunvisited">kaltura.org</a></li>
		</ul>
	</nav>
	<div class="clear">&nbsp;</div>
	<nav id="kaltura-masthead-menu">
		<ul>
			<li><a href="#">Embed Wizard</a></li>
			<li><a href="#">Wiki</a></li>
			<li><a href="#">Blog</a></li>
			<li><a href="#">Forums</a></li>
			<li><a href="#">Issues</a></li>
			<li><a href="#">Code</a></li>
		</ul>
	</nav>
</header>
<div class="clear">&nbsp;</div>
<header id="kaltura-content-menu-header" width="100%">&nbsp;</header>
<div class="clear">&nbsp;</div>
<content id="kaltura-content" class="container_3">
<!-- unfortunatly, content block's class doesn't respond to css, till it does, use a div -->
<div class="container_3">
	<!-- content -->
	<header width="100%">
		<nav>
			<!-- header -->
			<div id="mw-head" class="noprint">
				<div id="left-navigation">
					<?php $this->renderNavigation( array( 'NAMESPACES', 'VARIANTS' ) ); ?>
				</div>
				<div id="right-navigation">
					<?php $this->renderNavigation( array( 'VIEWS', 'ACTIONS', 'SEARCH' ) ); ?>
				</div>
			</div>
			<!-- /header -->
		</nav>
	</header>
	<div class="clear">&nbsp;</div>
	<div id="content"<?php $this->html( 'specialpageattributes' ) ?>>
		<a id="top"></a>
		<div id="mw-js-message" style="display:none;"<?php $this->html( 'userlangattributes' ) ?>></div>
		<?php if ( $this->data['sitenotice'] ): ?>
		<!-- sitenotice -->
		<div id="siteNotice"><?php $this->html( 'sitenotice' ) ?></div>
		<!-- /sitenotice -->
		<?php endif; ?>
		<!-- firstHeading -->
		<h1 id="firstHeading" class="firstHeading kaltura-first-title"><?php $this->html( 'title' ) ?></h1>
		<!-- /firstHeading -->
		<!-- bodyContent -->
		<div id="bodyContent">
			<?php if ( $this->data['isarticle'] ): ?>
			<!-- tagline -->
			<div id="siteSub"><?php $this->msg( 'tagline' ) ?></div>
			<!-- /tagline -->
			<?php endif; ?>
			<!-- subtitle -->
			<div id="contentSub"<?php $this->html( 'userlangattributes' ) ?>><?php $this->html( 'subtitle' ) ?></div>
			<!-- /subtitle -->
			<?php if ( $this->data['undelete'] ): ?>
			<!-- undelete -->
			<div id="contentSub2"><?php $this->html( 'undelete' ) ?></div>
			<!-- /undelete -->
			<?php endif; ?>
			<?php if( $this->data['newtalk'] ): ?>
			<!-- newtalk -->
			<div class="usermessage"><?php $this->html( 'newtalk' )  ?></div>
			<!-- /newtalk -->
			<?php endif; ?>
			<?php if ( $this->data['showjumplinks'] ): ?>
			<!-- jumpto -->
			<div id="jump-to-nav">
				<?php $this->msg( 'jumpto' ) ?> <a href="#mw-head"><?php $this->msg( 'jumptonavigation' ) ?></a>,
				<a href="#p-search"><?php $this->msg( 'jumptosearch' ) ?></a>
			</div>
			<!-- /jumpto -->
			<?php endif; ?>
			<!-- bodytext -->
			<?php $this->html( 'bodytext' ) ?>
			<!-- /bodytext -->
			<?php if ( $this->data['printfooter'] ): ?>
			<!-- printfooter -->
			<div class="printfooter">
			<?php $this->html( 'printfooter' ); ?>
			</div>
			<!-- /printfooter -->
			<?php endif; ?>
			<?php if ( $this->data['catlinks'] ): ?>
			<!-- catlinks -->
			<?php $this->html( 'catlinks' ); ?>
			<!-- /catlinks -->
			<?php endif; ?>
			<?php if ( $this->data['dataAfterContent'] ): ?>
			<!-- dataAfterContent -->
			<?php $this->html( 'dataAfterContent' ); ?>
			<!-- /dataAfterContent -->
			<?php endif; ?>
			<div class="visualClear"></div>
			<!-- debughtml -->
			<?php $this->html( 'debughtml' ); ?>
			<!-- /debughtml -->
		</div>
		<!-- /bodyContent -->
	</div>
	<!-- /content -->
</div> <!-- END Content Div Hack -->
</content>
<div class="clear">&nbsp;</div>
<footer class="kaltura-box container_3">
<div id="wiki-menu">
	<nav>
		<!-- panel -->
			<div id="mw-panel" class="noprint">
				<?php $this->renderPortals( $this->data['sidebar'] ); ?>
				<div class="portal">
					<h5>Personal Tools</h5>
					<div class="body">
						<?php $this->renderNavigation( 'PERSONAL' ); ?>
					</div>
				</div>
			</div>
		<!-- /panel -->
	</nav>
</div>
<div class="clear">&nbsp;</div>
	<!-- footer -->
	<div id="footer"<?php $this->html( 'userlangattributes' ) ?>>
		<?php foreach( $this->getFooterLinks() as $category => $links ): ?>
			<ul id="footer-<?php echo $category ?>">
				<?php foreach( $links as $link ): ?>
					<li id="footer-<?php echo $category ?>-<?php echo $link ?>"><?php $this->html( $link ) ?></li>
				<?php endforeach; ?>
			</ul>
		<?php endforeach; ?>
		<?php $footericons = $this->getFooterIcons("icononly");
		if ( count( $footericons ) > 0 ): ?>
			<ul id="footer-icons" class="noprint">
<?php			foreach ( $footericons as $blockName => $footerIcons ): ?>
				<li id="footer-<?php echo htmlspecialchars( $blockName ); ?>ico">
<?php				foreach ( $footerIcons as $icon ): ?>
					<?php echo $this->skin->makeFooterIcon( $icon ); ?>

<?php				endforeach; ?>
				</li>
<?php			endforeach; ?>
			</ul>
		<?php endif; ?>
		<div style="clear:both"></div>
	</div>
	<!-- /footer -->
</footer>
<div class="clear">&nbsp;</div>
<footer id="kaltura-footer">
	<div class="container_3">
		<div id="kaltura-footer-remarks">
			<p>Kaltura is the world's first Open Source Online Video Platform, providing both enterprise level commercial software and services for video publishing, management, syndication and monitization, fully supported and maintained by Kaltura, as well as free open-source community supported solutions.</p>
		</div>
		<div id="kaltura-footer-social"><h4>Social Bookmarks and Search</div>
		<div class="clear">&nbsp;</div>
		<hr class="kaltura-footer-rule" />
		<div id="kaltura-footer-lists">
			<nav class="kaltura-footer-list ">
				<span>Products</span>
				<ul>
					<li><a href="#nowhere" title="Lorum ipsum dolor sit amet">Lorem</a></li>
					<li><a href="#nowhere" title="Aliquam tincidunt mauris eu risus">Aliquam</a></li>
					<li><a href="#nowhere" title="Morbi in sem quis dui placerat ornare">Morbi</a></li>
					<li><a href="#nowhere" title="Praesent dapibus, neque id cursus faucibus">Praesent</a></li>
					<li><a href="#nowhere" title="Pellentesque fermentum dolor">Pellentesque</a></li>
				</ul>
			</nav>
			<nav class="kaltura-footer-list">
				<span>Solutions</span>
				<ul>
					<li><a href="#nowhere" title="Lorum ipsum dolor sit amet">Lorem</a></li>
					<li><a href="#nowhere" title="Aliquam tincidunt mauris eu risus">Aliquam</a></li>
					<li><a href="#nowhere" title="Morbi in sem quis dui placerat ornare">Morbi</a></li>
					<li><a href="#nowhere" title="Praesent dapibus, neque id cursus faucibus">Praesent</a></li>
					<li><a href="#nowhere" title="Pellentesque fermentum dolor">Pellentesque</a></li>
				</ul>
			</nav>
			<nav class="kaltura-footer-list">
				<span>Pricing</span>
				<ul>
					<li><a href="#nowhere" title="Lorum ipsum dolor sit amet">Lorem</a></li>
					<li><a href="#nowhere" title="Aliquam tincidunt mauris eu risus">Aliquam</a></li>
					<li><a href="#nowhere" title="Morbi in sem quis dui placerat ornare">Morbi</a></li>
					<li><a href="#nowhere" title="Praesent dapibus, neque id cursus faucibus">Praesent</a></li>
					<li><a href="#nowhere" title="Pellentesque fermentum dolor">Pellentesque</a></li>
				</ul>
			</nav>
			<nav class="kaltura-footer-list">
				<span>Why Kaltura?</span>
				<ul>
					<li><a href="#nowhere" title="Lorum ipsum dolor sit amet">Lorem</a></li>
					<li><a href="#nowhere" title="Aliquam tincidunt mauris eu risus">Aliquam</a></li>
					<li><a href="#nowhere" title="Morbi in sem quis dui placerat ornare">Morbi</a></li>
					<li><a href="#nowhere" title="Praesent dapibus, neque id cursus faucibus">Praesent</a></li>
					<li><a href="#nowhere" title="Pellentesque fermentum dolor">Pellentesque</a></li>
				</ul>
			</nav>
			<nav class="kaltura-footer-list">
				<span>Partners</span>
				<ul>
					<li><a href="#nowhere" title="Lorum ipsum dolor sit amet">Lorem</a></li>
					<li><a href="#nowhere" title="Aliquam tincidunt mauris eu risus">Aliquam</a></li>
					<li><a href="#nowhere" title="Morbi in sem quis dui placerat ornare">Morbi</a></li>
					<li><a href="#nowhere" title="Praesent dapibus, neque id cursus faucibus">Praesent</a></li>
					<li><a href="#nowhere" title="Pellentesque fermentum dolor">Pellentesque</a></li>
				</ul>
			</nav>
			<nav class="kaltura-footer-list">
				<span>Customers</span>
				<ul>
					<li><a href="#nowhere" title="Lorum ipsum dolor sit amet">Lorem</a></li>
					<li><a href="#nowhere" title="Aliquam tincidunt mauris eu risus">Aliquam</a></li>
					<li><a href="#nowhere" title="Morbi in sem quis dui placerat ornare">Morbi</a></li>
					<li><a href="#nowhere" title="Praesent dapibus, neque id cursus faucibus">Praesent</a></li>
					<li><a href="#nowhere" title="Pellentesque fermentum dolor">Pellentesque</a></li>
				</ul>
			</nav>
			<nav class="kaltura-footer-list">
				<span>Community</span>
				<ul>
					<li><a href="#nowhere" title="Lorum ipsum dolor sit amet">Lorem</a></li>
					<li><a href="#nowhere" title="Aliquam tincidunt mauris eu risus">Aliquam</a></li>
					<li><a href="#nowhere" title="Morbi in sem quis dui placerat ornare">Morbi</a></li>
					<li><a href="#nowhere" title="Praesent dapibus, neque id cursus faucibus">Praesent</a></li>
					<li><a href="#nowhere" title="Pellentesque fermentum dolor">Pellentesque</a></li>
				</ul>
			</nav>
		</div>
		<div class="clear">&nbsp;</div>
		<hr class="kaltura-footer-rule" />
		<div id="kaltura-copyright">
			<div id="kaltura-footer-logo">
				<img src="<?php echo htmlspecialchars( $this->text('stylepath') ); ?>/html5video/kaltura-images/kaltura-footer-logo.png" width="120" height="65">
			</div>
			<p>Copyright &copy; 2011 Kaltura Inc.<br/>All Rights Reserved.  Designed Trademarks and brands are the property of their respective owners.  Use of this web site constitutes acceptance of <a href="#">Terms of Use</a> and <a href="#">Privacy Policy</a>.  User submitted media on this site is licensed under:  Creative Commons Attribution-Share Alike 3.0 Unported License.</p>
		</div>
		<div class="clear">&nbsp;</div>
	</div>
</footer>
		<!-- fixalpha -->
		<script type="<?php $this->text( 'jsmimetype' ) ?>"> if ( window.isMSIE55 ) fixalpha(); </script>
		<!-- /fixalpha -->
		<?php $this->printTrail(); ?>

	</body>
</html>
<?php
	}

	/**
	 * Render a series of portals
	 *
	 * @params $portals array
	 */
	private function renderPortals( $portals ) {
		// Force the rendering of the following portals
		if ( !isset( $portals['SEARCH'] ) ) {
			$portals['SEARCH'] = true;
		}
		if ( !isset( $portals['TOOLBOX'] ) ) {
			$portals['TOOLBOX'] = true;
		}
		if ( !isset( $portals['LANGUAGES'] ) ) {
			$portals['LANGUAGES'] = true;
		}
		// Render portals
		foreach ( $portals as $name => $content ) {
			echo "\n<!-- {$name} -->\n";
			switch( $name ) {
				case 'SEARCH':
					break;
				case 'TOOLBOX':
					$this->renderPortal( 'tb', $this->getToolbox(), 'toolbox', 'SkinTemplateToolboxEnd' );
					break;
				case 'LANGUAGES':
					if ( $this->data['language_urls'] ) {
						$this->renderPortal( 'lang', $this->data['language_urls'], 'otherlanguages' );
					}
					break;
				default:
					$this->renderPortal( $name, $content );
				break;
			}
			echo "\n<!-- /{$name} -->\n";
		}
	}

	private function renderPortal( $name, $content, $msg = null, $hook = null ) {
		if ( !isset( $msg ) ) {
			$msg = $name;
		}
		?>
<div class="portal" id='<?php echo Sanitizer::escapeId( "p-$name" ) ?>'<?php echo Linker::titleAttrib( 'p-' . $name ) ?>>
	<h5<?php $this->html( 'userlangattributes' ) ?>><?php $msgObj = wfMessage( $msg ); echo htmlspecialchars( $msgObj->exists() ? $msgObj->text() : $msg ); ?></h5>
	<div class="body">
<?php
		if ( is_array( $content ) ): ?>
		<ul>
<?php
			foreach( $content as $key => $val ): ?>
			<?php echo $this->makeListItem( $key, $val ); ?>

<?php
			endforeach;
			if ( isset( $hook ) ) {
				wfRunHooks( $hook, array( &$this ) );
			}
			?>
		</ul>
<?php
		else: ?>
		<?php echo $content; /* Allow raw HTML block to be defined by extensions */ ?>
<?php
		endif; ?>
	</div>
</div>
<?php
	}

	/**
	 * Render one or more navigations elements by name, automatically reveresed
	 * when UI is in RTL mode
	 *
	 * @param $elements array
	 */
	private function renderNavigation( $elements ) {
		global $wgVectorUseSimpleSearch, $wgVectorShowVariantName, $wgUser;

		// If only one element was given, wrap it in an array, allowing more
		// flexible arguments
		if ( !is_array( $elements ) ) {
			$elements = array( $elements );
		// If there's a series of elements, reverse them when in RTL mode
		} elseif ( wfUILang()->isRTL() ) {
			$elements = array_reverse( $elements );
		}
		// Render elements
		foreach ( $elements as $name => $element ) {
			echo "\n<!-- {$name} -->\n";
			switch ( $element ) {
				case 'NAMESPACES':
?>
<div id="p-namespaces" class="vectorTabs<?php if ( count( $this->data['namespace_urls'] ) == 0 ) echo ' emptyPortlet'; ?>">
	<h5><?php $this->msg( 'namespaces' ) ?></h5>
	<ul<?php $this->html( 'userlangattributes' ) ?>>
		<?php foreach ( $this->data['namespace_urls'] as $link ): ?>
			<li <?php echo $link['attributes'] ?>><span><a href="<?php echo htmlspecialchars( $link['href'] ) ?>" <?php echo $link['key'] ?>><?php echo htmlspecialchars( $link['text'] ) ?></a></span></li>
		<?php endforeach; ?>
	</ul>
</div>
<?php
				break;
				case 'VARIANTS':
?>
<div id="p-variants" class="vectorMenu<?php if ( count( $this->data['variant_urls'] ) == 0 ) echo ' emptyPortlet'; ?>">
	<?php if ( $wgVectorShowVariantName ): ?>
		<h4>
		<?php foreach ( $this->data['variant_urls'] as $link ): ?>
			<?php if ( stripos( $link['attributes'], 'selected' ) !== false ): ?>
				<?php echo htmlspecialchars( $link['text'] ) ?>
			<?php endif; ?>
		<?php endforeach; ?>
		</h4>
	<?php endif; ?>
	<h5><span><?php $this->msg( 'variants' ) ?></span><a href="#"></a></h5>
	<div class="menu">
		<ul<?php $this->html( 'userlangattributes' ) ?>>
			<?php foreach ( $this->data['variant_urls'] as $link ): ?>
				<li<?php echo $link['attributes'] ?>><a href="<?php echo htmlspecialchars( $link['href'] ) ?>" <?php echo $link['key'] ?>><?php echo htmlspecialchars( $link['text'] ) ?></a></li>
			<?php endforeach; ?>
		</ul>
	</div>
</div>
<?php
				break;
				case 'VIEWS':
?>
<div id="p-views" class="vectorTabs<?php if ( count( $this->data['view_urls'] ) == 0 ) { echo ' emptyPortlet'; } ?>">
	<h5><?php $this->msg('views') ?></h5>
	<ul<?php $this->html('userlangattributes') ?>>
		<?php foreach ( $this->data['view_urls'] as $link ): ?>
			<li<?php echo $link['attributes'] ?>><span><a href="<?php echo htmlspecialchars( $link['href'] ) ?>" <?php echo $link['key'] ?>><?php
				// $link['text'] can be undefined - bug 27764
				if ( array_key_exists( 'text', $link ) ) {
					echo array_key_exists( 'img', $link ) ?  '<img src="' . $link['img'] . '" alt="' . $link['text'] . '" />' : htmlspecialchars( $link['text'] );
				}
				?></a></span></li>
		<?php endforeach; ?>
	</ul>
</div>
<?php
				break;
				case 'ACTIONS':
?>
<div id="p-cactions" class="vectorMenu<?php if ( count( $this->data['action_urls'] ) == 0 ) echo ' emptyPortlet'; ?>">
	<h5><span><?php $this->msg( 'actions' ) ?></span><a href="#"></a></h5>
	<div class="menu">
		<ul<?php $this->html( 'userlangattributes' ) ?>>
			<?php foreach ( $this->data['action_urls'] as $link ): ?>
				<li<?php echo $link['attributes'] ?>><a href="<?php echo htmlspecialchars( $link['href'] ) ?>" <?php echo $link['key'] ?>><?php echo htmlspecialchars( $link['text'] ) ?></a></li>
			<?php endforeach; ?>
		</ul>
	</div>
</div>
<?php
				break;
				case 'PERSONAL':
?>
<div id="p-personal" class="<?php if ( count( $this->data['personal_urls'] ) == 0 ) echo ' emptyPortlet'; ?>">
	<ul<?php $this->html( 'userlangattributes' ) ?>>
<?php			foreach( $this->getPersonalTools() as $key => $item ) { ?>
		<?php echo $this->makeListItem( $key, $item ); ?>

<?php			} ?>
	</ul>
</div>
<?php
				break;
				case 'SEARCH':
?>
<div id="p-search">
	<h5<?php $this->html( 'userlangattributes' ) ?>><label for="searchInput"><?php $this->msg( 'search' ) ?></label></h5>
	<form action="<?php $this->text( 'wgScript' ) ?>" id="searchform">
		<input type='hidden' name="title" value="<?php $this->text( 'searchtitle' ) ?>"/>
		<?php if ( $wgVectorUseSimpleSearch && $wgUser->getOption( 'vector-simplesearch' ) ): ?>
		<div id="simpleSearch">
			<?php if ( $this->data['rtl'] ): ?>
			<?php echo $this->makeSearchButton( 'image', array( 'id' => 'searchButton', 'src' => $this->skin->getSkinStylePath( 'images/search-rtl.png' ) ) ); ?>
			<?php endif; ?>
			<?php echo $this->makeSearchInput( array( 'id' => 'searchInput', 'type' => 'text' ) ); ?>
			<?php if ( !$this->data['rtl'] ): ?>
			<?php echo $this->makeSearchButton( 'image', array( 'id' => 'searchButton', 'src' => $this->skin->getSkinStylePath( 'images/search-ltr.png' ) ) ); ?>
			<?php endif; ?>
		</div>
		<?php else: ?>
		<?php echo $this->makeSearchInput( array( 'id' => 'searchInput' ) ); ?>
		<?php echo $this->makeSearchButton( 'go', array( 'id' => 'searchGoButton', 'class' => 'searchButton' ) ); ?>
		<?php echo $this->makeSearchButton( 'fulltext', array( 'id' => 'mw-searchButton', 'class' => 'searchButton' ) ); ?>
		<?php endif; ?>
	</form>
</div>
<?php

				break;
			}
			echo "\n<!-- /{$name} -->\n";
		}
	}
}
