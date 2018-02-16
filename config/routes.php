<?php
use App\Route;

// Homepage
Route::add('/', 'App\Controllers\Front\HomeController@index');

// Candidat
Route::add('candidat/login', 'App\Controllers\Front\CandidatController@login');
Route::add('candidat/reset-password', 'App\Controllers\Front\CandidatController@resetPassword');

// Register
Route::add('candidat/inscription', 'App\Controllers\Front\RegisterController@register');
Route::add('candidat/store', 'App\Controllers\Front\RegisterController@store');
Route::add('candidat/terms', 'App\Controllers\Front\RegisterController@terms');


// Pages
Route::add('infos/mentions_legales', 'App\Controllers\Front\PageController@terms');
Route::add('infos/conditions', 'App\Controllers\Front\PageController@conditions');
Route::add('infos/liens', 'App\Controllers\Front\PageController@sitemap');
Route::add('infos/contact', 'App\Controllers\Front\PageController@contact');
