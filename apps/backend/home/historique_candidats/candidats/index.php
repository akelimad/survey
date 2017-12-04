
<?php include("./canadidats_historique_resuta_t.php");    ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include ( dirname(__FILE__) . $tempurl3 . "/header_tmp_admin.php"); ?>
<script type="text/javascript" src="<?php echo $jsurl ?>/ckeditor/ckeditor.js"></script>
 
 

 <style>select{width:190px ;}</style>
</head>
<body>

<!-- START CONTAINER -->
<div id="container" >

<?php     include ( dirname(__FILE__) . $tempurl3 . "/header_admin.php");       ?>

<div id='gauche' >
<?php
if($candidats>0){ include ( dirname(__FILE__) . $menuurl3 . "/menu_g_a_candidats.php");}
elseif($candidatures_n>0){ include ( dirname(__FILE__) . $menuurl3 . "/menu_g_a_candidature.php");} 
elseif($candidatures_n_r>0){ include ( dirname(__FILE__) . $menuurl3 . "/menu_g_a_candidature.php");}
else { ?>
<div id="menu-fo1"><ul id="menu_site_carriere" style="padding: 1px;"></ul></div>
<?php } ?>

</div>
<div id='content_d' style="width:720px;">   
<?php include ("./canadidats_historique_resuta_m.php"); ?>
</div> 
</div>
<?php include ( dirname(__FILE__) . $tempurl3 . "/footer_admin.php"); ?>
<?php       include ( "./canadidats_historique_resuta_b.php");     ?>

<?php include ( dirname(__FILE__) . $tempurl3 . "/footer_tmp_admin.php"); ?>
<script type="text/javascript">

    function PrintElem(elem)
    {
        Popup($(elem).html());
    }

    function Popup(data) 
    {
        var mywindow = window.open('', 'my div', 'height=400,width=600');
        mywindow.document.write('<html><head><title>Notation de candidature</title>');
        
        mywindow.document.write('</head><body >');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');

        mywindow.print();
        mywindow.close();

        return true;
    }

</script>
</body>
</html> 