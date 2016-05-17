<?php get_header(); ?>
	<div class="page-content">
		<div class="content_container">
			<?php if (have_posts()) : while (have_posts()) : the_post() ?>
				<div class="entry-content">
					<h1 class="page-title"><?php the_title(); ?></h1>
					<?php the_content(); ?>
					<div class="clearfix"></div>
				</div>
			<?php endwhile; else: ?>
			<?php endif; ?>
			<div class="clearfix"></div>
		</div>
	</div>
<?php get_footer(); ?>