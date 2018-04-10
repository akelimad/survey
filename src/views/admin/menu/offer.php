<ul class="nav nav-pills nav-stacked mb-15">
<?php echo \App\Models\Menu::draw([
  [
    "label" => trans("Etat des offres"),
    "route" => "backend/offres/",
    "icon" => "fa fa-pie-chart"
  ],
  [
    "label" => trans("Liste des offres"),
    "route" => "backend/offres/liste_offre/",
    "icon" => "fa fa-list-ul"
  ],
  [
    "label" => trans("Créer une offre"),
    "route" => "backend/offres/creer_offre/",
    "icon" => "fa fa-plus"
  ],
  [
    "label" => trans("Partager des offres"),
    "route" => "backend/offres/partager_offre/",
    "icon" => "fa fa-share-alt"
  ],
  [
    "label" => trans("Matching des offres"),
    "route" => "backend/offres/matching_offre/",
    "icon" => "fa fa-random"
  ],
  [
    "label" => trans("Campagne de recrutement"),
    "route" => "backend/offres/campagne_recrutement/",
    "icon" => "fa fa-bullhorn"
  ],
  [
    "label" => trans("Rechercher des offres"),
    "route" => "backend/offres/rechercher_offre/",
    "icon" => "fa fa-search"
  ]
]); ?>
</ul>