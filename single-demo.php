<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Demos Single
*/
get_header(); ?>
	<div id="subheader">
		<h1><?php the_title() ?></h1>
	</div>
	<div id="content" class="widecolumn" role="main">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="post" id="post-<?php the_ID(); ?>">
			<div class="entry">
				<?php the_content(); ?>
        <!-- here's everything we need to build this demonstration -->
        <script type="text/javascript">
        var demonstration = {
            sourceURL: "<?php $key="demo_source_url"; $sources = get_post_custom_values($key); echo $sources[0]; ?>",
            fiddleURL: "<?php $key="fiddle_url"; $fiddles = get_post_custom_values($key); echo $fiddles[0]; ?>",
            sourceCode: <?php $key="demo_source"; $codes = get_post_custom_values($key); echo json_encode($codes[0]); ?>
        };
        </script>
        <div id="demo-preview"></div>
        <div id="demo-source"></div>
			</div>
		</div>
		<?php endwhile; endif; ?>
	</div>

  <div id="sidebar">
	  <h2>HTML5 Video Demonstrations</h2>
    <?php 
		  global $post;
		  $myposts = get_posts('post_type=demo&numberposts=0&orderby=parent');
	  ?>
	  <ul class="demos-list">
	  <?php foreach($myposts as $post): ?>
		  <?php setup_postdata($post); ?>
			  <li>
				  <div class="demo-link">
					  <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				  </div>
			  </li>
		<?php endforeach; ?>
		</ul>
	</div>
<?php get_footer(); ?>

<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/codemirror/js/codemirror.js"></script>
<script type="text/javascript">
var sourceCode;

function setupSource() {  
  // display the source editor and set the source code
  $('#demo-preview').html('<iframe id="preview-iframe" width="700px" height="600px" style="margin:0;padding:0;background:white"></iframe>');
  $('#demo-source').html('<h2>Demo Source:</h2><br /><textarea id="source-code"></textarea><br /><button id="update-preview" style="display:none">Update Preview</button>');
  $('#source-code').val(sourceCode);
  
  // define the preview update function
  var updatePreview = function() {
    var source = editor.getCode();
    var iframe = window.frames[0]; //["preview-iframe"];
    iframe.document.open();
    iframe.document.write(sourceCode);
    iframe.document.close();
  }

  var editor = CodeMirror.fromTextArea("source-code", {
      width: "700px",
      height: "dynamic",
      textWrapping: true,
      readOnly: true,
      onLoad: updatePreview,
      parserfile: ["parsexml.js", "parsecss.js", "tokenizejavascript.js", "parsejavascript.js", "parsehtmlmixed.js"],
      path: "<?php bloginfo('template_url'); ?>/js/codemirror/js/",
      stylesheet: ["<?php bloginfo('template_url'); ?>/js/codemirror/css/xmlcolors.css", "<?php bloginfo('template_url'); ?>/js/codemirror/css/jscolors.css", "<?php bloginfo('template_url'); ?>/js/codemirror/css/csscolors.css"]
  });
}

// default to jsfiddle embed or use source display
if (demonstration.fiddleURL != "") {
  // display the jsfiddle
  $('#demo-preview').html('<iframe id="preview-iframe" src="'+demonstration.fiddleURL+'/embedded/result,html,js,css,resources" width="700px" height="600px" style="margin:0;padding:0;background:white"></iframe>');
} else {
  // if there's a svn url for the demo, pull from svn via local proxy
  if (demonstration.sourceURL != "") {
    // fetch source code from svn
    sourceCode = $.ajax({
      url: "<?php bloginfo('wpurl'); ?>/ba-simple-proxy.php?url="+ demonstration.sourceURL +"&mode=native",
      async: false
    }).responseText ;
    setupSource();
  } else {
    // use the source code saved in wordpress
    sourceCode = demonstration.sourceCode;
    setupSource();
  }
}

//  $(document).ready( function () {
//    //bind the preview button to the updatePreview function
//    $("#update-preview").bind('click', updatePreview );
//  });
//}
</script>
