<?php get_header(); ?>
	<div class="page-header">
		<?php get_template_component('header-image'); ?>
	</div>
	<div class="page-content">
		<div class="home-section section-about">
			<h2 class="section-title">About Me</h2>
			<div class="about-picture">
				<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABAQAAAAA3bvkkAAAAAnRSTlMAAQGU/a4AAAAKSURBVHgBY2gAAACCAIFMF9ffAAAAAElFTkSuQmCC" class="image-sizer" alt="">
				<span class="headshot" style="background-image: url('<?php echo LUKE_2016_TEMPLATE_URL . 'includes/images/headshot.jpg'; ?>');"></span>
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
		<div class="home-section section-portfolio">
			<h2 class="section-title">Past Work</h2>
			<div class="portfolio_container">
				<?php		
					$query_args = array(
						'post_type'         =>  'project',
						'post_status'       =>  'publish',
						'posts_per_page'    =>  6,
						'order'             =>  'DESC',
					);
					
					$project_query = new WP_Query($query_args);
				?>
				<?php if ($project_query->have_posts()) : while ($project_query->have_posts()) : $project_query->the_post(); ?>
					<div class="project_container">
						<img src="<?php echo lai_image_sizing_data('1','0.7'); ?>" class="image-sizer" alt="">
						<a class="project-link" href="<?php the_permalink(); ?>">
							<?php get_template_component('header-image', array(
									'class'       =>  'project-image',
									'image_only'  =>  true,
									'size'        =>  'large',
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
				<?php endwhile; else:?>
					<p>No projects to display at the moment. Check again later.</p>
				<?php endif; ?>
				<div class="clearfix"></div>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="home-section section-services">
			<h2 class="section-title">Services</h2>
			<div class="services_container">
				<div class="service">
					<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABAQAAAAA3bvkkAAAAAnRSTlMAAQGU/a4AAAAKSURBVHgBY2gAAACCAIFMF9ffAAAAAElFTkSuQmCC" class="image-sizer" alt="">
					<div class="centering_container">
						<div class="service-icon"><span class="fa fa-server"></span></div>
						<h3 class="service-title">Website Management</h3>
						<p class="service-description">Web hosting? Domain names? Email? No need to worry about managing those, I’ll do it for you!</p>
					</div>
				</div>
				<div class="service">
					<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABAQAAAAA3bvkkAAAAAnRSTlMAAQGU/a4AAAAKSURBVHgBY2gAAACCAIFMF9ffAAAAAElFTkSuQmCC" class="image-sizer" alt="">
					<div class="centering_container">
						<div class="service-icon"><span class="fa fa-mobile"></span></div>
						<h3 class="service-title">Website Development</h3>
						<p class="service-description">Need a new website or improvements to an existing one? I build modern, responsive websites that work on every device and achieve your goals.</p>
					</div>
				</div>
				<div class="service">
					<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABAQAAAAA3bvkkAAAAAnRSTlMAAQGU/a4AAAAKSURBVHgBY2gAAACCAIFMF9ffAAAAAElFTkSuQmCC" class="image-sizer" alt="">
					<div class="centering_container">
						<div class="service-icon"><span class="fa fa-pencil-square-o"></span></div>
						<h3 class="service-title">Content Updates</h3>
						<p class="service-description">Have an existing site that you want to edit or add content to? No problem, I can work with any system you have in place!</p>
					</div>
				</div>
			<div class="clearfix"></div>
		</div>
		<div class="home-section section-contact">
			<h2 class="section-title">Contact Me</h2>
			<div class="contact-form">
				<?php echo do_shortcode('[gravityform id="1" title="false" description="false" ajax="true"]'); ?>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
<?php get_footer(); ?>