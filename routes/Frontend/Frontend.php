<?php

/**
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */
Route::get('/', 'FrontendController@index')->name('index');
Route::get('macros', 'FrontendController@macros')->name('macros');
/*About Us*/
// Route::get('about', 'FrontendController@about')->name('about_us');
/*Products*/
// Route::get('products', 'FrontendController@products')->name('products');
/*Brands*/
// Route::get('brands', 'FrontendController@brands')->name('brands');
/*Contact Us*/
// Route::get('contact-us', 'FrontendController@contact_us')->name('contact_us');
/*Projects*/
// Route::get('projects', 'FrontendController@projects')->name('projects');
/*
 * These frontend controllers require the user to be logged in
 * All route names are prefixed with 'frontend.'
 */
Route::group(['middleware' => 'auth'], function () {
    Route::group(['namespace' => 'User', 'as' => 'user.'], function () {
        /*
         * User Dashboard Specific
         */
        Route::get('dashboard', 'DashboardController@index')->name('dashboard');

        /*
         * User Account Specific
         */
        Route::get('account', 'AccountController@index')->name('account');

        /*
         * User Profile Specific
         */
        Route::patch('profile/update', 'ProfileController@update')->name('profile.update');


    });
});
