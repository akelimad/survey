<div class="container mb-30 mb-xs-15 pl-0 pr-0">
  <div class="row">
    <div class="col-md-12">
      <nav class="navbar navbar-default" id="topNav">
        <div class="container-fluid pl-5 pl-xs-15">
          <ul class="nav navbar-nav navbar-right pr-5">
            <li><a href="<?= get_site('site_url'); ?>" target="_blank" style="color:#ffffff;" title="Accès au site de l'institution - Nouvelle fenêtre">Accès au site de l'institution</a></li>
            <li><a href="<?= site_url('infos/contact/') ?>" title="Contactez-nous">Contactez-nous</a></li>
          </ul>
        </div>
      </nav>
    </div>
    <div class="col-md-12">
      <?php get_view('partials/admin_menu'); ?>
    </div>
  </div>
  <div class="row" id="breadcrumbs">
    <div class="col-md-6 col-xs-12">
      Vous êtes ici&nbsp;:&nbsp;<strong><?= $ariane; ?></strong>
    </div>
    <div class="col-md-6 col-xs-12">
      <?php if(isset($_SESSION['abb_admin'])) : ?>
        <div class="pull-right">
          Connecté en tant que: <b><?= $_SESSION['abb_admin']; ?></b> | <a href="<?= site_url('index.php?action=logout') ?>">Déconnexion</a>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>