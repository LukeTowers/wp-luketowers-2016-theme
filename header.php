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
		<style type="text/css">
			.madness-button {
				position: fixed;
				z-index: 9999 !important;
				text-align: center;
				padding: 15px;
				display: block;
				text-transform: uppercase;
			}
			
			#chaos {
				background-color: rgba(255,255,255,0.4);
				color: #000;
				top: 90%;
				left: 5%;
			}
			
			#stop {
				background-color: rgba(0,0,0,0.4);
				color: #FFF;
				top: 90%;
				right: 5%;
				display: none;
			}
		</style>
		<a href="#" id="chaos" class="madness-button">Chaos</a>
		<a href="#" id="stop" class="madness-button">Stop the madness!</a>
		<script type="text/javascript">
			jQuery(document).ready(function() {
				// Cache window size
				window_height = jQuery(window).height();
				window_width = jQuery(window).width();
				
				// Animation status variables
				stop_the_madness = false;
				animated_elements = 0;
				total_elements = 0;
				
				// Selectors
				chaos = '#chaos';
				stop = '#stop';
				selectors = [
					'.site-logo',
					'.menu-item',
					'.social-links a',
					'.header_featured_container',
					'.featured-text > *',
					'.section-about > *',
					'.service',
					'.project_container',
				];
				selector = selectors.join(', ');
				
				jQuery('#chaos').on('click', function(e) {
					e.preventDefault();
					
					// Prepare the variables
					stop_the_madness = false;
					total_elements = 0;
					jQuery(chaos).css('display','none');
					jQuery(stop).css('display','block');
					
					// Prepare the elements for the animation
					jQuery(selector).each(function() {
						total_elements++;
						current_el = jQuery(this);
						// Doesn't handle original rotation value because it looks cooler rotated still on finish (plus didn't want to implement it while 
						current_el.data('original-position', {
							position: current_el.css('position'),
							top: current_el.css('top'),
							right: current_el.css('right'),
							bottom: current_el.css('bottom'),
							left: current_el.css('left'),
						});
						current_el.css('position', 'fixed');
						jQuery(this).css('-webkit-transition', 'all 1s ease');
					})
					
					// BRING FORTH THE CHAOS!!!
					bring_forth_chaos();
				});
				
				jQuery(stop).on('click', function(e) {
					e.preventDefault();
					stop_the_madness = true;
				});
				
				function generate_new_position(element) {
					var h = window_height - jQuery(element).height();
					var w = window_width - jQuery(element).width();
					
					var x = Math.floor(Math.random() * w);
					var y = Math.floor(Math.random() * h);
					
					return [x,y];
				}
				
				function bring_forth_chaos() {
					animated_elements = 0;
					if (stop_the_madness) { 
						jQuery(selector).each(function() { 
							current_el = jQuery(this);
							original_position = current_el.data('original-position');
							current_el.css({
								position: original_position.position,
								top: original_position.top,
								right: original_position.right,
								bottom: original_position.bottom,
								left: original_position.left,
							});
						}); 
						return;
					}
					
					// Elements selector
					jQuery(selector).each(function() {
						
						jQuery(this).css('zIndex', parseInt(Math.random()*100, 10));
						jQuery(this).css('-webkit-transform','rotate(' +Math.random()*360 +'deg)');
						jQuery(this).on('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function() {
							new_position = generate_new_position(jQuery(this));
							jQuery(this).animate({left: new_position[0], top: new_position[1]}, function() {
								animated_elements++;
								if (animated_elements === total_elements) {
									bring_forth_chaos();
								}
							});
						});
					});
				}
			});
		</script>
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