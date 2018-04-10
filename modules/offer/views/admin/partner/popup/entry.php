<input type="hidden" name="id_entry" value="<?= isset($entry->id_entry) ? $entry->id_entry : ''; ?>">
<input type="hidden" name="id_role_offre" value="<?= $id_role_offre; ?>">

<div class="row">	
  <div class="col-md-12">
    <div class="subscription mt-0 mb-10" style="height: 23px;">
      <h1><?php trans_e("Informations Candidat"); ?></h1>
    </div>
  </div>	
</div>

<div class="row mb-10">
  <label for="last_name" class="col-md-3"><?php trans_e("Nom candidat"); ?></label>
  <div class="col-md-9">
    <input type="text" name="last_name" id="last_name" value="<?= isset($entry->last_name) ? $entry->last_name : ''; ?>">
  </div>
</div>

<div class="row mb-10">
  <label for="first_name" class="col-md-3"><?php trans_e("Prénom candidat"); ?></label>
  <div class="col-md-9">
    <input type="text" name="first_name" id="first_name" value="<?= isset($entry->first_name) ? $entry->first_name : ''; ?>">
  </div>
</div>

<div class="row mb-10">
  <label for="cin" class="col-md-3"><?php trans_e("CIN"); ?></label>
  <div class="col-md-9">
    <input type="text" name="cin" id="cin" value="<?= isset($entry->cin) ? $entry->cin : ''; ?>">
  </div>
</div>

<div class="row mb-10">
  <label for="mobile" class="col-md-3"><?php trans_e("Téléphone"); ?></label>
  <div class="col-md-9">
    <input type="number" name="mobile" id="mobile" value="<?= isset($entry->mobile) ? $entry->mobile : ''; ?>">
  </div>
</div>

<div class="row">	
  <div class="col-md-12">
    <div class="subscription mt-0 mb-10" style="height: 23px;">
      <h1><?php trans_e("Pièces jointes"); ?></h1>
    </div>
  </div>	
</div>

<div class="row">	
  <div class="col-md-12">
    <table class="table">
      <tbody>
        <?php if(isset($entry->attachments) && $entry->attachments != '') : foreach (json_decode($entry->attachments, true) as $attach_title => $value) : ?>
        <tr>
          <td width="150" style="padding: 4px 2px;"><input type="text" value="<?= $attach_title; ?>" disabled></td>
          <td><a href="<?= site_url('uploads/partner/entries/'. $entry->id_entry .'/'.$value); ?>" target="_blank"><i class="fa fa-download"></i>&nbsp;<?php trans_e("Télécharger"); ?></a></td>
          <td>
            <button type="button" class="btn btn-danger btn-xs" onclick="return window.chmModal.confirm(this, '', '<?php trans_e("Êtes-vous sûr de vouloir supprimer cette pièce joint ?"); ?>', 'chmOffer.deleteEntryAttachement', {eid: '<?= $entry->id_entry; ?>', roid: '<?= $id_role_offre; ?>', 'title': '<?= $attach_title; ?>'}, {width:315})"><i class="fa fa-trash"></i></button>
          </td>
        </tr>
        <?php endforeach; endif; ?>
        <tr>
          <td width="150" style="padding: 4px 2px;"><input type="text" name="titles[]" placeholder="<?php trans_e("Titre (CV, Lettre de motivation...)"); ?>"></td>
          <td width="250" style="padding: 4px 2px;"><input type="file" name="attachments[]" accept="image/*|.doc,.docx,.xls,.xlsx,.pdf"></td>
          <td width="5" style="padding: 4px 2px;"><button type="button" class="btn btn-success btn-block btn-xs addLine"><i class="fa fa-plus"></i></button></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>