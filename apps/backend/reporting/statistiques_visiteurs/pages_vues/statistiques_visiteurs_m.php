 			<div class='texte'><br>

<br/>
<h1> STATISTIQUES VISITEURS </h1>                   
<div  class="subscription" style="margin: 10px 0pt;">
<h1>  VISITEURS </h1>
</div> 
<table width="100%">
<tr>
                            <td width="25%"><b>Indicateur :</b></td>
                            <td width="75%"> 
                            <select onChange="window.location.href=this.value">
                                <option value="../visiteurs_uniques/" >Nombre de visiteurs uniques  </option>
                                <option value="../pages_vues/" selected="selected">Nombre des pages vues  </option>
                                <option value="../temps_sur_site/"  >Temps moyen passé sur le site </option>
                                <option value="../taux_rebond/">Taux de rebond</option>
                            </select>
                             
                        </tr>
</table>
<br/>
<div class="ligneBleu"></div>
                                
                                
                                <br>
                                
                              <div class="b1"  style="width:690px;">
 
          <?php 

 

		/////////////////////////////////////////////////////////////////////////////////////////
									//  google analytique  // 
                require_once ( dirname(__FILE__) . $incurl3 . "/gapi.class.php");
 
                $login= $conf_login;  $pass= $conf_pass;   $profileId = $conf_profileId;  
 
                $analytics=new gapi($login,$pass);
		////////////////////////////////////////////////////////////////////////////////////////
		
                 $dimensions = array('year','month','day','week','date');               
				 $metrics = array('visitors','visits','timeOnSite','pageviews','bounces','visitBounceRate','avgTimeOnSite','entranceBounceRate'); 
             
          ?>
                
<?php       include ( "./statistiques_visiteurs_2.php"); ?>

                            </div>  

<br/>
<div class="ligneBleu"></div>
                            </div>