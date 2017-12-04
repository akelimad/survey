



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

						 

                         $req_ecol = mysql_query("SELECT * FROM prm_ecoles");

                         while ($ecol = mysql_fetch_array($req_ecol)) {

						 

                             $e_id = $ecol['id_ecole'];

                             $e_desc = $ecol['nom_ecole'];

 

						 $e_0='e0'.$e_id;$e_1='e1'.$e_id;$e_2='e2'.$e_id;$e_3='e3'.$e_id;

						 

						$array_e = array($e_0 => 0,$e_1 => 0,$e_2 => 0,$e_3 => 0);

						 

						 

                         $req_o_e = mysql_query("SELECT * FROM offre_necole Where id_offre=".$id_off_m." ");

                         while ($o_e = mysql_fetch_array($req_o_e)) {

                             $o_e_id = $o_e['id_ecole'];

                             $o_e_desc = $o_e['note'];

							 

							 if($e_id==$o_e_id){

									if($o_e_desc=='10'){

										$array_e[$e_1]=1; 

									}elseif($o_e_desc=='15'){

										$array_e[$e_2]=1; 

									}elseif($o_e_desc=='25'){

										$array_e[$e_3]=1; 

									}else {

										$array_e[$e_0]=1; 

									}

							 }

						}		

  

						?>		 

								<tr> 		

									 <td style="border: 1px solid #aabcfe;width:80%;"> <?php echo $e_desc; ?> </td>

									 

									 <td style="border: 1px solid #aabcfe;width:15%;">

										<center>

											<select id="<?php echo $e_id; ?>_e" name="<?php echo $e_id; ?>_e" style="width:50px;"/>

													<option value="0"  <?php if($array_e[$e_0]==1) echo 'selected="selected"'; ?> >0</option> 

													<option value="10" <?php if($array_e[$e_1]==1) echo 'selected="selected"'; ?> >10</option> 

													<option value="15" <?php if($array_e[$e_2]==1) echo 'selected="selected"'; ?> >15</option> 

													<option value="25" <?php if($array_e[$e_3]==1) echo 'selected="selected"'; ?> >25</option> 

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

						 

                         $req_f = mysql_query("SELECT * FROM prm_filieres");

                         while ($f = mysql_fetch_array($req_f)) {

						  

                             $f_id = $f['id_fili'];

                             $f_desc = $f['filiere'];

  

						 $f_0='f0'.$f_id;$f_1='f1'.$f_id;$f_2='f2'.$f_id;$f_3='f3'.$f_id;

						  

						$array_f = array($f_0 => 0,$f_1 => 0,$f_2 => 0,$f_3 => 0);

						 

                         $req_o_f = mysql_query("SELECT * FROM offre_nfiliere Where id_offre=".$id_off_m."  ");

                         while ($o_f = mysql_fetch_array($req_o_f)) {

						

                             $o_f_id = $o_f['id_fili'];

                             $o_f_desc = $o_f['note'];

							  

							 

							 if($f_id==$o_f_id){

									if($o_f_desc==5){

										$array_f[$f_1]=1; 

									}elseif($o_f_desc==15){

										$array_f[$f_2]=1; 

									}elseif($o_f_desc==25){

										$array_f[$f_3]=1; 

									}else {

										$array_f[$f_0]=1; 

									}

							 }

						}

						  

 

						?>		 

		<tr> 		

									 <td style="border: 1px solid #aabcfe;width:80%;"> <?php echo $f_desc; ?> </td>

									 

									 <td style="border: 1px solid #aabcfe;width:15%;">

										<center>

											<select id="<?php echo $f_id; ?>_f" name="<?php echo $f_id; ?>_f" style="width:50px;"/>

													<option value="0"  <?php if($array_f[$f_0]==1) echo 'selected="selected"'; ?> >0</option> 

													<option value="5"  <?php if($array_f[$f_1]==1) echo 'selected="selected"'; ?> >5</option> 

													<option value="15" <?php if($array_f[$f_2]==1) echo 'selected="selected"'; ?> >15</option> 

													<option value="25" <?php if($array_f[$f_3]==1) echo 'selected="selected"'; ?> >25</option> 

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





 

			 

			 

 