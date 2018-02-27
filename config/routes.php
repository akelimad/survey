<?php
use App\Route;

$isLoggedCandidat = isLogged('candidat');

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

// Candidat account
Route::add('candidat/compte', 'App\Controllers\Front\CandidatController@account', false, $isLoggedCandidat);
Route::add('candidat/identifiants', 'App\Controllers\Front\CandidatController@changePassword', false, $isLoggedCandidat);
Route::add('candidat/change-password', 'App\Controllers\Front\CandidatController@changePassword', true, $isLoggedCandidat);

// Account
Route::add('candidat/cv/informations', 'App\Controllers\Front\CandidatController@informations', false, $isLoggedCandidat);
Route::add('candidat/cv/langues_pj', 'App\Controllers\Front\CandidatController@languages', false, $isLoggedCandidat);
Route::add('candidat/cv/langues_pj/delete-photo', 'App\Controllers\Front\CandidatController@deletePhoto', true, $isLoggedCandidat);

// Candidat formations
Route::add('candidat/cv/formations', 'App\Controllers\Front\FormationController@index', false, $isLoggedCandidat);
Route::add('candidat/cv/formation', 'App\Controllers\Front\FormationController@getForm', true, $isLoggedCandidat);
Route::add('candidat/cv/formation/[0-9]+', 'App\Controllers\Front\FormationController@getForm', true, $isLoggedCandidat);
Route::add('candidat/cv/formation/[0-9]+/delete', 'App\Controllers\Front\FormationController@delete', true, $isLoggedCandidat);
Route::add('candidat/cv/formation/delete-diplome-copy', 'App\Controllers\Front\FormationController@deleteDiplome', true, $isLoggedCandidat);
Route::add('candidat/cv/formation/store', 'App\Controllers\Front\FormationController@store', true, $isLoggedCandidat);
Route::add('candidat/cv/formation/table', 'App\Controllers\Front\Tables\FormationTableController@getTable', true, $isLoggedCandidat);

// Candidat experiences
Route::add('candidat/cv/experiences', 'App\Controllers\Front\ExperienceController@index', false, $isLoggedCandidat);
Route::add('candidat/cv/experience', 'App\Controllers\Front\ExperienceController@getForm', true, $isLoggedCandidat);
Route::add('candidat/cv/experience/[0-9]+', 'App\Controllers\Front\ExperienceController@getForm', true, $isLoggedCandidat);
Route::add('candidat/cv/experience/[0-9]+/delete', 'App\Controllers\Front\ExperienceController@delete', true, $isLoggedCandidat);
Route::add('candidat/cv/experience/delete-certificate', 'App\Controllers\Front\ExperienceController@deleteCertificate', true, $isLoggedCandidat);
Route::add('candidat/cv/experience/store', 'App\Controllers\Front\ExperienceController@store', true, $isLoggedCandidat);
Route::add('candidat/cv/experience/table', 'App\Controllers\Front\Tables\ExperienceTableController@getTable', true, $isLoggedCandidat);

// Pages
Route::add('infos/mentions_legales', 'App\Controllers\Front\PageController@terms');
Route::add('infos/conditions', 'App\Controllers\Front\PageController@conditions');
Route::add('infos/liens', 'App\Controllers\Front\PageController@sitemap');
Route::add('infos/contact', 'App\Controllers\Front\PageController@contact');

// Advanced search
Route::add('offres', 'App\Controllers\Front\OfferController@index');
Route::add('offres/stage', 'App\Controllers\Front\OfferController@index');
Route::add('offre/[0-9]+', 'App\Controllers\Front\OfferController@offer');
Route::add('offre/[0-9]+/postuler', 'App\Controllers\Front\OfferController@postuler');
Route::add('offre/[0-9]+/postuler/store', 'App\Controllers\Front\OfferController@storeCandidature');
Route::add('offre/[0-9]+/print', 'App\Controllers\Front\OfferController@printOffer');
Route::add('offre/[0-9]+/send-to-friend', 'App\Controllers\Front\OfferController@sendToFriend', true);
Route::add('offer/search-form', 'App\Controllers\Front\OfferController@searchForm', true);
