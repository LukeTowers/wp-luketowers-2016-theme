<?php 
	/*
		Template Name: Portfolio Page
	*/
	get_header(); 
?>
	<div class="page-header">
		<?php get_template_component('header-image'); ?>
	</div>
	<div class="page-content">
		<div class="portfolio_container">
			<?php
				$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	
				$query_args = array(
					'post_type'         =>  'project',
					'post_status'       =>  'publish',
					'posts_per_page'    =>  -1, // Remember to set posts_per_page in admin settings to <= than the lowest value used in all templates
					'order'             =>  'DESC', // Temporarily set to oldest first for testing purposes, reset to DESC when done
					'paged'				=>  $paged,
				);
				
				$project_query = new WP_Query($query_args);
			?>
			<?php if ($project_query->have_posts()) : while ($project_query->have_posts()) : $project_query->the_post(); ?>
				<?php if (!post_password_required()) { ?>
					<div class="project_container">
						<img src="<?php echo lai_image_sizing_data('1','0.7'); ?>" class="image-sizer" alt="">
						<a class="project-link" href="<?php the_permalink(); ?>">
							<?php get_template_component('header-image', array(
									'class'       =>  'project-image',
									'image_only'  =>  true,
									'size'        =>  array('580px','405px'),
								));
							?>
							<span class="project-overlay"></span>
							<div class="centering_container">
								<h2 class="project-title"><?php the_title(); ?></h2>
								<?php 
									$project_info = get_post_meta(get_the_ID(), 'project_info', true); 
									if (@$project_info['display_client']) { ?>
										<span class="project-client"><?php echo $project_info['client']; ?></span>
									<?php }								
								?>
								<span class="project-info-button">View Project</span>
							</div>
						</a>
					</div>
				<?php } ?>
			<?php endwhile; else:?>
				<p style="margin: 0px; color: #FFF; padding: 15px;">No projects to display at the moment. Check again later.</p>
			<?php endif; ?>
			<div class="clearfix"></div>
		</div>
		<?php wp_reset_postdata(); ?>
		<div class="clearfix"></div>
	</div>
<?php get_footer(); ?>