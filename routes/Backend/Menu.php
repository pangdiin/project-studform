<?php

/**
 * All route names are prefixed with 'admin.menu'.
 */
Route::group([
    'namespace'  => 'Menu',
], function () {

    /*
     * Menu Management
     */
Route::group([
        'middleware' => 'access.routeNeedsPermission:manage-menu',
    ], function () {

        /**
         * Menu CRUD 
         */
        Route::resource('menu', 'MenuController', ['except' => ['show', 'create', (config('menu.can_add') ? '' : 'store'), (config('menu.can_delete') ? '' : 'delete')]]);

        /**
         * For API
         */
        Route::group(['namespace' => 'Api', 'prefix' => 'api/menu', 'as' => 'api.menu.'], function () {
            /*
             * For DataTables
             */
            Route::post('index',            'MenuTableController@index')->name('index');
           
        });
    });

});
