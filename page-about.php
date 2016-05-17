<?php get_header(); ?>
	<div class="page-header">
		<?php get_template_component('header-image'); ?>
	</div>
	<div class="page-content">
		<div class="home-section section-about">
			<h2 class="section-title">About Me</h2>
			<div class="about-picture">
				<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABAQAAAAA3bvkkAAAAAnRSTlMAAQGU/a4AAAAKSURBVHgBY2gAAACCAIFMF9ffAAAAAElFTkSuQmCC" class="image-sizer headshot" alt="" style="background-image: url('<?php echo LUKE_2016_TEMPLATE_URL . 'includes/images/headshot.jpg'; ?>');">
			</div>
			<div class="about-description">
				<?php if (have_posts()) : while (have_posts()) : the_post() ?>
					<?php the_content(); ?>
					<div class="clearfix"></div>
				<?php endwhile; else: ?>
				<?php endif; ?>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
<?php get_footer(); ?>