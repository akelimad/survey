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

use App\Helpers\Form\Validator;
use Mpdf\Mpdf;

class Controller
{

	public function validate($fields, $rules)
	{
		$this->setFieldNames($rules);
		return Validator::is_valid($fields, $this->getRules($rules));
	}


	public function getRules($rules)
	{
		return array_map(function($rule) {
			return trans($rule[0]);
		}, $rules);
	}


	public function setFieldNames($rules)
	{
		Validator::set_field_names(array_map(function($rule) {
			return trans($rule[1]);
		}, $rules));
	}
	

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


	public function validateRecaptcha($params)
	{
		if(get_setting('google_recaptcha_enabled', 0) == 0) {
			return true;
		}

		if (!isset($params['g-recaptcha-response'])) {
			return false;
		}

		return $this->verifyGoogleRecaptcha($params['g-recaptcha-response']);
	}


	public function jsonResponse($status, $message = '', $data = [])
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
	public function getDirectoryFiles($directory)
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

	public static function getUrlParms($param = null, $url = null, $default = null)
	{
		if (is_null($url)) {
			return (isset($_GET[$param])) ? $_GET[$param] : $default;
		}

		$parts = parse_url($url);
		if (!isset($parts['query']))
			return $default;

		parse_str($parts['query'], $query);

		if (is_null($param)) {
			return $query;
		}

		if (isset($query[$param])) {
			return $query[$param];
		}

		return $default;
	}


	public function arrayToCSV($rows = [], $filename, $download = false)
	{
		if ($download) {
			header('Content-Encoding: UTF-8');
	    header("Content-Type: application/vnd.ms-excel");
	    header("Content-Disposition: attachment; filename=\"{$filename}.csv\"");
	 		header("Pragma: no-cache");
	 		header("Expires: 0");
		}

		$csv = "\xEF\xBB\xBF"; // UTF-8 BOM
		for ($i = 0; $i < count($rows); $i++) {
			$row = array_map('trim', $rows[$i]);
      $csv .= implode(';', array_values($row)) . "\n";
		}

    if ($download) {
    	echo $csv;exit;
    } else {
    	return $scv;
    }
	}


	public function htmlToPDF($html, $filename = null, $dest = 'I', $args = [])
  {
    try {
    	$args = array_replace_recursive([
    		'config' => [],
    		'displayMode' => 'fullpage',
    		'defaultFont' => 'Arial',
    	], $args);

    	if (is_null($filename)) {
    		$filename = date('dmY_Hi') .'.pdf';
    	}

    	if (strpos($filename, '.pdf') === false) {
    		$filename = $filename .'.pdf';
    	}

      $mpdf = new Mpdf($args['config']);
      $mpdf->SetDisplayMode($args['displayMode']);
      $mpdf->setDefaultFont($args['defaultFont']);
      $mpdf->WriteHTML($html);
      $mpdf->Output($filename, $dest);
    } catch(\Exception $e) {}
  }


} // END Class