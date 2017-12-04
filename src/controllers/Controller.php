<?php
/** 
 * Controller
 *
 * @author Mhamed Chanchaf
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

	


} // END Class