<?php









session_start();

 



if (!isset($_SESSION["abb_admin"]) || $_SESSION["abb_admin"] == "") {



    header("Location: ../../");



}  



require_once dirname(__FILE__) . "/../../../../../config/config.php";



?>





<?php



/******************* Upload ***********************/



$allowedExts = array("doc","docx","pdf");   



/*



$temp = explode(".", $_FILES["file"]["name"]);



$extension = end($temp);



//*/



  if( isset($_FILES["file"]["name"])and (($_FILES["file"]["name"] != "") OR ($_FILES["file"]["type"] != "") OR ($_FILES["file"]["size"] != "") OR ($_FILES["file"]["error"] != "") OR ($_FILES["file"]["tmp_name"] != "")  ))



  {



         $_SESSION['f_name0']= $_FILES["file"]["name"]; 



         $_SESSION['f_name']="" . __DIR__ . $file_cv_import3 . $_FILES["file"]["name"];



         $_SESSION['f_type']=$_FILES["file"]["type"];



         $_SESSION['f_size']=$_FILES["file"]["size"];



         $_SESSION['f_error']=$_FILES["file"]["error"];



         $_SESSION['f_tmp_name']=$_FILES["file"]["tmp_name"];



  }



  





  $temp = explode(".", $_SESSION['f_name']);



  $extension = end($temp);







if ( ($_SESSION['f_size'] < 900000) && in_array($extension, $allowedExts))



{



   if ($_SESSION['f_error'] > 0) {



   echo "Error: " . $_SESSION['f_error'] . "<br>";



  } 



  else {



 

  if( isset($_FILES["file"]["tmp_name"])and $_FILES["file"]["tmp_name"]!="")

  copy($_FILES["file"]["tmp_name"], SITE_BASE . '/apps/upload/backend/cv_import_uploads/'. basename($_SESSION['f_name']))  or 



           die( "Could not copy file! ". basename($_SESSION['f_name']));



           



}



}

else {

$messages=array();

array_push($messages,'<div class="alert alert-error"><li style="color:#FF0000">Veuillez respercter le format de fichier ( word (doc,docx),pdf ) </li></ul></div>');

$_SESSION['msg_erreur_impcv'] = $messages ;

/*header("Location: ".$urlad_cand."/import_manuel_des_cv/?e=1");

echo '<meta http-equiv=\'refresh\' content="0;'.$urlad_cand.'/import_manuel_des_cv/?e=1" />';*/

}





?>



 





<?php

/******************* Pdf or Word *******************/



if($_SESSION['f_type'] == "application/msword"){


$userDoc = site_base('apps/upload/backend/cv_import_uploads/'.basename($_SESSION['f_name']));



$text = parseWord($userDoc);

//echo $text ."doc";

$pass= Matching($text);



//echo $pass[1];



}

if($_SESSION['f_type'] == "application/vnd.openxmlformats-officedocument.wordprocessingml.document"){



$userDoc = site_base('apps/upload/backend/cv_import_uploads/'.basename($_SESSION['f_name']));



   $text =  readZippedXML($userDoc, "word/document.xml"); 

//echo $text ."doc";

$pass= Matching($text);



//echo $pass[1];



}



 if($_SESSION['f_type'] == "application/pdf"){



$userDoc = site_base('apps/upload/backend/cv_import_uploads/'.basename($_SESSION['f_name']));

$text = pdf2text($userDoc);

//echo $text ."pdf";

$pass= Matching($text);} 



/******************* readZippedXML *******************/



function readZippedXML($archiveFile, $dataFile) {

    // Create new ZIP archive

    $zip = new ZipArchive;



    // Open received archive file

    if (true === $zip->open($archiveFile)) {

        // If done, search for the data file in the archive

        if (($index = $zip->locateName($dataFile)) !== false) {

            // If found, read it to the string

            $data = $zip->getFromIndex($index);

            // Close archive file

            $zip->close();

            // Load XML from a string

            // Skip errors and warnings

            $xml = new DOMDocument(); 

            $xml->loadXML($data, LIBXML_NOENT | LIBXML_XINCLUDE | LIBXML_NOERROR | LIBXML_NOWARNING);

            // Return data without XML formatting tags

            return strip_tags($xml->saveXML());

        }

        $zip->close();

    }



    // In case of failure return empty string

    return "";

}



/******************* Matching *******************/





function Matching($outtext) 



{



    $mail = '/[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,3})/';



    $date = '/[0-9]{2}[- \/][0-9]{2}[- \/][0-9]{2,4}/';



    $tel = '/06[0-9 ]{8,12}|\+2126[0-9]{8,12}/';



    $name = '/[A-Z][a-z]{2}.[a-z]*[ ]{1,2}[A-Z]{3}[A-Z]*|[A-Z]{3}.[A-Z]*[ ]{1,2}[A-Z][a-z]{2}.[a-z]*/';



    $L_name ='/[A-Z]{3}[A-Z]*|[A-Z]{3}.[A-Z]*/';



    $F_name ='/[A-Z][a-z]{2}.[a-z]*|[A-Z][a-z]{2}.[a-z]*/';



    $nom = '/[A-Z][a-z]+/';



    $prenom = '/^.[A-Z][A-Z]*$/';



    $Arabe = '/Arabe/';



    $Francais = '/Français/';



    $Anglais = '/Anglais/';



    $Espagnol = '/Espagnol/';



    $ville = '/RABAT|Rabat|Casablanca|Fes|Tanger|Essaouira|Mohammedia|Kénitra/';



    



    

//* 

    



    if (preg_match($mail , $outtext, $matches))



    $var[1]= str_replace('mailto', '', $matches[0]); 



    if (preg_match($date , $outtext, $matches))



    $var[2]= $matches[0];



    if (preg_match($tel , $outtext, $matches))



    $var[3]= $matches[0];



    if (preg_match($name , $outtext, $matches))



    $full= (isset($matches[0])) ? $matches[0] : '' ;



    if (preg_match($L_name , $full, $matches))



    $var[4]= $matches[0];



    if (preg_match($F_name , $full, $matches))



    $var[5]= (isset($matches[0])) ? $matches[0] : '' ;



     if (preg_match($Arabe , $outtext, $matches))



    $var[6]= $matches[0];



    if (preg_match($Francais , $outtext, $matches))



    $var[7]= $matches[0];



    if (preg_match($Anglais , $outtext, $matches))



    $var[8]= $matches[0]; 



    if (preg_match($Espagnol , $outtext, $matches))



    $var[9]= $matches[0];


    return $var;

 //*/

}



 

 

/******************* Parsing Word*******************/



function parseWord($userDoc) 



{



    $fileHandle = fopen($userDoc, "r");



    $line = @fread($fileHandle, filesize($userDoc));   



    $lines = explode(chr(0x0D),$line);



    $outtext = "";



    foreach($lines as $thisline)



      {



        $pos = strpos($thisline, chr(0x00));



        if (($pos !== FALSE)||(strlen($thisline)==0))



          {



          } else {



            $outtext .= $thisline."<br>";



          }



      }



     $outtext = preg_replace("/[^a-zA-Z0-9\s\,\.\-\n\r\t@\/\_\(\)]/","",$outtext);



    return $outtext;



} 



/******************* Parsing PDF*******************/



function decodeAsciiHex($input) {



    $output = "";



    $isOdd = true;



    $isComment = false;



    for($i = 0, $codeHigh = -1; $i < strlen($input) && $input[$i] != '>'; $i++) {



        $c = $input[$i];



        if($isComment) {



            if ($c == '\r' || $c == '\n')



                $isComment = false;



            continue;



        }



        switch($c) {



            case '\0': case '\t': case '\r': case '\f': case '\n': case ' ': break;



            case '%': 



                $isComment = true;



            break;



            default:



                $code = hexdec($c);



                if($code === 0 && $c != '0')



                    return "";



                if($isOdd)



                    $codeHigh = $code;



                else



                    $output .= chr($codeHigh * 16 + $code);



                $isOdd = !$isOdd;



            break;



        }



    }



    if($input[$i] != '>')



        return "";



    if($isOdd)



        $output .= chr($codeHigh * 16);



    return $output;



}



function decodeAscii85($input) {



    $output = "";



    $isComment = false;



    $ords = array();



    



    for($i = 0, $state = 0; $i < strlen($input) && $input[$i] != '~'; $i++) {



        $c = $input[$i];



        if($isComment) {



            if ($c == '\r' || $c == '\n')



                $isComment = false;



            continue;



        }



        if ($c == '\0' || $c == '\t' || $c == '\r' || $c == '\f' || $c == '\n' || $c == ' ')



            continue;



        if ($c == '%') {



            $isComment = true;



            continue;



        }



        if ($c == 'z' && $state === 0) {



            $output .= str_repeat(chr(0), 4);



            continue;



        }



        if ($c < '!' || $c > 'u')



            return "";



        $code = ord($input[$i]) & 0xff;



        $ords[$state++] = $code - ord('!');



        if ($state == 5) {



            $state = 0;



            for ($sum = 0, $j = 0; $j < 5; $j++)



                $sum = $sum * 85 + $ords[$j];



            for ($j = 3; $j >= 0; $j--)



                $output .= chr($sum >> ($j * 8));



        }



    }



    if ($state === 1)



        return "";



    elseif ($state > 1) {



        for ($i = 0, $sum = 0; $i < $state; $i++)



            $sum += ($ords[$i] + ($i == $state - 1)) * pow(85, 4 - $i);



        for ($i = 0; $i < $state - 1; $i++)



            $ouput .= chr($sum >> ((3 - $i) * 8));



    }



    return $output;



}



function decodeFlate($input) {



    return @gzuncompress($input);



}



function getObjectOptions($object) {



    $options = array();



    if (preg_match("#<<(.*)>>#ismU", $object, $options)) {



        $options = explode("/", $options[1]);



        @array_shift($options);



        $o = array();



        for ($j = 0; $j < @count($options); $j++) {



            $options[$j] = preg_replace("#\s+#", " ", trim($options[$j]));



            if (strpos($options[$j], " ") !== false) {



                $parts = explode(" ", $options[$j]);



                $o[$parts[0]] = $parts[1];



            } else



                $o[$options[$j]] = true;



        }



        $options = $o;



        unset($o);



    }



    return $options;



}



function getDecodedStream($stream, $options) {



    $data = "";



    if (empty($options["Filter"]))



        $data = $stream;



    else {



        $length = !empty($options["Length"]) ? $options["Length"] : strlen($stream);



        $_stream = substr($stream, 0, $length);



        foreach ($options as $key => $value) {



            if ($key == "ASCIIHexDecode")



                $_stream = decodeAsciiHex($_stream);



            if ($key == "ASCII85Decode")



                $_stream = decodeAscii85($_stream);



            if ($key == "FlateDecode")



                $_stream = decodeFlate($_stream);



        }



        $data = $_stream;



    }



    return $data;



}



function getDirtyTexts(&$texts, $textContainers) {



    for ($j = 0; $j < count($textContainers); $j++) {



        if (preg_match_all("#\[(.*)\]\s*TJ#ismU", $textContainers[$j], $parts))



            $texts = array_merge($texts, @$parts[1]);



        elseif(preg_match_all("#Td\s*(\(.*\))\s*Tj#ismU", $textContainers[$j], $parts))



            $texts = array_merge($texts, @$parts[1]);



    }



}



function getCharTransformations(&$transformations, $stream) {



    preg_match_all("#([0-9]+)\s+beginbfchar(.*)endbfchar#ismU", $stream, $chars, PREG_SET_ORDER);



    preg_match_all("#([0-9]+)\s+beginbfrange(.*)endbfrange#ismU", $stream, $ranges, PREG_SET_ORDER);



    for ($j = 0; $j < count($chars); $j++) {



        $count = $chars[$j][1];



        $current = explode("\n", trim($chars[$j][2]));



        for ($k = 0; $k < $count && $k < count($current); $k++) {



            if (preg_match("#<([0-9a-f]{2,4})>\s+<([0-9a-f]{4,512})>#is", trim($current[$k]), $map))



                $transformations[str_pad($map[1], 4, "0")] = $map[2];



        }



    }



    for ($j = 0; $j < count($ranges); $j++) {



        $count = $ranges[$j][1];



        $current = explode("\n", trim($ranges[$j][2]));



        for ($k = 0; $k < $count && $k < count($current); $k++) {



            if (preg_match("#<([0-9a-f]{4})>\s+<([0-9a-f]{4})>\s+<([0-9a-f]{4})>#is", trim($current[$k]), $map)) {



                $from = hexdec($map[1]);



                $to = hexdec($map[2]);



                $_from = hexdec($map[3]);



                for ($m = $from, $n = 0; $m <= $to; $m++, $n++)



                    $transformations[sprintf("%04X", $m)] = sprintf("%04X", $_from + $n);



            } elseif (preg_match("#<([0-9a-f]{4})>\s+<([0-9a-f]{4})>\s+\[(.*)\]#ismU", trim($current[$k]), $map)) {



                $from = hexdec($map[1]);



                $to = hexdec($map[2]);



                $parts = preg_split("#\s+#", trim($map[3]));



                



                for ($m = $from, $n = 0; $m <= $to && $n < count($parts); $m++, $n++)



                    $transformations[sprintf("%04X", $m)] = sprintf("%04X", hexdec($parts[$n]));



            }



        }



    }



}



function getTextUsingTransformations($texts, $transformations) {



    $document = "";



    for ($i = 0; $i < count($texts); $i++) {



        $isHex = false;



        $isPlain = false;



        $hex = "";



        $plain = "";



        for ($j = 0; $j < strlen($texts[$i]); $j++) {



            $c = $texts[$i][$j];



            switch($c) {



                case "<":



                    $hex = "";



                    $isHex = true;



                break;



                case ">":



                    $hexs = str_split($hex, 4);



                    for ($k = 0; $k < count($hexs); $k++) {



                        $chex = str_pad($hexs[$k], 4, "0");



                        if (isset($transformations[$chex]))



                            $chex = $transformations[$chex];



                        $document .= html_entity_decode("&#x".$chex.";");



                    }



                    $isHex = false;



                break;



                case "(":



                    $plain = "";



                    $isPlain = true;



                break;



                case ")":



                    $document .= $plain;



                    $isPlain = false;



                break;



                case "\\":



                    $c2 = $texts[$i][$j + 1];



                    if (in_array($c2, array("\\", "(", ")"))) $plain .= $c2;



                    elseif ($c2 == "n") $plain .= '\n';



                    elseif ($c2 == "r") $plain .= '\r';



                    elseif ($c2 == "t") $plain .= '\t';



                    elseif ($c2 == "b") $plain .= '\b';



                    elseif ($c2 == "f") $plain .= '\f';



                    elseif ($c2 >= '0' && $c2 <= '9') {



                        $oct = preg_replace("#[^0-9]#", "", substr($texts[$i], $j + 1, 3));



                        $j += strlen($oct) - 1;



                        $plain .= html_entity_decode("&#".octdec($oct).";");



                    }



                    $j++;



                break;



                default:



                    if ($isHex)



                        $hex .= $c;



                    if ($isPlain)



                        $plain .= $c;



                break;



            }



        }



        $document .= "\n";



    }



    return $document;



}



/*

function pdf2text($filename) {



    $infile = @file_get_contents($filename, FILE_BINARY);



    if (empty($infile))



        return "";



    $transformations = array();



    $texts = array();



    preg_match_all("#obj(.*)endobj#ismU", $infile, $objects);



    $objects = @$objects[1];



    for ($i = 0; $i < count($objects); $i++) {



        $currentObject = $objects[$i];



        if (preg_match("#stream(.*)endstream#ismU", $currentObject, $stream)) {



            $stream = ltrim($stream[1]);



            $options = getObjectOptions($currentObject);



            if (!(empty($options["Length1"]) && empty($options["Type"]) && empty($options["Subtype"])))



                continue;



            $data = getDecodedStream($stream, $options); 



            if (strlen($data)) {



                if (preg_match_all("#BT(.*)ET#ismU", $data, $textContainers)) {



                    $textContainers = @$textContainers[1];



                    getDirtyTexts($texts, $textContainers);



                } else



                    getCharTransformations($transformations, $data);



            }



        }



    }



    $outtext =getTextUsingTransformations($texts, $transformations);



    return $outtext;



}

//*/







function pdf2text($filename) { 



    // Read the data from pdf file

    $infile = @file_get_contents($filename, FILE_BINARY); 

    if (empty($infile)) 

        return ""; 



    // Get all text data.

    $transformations = array(); 

    $texts = array(); 



    // Get the list of all objects.

    preg_match_all("#obj(.*)endobj#ismU", $infile, $objects); 

    $objects = @$objects[1]; 



    // Select objects with streams.

    for ($i = 0; $i < count($objects); $i++) { 

        $currentObject = $objects[$i]; 



        // Check if an object includes data stream.

        if (preg_match("#stream(.*)endstream#ismU", $currentObject, $stream)) { 

            $stream = ltrim($stream[1]); 



            // Check object parameters and look for text data. 

            $options = getObjectOptions($currentObject); 

            if (!(empty($options["Length1"]) && empty($options["Type"]) && empty($options["Subtype"]))) 

                continue; 



            // So, we have text data. Decode it.

            $data = getDecodedStream($stream, $options);  

            if (strlen($data)) { 

                if (preg_match_all("#BT(.*)ET#ismU", $data, $textContainers)) { 

                    $textContainers = @$textContainers[1]; 

                    getDirtyTexts($texts, $textContainers); 

                } else 

                    getCharTransformations($transformations, $data); 

            } 

        } 



    } 



    // Analyze text blocks taking into account character transformations and return results. 

    return getTextUsingTransformations($texts, $transformations); 

}



?>











<?php



function generateRandomString($length = 6) {



    //$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';



    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';



    $randomString = '';



    for ($i = 0; $i < $length; $i++) {



        $randomString .= $characters[rand(0, strlen($characters) - 1)];



    }



    return $randomString;



}



// Echo the random string.



// Optionally, you can give it a desired string length.



$gen_pass=generateRandomString();



?>











<?php









$type_candidatur="";



if(isset($_POST['envoi'])){ 

    include("./enregistrement_candidat.php");

    } 

 

    $sql = mysql_query("select * from offre ");

      

 

  $nom_page_site ="CANDIDATS || IMPORT MANUEL DE CV "  ;

  

    

 

    $ariane="Candidats > Import manuel des CVs ";



?>