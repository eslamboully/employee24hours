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

        // BlackList System
        Route::get('blacklist','HomeController@blockList')->name('blacklist');

        // Contact Us
        Route::get('contact-us','HomeController@contactUs')->name('contact-us');

        // Languages Crud System
        Route::resource('languages','LanguageController')->except(['destroy']);
        Route::get('languages/destroy/{id?}','LanguageController@destroy')->name('languages.destroy');

        // Admins Crud System
        Route::resource('admins','AdminController')->except(['destroy']);
        Route::get('admins/destroy/{id?}','AdminController@destroy')->name('admins.destroy');
        Route::post('admins/block/{id?}','AdminController@addBlockOrRemove')->name('admins.block');

        // Companies Crud System
        Route::resource('companies','CompanyController')->except(['destroy']);
        Route::get('companies/destroy/{id?}','CompanyController@destroy')->name('companies.destroy');
        Route::post('companies/block/{id?}','CompanyController@addBlockOrRemove')->name('companies.block');

        // Employees Crud System
        Route::resource('employees','EmployeeController')->except(['destroy']);
        Route::get('employees/destroy/{id?}','EmployeeController@destroy')->name('employees.destroy');
        Route::post('employees/block/{id?}','EmployeeController@addBlockOrRemove')->name('employees.block');

        // Support Systems Crud System
        Route::resource('support-systems','SupportSystemController')->except(['destroy']);
        Route::get('support-systems/destroy/{id?}','SupportSystemController@destroy')->name('support-systems.destroy');

        // Plans Crud System
        Route::resource('plans','PlanController')->except(['destroy']);
        Route::get('plans/destroy/{id?}','PlanController@destroy')->name('plans.destroy');

        // Agreements Crud System
        Route::resource('agreements','AgreementController')->except(['destroy']);
        Route::get('agreements/destroy/{id?}','AgreementController@destroy')->name('agreements.destroy');

        // Departments Crud System
        Route::resource('departments','DepartmentController')->except(['destroy']);
        Route::get('departments/destroy/{id?}','DepartmentController@destroy')->name('departments.destroy');

        // Skills Crud System
        Route::resource('skills','SkillController')->except(['destroy']);
        Route::get('skills/destroy/{id?}','SkillController@destroy')->name('skills.destroy');

        // Jobs System
        Route::get('jobs','JobController@index')->name('jobs.index');
        Route::get('jobs/{id}/show','JobController@show')->name('jobs.show');
        Route::post('jobs/refuse/{id?}','JobController@refuse')->name('jobs.refuse');
        Route::post('jobs/accept/{id?}','JobController@accept')->name('jobs.accept');

    });


});
