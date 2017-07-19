<?php

/**
 * All route names are prefixed with 'admin.inquiry'.
 */
Route::group([
    'namespace'  => 'Inquiry',
], function () {

    /*
     * User Management
     */
    Route::group([
        'middleware' => 'access.routeNeedsPermission:manage-inquiry',
    ], function () {
        /**
         * Inquiry CRUD
         */
        Route::resource('inquiry', 'InquiryController', ['only' => ['index', 'show', 'destroy']]);


        /**
         * For API
         */
        Route::group(['namespace' => 'Api', 'prefix' => 'inquiry', 'as' => 'api.inquiry.'], function () {
            /*
             * For DataTables
             */
            Route::post('index', 'InquiryTableController@index')->name('index');

        });
    });

});
