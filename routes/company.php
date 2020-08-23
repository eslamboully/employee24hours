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

        // Products Crud System
        Route::resource('products','ProductController')->except(['destroy']);
        Route::get('products/destroy/{id?}','ProductController@destroy')->name('products.destroy');

        // Block Product
        Route::get('block-products','ProductController@blockProductIndex')->name('block-products');
        Route::post('products/block/{id?}','ProductController@blockProduct')->name('products.block');

        // Recommended Products System
        Route::get('recommended-products','ProductController@recommended')->name('recommended-products');
        Route::post('recommended-products/destroy/{id?}','ProductController@recommendedDestroy')->name('recommended-products.destroy');

        // Meals Crud System
        Route::resource('meals','MealController')->except(['destroy']);
        Route::get('meals/destroy/{id?}','MealController@destroy')->name('meals.destroy');

        // Questions Crud System
        Route::resource('questions','QuestionController')->except(['destroy']);
        Route::get('questions/destroy/{id?}','QuestionController@destroy')->name('questions.destroy');

        // Service Categories Crud System
        Route::resource('service-categories','ServiceCategoryController')->except(['destroy']);
        Route::get('service-categories/destroy/{id?}','ServiceCategoryController@destroy')->name('service-categories.destroy');

        // Service Crud System
        Route::resource('services','ServiceController')->except(['destroy']);
        Route::get('services/destroy/{id?}','ServiceController@destroy')->name('services.destroy');

        // Corporation Crud System
        Route::resource('corporations','CorporationController')->except(['destroy']);
        Route::get('corporations/destroy/{id?}','CorporationController@destroy')->name('corporations.destroy');

        // Job Types Crud System
        Route::resource('job-types','JobTypeController')->except(['destroy']);
        Route::get('job-types/destroy/{id?}','JobTypeController@destroy')->name('job-types.destroy');

        // Jobs Crud System
        Route::resource('jobs','JobController')->except(['destroy']);
        Route::post('jobs/parent/ajax/{id?}','JobController@parent_ajax')->name('jobs.parent.ajax');
        Route::get('jobs/destroy/{id?}','JobController@destroy')->name('jobs.destroy');
        Route::get('jobs/bids/{id?}','JobController@jobBids')->name('jobs.bids.index');
        Route::post('jobs/accept/{id}','JobController@jobBidsAccept')->name('jobs.bids.accept');
        Route::post('jobs/jobs/contract','ContractController@store')->name('jobs.contract.store');

        // Missions Crud System
        Route::resource('missions','MissionController')->except(['destroy']);
        Route::get('missions/status/{id?}','MissionController@status')->name('missions.edit.status');
        Route::get('missions/destroy/{id?}','MissionController@destroy')->name('missions.destroy');

        // Bids Crud System
//        Route::get('offers/{id}','OfferController')->name('offers.index');
    });


});
