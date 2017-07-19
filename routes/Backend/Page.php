<?php

/**
 * All route names are prefixed with 'admin.page'.
 */
Route::group([
    'namespace'  => 'Page',
], function () {

    /*
     * Page Management
     */
    Route::group([
        'middleware' => 'access.routeNeedsPermission:manage-page',
    ], function () {

        /**
         * Page CRUD 
         */
        Route::resource('page', 'PageController', ['except' => ['show']]);
        Route::get('page/deleted',   'PageController@deleted')->name('page.deleted');

        /**
         * For API
         */
        Route::group(['namespace' => 'Api', 'prefix' => 'api/page', 'as' => 'api.page.'], function () {
            /*
             * For DataTables
             */
            Route::post('index', 'PageTableController@index')->name('index'  );
            Route::get('restore/{page}', 'PageController@restore')->name('restore');
            Route::patch('restore/{page}', 'PageController@restore')->name('restore');
            Route::delete('force/{page}',  'PageController@force'  )->name('force'  );
           
        });
    });

});
