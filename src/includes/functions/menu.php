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
		$isVisible = (!isset($item['isVisible']) || $item['isVisible'] === true);
		if(!$isVisible) continue;

		$active = ($uri == $item['route']) ? ' active' : '';
		if(isset($item['childrens']) && array_search($uri, array_column($item['childrens'], 'route')) !== false) {
		    $active = ' active';
		}			
		$dropdown = (isset($item['childrens'])) ? 'dropdown' : '';
		$toggle = (isset($item['childrens'])) ? 'class="dropdown-toggle" data-toggle="dropdown"' : '';

		$output .= '<li class="'. $dropdown . $active .'">';
		$output .= '<a '. $toggle .' href="'. site_url($item['route']) .'">'. $item['label'] .'</a>';
		if( isset($item['childrens']) ) {
			$output .= '<ul class="dropdown-menu">';
			$output .= drawAdminMenu($item['childrens']);
			$output .= '</ul>';
		}
		$output .= '</li>';
	}
	return $output;
}