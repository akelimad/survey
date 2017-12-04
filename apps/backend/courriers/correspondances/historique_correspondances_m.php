<?php



if(isset($_POST["motcle"]) and $_POST["motcle"]!='')  $_SESSION["ic_motcle"]=$_POST["motcle"];

if(isset($_POST["sujet"]) and $_POST["sujet"]!='')  $_SESSION["ic_sujet"]=$_POST["sujet"];

if(isset($_POST["nom"]) and $_POST["nom"]!='')  $_SESSION["ic_nom"]=$_POST["nom"];

if(isset($_POST["d_env"]) and $_POST["d_env"]!='')  $_SESSION["ic_d_env"]=$_POST["d_env"];

if(isset($_POST["t_env"]) and $_POST["t_env"]!='')  $_SESSION["ic_t_env"]=$_POST["t_env"];

if(isset($_POST["t_msg"]) and $_POST["t_msg"]!='')  $_SESSION["ic_t_msg"]=$_POST["t_msg"];



?>









<div class='texte' style="width:760px"><br/>

              <h1>HISTORIQUE DES CORRESPONDANCES</h1>   

                            <div class="subscription" style="margin: 10px 0pt;">

                  <h1>Options de filtrage de l'historique des correspondances </h1>

              </div>    

                <?php

                if (isset($_POST['actualiser'])) {

                        $_POST['motcle'] = "";        $_POST['d_env'] = "";        $_POST['sujet'] = "";

                        $_POST['t_env'] = "";        $_POST['nom'] = "";        $_POST['t_msg'] = "";  

						$_SESSION["ic_motcle"] = ""; $_SESSION["ic_sujet"] = ""; $_SESSION["ic_nom"] = ""; 

						$_SESSION["ic_d_env"] = ""; $_SESSION["ic_t_env"] = ""; $_SESSION["ic_t_msg"] = ""; 



                    }

                ?>                          

        <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST">

               <?php include ("./historique_correspondances_m_filtre.php"); ?>

        </form>

        

         

          <?php                 

              if (isset($_GET['id']) && !empty($_GET['id'])) {

                $id = $_GET['id'];

                if ($_GET['action'] == "delete") {

                          if (mysql_query("delete from corespondances  where id='$id'")) {

                            //  $_SESSION['msg'] = "L'agent ou le responsable de communication est supprimé avec succès";                                       

                          } else {

                              $_SESSION['erreur'] = "Une erreur est survenue lors de la suppression";                                       

                          }                                     

                          

                  }    

              } 

                 $q_ref_fili='';

        if (isset($_SESSION['ref_filiale_role']) and $_SESSION['ref_filiale_role']!=''){

            if (isset($_SESSION['ref_filiale_role']) and $_SESSION['ref_filiale_role']!='0'){       

                $q_ref_fili = "where ref_filiale = '".$_SESSION['ref_filiale_role']."' ";       

                

            }

        }              

                $sql = " select * from corespondances  ".$q_ref_fili." order by date_envoi desc ";

                

				

				

				

                    if (!empty($_SESSION["ic_motcle"]) || !empty($_SESSION["ic_d_enve"]) || !empty($_SESSION["ic_sujet"]) || !empty($_SESSION["ic_t_env"]) || !empty($_SESSION["ic_nom"]) || !empty($_SESSION["ic_t_msg"])  ) {

                      $result = "";

                    if (!empty($_SESSION["ic_motcle"])) {

                      $lemotcle = '%' . $_SESSION["ic_motcle"] . '%';

                    if (empty($result))

                      $result .= " LOWER(CONCAT_WS(sujet,type_email, type_email, nom, titre))  like LOWER('%" . $_SESSION["ic_motcle"] . "%') ";

                    else

                      $result .= " And LOWER(CONCAT_WS(sujet,type_email, type_email, nom, titre))  like LOWER('%" . $_SESSION["ic_motcle"] . "%') ";

                }

                if (!empty($_SESSION["ic_d_enve"])) {

                  $d_env_m=($_SESSION["ic_d_enve"]);

                  if (empty($result))

                    $result .= " CAST(`date_envoi` AS DATE)  = '" . $d_env_m . "'";

                  else

                    $result .= " And CAST(`date_envoi` AS DATE) = '" . $d_env_m . "'";

                }

                if (!empty($_SESSION["ic_sujet"])) {

                  if (empty($result))

                    $result .= " sujet = '" . $_SESSION["ic_sujet"] . "'";

                  else

                    $result .= " And sujet = '" . $_SESSION["ic_sujet"] . "'";

                  }

                if (!empty($_SESSION["ic_t_env"])) {

                  if ($_SESSION["ic_t_env"] == 'Envoi automatique')

                    $fvar = 'Envoi automatique';

                  if ($_SESSION["ic_t_env"] == 'Envoi manuel')

                    $fvar = 'Envoi manuel';

                  if (empty($result))

                    $result .= " type_email = '" . $fvar . "'"; 

                  else

                    $result .= " And type_email = '" . $fvar . "'";

                }

                if (!empty($_SESSION["ic_nom"])) {

                  if (empty($result))

                    $result .= " nom = '" . $_SESSION["ic_nom"] . "'";

                  else

                    $result .= " And nom = '" . $_SESSION["ic_nom"] . "'";

                }

                if (!empty($_SESSION["ic_t_msg"])) {

                  if (empty($result))

                    $result .= " titre = '" .  $_SESSION["ic_t_msg"]  . "'";

                  else

                    $result .= " And titre = '" .  $_SESSION["ic_t_msg"] . "'";

                }

                    $sql = " select * from corespondances  WHERE " . $result . " ORDER BY  `corespondances`.`date_envoi` DESC " ;

                    } 

                        else                            

                        $sql = " select * from corespondances ORDER BY  `corespondances`.`date_envoi` DESC";

                  

				  

				  

				  

				  

				  

              $sql0 = "SELECT COUNT(id) as nbArt FROM corespondances";

              $req = mysql_query($sql0) or die(mysql_error());

              $data = mysql_fetch_assoc($req);

              $nbArt = $data['nbArt'];

              $perPage = 2000;

              $nbPage = ceil($nbArt/$perPage);

              if(isset($_POST['p']) && $_POST['p']>0 && $_POST['p']<=$nbPage){

                $cPage = $_POST['p'];

              }

              else{

                $cPage =1;

              }

              //$sql.=" LIMIT ".(($cPage-1)*$perPage).",".$perPage." ";   

              

        ?>

        



      <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" name="global" >       

   <?php include ("./historique_correspondances_m_table.php"); ?>

    </form>

    

             

 

 

</div>