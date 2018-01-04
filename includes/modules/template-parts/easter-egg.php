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
	// numa numa, badgers, with a spirit (maybe),axel f crazy frog
	// what is love, witch doctor, scat man?, leek song
	$query_args = array(
		'post_type'         =>  'easter_egg',
		'post_status'       =>  'publish',
		'posts_per_page'    =>  -1,
		'order'             =>  'DESC',
	);

	$project_query = new WP_Query($query_args);

	$audio_tracks = array();

	if ($project_query->have_posts()) : while ($project_query->have_posts()) : $project_query->the_post();
		$easter_egg_info = get_post_meta(get_the_ID(), 'easter_egg_info', true);
		if (!empty($easter_egg_info)) {
			$new_track = array(
				'weight' => $easter_egg_info['weight'],
				'url'    => $easter_egg_info['media_url'],
				'credits'=> $easter_egg_info['credits'],
			);
			$audio_tracks[] = $new_track;
		}
	endwhile; endif;
	wp_reset_postdata();

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
    	// Shot in the dark
    	console.log('Work for Automattic? Perhaps you could put in a good word for me, eh? :)');

		// Cache window size
		window_height = jQuery(window).height();
		window_width = jQuery(window).width();

		// Initialize counter
		insanity_meter = 0;

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
				console.log('Liked this? Give me a shout at eastereggs@luketowers.ca');
			}
		<?php } ?>
		// Setup audio looping for the music
		music.addEventListener('ended', function() {
			this.currentTime = 0;
			insanity_meter++;
			if (this.playbackRate < 3.9) {
				this.playbackRate = this.playbackRate + 0.1;
				console.log('You have survived listening to this track ' + insanity_meter + ' time(s). Keep it up! - Current playback rate: ' + this.playbackRate.toFixed(1));
			} else {
    			console.log("Surely you must be insane by now? The music can't be played any faster than it's going now! Total plays: " + insanity_meter);
			}

			this.play();
		});
		// Only display the chaos button when the music has loaded
		music.addEventListener('canplaythrough', function(e) {
			// Remove the handler so that this only runs once
			e.target.removeEventListener(e.type, arguments.callee);

			// Display the chaos button
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
			'.featured-background',
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
			ga('send', 'event', 'Chaos Controls', 'play ' + jQuery(music).attr('src'), 'Easter Eggs');

			// Prepare the variables
			html.css('height', '100%');
			body.css('height', '100%');
			stop_the_madness = false;

			// Prepare the elements for the animation
			elements.each(function() {
    			var $this = jQuery(this);
				$this.css('position', 'fixed');
				$this.css('transition', 'all .5s ease-in-out');
				$this.addClass('animating');
			});

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
			ga('send', 'event', 'Chaos Controls', 'pause ' + jQuery(music).attr('src'), 'Easter Eggs');

			// Set the flag to prevent the madness from perpetuating
			stop_the_madness = true;

			// Reset the css (currently leaving transition properties applied)
			html.css('height', '');
			body.css('height', '');
			elements.each(function() {
    			var $this = jQuery(this);
    			$this.css({
					position: '',
					transform: '',
					zIndex: ''
				});
				$this.removeClass('animating');
			});
			// Fade out then pause the music
			jQuery(music).animate({volume: 0}, 1000, function() {
				music.pause();
			});
		}


		// Generate the translation to be applied to the selected element based on the window size and element offset. Could be refined greatly.
		function generate_new_translation(element) {
			var h = window_height - element.offset().top;
			var w = window_width - element.offset().left;

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
    			var $this = jQuery(this);
				$this.css('zIndex', parseInt(Math.random()*100, 10));
				translate = generate_new_translation($this);
				$this.css('transform','rotate(' + Math.random()*360 +'deg) ' + 'translate(' + translate[0] + 'px,' + translate[1] + 'px)');
			});

			// Perpetuate the chaos in an orderly fashion
			elements.last().one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function() {
				bring_forth_chaos();
			});
		}
	});
</script>