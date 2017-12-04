<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">

<table  width="100%">

                    <td  width="30%">

                        

                            <tr>

                              <td colspan="2" >Par mot clé

                                <label><br/>

                                  <input  type="text" name="motcle" style="width:185px" 

                                  placeholder="mot clé" 

                                  value="<?php if (!empty($_POST['motcle'])) echo $_POST['motcle']; ?>" 

                                  maxlength="100" />

                                </label>

                              </td>

                            

                              <td colspan="2">

                                <label>Par date </label><br />

                                <input  type="date" name="d_env"  id="d_env" style="width:185px" placeholder="  01/01/1980  " value="<?php if (!empty($_POST['d_env']) and ($_POST['d_env']!='')) echo $_POST['d_env']; ?>" maxlength="100" />

                              </td>

                            </tr>

                       

                    </td>

                  </table><br/>

<input type="submit" name="envoi" class="espace_candidat" value="Filtrer" /> 

                  <input type="submit" name="actualiser"  class="espace_candidat" 

                  OnClick="javascript:window.location.reload()" value="Actualiser"> 

                  <div class="ligneBleu"></div>  

  </form>

  <?php 

$sql = " select * from historique_cvtheque  ORDER BY  `historique_cvtheque`.`date` DESC ";

                if (isset($_POST['envoi'])) {

                    if (!empty($_POST['motcle']) || !empty($_POST['d_env'])  ) {

                      $result = "";

                    if (!empty($_POST['motcle'])) {

                      $lemotcle = '%' . $_POST['motcle'] . '%';

                    if (empty($result))

                      $result .= " LOWER(CONCAT_WS(user,motcle))  like LOWER('%" . $_POST['motcle'] . "%') ";

                    else

                      $result .= " And LOWER(CONCAT_WS(user,motcle))  like LOWER('%" . $_POST['motcle'] . "%') ";

                }

                if (!empty($_POST['d_env'])) {

                  $d_env_m=($_POST['d_env']);

                  if (empty($result))

                    $result .= " CAST(`date` AS DATE)  = '" . $d_env_m . "'";

                  else

                    $result .= " And CAST(`date` AS DATE) = '" . $d_env_m . "'";

                }

                

                    $sql = " select * from historique_cvtheque  WHERE " . $result . " ORDER BY  `historique_cvtheque`.`date` DESC  " ;

                    } }/*

                        else                            

                        $sql = " select * from corespondances ORDER BY  `historique_cvtheque`.`date` DESC";

                   }

              $sql0 = "SELECT COUNT(id_hit_cvtheq) as nbArt FROM historique_cvtheque";

              $req = mysql_query($sql0) or die(mysql_error());

              $data = mysql_fetch_assoc($req);

              $nbArt = $data['nbArt'];

              $perPage = 20;

              $nbPage = ceil($nbArt/$perPage);

              if(isset($_POST['p']) && $_POST['p']>0 && $_POST['p']<=$nbPage){

                $cPage = $_POST['p'];

              }

              else{

                $cPage =1;

              }

              //$sql.=" LIMIT ".(($cPage-1)*$perPage).",".$perPage." ";   

              */

              $select = mysql_query($sql);

  ?>