<?php

/**
 * All route names are prefixed with 'admin.project'.
 */
Route::group([
    'namespace'  => 'Letter',
], function () {

    /*
     * Letter Management
     */
    Route::group([
        'middleware' => 'access.routeNeedsPermission:manage-letter',
    ], function () {

        /**
         * Project CRUD 
         */
        Route::resource('letter', 'LetterController', ['except' => ['show']]);;
        // Route::resource('project', 'ProjectController', ['except' => ['show']]);
        // Route::get('project/deleted',   'ProjectController@deleted')->name('project.deleted');

        /**
         * For API
         */
        Route::group(['namespace' => 'Api', 'prefix' => 'api/letter', 'as' => 'api.letter.'], function () {
            /*
             * For DataTables
             */
            Route::post('index', 'LetterTableController@index')->name('index');
           
        });
    });

});
