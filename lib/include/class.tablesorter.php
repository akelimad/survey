<?php

class tablesorter {

 var $page;
 var $requete;
 var $tri_parametres;
 var $css_initial;
 var $css_asc;
 var $css_desc;
function tablesort($page,$tri_parametres,$get_parametres,$css_initial,$css_asc,$css_desc)
{

$tri_parametres = str_replace(".","pt_pt",$tri_parametres);

$this->css_initial=$css_initial;
$this->css_asc=$css_asc;
$this->css_desc=$css_desc;
$this->page=$page;
$this->tri_parametres=$tri_parametres;

echo '<form name="form_tri" action='.$page.' method="get" >';

foreach($tri_parametres as $par)
{
$par = "tri_".$par;

if(isset($_GET[$par]) and ($_GET[$par]=="desc" or $_GET[$par]=="asc"))
echo '<input type="hidden" name="'.$par.'" value="'.$_GET[$par].'" />';
else
echo '<input type="hidden" name="'.$par.'" value="" />';


}
foreach($get_parametres as $par)
{
if(isset($_GET[$par]) and $_GET[$par]!="")
echo '<input type="hidden" name="'.$par.'" value="'.$_GET[$par].'" />';

}

echo '</form>';



}

function tsort($str,$requete)
{

foreach($this->tri_parametres as $par)
{

$var = "tri_".$par."";
$par= str_replace("pt_pt",".",$par);


if(isset($_GET[$var]) and ($_GET[$var]=="asc" or $_GET[$var]=="desc"))
{

if($str!="")
{
$requete = str_replace($str," order by ".$par." ".$_GET[$var]." ",$requete);
return $requete;
}
else
$requete.=" order by ".$par." ".$_GET[$var]." ";

}


}
return $requete;

}


function displayontablehead($par)
{

$par = "tri_".$par;
$par =str_replace(".","pt_pt",$par);
echo 'class="';
if(!isset($_GET[$par])) 
echo $this->css_initial;
 elseif($_GET[$par]=="asc") 
 echo $this->css_desc; 
 elseif($_GET[$par]=="desc")
 echo $this->css_asc; 
 else 
 echo $this->css_initial;
 echo '"';
 
 echo 'onclick="';

foreach($this->tri_parametres as $parr)
{
$parr = "tri_".$parr."";
if($parr!=$par)
{

echo "document.forms['form_tri'].".$parr.".value='';";

}

}
echo "if(document.forms['form_tri'].".$par.".value=='desc') document.forms['form_tri'].".$par.".value='asc'; else document.forms['form_tri'].".$par.".value='desc';  document.forms['form_tri'].submit();";
echo '"';

}



















}















?>