<?php
/**
 * Menus
 *
 * @author mchanchaf
 * @since 05/01/2018
 */


/**
 * Draw admin menu HTML
 *
 * @param $array array
 * @return $output
 */
function drawAdminMenu($array) {
	if (empty($array)) return '';

	$output = '';
	$uri = str_replace(site_url(), '', get_current_url());
	foreach ($array as $key => $item) {
		$show = (!isset($item['show']) || $item['show'] === true);
		if(!$show) continue;
		
		$active = ($uri == $item['uri']) ? ' active' : '';
		if(isset($item['sub_menu']) && array_search($uri, array_column($item['sub_menu'], 'uri')) !== false) {
		    $active = ' active';
		}			
		$dropdown = (isset($item['sub_menu'])) ? 'dropdown' : '';
		$toggle = (isset($item['sub_menu'])) ? 'class="dropdown-toggle" data-toggle="dropdown"' : '';

		$output .= '<li class="'. $dropdown . $active .'">';
		$output .= '<a '. $toggle .' href="'. site_url($item['uri']) .'">'. $item['name'] .'</a>';
		if( isset($item['sub_menu']) ) {
			$output .= '<ul class="dropdown-menu">';
			$output .= drawAdminMenu($item['sub_menu']);
			$output .= '</ul>';
		}
		$output .= '</li>';
	}
	return $output;
}