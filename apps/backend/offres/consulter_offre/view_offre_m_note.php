



        <tr><td colspan="2"><div class="ligneBleu"></div></td></tr>

			 

            <tr><td colspan="2">

			 

	       <div class="subscription" style="margin: 10px 0pt;">

                         <h1>Notation du poste </h1>

                     </div> 

			 <table width="100%" cellpadding="0" border="0">

			 

			 

			   <tr>

				<th  style="background: #CFD4D8;border-style: solid;border-width: 1px;  overflow: hidden;

  word-break: normal;  border-color: #a9a9a9;width:80%;"><strong>Ecoles</strong></th>

				<th   style="background: #CFD4D8;border-style: solid;border-width: 1px;  overflow: hidden;

  word-break: normal;  border-color: #a9a9a9;width:80%;width:15%;"><center><strong>Note</strong></center></th>

			  </tr>  



			 </table>

			 

			 <div style=" height: 100%;/* overflow-y: scroll;*/">



			 <table width="100%" cellpadding="0" border="0">

 

                         <?php 

						 

                         $req_o_e = mysql_query("SELECT * FROM offre_necole Where id_offre=".$id_offre." ");

						 

				$a = mysql_num_rows($req_o_e);

				

				if($a>0) {

				

                         while ($o_e = mysql_fetch_array($req_o_e)) {

						 

                             $o_e_id = $o_e['id_ecole'];

                             $o_e_desc = $o_e['note'];

							 

                         $req_ecol = mysql_query("SELECT * FROM prm_ecoles");

                         while ($ecol = mysql_fetch_array($req_ecol)) {

						 

                             $e_id = $ecol['id_ecole'];

                             $e_desc = $ecol['nom_ecole'];

   

							 if($e_id==$o_e_id){ 

							 

						?>		 

								<tr> 		

									 <td style="border: 1px solid #aabcfe;width:80%"> <?php echo $e_desc; ?> </td>

									 

									 <td style="border: 1px solid #aabcfe;width:15%">

										<center>

										 <?php   echo $o_e_desc ; ?> 

										</center>

									 </td>  

									 

								 </tr>	 

 

						<?php	

								}

							}

						 

						 }

						 

						 } else {

						echo ' <tr>

								<td colspan="2" align="center"  style="border: 1px solid #aabcfe;width:100px"> Aucune donnée </td>

							  </tr>';

						}

                         ?> 

                 

			 

			 

			 

			 </table>

	</div>	



			 </td></tr>			



 <tr><td colspan="2"><div class="ligneBleu"></div></td></tr>



            <tr><td colspan="2">

	

			  

	

			 <table width="100%" cellpadding="0" border="0">

			 

			 

			   <tr>

				<th  style="background: #CFD4D8;border-style: solid;border-width: 1px;  overflow: hidden;

  word-break: normal;  border-color: #a9a9a9;width:80%;"><strong>Filières</strong></th>

				<th  style="background: #CFD4D8;border-style: solid;border-width: 1px;  overflow: hidden;

  word-break: normal;  border-color: #a9a9a9;width:15%;"><center><strong>Note</strong></center></th>

			  </tr>

 

			 

<!--			 

			  

								<tr> 		

									 <td colspan="5" style="width:600px">  

										<div class="ligneBleu"></div>

									 </td> 

								 </tr>	 

-->

			

			 </table>

			 

			 <div style=" height: 100%;/* overflow-y: scroll;*/">

	

			 <table width="100%" cellpadding="0" border="0">

 

                         <?php  

						 

                         $req_o_f = mysql_query("SELECT * FROM offre_nfiliere Where id_offre=".$id_offre."  ");

						 

				$a = mysql_num_rows($req_o_f);

				

				if($a>0) {

				

                         while ($o_f = mysql_fetch_array($req_o_f)) {

						

                             $o_f_id = $o_f['id_fili'];

                             $o_f_desc = $o_f['note'];

							 

                         $req_f = mysql_query("SELECT * FROM prm_filieres");

                         while ($f = mysql_fetch_array($req_f)) {

						  

                             $f_id = $f['id_fili'];

                             $f_desc = $f['filiere']; 

						  

							 if($f_id==$o_f_id){  

							 

						?>		 

		<tr> 		

									 <td style="border: 1px solid #aabcfe;width:80%"> <?php echo $f_desc; ?> </td>

									 

									 <td style="border: 1px solid #aabcfe;width:15%">

										<center>

										 <?php   echo $o_f_desc ; ?> 

										</center>

									 </td>  

									 

								 </tr>	

						<?php

								}

							}

						 

						 }

						 

						 } else {

						echo ' <tr>

								<td colspan="2" align="center"  style="border: 1px solid #aabcfe;width:100px"> Aucune donnée </td>

							  </tr>';

						}

                         ?>

                     <!--</select>-->

                 

			 

			 

			 

			 </table>

	</div>		

			 </td></tr>		





 

			 

			 

 