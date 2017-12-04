<div id="idTable2" class="subscription" style="margin: 10px 0pt;">

                                    <h1>Critére de notation</h1>

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

              <b>Ecole </b><br/>

              <b>Filière </b><br/>

              <b>Année d’obtention du diplôme </b>

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

              <b>Expérience probante  </b><br/>

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

              <b>Stages probants </b><br/>

            </td>

            <td style="border: 1px solid #ccc;text-align: left;">

              <center><?php echo $r_notation_1['note_stages']; ?></center>

            </td>

          </tr>

          <tr>

          <td>

            

          </td> 

            <td  style="border: 1px solid #ccc;text-align: left;background:#CFD4D8;">

           <b <?php echo $color_note;?> >TOTAL</b>

            </td>

            

            <td style="border: 1px solid #ccc;text-align: left;background:#CFD4D8;">

              <center><b <?php echo $color_note;?> ><?php echo $sum_not; ?></b></center>

            </td>

          </tr>

        </tbody>

      </table> 