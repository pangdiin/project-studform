<?php

/**
 * All route names are prefixed with 'admin.block'.
 */
Route::group([
    'namespace'  => 'Block',
], function () {

    /*
     * Block Management
     */
    Route::group([
        'middleware' => 'access.routeNeedsPermission:manage-block',
    ], function () {

        /**
         * Block CRUD 
         */
        Route::resource('block', 'BlockController', ['except' => ['show']]);
        Route::get('block/deleted',   'BlockController@deleted')->name('block.deleted');

        /**
         * For API
         */
        Route::group(['namespace' => 'Api', 'prefix' => 'api/block', 'as' => 'api.block.'], function () {
            /*
             * For DataTables
             */
            Route::post('index',            'BlockTableController@index')->name('index'  );
            Route::patch('restore/{block}', 'BlockController@restore'   )->name('restore');
            Route::delete('force/{block}',  'BlockController@force'     )->name('force'  );
           
        });
    });

});
