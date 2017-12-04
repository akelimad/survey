

        <tr><td colspan="2"><div class="ligneBleu"></div></td></tr>

		

	         <tr>

                 <td colspan="2"><div class="subscription" style="margin: 10px 0pt;">

                         <h1>Notation du poste </h1>

                     </div></td>

             </tr>



        <tr><td colspan="2"><div class="ligneBleu"></div></td></tr>

			 

            <tr><td colspan="2">

			 

			 <table width="670px" cellpadding="0" border="0">

			 

			 

			   <tr>

				<th  style="background: #CFD4D8;border-style: solid;border-width: 1px;  overflow: hidden;

  word-break: normal;  border-color: #a9a9a9;width:80%;"><strong>Ecoles</strong></th>

				<th   style="background: #CFD4D8;border-style: solid;border-width: 1px;  overflow: hidden;

  word-break: normal;  border-color: #a9a9a9;width:15%;"><center><strong>Note</strong></center></th>

			  </tr>  



			 </table>

			 

			 <div style=" height: 200px; overflow-y: scroll;">



			 <table width="670px" cellpadding="0" border="0">

 

                         <?php

                         $req_exp = mysql_query("SELECT * FROM prm_ecoles");

                         while ($ecol = mysql_fetch_array($req_exp)) {

                             $ecol_id = $ecol['id_ecole'];

                             $ecol_desc = $ecol['nom_ecole'];

 

 

						?>		 

								<tr> 		

									 <td style="border: 1px solid #aabcfe;width:80%;"> <?php echo $ecol_desc; ?> </td>

									 

									 <td style="border: 1px solid #aabcfe;width:15%;">

										<center>

											<select id="<?php echo $ecol_id; ?>_e" name="<?php echo $ecol_id; ?>_e" style="width:50px;"/>

													<option value="0" selected="selected">0</option> 

													<option value="10"  >10</option> 

													<option value="15"  >15</option> 

													<option value="25"  >25</option> 

											</select> 

										</center>

									 </td>  

									 

								 </tr>	 

 

						<?php		 

                         }

                         ?> 

                 

			 

			 

			 

			 </table>

	</div>	



			 </td></tr>			



 <tr><td colspan="2"><div class="ligneBleu"></div></td></tr>



            <tr><td colspan="2">

	

			  

	

			 <table width="670px" cellpadding="0" border="0">

			 

			 

			   <tr>

				<th  style="background: #CFD4D8;border-style: solid;border-width: 1px;  overflow: hidden;

  word-break: normal;  border-color: #a9a9a9;width:80%;"><strong>Filières</strong></th>

				<th  style="background: #CFD4D8;border-style: solid;border-width: 1px;  overflow: hidden;

  word-break: normal;  border-color: #a9a9a9;width:15%;"><center><strong>Note</strong></center></th>

			  </tr>

		

			 </table>

			 

			 <div style=" height: 200px; overflow-y: scroll;">

	

			 <table width="670px" cellpadding="0" border="0">

 

                         <?php

                         $req_exp = mysql_query("SELECT * FROM prm_filieres");

                         while ($fonc = mysql_fetch_array($req_exp)) {

                             $fonc_id = $fonc['id_fili'];

                             $fonc_desc = $fonc['filiere'];

  

				 

 

						?>		 

		<tr> 		

									 <td style="border: 1px solid #aabcfe;width:80%;"> <?php echo $fonc_desc; ?> </td>

									 

									 <td style="border: 1px solid #aabcfe;width:15%;">

										<center>

											<select id="<?php echo $fonc_id; ?>_f" name="<?php echo $fonc_id; ?>_f" style="width:50px;"/>

													<option value="0" selected="selected">0</option> 

													<option value="5"  >5</option> 

													<option value="15"  >15</option> 

													<option value="25"  >25</option> 

											</select> 

										</center>

									 </td>  

									 

								 </tr>	

						<?php		 

                         }

                         ?>

                     <!--</select>-->

                 

			 

			 

			 

			 </table>

	</div>		

			 </td></tr>		





 

			 

			 

 