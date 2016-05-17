<?php get_header(); ?>
	<div class="content_container">
		<?php if (have_posts()) : while (have_posts()) : the_post() ?>
			<div class="entry-content">
				<h2 class="entry-title"><?php the_title(); ?></h2>
				<div class="entry-excerpt">
					<?php echo wp_trim_words(get_the_content('&nbsp;'), 45); ?>
				</div>
				<a href="<?php the_permalink(); ?>" class="entry-read-more">Read more...</a>
			</div>
		<?php endwhile; else: ?>
		<?php endif; ?>
		<?php get_template_component('pagination'); ?>
		<div class="clearfix"></div>
	</div>
<?php get_footer(); ?>