<?php

Route::group(['prefix' => 'company-panel','as' => 'company.'], function () {

    // Company Login
    Route::get('/login','HomeController@login')->name('login');
    Route::post('/login','HomeController@login_post')->name('login.post');
    Route::get('/logout','HomeController@logout')->name('logout');

    // Change Language For Company Only
    Route::get('change-lang/{lang}','HomeController@changeLang')->name('change.lang');


    // Company Panel Operations
    Route::group(['middleware' => 'company.auth'],function () {

        // Company Home
        Route::get('/', 'HomeController@home')->name('home');

        // Company Profile
        Route::get('/profile','HomeController@profile')->name('profile');
        Route::post('/profile','HomeController@profile_post')->name('profile_post');

         // Conventions Crud System
        Route::resource('conventions','ConventionController')->except(['destroy']);
        Route::get('conventions/destroy/{id?}','ConventionController@destroy')->name('conventions.destroy');

        // Companies Crud System
//        Route::resource('companies','CompanyController')->except(['destroy']);
//        Route::get('companies/destroy/{id?}','CompanyController@destroy')->name('companies.destroy');

        // Plans Crud System
//        Route::resource('plans','PlanController')->except(['destroy']);
//        Route::get('plans/destroy/{id?}','PlanController@destroy')->name('plans.destroy');
    });


});
