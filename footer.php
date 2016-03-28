			</div> <!-- page_container -->
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