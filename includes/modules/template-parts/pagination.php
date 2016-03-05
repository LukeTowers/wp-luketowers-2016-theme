<?php
//************************************************************************************************
// Section: 		Pagination
// Description:		Template part that handles pagination on archive pages
//************************************************************************************************

if (!function_exists('display_pagination')) {
	function display_pagination($max_num_pages = '', $current_page = '') {
		global $template_component_args;
		
		if (empty($max_num_pages)) {
			$max_num_pages = @$template_component_args['max_num_pages'];
			if (empty($max_num_pages)) {
				global $wp_query;
				$max_num_pages = $wp_query->max_num_pages;
				if (empty($max_num_pages)) {
					$max_num_pages = 1;
				}
			}
		}
		
		if (empty($current_page)) {
			$current_page = @$template_component_args['current_page'];
			if (empty($current_page)) {
				$current_page = (get_query_var('paged')) ? get_query_var('paged') : 1;
				if (empty($current_page)) {
					$current_page = 1;
				}
			}
		}
		
		
		$pagination_args = array(
			'base'            => get_pagenum_link(1) . '%_%',
			'format'          => 'page/%#%',
			'total'           => $max_num_pages,
			'current'         => $current_page,
			'show_all'        => false,
			'end_size'        => 1,
			'mid_size'        => 2,
			'prev_next'       => true,
			'prev_text'       => '&larr; Previous',
			'next_text'       => 'Next &rarr;',
			'type'            => 'array',
		);
		
		$paginate_links = paginate_links($pagination_args);
		
		if (!empty($paginate_links)) {
			echo "<ul class='pagination'>";
				foreach ($paginate_links as $page_link) {
					if (!empty(strpos($page_link, 'current'))) { $class = 'active custom_colour'; } else { $class = ""; }
					echo '<li class="'.@$class.'">' . $page_link . '</li>';
				}
			echo "</ul>";
		}
	}	
} ?>

<style id="pagination-styles">
	.pagination_container {
		margin: 14px 0px 0px;
	}
	
	.pagination {
		padding: 0px;
		margin: 0px;
	}
	
	.pagination li {
		background-image: none !important;
		background-color: #EEE;
		border-radius: 3px;
	    color: #000;
	    display: inline-block;
	    margin: 0px 10px 10px 0px;
	}
	
	.pagination li > * {
		color: #000;
		display: block;
		padding: 8px 15px;
		border-radius: 3px;
	}
	
	.pagination a:hover, .pagination .active span {
		color: #FFF !important;
		background-color: #4B8C61;
	}
</style>

<div class="pagination_container">
	<?php display_pagination(); ?>
</div>