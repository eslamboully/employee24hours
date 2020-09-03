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


        // Jobs & Offers Crud System
        Route::get('jobs','JobController@jobIndex')->name('jobs.index');
        Route::get('jobs/show/{id}','JobController@show')->name('jobs.show');
        Route::post('jobs/bids/create','JobController@createBids')->name('jobs.bids.create');
        Route::get('jobs/bids/index','JobController@indexBids')->name('jobs.bids.index');
        Route::get('jobs/contract/update/{id}','ContractController@acceptContract')->name('jobs.contracts.accept');
        Route::post('jobs/contract/update','ContractController@refuseContract')->name('jobs.contracts.refuse');

        // Related Companies Crud System
        Route::get('related-companies','JobController@relatedCompanies')->name('related-companies.index');

        // Employee Tasks
        Route::get('tasks','TaskController@index')->name('tasks.index');
        Route::get('/tasks/finish/{id?}','TaskController@finishTask')->name('tasks.finish');

        // Contracts
        Route::get('contracts','ContractController@contractIndex')->name('contracts.index');

        // Profits
        Route::get('profits','ProfitController@profitIndex')->name('profits.index');
    });


});
