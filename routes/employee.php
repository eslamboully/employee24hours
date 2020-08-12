<?php

Route::group(['prefix' => 'employee-panel','as' => 'employee.'], function () {

    // Employee Login
    Route::get('/login','HomeController@login')->name('login');
    Route::post('/login','HomeController@login_post')->name('login.post');
    Route::get('/logout','HomeController@logout')->name('logout');

    // Change Language For Employee Only
    Route::get('change-lang/{lang}','HomeController@changeLang')->name('change.lang');


    // Employee Panel Operations
    Route::group(['middleware' => 'employee.auth'],function () {

        // Employee Home
        Route::get('/', 'HomeController@home')->name('home');

        // Employee Profile
        Route::get('/profile','HomeController@profile')->name('profile');
        Route::post('/profile','HomeController@profile_post')->name('profile_post');


        // Companies Crud System
//        Route::resource('companies','CompanyController')->except(['destroy']);
//        Route::get('companies/destroy/{id?}','CompanyController@destroy')->name('companies.destroy');

        // Plans Crud System
//        Route::resource('plans','PlanController')->except(['destroy']);
//        Route::get('plans/destroy/{id?}','PlanController@destroy')->name('plans.destroy');
    });


});
