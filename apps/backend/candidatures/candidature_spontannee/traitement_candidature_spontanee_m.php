 <div class="texte">

                            <form action="contact.php" method="post">

                                <input name="email" id="email" type="hidden" />

                            </form>
                            <br/>
                            <h1>TRAITEMENT DES CANDIDATURES SPONTANEES</h1>

                            <div class="subscription" style="margin: 10px 0pt;">

                                <h1>Options de filtrage des CANDIDATURES SPONTANEES</h1>

                            </div>
            <?php
             /////////////////////////////////////////////traitement filtrage///////////////////////////////////////////////// 
if(isset($_POST["motcle"]) and $_POST["motcle"]!='')  $_SESSION["cp_motcle"]=$_POST["motcle"];
if(isset($_POST["fonction"]) and $_POST["fonction"]!='')  $_SESSION["cp_fonction"]=$_POST["fonction"];
if(isset($_POST["pays"]) and $_POST["pays"]!='')  $_SESSION["cp_pays"]=$_POST["pays"];
if(isset($_POST["ville"]) and $_POST["ville"]!='')  $_SESSION["cp_ville"]=$_POST["ville"];

if(isset($_POST["exp"]) and $_POST["exp"]!='')  $_SESSION["cp_exp"]=$_POST["exp"];
if(isset($_POST["secteur"]) and $_POST["secteur"]!='')  $_SESSION["cp_secteur"]=$_POST["secteur"];

if(isset($_POST["fraicheur"]) and $_POST["fraicheur"]!='')  $_SESSION["cp_fraicheur"]=$_POST["fraicheur"];
if(isset($_POST["situation"]) and $_POST["situation"]!='')  $_SESSION["cp_situation"]=$_POST["situation"];

if(isset($_POST["etablissement"]) and $_POST["etablissement"]!='')  $_SESSION["cp_etablissement"]=$_POST["etablissement"];
if(isset($_POST["type_formation"]) and $_POST["type_formation"]!='')  $_SESSION["cp_type_formation"]=$_POST["type_formation"];

if(isset($_POST["formation"]) and $_POST["formation"]!='')  $_SESSION["cp_formation"]=$_POST["formation"];
if(isset($_POST["typestage"]) and $_POST["typestage"]!='')  $_SESSION["cp_typestage"]=$_POST["typestage"];
if(isset($_POST["duree_stage"]) and $_POST["duree_stage"]!='')  $_SESSION["cp_duree_stage"]=$_POST["duree_stage"];

//------------------------------------------------------------------------------------------  
if(isset($_POST["age"]) and $_POST["age"]!='')  $_SESSION["cp_age"]=$_POST["age"];  
if(isset($_POST["sexe"]) and $_POST["sexe"]!='')  $_SESSION["cp_sexe"]=$_POST["sexe"];  
/////////////////////////////////////////////////////////////////////////////////////////////

    

        if (isset($_POST['actualiser'])) {

                                $_POST['motcle'] = "";
                                $_SESSION['cp_motcle'] = "";

                                $_POST['fonction'] = "";
                                $_SESSION['cp_fonction'] = "";

                                $_POST['pays'] = "";
                                $_SESSION['cp_pays'] = "";

                                $_POST['exp'] = "";
                                $_SESSION['cp_exp'] = "";

                                $_POST['secteur'] = "";
                                $_SESSION['cp_secteur'] = "";

                                $_POST['fraicheur'] = "";
                                $_SESSION['cp_fraicheur'] = "";

                                $_POST['situation'] = "";
                                $_SESSION['cp_situation'] = "";

                                $_POST['etablissement'] = "";
                                $_SESSION['cp_etablissement'] = "";

                                $_POST['type_formation'] = "";
                                $_SESSION['cp_type_formation'] = "";

                                $_POST['formation'] = "";
                                $_SESSION['cp_formation'] = "";

                                $_POST['typestage'] = "";
                                $_SESSION['cp_typestage'] = "";

                                $_POST['duree_stage'] = "";
                                $_SESSION['cp_duree_stage'] = "";

                                $_POST['ville'] = "";
                                $_SESSION['cp_ville'] = "";
								
								$_POST['age']="";
								$_SESSION["cp_age"]="";
								
								$_POST['sexe']="";
								$_SESSION["cp_sexe"]="";

                                $_SESSION['query_cpf']=$selectString;
                            }  


include("./traitement_candidature_spontanee_m_filtre.php");

include('./traitement_candidature_spontanee_m_filtre_traitement.php');

$query_cspont = isset($_SESSION['query_cpf']) ? $_SESSION['query_cpf'] : $selectString;

$select = mysql_query($query_cspont);
$count = mysql_num_rows($select);

?>
<div class="subscription" style="margin: 10px 0pt;">
<h1>CV des candidats  <span class="badge"><?php echo $count; ?></span></h1>
</div>

<section>
<?php  include("./traitement_candidature_spontanee_m_table.php");?>
</section>

</div>
<br/><br/>
<div class="ligneBleu"></div>
</div></div><!-- fin content gauche -->