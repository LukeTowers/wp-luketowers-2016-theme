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
				display: none;
				background-color: rgba(255,255,255,0.4);
				color: #000;
				bottom: 15px;
				left: 15px;
			}
			
			#stop {
				background-color: rgba(0,0,0,0.4);
				color: #FFF;
				bottom: 15px;
				right: 15px;
				display: none;
			}
		</style>
		<a href="#" id="chaos" class="madness-button">Chaos</a>
		<a href="#" id="stop" class="madness-button">Stop the madness!</a>
		<?php 
			// TODO: keyboard cat,
			// numa numa, gummi bear (BWAHAHAHAAHAAAA), badgers, with a spirit (maybe),axel f crazy frog
			// what is love, witch doctor, scat man?, leek song
			$audio_tracks = array(
				'benny-hill-techo' => array(
					'weight'  => 5,
					'url'     => LUKE_2016_TEMPLATE_URL . 'includes/audio/benny-hill-techno.mp3',
					'credits' => 'Benny Hill Techno Remix by DJ Freshwinter - https://www.youtube.com/watch?v=fesYUkG4Kyg',
				),
				'epic-sax-guy'     => array(
					'weight'  => 5,
					'url'     => LUKE_2016_TEMPLATE_URL . 'includes/audio/epic-sax-guy.mp3',
					'credits' => 'Epic Sax Guy clip as pulled from https://www.myinstants.com/media/sounds/epic-sax-guy-plays-for-57-minutes.mp3',
				),
				'nyan-cat'         => array(
					'weight'   => 5,
					'url'      => LUKE_2016_TEMPLATE_URL . 'includes/audio/nyan-cat.mp3',
					'credits'  => 'Nyan Cat as pulled from http://www.nyan.cat',
				),
				'caramelldansen'   => array(
					'weight'   => 3,
					'url'      => LUKE_2016_TEMPLATE_URL . 'includes/audio/caramelldansen-english.mp3',
					'credits'  => 'Caramelldansen; this one\'s for you Dylan - https://www.youtube.com/watch?v=A67ZkAd1wmI',
				),
				'rickroll'         => array(
					'weight'   => 2,
					'url'      => LUKE_2016_TEMPLATE_URL . 'includes/audio/rickroll.mp3',
					'credits'  => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
				),
				'heyyeyaaeyaaeyaeyaa' => array(
					'weight'   => 3,
					'url'      => LUKE_2016_TEMPLATE_URL . 'includes/audio/heyyeyaaeyaaeyaeyaa.mp3',
					'credits'  => 'HEY YEYAAE YEYAAE YAE YAA - https://www.youtube.com/watch?v=ZZ5LpwO-An4',
				),
				'narwhals'         => array(
					'weight'   => 3,
					'url'      => LUKE_2016_TEMPLATE_URL . 'includes/audio/narwhals.mp3',
					'credits'  => 'Who lives in the ocean, causes commotions, and is awesome? - https://www.youtube.com/watch?v=ykwqXuMPsoc',
				),
				'gummibear'=> array(
					'weight'   => 3,
					'url'      => LUKE_2016_TEMPLATE_URL . 'includes/audio/gummibear.mp3',
					'credits'  => 'BWAHAHAHAHAHAAAA!!! I really am quite evil sometimes XD - https://www.youtube.com/watch?v=astISOttCQ0',
				),
				'crazyfrog'=> array(
					'weight'   => 3,
					'url'      => LUKE_2016_TEMPLATE_URL . 'includes/audio/crazyfrog.mp3',
					'credits'  => 'Hello? Yes, middle school called. It want\'s its gym playlist back. - https://www.youtube.com/watch?v=k85mRPqvMbE',
				),
				'sandstorm'         => array(
					'weight'   => 2,
					'url'      => LUKE_2016_TEMPLATE_URL . 'includes/audio/sandstorm.mp3',
					'credits'  => 'What song is that? - https://www.youtube.com/watch?v=2HQaBWziYvY',
				),
				'sandroll'=> array(
					'weight'   => 2,
					'url'      => LUKE_2016_TEMPLATE_URL . 'includes/audio/sandroll.mp3',
					'credits'  => 'What sort of evil person combines these? Oh wait, this actually sounds good... - https://www.youtube.com/watch?v=SQoA_wjmE9w',
				),
				'chocolate-rain'   => array(
					'weight'   => 2,
					'url'      => LUKE_2016_TEMPLATE_URL . 'includes/audio/chocolate-rain.mp3',
					'credits'  => 'Chocolate Rain by Tay Zonday - This is actually quite a powerful song about racism, however given its status as an internet meme, (moves away from keyboard to breathe) I\'m still including it in the lineup. - Used under the Creative Commons 3.0 license: http://creativecommons.org/licenses/by-nc-nd/3.0/us/ - https://www.youtube.com/watch?v=EwTZ2xpQwpA',
				),
			);
			
			
			// Total the weights
			$total_weight = 0;
			foreach ($audio_tracks as $counting_track) {
				if (!empty($counting_track['weight'])) {
					$total_weight += $counting_track['weight'];
				}
			}
			
			// Select a random track to use
			$random = rand(1, $total_weight);
			$chosen_track;
			$i = 0;
			foreach ($audio_tracks as $track) {
				$i++;
				// decrement the random number by the current weight
				// the larger the current weight, the more likely the random number will trigger acceptance (below 0)
				// keep in mind that later elements in the stack have a higher chance of being selected this way
				$random -= $track['weight'];
				
				if ($random <= 0) {
					$chosen_track = $track;
					$chosen_track['number'] = $i;
					break;
				}
			}
		?>
		
		<script type="text/javascript">
			jQuery(document).ready(function() {
				// Cache window size
				window_height = jQuery(window).height();
				window_width = jQuery(window).width();
				
				// Animation status variables
				stop_the_madness = false;
				
				// Music initilization
				music = new Audio('<?php echo $chosen_track['url']; ?>');
				<?php if (!empty($chosen_track['credits'])) { ?>
					if (!window.console) {
						console = {
							log: function(){},
						};
					} else {
						console.log(<?php echo json_encode($chosen_track['credits']); ?>);
						console.log(<?php echo json_encode('Track ' . $chosen_track['number'] . ' of ' . count($audio_tracks) . '. Try to find them all!'); ?>);
					}
				<?php } ?>
				// Setup audio looping for the music
				music.addEventListener('ended', function() {
					this.currentTime = 0;
					if (this.playbackRate < 4) {
						this.playbackRate = this.playbackRate + 0.1;
					}
					this.play();
				});
				// Only display the chaos button when the music has loaded
				music.addEventListener('canplaythrough', function() {
					chaos.css('display', 'block');
				}, false);
				
				
				// Selectors
				chaos = jQuery('#chaos');
				stop = jQuery('#stop');
				html = jQuery('html');
				body = jQuery('body');
				selectors = [
					'.site-logo',
					'.menu-item',
					'.mobile-menu-button',
					'.social_links_container',
					'.social-links a',
					'.header_featured_container',
					'.featured-text > *',
					'.section-about > *',
					'.service',
					'.project_container',
					'.section-title',
					'.contact-form form li',
					'.button',
					'.footer_container',
					'.copyright',
					'.footer-logo',
					'.pagination_container',
					'.meta-info',
				];
				selector = selectors.join(', ');
				elements = jQuery(selector);
				
				// The function of these functions is to be functionally funny, not dysfunctionally practical			
				chaos.on('click', function(e) {
					e.preventDefault();
					the_law_of_nature();
				});
				
				stop.on('click', function(e) {
					e.preventDefault();
					the_dream_of_man();
				});
				
				function the_law_of_nature() {
					// Toggle the buttons
					chaos.css('display','none');
					stop.css('display','block');
					ga('send', 'event', 'Chaos Controls', 'play', 'Easter Eggs');
					
					// Prepare the variables
					html.css('height', '100%');
					body.css('height', '100%');
					stop_the_madness = false;
					
					// Prepare the elements for the animation
					elements.each(function() {
						current_el = jQuery(this);
						current_el.css('position', 'fixed');
						current_el.css('transition', 'all .5s ease');
					})
					
					// BRING FORTH THE CHAOS!!!
					music.volume = 0;
					music.play();
					jQuery(music).animate({volume: 1.0},1000);
					bring_forth_chaos();
				}
				
				function the_dream_of_man() {
					// Toggle the buttons
					chaos.css('display','block');
					stop.css('display','none');
					ga('send', 'event', 'Chaos Controls', 'pause', 'Easter Eggs');
					
					// Set the flag to prevent the madness from perpetuating
					stop_the_madness = true;
					
					// Reset the css (currently leaving transition properties applied)
					html.css('height', '');
					body.css('height', '');
					elements.each(function() { 
						jQuery(this).css({
							position: '',
							top: '',
							right: '',
							bottom: '',
							left: '',
							transform: '',
							zIndex: '',
						});
					}); 
					// Fade out then pause the music
					jQuery(music).animate({volume: 0}, 1000, function() {
						music.pause();
					});
				}
				
				
				// Generate the translation to be applied to the selected element based on the window size and element offset. Could be refined greatly.
				function generate_new_translation(element) {
					var h = window_height - jQuery(element).offset().top;
					var w = window_width - jQuery(element).offset().left;
					
					var translate_x = Math.floor(Math.random() * w);
					var translate_y = Math.floor(Math.random() * h);
					
					return [translate_x, translate_y];
				}
				
				function bring_forth_chaos() {
					animated_elements = 0;
					if (stop_the_madness) { 
						return;
					}
					
					// Randomize elements z-index, rotation, and translation
					elements.each(function() {
						jQuery(this).css('zIndex', parseInt(Math.random()*100, 10));
						translate = generate_new_translation(jQuery(this));
						jQuery(this).css('transform','rotate(' +Math.random()*360 +'deg) ' + 'translate(' + translate[0] + 'px,' + translate[1] + 'px)');
					});
					
					// Perpetuate the chaos in an orderly fashion
					elements.last().one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function() {
						bring_forth_chaos();
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