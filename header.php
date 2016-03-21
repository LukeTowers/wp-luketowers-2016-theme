<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<title><?php wp_title(' - ', true, 'right'); bloginfo('name'); ?></title>
		<?php lai_display_seo_metatags(); ?>
		
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
		<div class="site_container">
			<div class="header_container">
				<div class="site-logo">
					<a href="/" title="Home">
						<img src="<?php echo LUKE_2016_TEMPLATE_URL . "includes/images/site-logo.png"; ?>" alt="Luke Towers - Web Developer">
						<span class="hidden-text">Luke Towers - Web Developer</span>
					</a>
				</div>
				<div class="mobile-menu-button">
					<a class="mobile-menu-btn" href="#">
						<div class="menu-btn-bar-container">
							<span class="menu-btn-bar"></span>
							<span class="menu-btn-bar"></span>
							<span class="menu-btn-bar"></span>
						</div>
						<span class="menu-btn-text">Menu</span>
					</a>
					<div class="clearfix"></div>
				</div>
				<!-- menu.jquery.min.js -->
				<script type="text/javascript">
					jQuery(document).ready(function() {
						jQuery('.mobile-menu-btn').click(function(e) {
							e.preventDefault();
							jQuery('.navigation_container').slideToggle('fast');
							jQuery('.navigation_container').toggleClass('open');
						});
					});
				</script>
				<div class="navigation_position_wrapper">
					<div class="navigation_container">
						<?php echo get_template_component('social-links', array('class'=>'mobile')); ?>
						<?php						
							$main_menu_args = array(
								'theme_location'  => 'main-menu',
								'container'       => 'nav',
								'container_class' => 'main-navigation',
								'menu_class'      => 'main-menu',
								'echo'            => true,
								'fallback_cb'     => 'wp_page_menu',
								'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
								'after'			  => '<div class="clearfix"></div>',
								'depth'           => 0,
							);
							
							wp_nav_menu($main_menu_args);	
						?>
					</div>
					<div class="clearfix"></div>
				</div>
				<?php echo get_template_component('social-links', array('class'=>'desktop')); ?>
				<div class="clearfix"></div>
			</div>
			<div class="page_container">