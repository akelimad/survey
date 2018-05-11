<h1><?php trans_e("Conditions générales d'utilisation") ?></h1>
<?php if (get_setting('pages.conditions', '') != '') : ?>
  <?= get_setting('pages.conditions'); ?>
<?php else : ?>
<p align="justify" style="font-size:12px;"><strong>1.</strong> La solution <strong><?= $terms_site_title; ?>
</strong> et l'ensemble de son contenu, y compris textes, images fixes ou animées, bases de données, programmes, langage, jsp, cgi, etc., nommé ci-après <strong><?= $terms_site_title; ?>
</strong>, est protégé par le droit d'auteur.</p>
<p align="justify" style="font-size:12px;"><strong>2.</strong> La solution <strong><?= $terms_site_title; ?>
</strong> ne vous concède qu'une autorisation de visualisation de son contenu à titre personnel et privé, à l'exclusion de toute visualisation ou diffusion publique. L'autorisation de reproduction ne vous est concédée que sous forme numérique sur votre ordinateur de consultation aux fins de visualisation des pages consultées par votre logiciel de navigation. Conformément à la loi 09-08 relative à la protection des personnes physiques à l’égard du traitement des données à caractère personnel du 18 Février 2009 (BO n° 5714 du 05/03/2009), les personnes concernées par le traitement de données personnelles disposent d’un droit d’accès, de rectification et de suppression des données personnelles qui les concernent.</p>
<p align="justify" style="font-size:12px;"><strong>3.</strong> Toute autre utilisation non expressément visée aux présentes n'est pas permise et nécessite l'accord exprès écrit et préalable des propriétaires de la solution <strong><?= $terms_site_title; ?>
</strong>. Il ne vous est pas permis en dehors des utilisations expressément concédées ci-dessus, notamment : de reproduire des marques et logos de <?= $titre_site; ?>, <strong><?= $terms_site_title; ?>
</strong> et d'utiliser tous programmes utilisés par la solution, site Web, etc.</p>
<p align="justify" style="font-size:12px;"><strong>4.</strong> Malgré les soins apportés par l'équipe <strong><?= $terms_site_title; ?>
</strong>, les informations contenues dans la présente application sont données à titre indicatif et sont sujettes à changement sans préavis.</p>
<p align="justify" style="font-size:12px;"><strong>5.</strong> <?= $titre_site; ?> ne vous garantit pas l'exactitude, complétude, adéquation ou fonctionnement de la solution <strong><?= $terms_site_title; ?>
</strong> ou de l'information qu'elle contient, ni que ladite information a été vérifiée.</p>
<p align="justify" style="font-size:12px;"><strong>6.</strong> <?= $titre_site; ?> n'assume aucune responsabilité relative à l'information contenue et à l'existence ou la disponibilité de toute offre mentionnée dans la présente solution <strong><?= $terms_site_title; ?>
</strong> ou le site web et décline toute responsabilité découlant d'une négligence ou autre concernant cette information.</p>
<p align="justify" style="font-size:12px;"><strong>7.</strong> La présente solution est créée au Maroc. En l’utilisant, vous acceptez les conditions d'utilisation décrites ci-avant, sans préjudice de tous recours de nature contractuelle ou délictuelle pouvant être exercés par <?= $titre_site; ?>. Tout litige portant sur l'interprétation ou l'exécution d'un engagement contractuel prévu au présent site ou solution <strong><?= $terms_site_title; ?>
</strong> sera de la compétence exclusive des tribunaux marocains de Rabat faisant application de la loi marocaine.</p>
<p align="justify" style="font-size:12px;">8. L'ensemble des éléments de cette solution est protégé par copyright © <?= $titre_site; ?> par - tous droits réservés. Tous les éléments de propriété intellectuelle, marques, noms commerciaux et logos sont la propriété de <?= $titre_site; ?>, sauf mentions contraires. Toute reproduction de la solution <strong><?= $terms_site_title; ?>
</strong> est interdite.</p>
<?php endif; ?>