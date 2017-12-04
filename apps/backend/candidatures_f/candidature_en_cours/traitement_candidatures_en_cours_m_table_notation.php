<div  class="subscription" style="margin: 10px 0pt;">

        <h1>Critére de notation </h1>

      </div>

 

      <table width="100%" style="  border-collapse: collapse;">

        <thead>

          <tr>

            <td colspan="2" style="border: 1px solid #ccc;text-align: left;background:#CFD4D8;">

            <b><center>CRITERES</center></b>

            </td>

            <td colspan="1" style="border: 1px solid #ccc;text-align: left;background:#CFD4D8;">

            <b><center>NIVEAUX</center></b>

            </td>

          </tr>

        </thead>

        <tbody>

          <tr>

            <td width="30%" style="border: 1px solid #ccc;text-align: left;">

              <b>FORMATION</b>

            </td>

            <td width="40%" style="border: 1px solid #ccc;text-align: left;">

             Ecole <br/>

              Filière <br/>

             Année d’obtention du diplôme

            </td>

            <td width="10%" style="border: 1px solid #ccc;text-align: left;">

             <center><?php echo $r_notation_1['note_ecole']; ?></center>

             <center><?php echo $r_notation_1['note_filiere']; ?></center>

             <center><?php echo $r_notation_1['note_diplome']; ?></center>

 



            </td>

          </tr>

          <tr>

            <td style="border: 1px solid #ccc;text-align: left;">

              <b>EXPERIENCE CONFIRMEE</b>

            </td>

            <td style="border: 1px solid #ccc;text-align: left;">

             Expérience probante <br/>

            </td>

            <td style="border: 1px solid #ccc;text-align: left;">

            <center><?php echo $r_notation_1['note_experience']; ?></center>

            </td>

          </tr>

           <tr>

            <td style="border: 1px solid #ccc;text-align: left;">

              <b>STAGES</b>

            </td>

            <td style="border: 1px solid #ccc;text-align: left;">

              Stages probants  <br/>

            </td>

            <td style="border: 1px solid #ccc;text-align: left;">

              <center><?php echo $r_notation_1['note_stages']; ?></center>

            </td>

          </tr>

          <tr>

          <td>

            

          </td> 

            <td  style="border: 1px solid #ccc;text-align: left;">

            <center><b>TOTAL N° 1</b></center>

            </td>

            

            <td style="border: 1px solid #ccc;text-align: left;">

             <center><b><?php echo $sum_not1; ?></b></center>

            </td>

          </tr>

        </tbody>

      </table>

       <div  class="subscription" style="margin: 10px 0pt;">

       <h1>Notation de commission</h1>

       </div>

    <table width="100%" style="  border-collapse: collapse;">

    <thead>

          <tr>

            <td  style="border: 1px solid #ccc;text-align: left;background:#CFD4D8;">

            <b><center>APTITUDES</center></b>

            </td>

            <td style="border: 1px solid #ccc;text-align: left;background:#CFD4D8;">

            <b><center>NOTES</center></b>

            </td>

            <td style="border: 1px solid #ccc;text-align: left;background:#CFD4D8;">

            <b><center>COEFFICIENT</center></b>

            </td>

          </tr>

        </thead>

        <tbody>

           <tr>





            <td style="border: 1px solid #ccc;text-align: left;">

              <b>Qualifications techniques</b>

            </td>

            <td style="border: 1px solid #ccc;text-align: left;">

            <center><?php echo $r_notation_2['note_qualif']; ?></center>

            </td>

            <td style="border: 1px solid #ccc;text-align: left;">

             <center>50%</center> 

            </td>

            

          </tr>

           <tr>

            <td style="border: 1px solid #ccc;text-align: left;">

              <b>Communication</b>

            </td>

            <td style="border: 1px solid #ccc;text-align: left;">

              <center><?php echo $r_notation_2['note_commun']; ?></center>

            </td>

            <td style="border: 1px solid #ccc;text-align: left;">

              <center>30% </center>

            </td>

            

          </tr>

           <tr>

            <td style="border: 1px solid #ccc;text-align: left;">

              <b>Comportement</b>

            </td>

            <td style="border: 1px solid #ccc;text-align: left;">

              <center><?php echo $r_notation_2['note_compor']; ?></center>

            </td>

            <td style="border: 1px solid #ccc;text-align: left;">

              <center>20% </center>

            </td>

          </tr>

          <tr>

          <td>

            

          </td> 

            <td  style="border: 1px solid #ccc;text-align: left;">

            <center><b>TOTAL N° 2</b></center>

            </td>

            <td style="border: 1px solid #ccc;text-align: left;">

             <center><b><?php echo $sum_note2; ?></b></center>

            </td>

          </tr>

        </tbody> 

      </table><br/>

      <table width="100%" style="  border-collapse: collapse;">

        <thead>

          <tr>

            <td  style="border: 1px solid #ccc;text-align: left;background:#CFD4D8;?>">

            <b><center>TOTAL</center></b>

            </td>

            <td style="border: 1px solid #ccc;text-align: left;background:#CFD4D8;?>">

            <b><center>NOTES</center></b>

            </td>

            <td style="border: 1px solid #ccc;text-align: left;background:#CFD4D8;">

            <b><center>COEFFICIENT</center></b>

            </td>

            <td style="border: 1px solid #ccc;text-align: left;background:#CFD4D8;">

            <b><center>Résultat</center></b>

            </td>

          </tr>

        </thead>

        <tbody>

          <tr>

            <td  style="border: 1px solid #ccc;text-align: left;">

              <b>TOTAL N°1</b>

            </td> 

            <td width="15%" style="border: 1px solid #ccc;text-align: left;">

             <center><?php echo $sum_not1; ?></center>

            </td>

            <td width="45%" style="border: 1px solid #ccc;text-align: left;">

             <center> ( TOTAL N°1 / 100 ) * 40 %</center>

            </td>

            <td width="15%" style="border: 1px solid #ccc;text-align: left;">

             <center><?php echo $sum_not1_final2." % "; ?></center>

            </td>

            

          </tr>

          <tr>

            <td  style="border: 1px solid #ccc;text-align: left;">

              <b>TOTAL N°2</b>

            </td> 

            <td style="border: 1px solid #ccc;text-align: left;">

            <center><?php echo $sum_note2; ?></center>

            </td>

             <td style="border: 1px solid #ccc;text-align: left;">

            <center> ( TOTAL N°2 <b>/</b> 40 )<b>*</b> 2.5 <b>=</b> resultat <b>*</b> 60%</center>

            </td>

             <td style="border: 1px solid #ccc;text-align: left;">

            <center><?php echo $sum_note2_final2." % "; ?></center>

            </td>

          </tr>



          <tr> 

          <td colspan="2">

            

          </td>

            <td  style="border: 1px solid #ccc;text-align: left;">

           <center><b>TOTAL FINAL </b></center>

            </td>

            

            <td colspan="1" style="border: 1px solid #ccc;text-align: left;background:<?php echo $color_bg;?>">

             <center><b style="color:#fff"><?php echo $sum_ffinal2." % "; ?></b></center>

            </td>

          </tr>

        </tbody>

      </table>