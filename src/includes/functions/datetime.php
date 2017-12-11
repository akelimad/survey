<?php
/**
 * Datetime
 *
 * @author M'hamed Chanchaf <m.chanchaf@gmail.com>
 * @since 03/10/2017
 */


/**
 * Get English date from French date
 *
 * @param string $date
 *
 * @return string $french_date
 */
function french_to_english_date($date) {
	return \DateTime::createFromFormat('d/m/Y', $date)->format('Y-m-d');
}

/**
 * Get English datetime from French datetime
 *
 * @param string $datetime
 *
 * @return string $french_datetime
 */
function french_to_english_datetime($datetime) {
	return \DateTime::createFromFormat('d/m/Y H:i', $datetime)->format('Y-m-d H:i:s');
}

/**
 * Get French date from English date
 *
 * @param string $date
 *
 * @return string $english_date
 */
function english_to_french_date($date) {
	return \DateTime::createFromFormat('Y-m-d', $date)->format('d/m/Y');
}

/**
 * Get French time from English datetime
 *
 * @param string $datetime
 *
 * @return string $english_datetime
 */
function english_to_french_datetime($datetime) {
	return \DateTime::createFromFormat('Y-m-d H:i:s', $datetime)->format('d/m/Y H:i');
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


function timeAgo($date, $granularity = 2) {
	$date = strtotime($date);
	$difference = time() - $date;
	$periods = array(
		'decade' => 315360000,
		'année'   => 31536000,
		'mois'  => 2628000,
		'semaine'   => 604800, 
		'jour'    => 86400,
		'heure'   => 3600,
		'minute' => 60,
		'seconde' => 1);
	
	$retval = '';
	if ($difference < 1)
	{
		$retval = "moins de 1 second";
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
				$retval .= (($time > 1 && $key !='mois') ? $key.'s' : $key);
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