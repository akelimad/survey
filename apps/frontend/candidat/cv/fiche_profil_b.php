
<script type="text/javascript">
  function avancement() {
  var ava = document.getElementById("avancement");
  var prc = document.getElementById("pourcentage");
  prc.innerHTML = ava.value + "%";
}

avancement(); //Initialisation
</script>   
    

 

<script type="text/javascript">//<![CDATA[ 
$(window).load(function(){  
$('#etablissement').on('change',function(){
    if( $(this).val()=="290" ){    $("#div_etablissement").show()    }
    else{    $("#nom_etablissement").val('');   $("#div_etablissement").hide()    }
});
$('#etablissement1').on('change',function(){
    if( $(this).val()=="290" ){    $("#div_etablissement1").show()    }
    else{    $("#nom_etablissement1").val('');  $("#div_etablissement1").hide()    }
});
$('#etablissement2').on('change',function(){
    if( $(this).val()=="290" ){    $("#div_etablissement2").show()    }
    else{    $("#nom_etablissement2").val('');  $("#div_etablissement2").hide()    }
});
$('#etablissement3').on('change',function(){
    if( $(this).val()=="290" ){    $("#div_etablissement3").show()    }
    else{    $("#nom_etablissement3").val('');  $("#div_etablissement3").hide()    }
});
$('#etablissement4').on('change',function(){
    if( $(this).val()=="290" ){    $("#div_etablissement4").show()    }
    else{    $("#nom_etablissement4").val('');  $("#div_etablissement4").hide()    }
});
});//]]>  

</script>

   <style type="text/css">
       select 
       {
width:200px;
       }
   </style> 
 

<script type="text/javascript" >
count=6;
function create_champ(i) {


if(i<count)
{
var i2 = i + 1;     

document.getElementById('leschamps_'+i).innerHTML = '<input  type="file" name="upload[]" size="30" class="cvs"/></span>';
document.getElementById('leschamps_'+i).innerHTML += (i <= 10) ? '<br /><span  id="leschamps_'+i2+'"><a class="lettre" href="javascript:create_champ('+i2+')">Ajouter une lettre</a></span>' : '';
}

}
</script>
<script type="text/javascript" >
countcv=6;
function create_champcv(i) {


if(i<countcv)
{
var i2 = i + 1;     

document.getElementById('leschampscv_'+i).innerHTML = '<input  type="file" name="upload1[]" size="30" class="cvs"/></span>';
document.getElementById('leschampscv_'+i).innerHTML += (i <= 10) ? '<br /><span  id="leschampscv_'+i2+'"><a class="cvchamp" href="javascript:create_champcv('+i2+')">Ajouter un cv</a></span>' : '';
}

}
</script>

   <script type="text/javascript">
       function display(){
document.getElementById('zone').style.display='inline';
       }
       function hide(){
document.getElementById('zone').style.display='none';
       }
   </script>
      
<style>
    :invalid {
        border: 1px solid red; 
    }
    :valid {
    /*     border: 1px solid green;*/
    }
</style>    


<link rel="stylesheet" href="<?php echo $jsurl; ?>/jquery/jquery-ui.min.css"> 
  <script src="<?php echo $jsurl; ?>/jquery/jquery-1.11.2.min.js"></script>
  <script src="<?php echo $jsurl; ?>/jquery/jquery-ui.min.js"></script>
  <script src="<?php echo $jsurl; ?>/jquery/datepicker-fr.js"></script>
    

<script type="text/javascript">//<![CDATA[ 
$(window).load(function(){ 
                $('#autre00').keyup( function (){  $('#autre_n00').attr("disabled", false); });
                $('#autre01').keyup(function () {  $('#autre1_n01').attr("disabled", false);});
                $('#autre02').keyup(function () {  $('#autre2_n02').attr("disabled", false);});
                
                $('#autre').keyup( function () {  $('#autre_n00').attr("disabled", false) ;});
                $('#autre1').keyup(function () {  $('#autre1_n01').attr("disabled", false);});
                $('#autre2').keyup(function () {  $('#autre2_n02').attr("disabled", false);});
});//]]>  

</script>  

  <script>
  $(function() {
     $( "#calendar" ).datepicker({  changeMonth: true,  changeYear: true    });
     $( "#calendar_naissance" ).datepicker({    changeMonth: true,  changeYear: true    });
     $( "#calendar_dbf" ).datepicker({  changeMonth: true,  changeYear: true    });  $( "#calendar_ff" ).datepicker({   changeMonth: true,  changeYear: true    });
     $( "#calendar_dbf1" ).datepicker({ changeMonth: true,  changeYear: true    });  $( "#calendar_ff1" ).datepicker({  changeMonth: true,  changeYear: true    });
     $( "#calendar_dbf2" ).datepicker({ changeMonth: true,  changeYear: true    });  $( "#calendar_ff2" ).datepicker({  changeMonth: true,  changeYear: true    });
     $( "#calendar_dbf3" ).datepicker({ changeMonth: true,  changeYear: true    });  $( "#calendar_ff3" ).datepicker({  changeMonth: true,  changeYear: true    });
     $( "#calendar_dbf4" ).datepicker({ changeMonth: true,  changeYear: true    });  $( "#calendar_ff4" ).datepicker({  changeMonth: true,  changeYear: true    });
     $( "#calendar_dbex" ).datepicker({ changeMonth: true,  changeYear: true    });  $( "#calendar_fex" ).datepicker({  changeMonth: true,  changeYear: true    });
     $( "#calendar_dbex1" ).datepicker({    changeMonth: true,  changeYear: true    });  $( "#calendar_fex1" ).datepicker({ changeMonth: true,  changeYear: true    });
     $( "#calendar_dbex2" ).datepicker({    changeMonth: true,  changeYear: true    });  $( "#calendar_fex2" ).datepicker({ changeMonth: true,  changeYear: true    });
     $( "#calendar_dbex3" ).datepicker({    changeMonth: true,  changeYear: true    });  $( "#calendar_fex3" ).datepicker({ changeMonth: true,  changeYear: true    });
     $( "#calendar_dbex4" ).datepicker({    changeMonth: true,  changeYear: true    });  $( "#calendar_fex4" ).datepicker({ changeMonth: true,  changeYear: true    });
     $( "#calendar_dbex5" ).datepicker({    changeMonth: true,  changeYear: true    });  $( "#calendar_fex5" ).datepicker({ changeMonth: true,  changeYear: true    });
     $( "#calendar_dbex6" ).datepicker({    changeMonth: true,  changeYear: true    });  $( "#calendar_fex6" ).datepicker({ changeMonth: true,  changeYear: true    });
     $( "#calendar_dbex7" ).datepicker({    changeMonth: true,  changeYear: true    });  $( "#calendar_fex7" ).datepicker({ changeMonth: true,  changeYear: true    });
     $( "#calendar_dbex8" ).datepicker({    changeMonth: true,  changeYear: true    });  $( "#calendar_fex8" ).datepicker({ changeMonth: true,  changeYear: true    });
     $( "#calendar_dbex9" ).datepicker({    changeMonth: true,  changeYear: true    });  $( "#calendar_fex9" ).datepicker({ changeMonth: true,  changeYear: true    });
  });
  </script>
  
<script type="text/javascript">
function hideDiv() {

    var chboxs = document.getElementsByName("sans_exp");
    var vis = "block";
    for(var i=0;i<chboxs.length;i++) { 
        if(chboxs[i].checked){
         vis = "none";
            break;
        }
    }
    document.getElementById("div1").style.display = vis;    document.getElementById("div2").style.display = vis;    document.getElementById("div3").style.display = vis;    document.getElementById("div4").style.display = vis;    document.getElementById("div5").style.display = vis;    document.getElementById("div6").style.display = vis;    document.getElementById("div7").style.display = vis;    document.getElementById("div8").style.display = vis;    document.getElementById("div9").style.display = vis;    document.getElementById("div10").style.display = vis;    document.getElementById("div11").style.display = vis;  

}
function hideDiv1() {

    var chboxs = document.getElementsByName("sans_exp");
    var vis = "block";
    for(var i=0;i<chboxs.length;i++) { 
        if(chboxs[i].checked){
         vis = "none";
            break;
        }
    }
    document.getElementById("div19").style.display = vis;    document.getElementById("div20").style.display = vis;    document.getElementById("div30").style.display = vis;    document.getElementById("div40").style.display = vis;    document.getElementById("div50").style.display = vis;    document.getElementById("div60").style.display = vis;    document.getElementById("div70").style.display = vis;    document.getElementById("div80").style.display = vis;    document.getElementById("div90").style.display = vis;    document.getElementById("div100").style.display = vis;    document.getElementById("div110").style.display = vis;  

}
</script>
            
<?php   
if(isset($_GET['succed']))
{

  if(isset($_SESSION['fb_desactive']))
  {
    $_SESSION['fb_login'] = $_SESSION['abb_login_candidat'];
    $_SESSION['fb_nom']   = $_SESSION['abb_nom'];
    $_SESSION['fb_id']   =  $_SESSION['abb_id_candidat'];
    unset($_SESSION['abb_login_candidat']);
    unset($_SESSION['abb_nom']);
    unset($_SESSION['abb_id_candidat']);
    echo '<script type="text/javascript" >
window.opener.location.reload();
window.opener.location.href="index.php";
self.close(); 
</script>';
   }
}


    if(isset($_GET['succed']))
{



echo '<script type="text/javascript" >
window.opener.location.reload();
window.opener.location.href="fiche_profil.php";
self.close(); 
</script>';

}
?> 
   <script type="text/javascript" src="<?php echo $jsurl ?>/traitement_profil_lettre.js"></script>
   <script type="text/javascript" src="<?php echo $jsurl ?>/traitement_profil.js"></script>
   <script type="text/javascript" src="<?php echo $jsurl; ?>/traitement_formation_experience.js"></script>

