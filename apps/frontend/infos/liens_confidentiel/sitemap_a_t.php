<?php
 $stri=dirname(__FILE__);  $pieces = explode("\\", $stri);  $i=0;$j=0;$r=''; 
 foreach ($pieces as &$value) {   $j++;   if($value=='www') $i=$j; } 
   $k=$j-$i;    
for ($i = 1; $i <  $k; $i++) {     $r.='/..'; }  /*  echo '<br>$ r = '. $r; */

    require_once dirname(__FILE__) . $r. "/config/fo_conn.php";
 
 
	
$ariane="Admin > liens";	
    ?> 
				