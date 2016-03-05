<?php
// Renders the Header Options metabox
function render_header_options_metabox($post) {
	$header_options = get_post_meta($post->ID, 'header_options', true);
	
	if (empty($header_options) || !is_array($header_options)) {
		$header_options = array();
	}
	
	wp_nonce_field('header_options', 'header_options_nonce');
	?>
	<style>
		.clearfix {
			clear: both;
		}
		.row {
			position: relative;
		}
		.row * {
			display: block;
		}
		.checkbox-group label {
			display: inline-block;
		}
		.checkbox-group {
			margin: 15px 0px;
		}
		#header_text {
			min-height: 100px;
			min-width: 100%;
		}
	</style>
	<div class="row">
		<label for="header_text">HTML Content</label>
		<textarea id="header_text" name="header_text"><?php echo @$header_options['header_text']; ?></textarea>
	</div>
	<div class="row">
		<label for="background_colour">Background Colour</label>
		<input name="background_colour" id="background_colour" value="<?php echo @$header_options['background_colour']; ?>" type="text" placeholder="#FFFFFF" style="width: 100%;">
	</div>
	<div class="row">
		<div class="checkbox-group">
			<input type="checkbox" name="no_image" id="no_image" <?php checked(@$header_options['no_image']); ?> value="1">
				<label for="no_image">No Image</label>
			</input>
		</div>
	</div>
	<div class="row">
		<label for="y_correction">Y-axis correction:</label>
		<input name="y_correction" id="y_correction" value="<?php echo @$header_options['y_correction']; ?>" type="text" placeholder="30%" style="width: 100%;">
	</div>
	<div class="row">
		<div class="checkbox-group">
			<input type="checkbox" name="transparent_overlay" id="transparent_overlay" <?php checked(@$header_options['transparent_overlay']); ?> value="1">
				<label for="transparent_overlay">Transparent Overlay</label>
			</input>
		</div>
	</div>
	<div class="row">
		<label for="overlay_opacity">Overlay Opacity</label>
		<input name="overlay_opacity" id="overlay_opacity" value="<?php echo @$header_options['overlay_opacity']; ?>" type="text" placeholder="Default 0.6" style="width: 100%;">
	</div>

	
	<?php
}