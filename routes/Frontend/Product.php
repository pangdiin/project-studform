<?php

/**
 * Inquiry Frontend
 */
/*
 * These frontend controllers require the user to be logged in
 * All route names are prefixed with 'frontend.'
 */
Route::group(['namespace' => 'Product', 'as' => 'product.'], function () {
    /*
     * User Dashboard Specific
     */
    Route::get('products'		   , 'ProductController@index')->name('index');
    Route::get('products/{product}', 'ProductController@show')->name('show');

});
