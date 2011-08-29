<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: News
*/
get_header(); ?>
		<div id="container">
			<div id="content" role="main">
		<h2>Industry News & Resources</h2>
		<?php 
			global $post;
			$myposts = get_posts('category_name=news&numberposts=0');
		?>
		<ul class="posts">
		<?php foreach($myposts as $post): ?>
			<?php setup_postdata($post); ?>
			<li>
				<div class="time">
					<div class="month"><?php the_time('M') ?></div>
					<div class="day"><?php the_time('j') ?></div>
				</div>
				<div class="entry">
					<?php the_content(); ?>
				</div>
			</li>
		<?php endforeach; ?>
		</ul>
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="post" id="post-<?php the_ID(); ?>">
			<div class="entry">
				<?php the_content(); ?>
			</div>
		</div>
		<?php endwhile; endif; ?>
			</div><!-- #content -->
		</div><!-- #container -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
