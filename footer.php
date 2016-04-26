			</div> <!-- page_container -->
			<div class="home-section section-contact">
				<h2 class="section-title">Contact Me</h2>
				<div class="contact-form">
					<?php echo do_shortcode('[gravityform id="1" title="false" description="false" ajax="true"]'); ?>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="footer_container">
				<div class="footer-logo">
					<a href="<?php echo home_url(); ?>">
						<img src="<?php echo LUKE_2016_TEMPLATE_URL . 'includes/images/site-logo-white.png'; ?>" alt="<?php echo bloginfo('name'); ?>">
					</a>
				</div>
				<?php echo get_template_component('social-links'); ?>
				<div class="copyright">
					<span>&copy; <?php echo date('Y'); ?> <a href="<?php echo home_url(); ?>"><?php echo bloginfo('name'); ?></a></span>
				</div>
				<div class="clearfix"></div>
			</div>
		</div> <!-- site_container -->
		<?php wp_footer(); ?>
		
		<!-- Google Analytics -->
			<?php if (!empty(site_setting('ga-property-id'))) { ?>
				<script>
					(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
					(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
					m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
					})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
					
					ga('create', '<?php echo site_setting('ga-property-id'); ?>', 'auto');
					ga('send', 'pageview');
				</script>
			<?php } ?>
		<!-- Google Analytics -->
	</body>
</html>