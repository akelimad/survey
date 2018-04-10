<?php
/**
 * Controller
 *
 * @author mchanchaf
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
	}


	public function verifyGoogleRecaptcha($response)
	{
		$secret = get_setting('google_recaptcha_secret');
		$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=". $secret ."&response=". $response);
		$response = json_decode($response, true);
		return ($response["success"] === true);
	}


	public function jsonResponse($status, $message, $data = [])
	{
		return json_encode(['status' => $status, 'message' => $message, 'data' => $data]);
	}


	public function koToOctet($size)
	{
		return round($size * 1024, 2);
	}


	public function octetToKo($size)
	{
		return round($size/1024, 2);
  }


	/**
	 * Generate random string
	 *
	 * @param int $length
	 *
	 * @return string $string
	 *
	 * @author Mhamed Chanchaf
	 */
	public function randomString($length=6)
	{
    return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
	}


	/**
	 * Get files recursively inside a directory
	 *
	 * @param string $directory
	 *
	 * @return array $files
	 */
	function getDirectoryFiles($directory)
	{
	  $files = [];
		if ($h = opendir($directory)) {
		  while (($item = readdir($h)) !== false) {
	      $f = $directory . '/' . $item;
	      if (is_file($f))  {
	        $files[] = $f;
	      }
	      else
	      if (is_dir($f) && !preg_match("/^[\.]{1,2}$/uis", $item)) {
	        $files = array_merge($files, $this->getDirectoryFiles($f));
	      }
		  }
		  closedir($h);
		}
		return $files;
	}


} // END Class