<?php
/**
 * Helpers
 *
 * @author mchanchaf
 * @since 04/10/2017
 */


/**
 * Redirect to another page or url
 *
 * @return string $url
 */
function redirect($url, $timer=null) {
	if (strpos($url, 'http') === false) $url = site_url($url);

	if(!headers_sent()) {
      //If headers not sent yet... then do php redirect
		if( is_null($timer) ) {
			header("Location: ".$url);exit;
		} else {
			header('Refresh: '. $timer .'; URL='.$url);
		}
	} else {
      //If headers are sent... do javascript redirect... if javascript disabled, do html redirect.
		echo '<script type="text/javascript">';
		echo 'window.location.href="'.$url.'";';
		echo '</script>';
		echo '<noscript>';
		echo '<meta http-equiv="refresh" content="'. intval($timer) .';url='.$url.'" />';
		echo '</noscript>';
		exit;
	}
}


/**
 * Tell if a page is being called via Ajax
 *
 * @return bool
 */
function is_ajax() {
	return ( 
		isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
		strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
	);
}


/**
 * Get breadcrumbs
 *
 * @param string $page_title
 * @param array $args
 *
 * @return html $breadcrumbs
 */
function get_breadcrumbs($page_title, $args=[]) {
	$class = (!empty($args['buttons'])) ? 'col-md-9' : 'col-md-12';
	$breadcrumbs = '<section id="titlebar2"><div class="container"><div class="row mb-0"><div class="'. $class .'">
        <h2 id="cim_page_title">'. $page_title .'</h2><nav id="breadcrumbs"><ul><li>'. trans("Vous êtes ici:") .'</li><li><a href="'. site_url() .'">'. trans("Accueil") .'</a></li>';

		if( !empty($args['items']) ) : foreach ($args['items'] as $key => $item) :
			$breadcrumbs .= '<li><a href="'. $item['url'] .'">'. $item['name'] .'</a></li>';
		endforeach; endif;

	$breadcrumbs .= '<li>'. $page_title .'</li></ul></nav></div>';

    if(!empty($args['buttons'])) :
   		$breadcrumbs .= '<div class="col-md-3">';
   		foreach ($args['buttons'] as $key => $btnArgs) :
   			$btnDefaultArgs = array(
		        'text'  => trans("Sans titre"),
		        'href'  => '#',
		        'class' => 'btn btn-default',
		        'icon'  => ''
		    );
   		$args = array_merge($btnDefaultArgs, $btnArgs);

   		$icon = ($args['icon']!='') ? '<i class="'. $args['icon'] .'"></i>&nbsp;' : '';
   		$breadcrumbs .= '<a class="'. $args['class'] .'" href="'. $args['href'] .'">'. $icon . $args['text'] .'</a>';

   		endforeach;
   		$breadcrumbs .= '</div>';
    endif;

    $breadcrumbs .= '</div></section>';

	print($breadcrumbs);
}


/**
 * Content Word Limit
 *
 * @param string $content
 * @param int $limit
 * @return $content
 */ 
function word_limit($content, $limit) {
	$limit += 1;
	$content = explode(' ', $content, $limit);
	if (count($content)>=$limit) {
		array_pop($content);
		$content = implode(" ", $content).'...';
	} else {
		$content = implode(" ", $content);
	} 
	$content = preg_replace('/\[.+\]/','', $content);
	$content = str_replace(']]>', ']]&gt;', $content);
	return $content;
}


/**
 * Limit text length
 *
 * @param string $content
 * @param int $limit
 * @return $content
 */ 
function letters_limit($content, $limit) {
	// strip tags to avoid breaking any html
	$content = strip_tags($content);
	if (strlen($content) > $limit) {
	    // truncate content
	    $stringCut = substr($content, 0, $limit);
	    // make sure it ends in a word so assassinate doesn't become ass...
	    $content = substr($stringCut, 0, strrpos($stringCut, ' ')).'...'; 
	}
	return $content;
}



/**
 * Tell if backend
 *
 * @return bool
 *
 * @author Mhamed Chanchaf
 */
function isBackend(){
	$backend = site_url('backend');
	if (preg_match("!$backend!", get_current_url(), $match) === 1) {
		return true;
	}
	return false;
}


/**
 * Tell if user logged by account type
 *
 * @param string $accountType
 *
 * @return bool
 *
 * @author Mhamed Chanchaf
 */
function isLogged($accountType){
	switch ($accountType) {
		case 'candidat':
			return (\App\Session::get('abb_login_candidat', false) !== false);
			break;
		case 'admin':
			return (\App\Session::get('abb_admin', false) !== false);
			break;
	}
	return false;
}


/**
 * Slug to capitalize
 *
 * @param string $slug
 *
 * @return $slug_capitalized
 *
 * @author Mhamed Chanchaf
 */
function slug_to_capitalize($slug) {
	$slug = preg_replace("!-|_!", " ", $slug);
	$slug = ucwords($slug);
	$slug_capitalized = str_replace(' ', '_', $slug);
	return $slug_capitalized;
}


/**
 * Get page number
 *
 * @return $page_number
 *
 * @author Mhamed Chanchaf
 */
function get_page_number() {
	return (
		isset($_GET['page']) && 
		is_numeric($_GET['page']) &&
		$_GET['page'] > 0
	) ? intval($_GET['page']) : 1;
}


/**
 * Hyphens and dashes to camelcase
 *
 * @param string $string
 * @param boolean $capitalizeFirstCharacter
 * @return boolean
 *
 * @author Mhamed Chanchaf
 */
function dashesToCamelCase($string, $capitalizeFirstCharacter = true) 
{
  $str = str_replace(' ', '', ucwords(preg_replace('/[-_]/', ' ', $string)));
  if (!$capitalizeFirstCharacter) {
    $str[0] = strtolower($str[0]);
  }
  return $str;
}


/**
 * GENERATE RANDOM REFERENCE
 *
 * @param string $length number of caracters.
 * @param int    $length number of caracters.
 *
 * @return string $reference.
 */
function generate_reference($table, $length=8) {
	$lastID = getDB()->read($table, array('id'), true);
	$lastID = ($lastID) ? $lastID->id : 0;
	$reference = intval($lastID) + 1;
	$char_length = $length - strlen( $reference );
	$characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$charactersLength = strlen($characters);
	for ($i = 0; $i < $char_length; $i++) {
		$reference .= $characters[rand(0, $charactersLength - 1)];
	}
	return str_shuffle($reference);
}


/**
 * Sort a 2 dimensional array based on 1 or more indexes.
 * 
 * array_sort() can be used to sort a rowset like array on one or more
 * 'headers' (keys in the 2th array).
 * 
 * @param array        $array      The array to sort.
 * @param string|array $key        The index(es) to sort the array on.
 * @param int          $sort_flags The optional parameter to modify the sorting 
 *                                 behavior. This parameter does not work when 
 *                                 supplying an array in the $key parameter. 
 * 
 * @return array The sorted array.
 */
function etalent_array_sort($array, $key, $sort_flags = SORT_REGULAR) {
	if (is_array($array) && count($array) > 0) {
		if (!empty($key)) {
			$mapping = array();
			foreach ($array as $k => $v) {
				$sort_key = '';
				if (!is_array($key)) {
					$sort_key = $v[$key];
				} else {
					// This should be fixed, now it will be sorted as string
					foreach ($key as $key_key) {
						$sort_key .= $v[$key_key];
					}
					$sort_flags = SORT_STRING;
				}
				$mapping[$k] = $sort_key;
			}
			asort($mapping, $sort_flags);
			$sorted = array();
			foreach ($mapping as $k => $v) {
				$sorted[] = $array[$k];
			}
			return $sorted;
		}
	}
	return $array;
}


function isAssoc(array $arr)
{
    if (array() === $arr) return false;
    return array_keys($arr) !== range(0, count($arr) - 1);
}


function cim_date_diff($date1, $date2) {
    $s = strtotime($date2) - strtotime($date1);
    $d = intval($s / 86400) + 1;
    return "$d";
}


function is_valid_int($number){
  return is_numeric($number) && $number >= 0;
}


// if array_column does not exist the below solution will work.
if(!function_exists("array_column")) {
	function array_column($array, $column_name) {
	  return array_map(function($element) use($column_name){return $element[$column_name];}, $array);
	}
}


/**
 * Convert HEX to RGB
 *
 * @param string $colour
 * @return boolean
 *
 * @author Mhamed Chanchaf
 */
function hex2rgb( $colour ) {
	if ( $colour[0] == '#' ) {
		$colour = substr( $colour, 1 );
	}
	if ( strlen( $colour ) == 6 ) {
		list( $r, $g, $b ) = array( $colour[0] . $colour[1], $colour[2] . $colour[3], $colour[4] . $colour[5] );
	} elseif ( strlen( $colour ) == 3 ) {
		list( $r, $g, $b ) = array( $colour[0] . $colour[0], $colour[1] . $colour[1], $colour[2] . $colour[2] );
	} else {
		return false;
	}
	$r = hexdec( $r );
	$g = hexdec( $g );
	$b = hexdec( $b );
	return array( 'red' => $r, 'green' => $g, 'blue' => $b );
}


/**
 * Css rule from hex color
 *
 * @param string $colour
 * @return boolean
 *
 * @author Mhamed Chanchaf
 */
function css_bg_from_hex($colour, $opacity=0) {
	$rgb = hex2rgb($colour);
	return "rgba(". $rgb['red'] .", ". $rgb['green'] .", ". $rgb['blue'] .", ". $opacity .")";
}


function safe_show($value){  
  $str_value =str_replace('"', "'", $value); 
   return addslashes($str_value); 
} 

function safe($value){ 
   return mysql_real_escape_string($value); 
} 


function percent2Color($value, $brightness = 255, $max = 100, $min = 0, $thirdColorHex = '00')
{       
	// Calculate first and second color (Inverse relationship)
	$first = (1-($value/$max))*$brightness;
	$second = ($value/$max)*$brightness;

	// Find the influence of the middle color (yellow if 1st and 2nd are red and green)
	$diff = abs($first-$second);    
	$influence = ($brightness-$diff)/2;     
	$first = intval($first + $influence);
	$second = intval($second + $influence);

	// Convert to HEX, format and return
	$firstHex = str_pad(dechex($first),2,0,STR_PAD_LEFT);     
	$secondHex = str_pad(dechex($second),2,0,STR_PAD_LEFT); 

	return $firstHex . $secondHex . $thirdColorHex ; 

    // alternatives:
    // return $thirdColorHex . $firstHex . $secondHex; 
    // return $firstHex . $thirdColorHex . $secondHex;
}


/**
 * Debug var
 *
 * @param mixed $var
 *
 * @return string
 */
function dump($var, $exit=true) {
	echo '<pre>';
	if( is_array($var) ) {
		print_r($var);
	} else {
		var_dump($var);
	}
	echo '</pre>';
	if( $exit ) exit;
}