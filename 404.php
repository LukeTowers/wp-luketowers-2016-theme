<?php get_header(); ?>
	<div class="page-content">
		<h1>Nothing here - 404</h1>
		<p>The resource you have requested doesn't exist.</p>
		<div class="sitemap">
			<h2 style="text-align: center;">Site Map</h2>
			<?php
				$sitemap_settings = array(
					'theme_location'  => 'sitemap',
					'container'       => 'div',
					'menu_class'      => 'sitemap-menu',
					'echo'            => true,
					'fallback_cb'     => 'wp_page_menu',
					'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
					'after'			  => '<div class="clearfix"></div>',
					'depth'           => 0,
				);
				
				wp_nav_menu($sitemap_settings);
			?>
		</div>
	</div>
<?php get_footer(); ?>