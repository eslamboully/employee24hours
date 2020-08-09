<?php

Route::group(['prefix' => 'admin-panel','as' => 'admin.'], function () {

    // Admin Login
    Route::get('/login','HomeController@login')->name('login');
    Route::post('/login','HomeController@login_post')->name('login.post');
    Route::get('/logout','HomeController@logout')->name('logout');

    // Change Language For Admin Only
    Route::get('change-lang/{lang}','HomeController@changeLang')->name('change.lang');


    // Admin Panel Operations
    Route::group(['middleware' => 'admin.auth'],function () {

        // Admin Home
        Route::get('/', 'HomeController@home')->name('home');

        // Languages Crud System
        Route::resource('languages','LanguageController')->except(['destroy']);
        Route::get('languages/destroy/{id?}','LanguageController@destroy')->name('languages.destroy');

        // Companies Crud System
        Route::resource('companies','CompanyController')->except(['destroy']);
        Route::get('companies/destroy/{id?}','CompanyController@destroy')->name('companies.destroy');
    });


});
