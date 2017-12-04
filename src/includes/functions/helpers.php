<?php
/**
 * Unlink file
 *
 * @return string $path
 */
function unlinkFile($path) {
	chown($path, 666);
	if (unlink($path))
		return true;

	return false;
}


/**
 * Redirect to another page or url
 *
 * @return string $url
 */
function redirect($url, $timer=null) {
	if (strpos($url, 'http') === false) $url = site_url($url);

	if( is_null($timer) ) {
		header("Location: ".$url);exit;
	} else {
		header('Refresh: '. $timer .'; URL='.$url);
	}
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
	<h2 id="cim_page_title">'. $page_title .'</h2><nav id="breadcrumbs"><ul><li>Vous Ãªtes ici :</li><li><a href="'. site_url() .'">Accueil</a></li>';

	if( !empty($args['items']) ) : foreach ($args['items'] as $key => $item) :
		$breadcrumbs .= '<li><a href="'. $item['url'] .'">'. $item['name'] .'</a></li>';
	endforeach; endif;

	$breadcrumbs .= '<li>'. $page_title .'</li></ul></nav></div>';

	if(!empty($args['buttons'])) :
		$breadcrumbs .= '<div class="col-md-3">';
		foreach ($args['buttons'] as $key => $btnArgs) :
			$btnDefaultArgs = array(
				'text'  => 'Sans titre',
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
 * Get alert
 *
 * @param string $type
 * @param mixt $messages
 * @param bool $dismiss
 *
 * @author Mhamed Chanchaf
 */
function get_alert($type, $messages, $dismiss=true){
	\App\View::get('alerts/'.$type, [
		'messages' => (is_array($messages)) ? $messages : array($messages),
		'dismissible' => $dismiss
	]);
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
		return ( isset($_SESSION['abb_login_candidat']) );
		break;
		case 'employeur':
		return ( isset($_SESSION['login']) );
		break;
		case 'admin':
		return ( isset($_SESSION['abb_admin']) );
		break;
		case 'agentcom':
		return ( isset($_SESSION['agentcom']) );
		break;
	}
	return false;
}


/**
 * Get logged candidat ID
 *
 * @return $candidat_id
 *
 * @author Mhamed Chanchaf
 */
function get_candidat_id(){
	return $_SESSION['abb_id_candidat'] ?: false;
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
 * Get candidat pertinance
 *
 * @param int $id_candidat
 *
 * @return $pertinance
 *
 * @author Mhamed Chanchaf
 */
function get_candidat_offre_pertinence($id_candidat, $id_offre) {
	$db = getDB();
	$candidat = $db->_prepare("SELECT domaine, experience FROM candidats WHERE candidats_id=?", [$id_candidat], true);
	$offre = $db->_prepare("SELECT id_sect, id_expe FROM offre WHERE id_offre=?", [$id_offre], true);

	if( !$candidat || !$offre )
		return false;

	// Calculate pertinance
	if( $candidat->domaine != $offre->id_sect && $candidat->experience != $offre->id_expe )
	{
		$pertinence = 0;
	} else if(
		( $candidat->domaine == $offre->id_sect && $candidat->experience != $offre->id_expe ) || 
		( $candidat->domaine != $offre->id_sect && $candidat->experience == $offre->id_expe )
	) {
		$pertinence = 50;
	} else {
		$pertinence = 100;
	}
	return $pertinence;
}


/**
 * Validate date format
 *
 * @param date $date
 *
 * @return bool
 *
 * @author Mhamed Chanchaf
 */
function isValidDate($date)
{
	$d = DateTime::createFromFormat('Y-m-d', $date);
	return $d && $d->format('Y-m-d') === $date;
}





/**
 * Get config value
 *
 * @param string $name
 * @return string
 *
 * @author Mhamed Chanchaf
 */
function get_config($name){
	$config = getDB()->findByColumn('configuration', 'name', $name, ['limit'=>1]);
	return ( isset($config->value) ) ? json_decode($config->value, true) : false;
}


/**
 * Get config value
 *
 * @param string $name
 * @param string $value
 * @return string
 *
 * @author Mhamed Chanchaf
 */
function save_config($name, $value){
	$db = getDB();
	$config = get_config($name);

	if( is_array($value) ) {
		$value = json_encode($value, JSON_UNESCAPED_UNICODE);
	}

	if( empty($config) ) {
		return $db->create('configuration', [
			'name' => $name,
			'value' => $value
		]);
	} else {
		return $db->update('configuration', 'name', $name, [
			'value' => $value
		]);
	}
}

/**
 * Delete config value
 *
 * @param string $name
 * @return boolean
 *
 * @author Mhamed Chanchaf
 */
function remove_config($name){
	return getDB()->delete('configuration', 'name', $name);
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