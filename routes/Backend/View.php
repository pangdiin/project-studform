<?php

/**
 * All route names are prefixed with 'admin.view'.
 */
Route::group([
    'namespace'  => 'View',
], function () {

    /*
     * View Management
     */
    Route::group([
        'middleware' => 'access.routeNeedsPermission:manage-view',
    ], function () {

        /**
         * view CRUD 
         */
        Route::resource('view', 'ViewController', ['except' => ['show']]);
        Route::get('view/deleted',   'ViewController@deleted')->name('view.deleted');

        /**
         * For API
         */
        Route::group(['namespace' => 'Api', 'prefix' => 'api/view', 'as' => 'api.view.'], function () {
            /*
             * For DataTables
             */
            Route::post('index', 'ViewTableController@index')->name('index'  );
            Route::get('restore/{view}', 'ViewController@restore')->name('restore');
            Route::patch('restore/{view}', 'ViewController@restore')->name('restore');
            Route::delete('force/{view}',  'ViewController@force'  )->name('force'  );

            Route::delete('content/{view}/destory/{content}/criteria/{criteria}',  'ViewController@contentDestroy'  )->name('content.criteria.destroy');
           
        });
    });

});
