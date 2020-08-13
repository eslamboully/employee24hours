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
    });


});
