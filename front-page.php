<?php get_header(); ?>
	<div class="page-header">
		<?php get_template_component('header-image'); ?>
	</div>
	<div class="page-content">
		<?php if (have_posts()) : while (have_posts()) : the_post() ?>
			<h1 class="page-title"><?php the_title(); ?></h1>
			<?php the_content(); ?>
			<div class="clearfix"></div>
		<?php endwhile; else: ?>
		<?php endif; ?>
		<div class="clearfix"></div>
	</div>
<?php get_footer(); ?>