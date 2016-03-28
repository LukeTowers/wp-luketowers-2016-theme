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
			'prev_text'       => '<span class="fa fa-arrow-left"></span>&nbsp;Previous',
			'next_text'       => 'Next&nbsp;<span class="fa fa-arrow-right"></span>',
			'type'            => 'array',
		);
		
		$paginate_links = paginate_links($pagination_args);
		
		$always_display_container = @$template_component_args['always_display_container'];
		
		if (!empty($paginate_links)) {
			echo '<div class="pagination_container contains_pagination">';
				echo '<ul class="pagination">';
					foreach ($paginate_links as $page_link) {
						if (!empty(strpos($page_link, 'current'))) { $class = 'active custom_colour'; } else { $class = ""; }
						echo '<li class="'.@$class.'">' . $page_link . '</li>';
					}
				echo "</ul>";
			echo '</div>';
		} elseif ($always_display_container) {
			echo '<div class="pagination_container"></div>';
		}
	}	
} ?>

<style id="pagination-styles">
	.pagination_container {
		background-color: #041E25;
		min-height: 10px;
	}
	
	.pagination_container.contains_pagination {
		padding: 14px 0px 0px 0px;
		background-color: #FFF;
		text-align: center;
	}
	
	.pagination {
		padding: 0px;
		margin: 0px;
	}
	
	.pagination li {
		text-transform: uppercase;
		text-align: center;
		display: inline-block;
		margin: 0px 14px 14px 0px;
	}
	
	.pagination li > * {
		display: block;
		padding: 10px 25px;
		background-color: #1395BA;
		border-color: #FFF;
		color: #FFF;
		box-shadow: 0px 0px 10px -2px #000 inset;
		font-size: 1.2em !important;
		letter-spacing: 1px;
		-webkit-transition: all .4s ease-in-out;
		-moz-transition: all .4s ease-in-out;
		-o-transition: all .4s ease-in-out;
		-ms-transition: all .4s ease-in-out;
		transition: all .4s ease-in-out;
	}
	
	.pagination a:hover, .pagination a:focus, .pagination .active span {
		background-color: #0C647D;
	}
</style>

<?php display_pagination(); ?>