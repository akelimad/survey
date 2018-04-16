<h1 class="mb-10"><?php trans_e("Se désabonner") ?></h1>

<?php if (!$is_subscribed) : ?>
  <?php get_alert('info', trans("Votre email a été déja désabonner."), false) ?>
<?php else : ?>
  <?php
  $raisons = [
    trans("Je reçois plusieurs notifications"),
    trans("Je ne suis plus à la recherche d'emploi"),
    trans("Autres à préciser")
  ];
  ?>

  <form method="POST" action="" chm-form class="chm-simple-form" id="unsubscribe">
    <div class="styled-title mt-10 mb-10">
      <h3><?php trans_e("Vous souhaitez désabonné de nos alertes ?"); ?></h3>
    </div>

    <strong><?php trans_e("Pourquoi souhaiteriez-vous désabonner ?"); ?></strong>

    <ul class="mt-15 mb-15 ml-15">
      <?php foreach ($raisons as $key => $raison) : ?>
      <li class="mb-10">
        <label for="raison_<?= $key; ?>">
          <input type="radio" name="raison" value="<?= $raison ?>" id="raison_<?= $key; ?>" required>
          <?= $raison ?>
        </label>
      </li>
      <?php endforeach; ?>
    </ul>

    <input type="text" name="raison_other" id="raison_other" class="form-control ml-15" style="width:98%;display: none;">

    <div class="ligneBleu mt-5"></div>
    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-warning"></i>&nbsp;<?php trans_e("Désabonner"); ?></button>
  </form>

  <script>
  $(document).ready(function() {
    $('[name="raison"]').change(function () {
      $('#raison_other').val('')
      if ($(this).closest('li').index() == 2) {
        $('#raison_other').show()
      } else {
        $('#raison_other').hide()
      }
    })

    $('#unsubscribe').on('chm_form_success', function(event, response) {
      $(this).replaceWith('<div class="chm-alerts alert alert-success alert-white rounded "><div class="icon"><i class="fa fa-check"></i></div><ul><li>'+ response.message +'</li></ul></div>')
    })
  })
  </script>
<?php endif; ?>