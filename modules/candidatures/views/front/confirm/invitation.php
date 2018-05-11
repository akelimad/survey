<page format="100x200" orientation="L" backcolor="#fff" style="font: arial;">
  <div style="position: relative; right: -376px; top: 165px; font-style: italic; font-weight: normal; text-align: center; font-size: 11px; font-weight: 700;"><?php trans_e("Votre invitation au concours") ?></div>
  <table style="width: 99%;border: none;" cellspacing="2mm" cellpadding="0">
    <tr>
      <td style="width: 25%;"> 
        <div class="zone" style="height: 40mm;vertical-align: middle;text-align: center;margin-top:20px;"><br>
          <barcode code="<?= site_url('backend/candidature/invitation/'. $data->id_agend .'/validate'); ?>" disableborder="1" type="QR" class="barcode" size="1.5" error="M" />
        </div>            
      </td>
      <td style="width: 45%"> 
        <div class="zone" style="height: 40mm;vertical-align: middle; text-align: justify"><br>
          <table>
            <tr>
              <th align="left" width="75"><?php trans_e("Numéro") ?></th>
              <td>:&nbsp;<?= sprintf('%04d', $data->id_agend); ?></td>
            </tr>
            <tr>
              <th align="left"><?php trans_e("Date") ?></th>
              <td>:&nbsp;<?= eta_date($data->start, '%A %d %B', true) .' à '. eta_date($data->start, 'H:i'); ?></td>
            </tr>
            <tr>
              <th align="left"><?php trans_e("Lieu") ?></th>
              <td>:&nbsp;<?= $data->lieu; ?></td>
            </tr>
            <tr>
              <th align="left"><?php trans_e("Nom") ?></th>
              <td>:&nbsp;<?= $data->nom ?></td>
            </tr>
            <tr>
              <th align="left"><?php trans_e("Prénom") ?></th>
              <td>:&nbsp;<?= $data->prenom; ?></td>
            </tr>
            <tr>
              <th align="left"><?php trans_e("Email") ?></th>
              <td>:&nbsp;<?= $data->email; ?></td>
            </tr>
            <tr>
              <th align="left"><?php trans_e("Téléphone") ?></th>
              <td>:&nbsp;<?= $data->tel1; ?></td>
            </tr>
          </table>
        </div>            
      </td>
    </tr>
  </table>
</page>