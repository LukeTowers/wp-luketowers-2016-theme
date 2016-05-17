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
		<?php get_template_component('easter-egg'); ?>
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
											
						var btnScrollToTop = jQuery('.scroll-to-top');
						didScroll = false;
						
						jQuery(window).scroll(function() {
							didScroll = true;
						});
						
						setInterval(function() {
							if (didScroll) {
								didScroll = false;
								
								if (jQuery(window).scrollTop() > 75) {
									jQuery('body').addClass('pin-nav-to-top');
								} else {
									jQuery('body').removeClass('pin-nav-to-top');
								}
							}
						}, 250);
						
						
	
						// Handle the ID/hash scrolling
						var busy = false;
						function navigation_scroll() {
							if (busy) { return false; }
							if (location.hash) {
								var hashName = location.hash.substring(1, location.hash.length);
								var target = jQuery('[data-scroll-target='+hashName+']:first');
								if (target.length) {
									busy = true;
									var scroll_pos = target.offset().top - 100;
									if (jQuery('html, body').scrollTop() !== scroll_pos) {
										jQuery('html, body').animate({ scrollTop: scroll_pos}, 500, function() { busy = false; });
									}
								}
							}
							return false;
						}
						jQuery('.menu-item a[href*="#"]').on('click', function(e) {
							// Detect if this is the current page and scroll to the element if so. Otherwise, continue on to the proper page
							// - NOTE: Does not take other potential additions to the href like ? or & into account.								
							if (jQuery(window).width() <= 820) {
								jQuery('.navigation_container').slideToggle('fast');
								jQuery('.navigation_container').toggleClass('open');
							}
							var href_pathname = jQuery(this).attr('href').split('#');
							if (href_pathname[1] === window.location.hash.split('#')[1]) { // Only perform check when the chosen href hash is the same as the current one, otherwise our hashchange event can handle it
								if (href_pathname[0] === window.location.pathname || href_pathname === '') {
									e.preventDefault();
									if (jQuery(window).width() <= 820) {
										jQuery('.navigation_container').slideToggle('fast');
										jQuery('.navigation_container').toggleClass('open');
									}
									navigation_scroll();
								}
							}
						});
						jQuery(window).on('hashchange', function(e) {
							e.preventDefault();
							navigation_scroll();
						});
						jQuery(window).trigger('hashchange');
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