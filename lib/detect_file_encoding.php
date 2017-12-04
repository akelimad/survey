<?php
$files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator( dirname(__FILE__) ));
foreach ($files as $filename => $file) {
	//check string strict for encoding out of list of supported encodings
	$enc = mb_detect_encoding($file, mb_list_encodings(), true);

	if ($enc!=="UTF-8"){
echo $file .'<br>';
	}

	// if( is_file($file) && !detectFileEncoding($file) ) {
	// 	echo $file .'<br>';
	// }
}