<?php
use App\Route;

// Homepage
Route::add('/', 'App\Controllers\Front\HomeController@index');

// Auth
Route::add('candidat/login', 'App\Controllers\Front\AuthController@login', true);
Route::add('candidat/logout', 'App\Controllers\Front\AuthController@logout');
Route::add('candidat/inscription', 'App\Controllers\Front\AuthController@register');
Route::add('candidat/store', 'App\Controllers\Front\AuthController@store', true);
Route::add('candidat/terms', 'App\Controllers\Front\AuthController@terms', true);
Route::add('candidat/account/reset-password', 'App\Controllers\Front\AuthController@resetPassword', true);
Route::add('candidat/account/re-activate', 'App\Controllers\Front\AuthController@reActivate', true);
Route::add('candidat/account/resent-email', 'App\Controllers\Front\AuthController@resentEmail', true);

// Candidat account
Route::add('candidat/compte', 'App\Controllers\Front\CandidatController@account');
Route::add('candidat/identifiants', 'App\Controllers\Front\CandidatController@changePassword');
Route::add('candidat/change-password', 'App\Controllers\Front\CandidatController@changePassword', true);

Route::add('candidat/cv/formations', 'App\Controllers\Front\CandidatController@formations');
Route::add('candidat/cv/formation', 'App\Controllers\Front\CandidatController@formationForm', true);
Route::add('candidat/cv/formation/[0-9]+', 'App\Controllers\Front\CandidatController@formationForm', true);

// Auth modal
Route::add('auth/login', 'App\Controllers\Front\AuthController@loginModal', true);


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
