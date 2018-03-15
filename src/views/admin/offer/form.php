<div class="row">
  <div class="col-sm-3 col-xs-12 custom pr-0 pr-xs-15">
    <?php get_view('admin/menu/offer') ?>
  </div>
  <div class="col-sm-9 col-xs-12 custom column-body">
    <h1><?= (isset($offer->id_offre)) ? 'Modifier une offre' : 'Créer une offre' ;?></h1>

    <form method="POST" action="<?= site_url('admin/offer/store'); ?>" class="chm-simple-form" onsubmit="return window.chmForm.submit(event)" enctype="multipart/form-data">

      <div class="styled-title mt-10 mb-10">
        <h3>Description du poste</h3>
      </div>
      <div class="row">
        <div class="col-sm-6 required">
          <label for="offer_name">Intitulé du poste</label>
          <input type="text" class="form-control" id="offer_name" name="offer[Name]" required>
        </div>
        <div class="col-sm-6 required">
          <label for="offer_fonction">Fonction / Département</label>
          <input type="text" class="form-control" id="offer_fonction" name="offer[id_fonc]" required>
        </div>
      </div>
      <div class="row mt-10">
        <div class="col-sm-12 required">
          <label for="offer_details">Mission et responsabilité</label>
          <textarea name="offer[Details]" class="form-control" id="offer_details" required></textarea>
        </div>
      </div>




    </form>
  </div>
</div>