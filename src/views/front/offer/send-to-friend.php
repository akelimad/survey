<label for="email" class="form-label mt-0"><?php trans_e("L'email de votre ami"); ?></label>
<input type="hidden" name="id_offre" value="<?= (isset($id)) ? $id : 0 ?>">
<input type="email" name="email" class="form-control mb-0" required>