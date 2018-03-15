<ul class="nav nav-pills nav-stacked mb-15">
<?php echo \App\Models\Menu::draw([
  [
    "label" => "Etat des offres",
    "route" => "backend/offres/",
    "icon" => "fa fa-pie-chart"
  ],
  [
    "label" => "Liste des offres",
    "route" => "backend/offres/liste_offre/",
    "icon" => "fa fa-list-ul"
  ],
  [
    "label" => "Créer une offre",
    "route" => "backend/offres/creer_offre/",
    "icon" => "fa fa-plus"
  ],
  [
    "label" => "Partager des offres",
    "route" => "backend/offres/partager_offre/",
    "icon" => "fa fa-share-alt"
  ],
  [
    "label" => "Matching des offres",
    "route" => "backend/offres/matching_offre/",
    "icon" => "fa fa-random"
  ],
  [
    "label" => "Campagne de recrutement",
    "route" => "backend/offres/campagne_recrutement/",
    "icon" => "fa fa-bullhorn"
  ],
  [
    "label" => "Rechercher des offres",
    "route" => "backend/offres/rechercher_offre/",
    "icon" => "fa fa-search"
  ]
]); ?>
</ul>