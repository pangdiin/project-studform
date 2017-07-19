<?php

/**
 * All route names are prefixed with 'admin.slide'.
 */
Route::group([
    'namespace'  => 'Slide',
], function () {

    /*
     * User Management
     */
    Route::group([
        'middleware' => 'access.routeNeedsPermission:manage-slide',
    ], function () {

        /**
         * Slide CRUD 
         */
        Route::resource('slide', 'SlideController');

        /**
         * For API
         */
        Route::group(['namespace' => 'Api', 'prefix' => 'api/slide', 'as' => 'api.slide.'], function () {
            /*
             * For DataTables
             */
            Route::post('index',            'SlideTableController@index')->name('index');
           
        });
    });

});
