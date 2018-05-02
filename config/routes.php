<?php
use App\Route;

$isLoggedCandidat = isLogged('candidat');
$canUpdateAccount = \Modules\Candidat\Models\Candidat::canUpdateAccount();

// Homepage
Route::add('/', 'App\Controllers\Front\HomeController@index');

// Auth
Route::add('auth/login', 'App\Controllers\Front\AuthController@loginModal', true);
Route::add('candidat/login', 'App\Controllers\Front\AuthController@login', true);
Route::add('candidat/logout', 'App\Controllers\Front\AuthController@logout');
Route::add('candidat/inscription', 'App\Controllers\Front\AuthController@register');
Route::add('candidat/store', 'App\Controllers\Front\AuthController@store', true);
Route::add('candidat/terms', 'App\Controllers\Front\AuthController@terms', true);
Route::add('candidat/account/reset-password', 'App\Controllers\Front\AuthController@resetPassword', true);
Route::add('candidat/account/re-activate', 'App\Controllers\Front\AuthController@reActivate', true);
Route::add('candidat/account/resent-email', 'App\Controllers\Front\AuthController@resentEmail', true);

// Formulaire Forum
Route::add('candidat/forum', 'App\Controllers\Front\CandidatController@getForumForm', false, !$isLoggedCandidat);


// Candidat account
Route::add('candidat/account/confirm/[a-zA-Z0-9]+', 'App\Controllers\Front\CandidatController@confirmAccount');
Route::add('candidat/account/candidature/deleteSpontanee', 'App\Controllers\Front\CandidatureController@deleteSpontanee');
Route::add('candidat/account/candidature/deleteStage', 'App\Controllers\Front\CandidatureController@deleteStage');

Route::add('candidature/spontanee', 'App\Controllers\Front\CandidatureController@spontanee', true, $isLoggedCandidat);
Route::add('candidature/stage', 'App\Controllers\Front\CandidatureController@stage', true, $isLoggedCandidat);

Route::add('candidat/account/alert/form', 'App\Controllers\Front\AlertController@form', true, $isLoggedCandidat);
Route::add('candidat/account/alert/activate', 'App\Controllers\Front\AlertController@activate', true, $isLoggedCandidat);
Route::add('candidat/account/alert/delete', 'App\Controllers\Front\AlertController@delete', true, $isLoggedCandidat);
Route::add(
  'candidat/account/alert/table', 
  'App\Controllers\Front\Tables\AlertTableController@getTable', 
  true, 
  $isLoggedCandidat
);

Route::add(
  'candidat/compte', 
  'App\Controllers\Front\CandidatController@account', 
  false, 
  $isLoggedCandidat
);
Route::add(
  'candidat/identifiants', 
  'App\Controllers\Front\CandidatController@changePassword', 
  false, 
  $isLoggedCandidat
);
Route::add(
  'candidat/change-password', 
  'App\Controllers\Front\CandidatController@changePassword', 
  true, 
  $isLoggedCandidat
);


// Mon CV
Route::add(
  'candidat/cv', 
  'App\Controllers\Front\CandidatController@cv', 
  false, 
  $isLoggedCandidat
);
Route::add(
  'candidat/cv/informations', 
  'App\Controllers\Front\CandidatController@informations', 
  false, 
  ($isLoggedCandidat && $canUpdateAccount)
);

// Candidat formations
Route::add(
  'candidat/cv/formations', 
  'App\Controllers\Front\FormationController@index', 
  false, 
  ($isLoggedCandidat && $canUpdateAccount)
);
Route::add(
  'candidat/cv/formation', 
  'App\Controllers\Front\FormationController@getForm', 
  true, 
  ($isLoggedCandidat && $canUpdateAccount)
);
Route::add(
  'candidat/cv/formation/[0-9]+', 
  'App\Controllers\Front\FormationController@getForm', 
  true, 
  ($isLoggedCandidat && $canUpdateAccount)
);
Route::add(
  'candidat/cv/formation/[0-9]+/delete', 
  'App\Controllers\Front\FormationController@delete', 
  true, 
  ($isLoggedCandidat && $canUpdateAccount)
);
Route::add(
  'candidat/cv/formation/delete-diplome-copy', 
  'App\Controllers\Front\FormationController@deleteDiplome', 
  true, 
  ($isLoggedCandidat && $canUpdateAccount)
);
Route::add(
  'candidat/cv/formation/store', 
  'App\Controllers\Front\FormationController@store', 
  true, 
  ($isLoggedCandidat && $canUpdateAccount)
);
Route::add(
  'candidat/cv/formation/table', 
  'App\Controllers\Front\Tables\FormationTableController@getTable', 
  true, 
  ($isLoggedCandidat && $canUpdateAccount)
);

// Candidat experiences
Route::add(
  'candidat/cv/experiences', 
  'App\Controllers\Front\ExperienceController@index', 
  false, 
  ($isLoggedCandidat && $canUpdateAccount)
);
Route::add(
  'candidat/cv/experience', 
  'App\Controllers\Front\ExperienceController@getForm', 
  true, 
  ($isLoggedCandidat && $canUpdateAccount)
);
Route::add(
  'candidat/cv/experience/[0-9]+', 
  'App\Controllers\Front\ExperienceController@getForm', 
  true, 
  ($isLoggedCandidat && $canUpdateAccount)
);
Route::add(
  'candidat/cv/experience/[0-9]+/delete', 
  'App\Controllers\Front\ExperienceController@delete', 
  true, 
  ($isLoggedCandidat && $canUpdateAccount)
);
Route::add(
  'candidat/cv/experience/delete-certificate', 
  'App\Controllers\Front\ExperienceController@deleteCertificate', 
  true, 
  ($isLoggedCandidat && $canUpdateAccount)
);
Route::add(
  'candidat/cv/experience/delete-bulletin-paie', 
  'App\Controllers\Front\ExperienceController@deleteBulletinPaie', 
  true, 
  ($isLoggedCandidat && $canUpdateAccount)
);
Route::add(
  'candidat/cv/experience/store', 
  'App\Controllers\Front\ExperienceController@store', 
  true, 
  ($isLoggedCandidat && $canUpdateAccount)
);
Route::add(
  'candidat/cv/experience/table', 
  'App\Controllers\Front\Tables\ExperienceTableController@getTable', 
  true, 
  ($isLoggedCandidat && $canUpdateAccount)
);

Route::add(
  'candidat/cv/langues_pj', 
  'App\Controllers\Front\CandidatController@languages', 
  false, 
  ($isLoggedCandidat && $canUpdateAccount)
);
Route::add(
  'candidat/cv/langues_pj/delete-photo', 
  'App\Controllers\Front\CandidatController@deletePhoto', 
  true, 
  ($isLoggedCandidat && $canUpdateAccount)
);
Route::add(
  'candidat/cv/langues_pj/delete-cv', 
  'App\Controllers\Front\CandidatController@deleteCV', 
  true, 
  ($isLoggedCandidat && $canUpdateAccount)
);
Route::add(
  'candidat/cv/langues_pj/delete-lm', 
  'App\Controllers\Front\CandidatController@deleteLM', 
  true, 
  ($isLoggedCandidat && $canUpdateAccount)
);
Route::add(
  'candidat/cv/langues_pj/delete-permis-conduire', 
  'App\Controllers\Front\CandidatController@deletePermisConduire', 
  true, 
  ($isLoggedCandidat && $canUpdateAccount)
);
Route::add(
  'candidat/cv/langues_pj/set-cv-default', 
  'App\Controllers\Front\CandidatController@setCVDefault', 
  true, 
  ($isLoggedCandidat && $canUpdateAccount)
);
Route::add(
  'candidat/cv/langues_pj/set-lm-default', 
  'App\Controllers\Front\CandidatController@setLMDefault', 
  true, 
  ($isLoggedCandidat && $canUpdateAccount)
);

Route::add(
  'candidat/compte/desactiver', 
  'App\Controllers\Front\CandidatController@deactivateAccount', 
  false, 
  ($isLoggedCandidat && $canUpdateAccount)
);


// Pages
Route::add('terms', 'App\Controllers\Front\PageController@terms');
Route::add('conditions', 'App\Controllers\Front\PageController@conditions');
Route::add('sitemap', 'App\Controllers\Front\PageController@sitemap');
Route::add('contact', 'App\Controllers\Front\PageController@contact');
Route::add('bug-report', 'App\Controllers\Front\PageController@bugReport');

// Advanced search
Route::add('offres', 'App\Controllers\Front\OfferController@index');
Route::add('offres/stage', 'App\Controllers\Front\OfferController@index');
Route::add('offre/[0-9]+', 'App\Controllers\Front\OfferController@offer');
Route::add('offre/[0-9]+/postuler', 'App\Controllers\Front\OfferController@postuler');
Route::add('offre/[0-9]+/postuler/store', 'App\Controllers\Front\OfferController@storeCandidature');
Route::add('offre/[0-9]+/print', 'App\Controllers\Front\OfferController@printOffer');
Route::add('offre/[0-9]+/send-to-friend', 'App\Controllers\Front\OfferController@sendToFriend', true);
Route::add('offer/search-form', 'App\Controllers\Front\OfferController@searchForm', true);


// Backend
Route::add('backend/logout', 'App\Controllers\Admin\AuthController@logout');


// Dashboard Statistiques
Route::add('dashboard/chart/sector', 'App\Controllers\Admin\StatsController@sectorChart', true, isLogged('admin'));
Route::add('dashboard/chart/residence-country', 'App\Controllers\Admin\StatsController@residenceCountryChart', true, isLogged('admin'));
Route::add('dashboard/chart/situation', 'App\Controllers\Admin\StatsController@situationChart', true, isLogged('admin'));
Route::add('dashboard/chart/experience', 'App\Controllers\Admin\StatsController@experienceChart', true, isLogged('admin'));
Route::add('dashboard/chart/offers-status', 'App\Controllers\Admin\StatsController@offersStatusChart', true, isLogged('admin'));
Route::add('dashboard/chart/candidatures-status', 'App\Controllers\Admin\StatsController@candidaturesStatusChart', true, isLogged('admin'));
