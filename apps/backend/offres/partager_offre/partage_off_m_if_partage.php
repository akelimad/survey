 

    <div class="subscription" style="margin: 10px 0pt;">
        <h1>Partager l'offre</h1>
    </div>    
    <form method="post" action="<?php echo($_SERVER['REQUEST_URI']); ?>">
        <table>
            <tr>
                <td ><h1>Offre :</h1></td>
                <td ><span style="color:#000000;font-weight:normal"><h1>&nbsp; <?php echo $reponse['Name']; ?> </h1></span>
                <input name="id_offre" type="hidden" value="<?php echo $id_offre; ?>" />
                </td>
            </tr>

               <table width="100%" border="0" cellspacing="0" id="partage_offre_envoi" class="tablesorter" style="background: none;">
 

            <thead>
                  <tr>
                    <th width="20%" >Nom</th>
                    <th width="40%" >Type de partenaire</th>
                    <th width="30%" >Email</th>
                    <th width="30%" >Partager</th>
                  </tr>
            </thead>
           <tbody>           
                    <?php   
                        while($reponse2=mysql_fetch_array($select2))
                        { 
                        
                        $sql_partenaire01 = mysql_query("SELECT * FROM  prm_type_partenaire where id_tparte  = '".$reponse2['id_tparte']."' ");
                        $rep_partenaire01 = mysql_fetch_assoc($sql_partenaire01);              
                        
            
                        $id_ptg = $reponse2['id_parte'];
                        $nom_ptg = $reponse2['nom'];
                        $tpart_ptg = $rep_partenaire01['type_partenaire'];
                        $email_ptg = $reponse2['email'];
                        ?>
                        <tr>
                        <input name="id_ptg" type="hidden" value="<?php echo $id_ptg;?>" />
                       <td  style="border:1px solid #FFFFFF;background-color: #ddd;"><?php echo $nom_ptg; ?></td>
                       <td  style="border:1px solid #FFFFFF;background-color: #ddd;"><?php echo $tpart_ptg; ?></td>
                      <td  style="border:1px solid #FFFFFF;background-color: #ddd;"><?php echo $email_ptg; ?></td>
                      <td  style="border:1px solid #FFFFFF;background-color: #ddd;"><input type="checkbox" class='form'  id="checkbox" name="checkbox[]"  value="<?php echo $id_ptg; ?>" style="margin-left: 33px;" /><td >

                    </tr>
                <?php } ?>
                    </tbody> 
        </table>

        <tr>
        <td>
        </td>
        <td><br>
        <input name="partager" class="espace_candidat" type="submit" value="Envoyer" style="width:100px" />
                  <input name="reset" class="espace_candidat" type="reset" style="width:100px"/>
               </td>
        </tr>
        </table>
    </form>
    <br><br>
                        <div class="ligneBleu"></div>
