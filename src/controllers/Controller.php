<?php
/**
 * Controller
 *
 * @author M'hamed Chanchaf <m.chanchaf@gmail.com>
 *
 * @package app.controllers
 * @version 1.0
 * @since 1.5.0
 */
namespace App\Controllers; 


class Controller
{

	

	/**
	 * Get Prev Key From array
	 *
	 * @author Mhamed Chanchaf
	 */
	public function getPrevKey($key, $hash=array())
	{
		$keys = array_keys($hash);
		$found_index = array_search($key, $keys);
		if ($found_index === false || $found_index === 0)
			return false;
		return $keys[$found_index-1];
	}





	public function percent2Color($value, $brightness = 255, $max = 100, $min = 0, $thirdColorHex = '00')
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

	


} // END Class