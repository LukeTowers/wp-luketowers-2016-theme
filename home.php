<?php get_header(); ?>
	<div class="archive_page_container">
		<div class="posts_container">
			<?php if (have_posts()) : while (have_posts()) : the_post() ?>
				<div class="entry_container">
					<div class="entry_featured_image_container">
						<a href="<?php the_permalink(); ?>" class="block-link">
							<img src="<?php echo lai_image_sizing_data('1','0.48'); ?>" class="image-sizer">
							<?php get_template_component('header-image', array(
								'class'       =>  'entry-featured-image',
								'image_only'  =>  true,
								'defaults'    =>  array('image_url' => LUKE_2016_TEMPLATE_URL. 'includes/images/default-blog.png'),
							)); ?>
						</a>
					</div>
					<h2 class="entry-title"><a href="<?php the_permalink(); ?>" class="block-link"><?php the_title(); ?></a></h2>
					<div class="entry-meta">
						<p class="meta-info">
							Posted <span class="entry-time"><?php the_time('d/m/Y'); ?></span><br><?php
								// Get the categories this post belongs to
								$post_categories = wp_get_post_categories(get_the_ID());
								
								if (!empty($post_categories) && is_array($post_categories)) {
									// Setup the amount of categories to process
									$num_of_categories = count($post_categories);
									$i = 0;
									
									echo ' in ';
									foreach ($post_categories as $cat_id) {
										// Get the category information
										$cat = get_category($cat_id);
										
										
										$i++;
										if ($i < $num_of_categories) { $seperator = ', '; } else { $seperator = ''; }
										
										// Output category link
										echo '<a href="/blog/category/' . $cat->slug . '" class="entry-category-link">' . $cat->name . '</a>' . $seperator;
									}
								}
							?>
						</p>
						<a href="<?php the_permalink(); ?>#comments" class="entry-comments-link"><span class="fa fa-comments">&nbsp;</span><?php comments_number(); ?></a>
					</div>
					<div class="entry-excerpt">
						<?php the_excerpt(); ?>
						<div class="clearfix"></div>
					</div>
					<div class="entry_link_container">
						<a href="<?php the_permalink(); ?>" class="entry-read-more button">Read More <span class="fa fa-arrow-right"></span></a>
					</div>
				</div>
			<?php endwhile; else: ?>
				<p>There are no posts to display at the moment. Check back later.</p>
			<?php endif; ?>
			<?php get_template_component('pagination'); ?>
			<div class="clearfix"></div>
		</div>
		<div class="sidebar_container">
			<?php dynamic_sidebar('blog-sidebar'); ?>
		</div>
		<div class="clearfix"></div>
	</div>
<?php get_footer(); ?>