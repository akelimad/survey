<style>
#menu-fo {
    padding-top: 0px;
}
.alert {
    margin-bottom: 5px;
}
</style>
<div id="gauche" style="width:100%;">
    <?php include ( site_base("lib/menu/menu_g_a_admin.php") ); ?>
    <div id="content_d" style="width: 735px;">
        <h1 style="display: inline;"><?php trans_e("LISTE DES FICHES DES CANDIDATURES"); ?></h1>
        <div class="pull-right mb-20">
            <a href="<?= site_url('backend/module/fiches/fiche/create?type=0'); ?>" class="btn btn-primary btn-xs"><?php trans_e("Créer une fiche de présélection"); ?></a>
            <a href="<?= site_url('backend/module/fiches/fiche/create?type=1'); ?>" class="btn btn-default btn-xs"><?php trans_e("Créer une fiche d'evaluation"); ?></a>
        </div>
        <?php \App\Session::getFlash(); ?>
        <?= $table->render(); ?>
    </div>
</div>