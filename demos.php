<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Demos Index
*/
get_header(); ?>
	<div id="subheader">
		<h1><?php the_title() ?></h1>
	</div>
	<div id="content" class="narrow">
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
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="post" id="post-<?php the_ID(); ?>">
			<div class="entry">
				<?php the_content(); ?>
			</div>
		</div>
		<?php endwhile; endif; ?>
	</div>
	<div id="sidebar">
		<ul>
			<?php dynamic_sidebar('news-sidebar'); ?>
		</ul>
	</div>
<?php get_footer(); ?>
