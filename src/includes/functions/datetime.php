<?php
/**
 * Datetime
 *
 * @author mchanchaf
 * @since 03/10/2017
 */


/**
 * Format date
 *
 * @param string $date
 * @param string $format
 * @param bool $strftime
 *
 * @return string $date_formated
 */
function eta_date($date, $format = null, $strftime = false) {
	// Transforme frensh date to englich date
	if ( preg_match("/^(0[1-9]|[1-2][0-9]|3[0-1])\/(0[1-9]|1[0-2])\/[0-9]{4} [0-9]{2}:[0-9]{2}$/", $date) ) {
		$date = french_to_english_datetime($date);
	} else if ( preg_match("/^(0[1-9]|[1-2][0-9]|3[0-1])\/(0[1-9]|1[0-2])\/[0-9]{4}$/", $date) ) {
		$date = french_to_english_date($date);
	}

	// Get default format
	$fromFormat = 'Y-m-d';
	$date_format = 'date_format';
	if (strlen($date) > 10) {
		$fromFormat = 'Y-m-d H:i:s';
		$date_format = 'datetime_format';
	}
	if (is_null($format)) $format = get_setting($date_format);

	// Format date
	if ($strftime) {
		$date = utf8_encode(strftime($format, strtotime($date)));
    return ucwords($date);
	} elseif (\DateTime::createFromFormat($fromFormat, $date)) {
		return \DateTime::createFromFormat($fromFormat, $date)->format($format);
	}
	return $date;
}


/**
 * Get English date from French date
 *
 * @param string $date
 *
 * @return string $french_date
 */
function french_to_english_date($date, $format='Y-m-d') {
	if(\DateTime::createFromFormat('d/m/Y', $date)) {
		return \DateTime::createFromFormat('d/m/Y', $date)->format($format);
	}
	return null;
}

/**
 * Get English datetime from French datetime
 *
 * @param string $datetime
 *
 * @return string $french_datetime
 */
function french_to_english_datetime($datetime, $format='Y-m-d H:i:s') {
	if(\DateTime::createFromFormat('d/m/Y H:i:s', $datetime)) {
		return \DateTime::createFromFormat('d/m/Y H:i:s', $datetime)->format($format);
	}
	return null;
}

/**
 * Get French date from English date
 *
 * @param string $date
 *
 * @return string $english_date
 */
function english_to_french_date($date, $format='d/m/Y') {
	if(\DateTime::createFromFormat('Y-m-d', $date)) {
		return \DateTime::createFromFormat('Y-m-d', $date)->format($format);
	}
	return null;
}

/**
 * Get French time from English datetime
 *
 * @param string $datetime
 *
 * @return string $english_datetime
 */
function english_to_french_datetime($datetime, $format='d/m/Y H:i') {
	if(\DateTime::createFromFormat('Y-m-d H:i:s', $datetime)) {
		return \DateTime::createFromFormat('Y-m-d H:i:s', $datetime)->format($format);
	}
	return null;
}


/**
 * Validate date format
 *
 * @param date $date
 * @param string $format
 *
 * @return bool
 *
 * @author Mhamed Chanchaf
 */
function isValidDate($date, $format = 'Y-m-d')
{
	$d = \DateTime::createFromFormat($format, $date);
	return $d && $d->format($format) === $date;
}



function timeAgo($date, $granularity = 2) {
	if(!isValidDate($date, 'Y-m-d H:i:s'))
		return '---';
		
	$date = strtotime($date);
	$difference = time() - $date;
	$periods = array(
		trans("decade") => 315360000,
		trans("année")   => 31536000,
		trans("mois")  => 2628000,
		trans("semaine")   => 604800, 
		trans("jour")    => 86400,
		trans("heure")   => 3600,
		trans("minute") => 60,
		trans("seconde") => 1
	);
	
	$retval = '';
	if ($difference < 1)
	{
		$retval = trans("moins de 1 second");
	}
	else
	{
		foreach ($periods as $key => $value)
		{
			if ($difference >= $value)
			{
				$time = floor($difference/$value);
				$difference %= $value;
				$retval .= ($retval ? ' ' : '').$time.' ';
				$retval .= (($time > 1 && $key != trans("mois")) ? $key.'s' : $key);
				$granularity--;
			}
			if ($granularity == '0')
			{
				break;
			}
		}
	}
	return $retval;      
}