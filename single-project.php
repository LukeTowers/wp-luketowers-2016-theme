<?php get_header(); ?>
		<?php if (have_posts()) : while (have_posts()) : the_post() ?>
			<?php if (!post_password_required()) { ?>
				<?php $project_info = get_post_meta(get_the_ID(), 'project_info', true); ?>
				<div class="page-header">
					<?php get_template_component('header-image', array(
						'defaults' => array(
							'relative_height' => '0.7',
						),
					)); ?>
				</div>
				<style>
					.single-project .header_featured_container {
						min-height: 0px;
					}
					
					.project_meta_container {
					    background-color: #1395BA;
					    display: table;
					    width: 100%;
					    table-layout: fixed;
					    box-shadow: 0px 0px 15px -3px #000 inset;
					}
					
					.meta-info {
					    display: table-cell;
					    text-align: center;
					    vertical-align: middle;
					    padding: 25px 0px;
					}
					
					.meta-info > * {
						display: block;
						color: #FFF;
					}
					
					.meta-info > *:first-child {
						font-size: 1.2em;
						text-transform: uppercase;
					}
					
					.project-meta-client, .project-year { 
						font-style: italic;
					}
					
					.project-employer-link:hover, .project-url-link:hover {
						color: #0C647D;
					}
					
					@media screen and (max-width: 500px) {
						.meta-info {
							display: block;
						}
					}
				</style>
				<div class="page-content">
					<div class="project_meta_container">
						<?php 
							// Client metadata
							if (@$project_info['display_client'] && !empty($project_info['client'])) {
								echo '<div class="meta-info">';
									echo '<span class="meta-descriptor">Client:</span>';
									echo '<span class="project-meta-client">' . $project_info['client'] . '</span>';
								echo '</div>';
							}
							
							// Employer metadata
							if (@$project_info['display_employer'] && !empty($project_info['employer'])) {
								echo '<div class="meta-info">';
									echo '<span class="meta-descriptor">Employer:</span>';
									if (!empty($project_info['employer_url'])) {
										echo '<a href="' . $project_info['employer_url'] . '" target="_blank" class="project-employer-link">';
											echo '<span class="project-employer">' . $project_info['employer'] . '</span>';
										echo '</a>';
									} else {
										echo '<span class="project-employer">' . $project_info['employer'] . '</span>';
									}
								echo '</div>';
							}	
							
							// Project URL metadata
							if (!empty($project_info['url'])) {
								echo '<div class="meta-info">';
									echo '<a href="' . $project_info['url'] . '" class="project-url-link" target="_blank">Visit project</a>';
								echo '</div>';
							}
							
							// Project Year metadata
							echo '<div class="meta-info">';
								echo '<span class="meta-descriptor">Year:</span>';
								echo '<span class="project-year">' . get_the_time('Y') . '</span>';
							echo '</div>';
						?>
					</div>
					<div class="section_title_container">
						<h1 class="section-title page-title"><?php the_title(); ?></h1>
					</div>
					<div class="content_container">
						<?php the_content(); ?>
						<div class="clearfix"></div>
					</div>
					<div class="project_images_container">
						<?php
							if (!empty($project_info['images']) && is_array($project_info['images'])) {
								// If mobile, default to large instead of original size
								if (lai_mobile_visitor() || lai_tablet_visitor()) {
									$size = 'large';
								} else {
									$size = 'full';
								}
								
								foreach ($project_info['images'] as $image_id) {
									$url_array = wp_get_attachment_image_src($image_id, $size);
									$image_url = @$url_array[0];
									
									if (!empty($image_url)) { ?>
										<div class="project_image_container">
											<img class="project-showcase-image" src="<?php echo $image_url; ?>" alt="<?php the_title() ?> Project Image">
										</div>
									<?php }
								}
							}
						?>
					</div>
					<div class="clearfix"></div>
				</div>
			<?php } else { echo get_the_password_form(); } ?>
		<?php endwhile; else: ?>
		<?php endif; ?>
<?php get_footer(); ?>