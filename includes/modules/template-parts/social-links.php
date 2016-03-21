<?php
//************************************************************************************************
// Section: 		Social Links Module
// Description:		Module that manages the social links component used by this theme
//************************************************************************************************

global $template_component_args;
?>
<div class="social_links_container <?php echo @$template_component_args['class']; ?>">
	<span class="social-links">
		<a href="mailto:<?php echo site_setting('contact_email'); ?>" target="_blank"><span class="fa fa-envelope"></span></a>
		<a href="https://bitbucket.org/LukeTowers/" target="_blank"><span class="fa fa-bitbucket"></span></a>
		<a href="https://twitter.com/@<?php echo site_setting('twitter_handle'); ?>" target="_blank"><span class="fa fa-twitter"></span></a>
		<a href="<?php echo site_setting('instagram_url'); ?>" target="_blank"><span class="fa fa-instagram"></span></a>
<!-- 	<a href="<?php echo site_setting('google_plus_url'); ?>" target="_blank"><span class="fa fa-google-plus-square"></span></a> -->
		<a href="<?php echo site_setting('linkedin_url'); ?>" target="_blank"><span class="fa fa-linkedin-square"></span></a>
		<a href="<?php echo site_setting('youtube_url'); ?>" target="_blank"><span class="fa fa-youtube-play"></span></a>
	</span>
</div>