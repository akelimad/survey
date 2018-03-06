<div class="styled-title mt-0 mb-10">
  <h3>Récapitulatif de l'offre</h3>
</div>

<table>
  <tbody>
    <tr>
      <td width="120" style="font-size: 11px;">Lieu de travail</td>
      <td style="font-size: 11px;">:&nbsp;<strong><?= $lieu->name ?></strong></td>
    </tr>
    <tr>
      <td style="font-size: 11px;">Date de publication</td>
      <td style="font-size: 11px;">:&nbsp;<strong><?= date('d.m.Y', strtotime($offer->date_insertion)) ?></strong></td>
    </tr>
  </tbody>
</table>

<div class="styled-title mt-15 mb-10">
  <h3>Votre motivation pour le poste</h3>
</div>

<input type="hidden" name="region[id]" value="<?= $lieu->id ?>">
<input type="hidden" name="region[ville]" value="<?= $lieu->name ?>">
<input type="hidden" name="candidature[id_offre]" value="<?= $offer->id_offre ?>">

<label for="candidat_cv" class="form-label mt-0">Choisissez un CV&nbsp;<span style="color: red">*</span></label>
<select id="candidat_cv" name="candidature[id_cv]" class="form-control" required>
  <option value=""></option>
  <?php foreach ($candidat_cvs as $key => $value) : ?>
    <option value="<?= $value->id_cv ?>"><?= $value->titre_cv ?></option>
  <?php endforeach; ?>
</select>


<label for="candidat_lm" class="form-label mt-0">Choisissez une Lettre de motivation</label>
<select id="candidat_lm" name="candidature[id_lettre]" class="form-control">
  <option value=""></option>
  <?php foreach ($candidat_lms as $key => $value) : ?>
    <option value="<?= $value->id_lettre ?>"><?= $value->titre ?></option>
  <?php endforeach; ?>
</select>

<label for="motivation" class="form-label mt-0">Votre motivation&nbsp;<span style="color: red">*</span></label>
<textarea name="candidature[motivation]" class="ckeditor form-control" id="motivation" required></textarea>

<label for="confirm" class="mt-10">
  <input type="checkbox" id="confirm" style="width: auto;" required>
  <strong style="font-size: 10px;">Je confirme qu'après l'envoi de ma candidature, je ne pouvez plus editer vos informations.</strong>
</label>

<script>
jQuery(document).ready(function(){

  // editors
  CKEDITOR.replace('motivation', {height: 200});

})
</script>