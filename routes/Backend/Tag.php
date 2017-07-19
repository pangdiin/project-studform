<?php

/**
 * All route names are prefixed with 'admin.tag'.
 */
if(config('tag.active')){

    Route::group([
        'namespace'  => 'Tag',
    ], function () {

        /*
         * User Management
         */
        Route::group([
            'middleware' => 'access.routeNeedsPermission:manage-tag',
        ], function () {

            /**
             * Tag CRUD inde | show
             */


            Route::get('tag/{tag_type?}/index',      'TagController@index')->name('tag.index');
            Route::get('tag/{tag_type?}/edit/{tag}', 'TagController@edit')->name('tag.edit');
            Route::patch('tag/{tag_type?}/update/{tag}',   'TagController@update')->name('tag.update');
            Route::post('tag/{tag_type?}/store',            'TagController@store')->name('tag.store');
            Route::delete('tag/{tag_type?}/destroy/{tag}',  'TagController@destroy')->name('tag.destroy');

            /**
             * For API
             */
            Route::group(['namespace' => 'Api', 'prefix' => 'api/tag/{tag_type?}/', 'as' => 'api.tag.'], function () {
                /*
                 * For DataTables
                 */
                Route::post('index',            'TagTableController@index')->name('index');
                Route::post('show',             'TagTableController@show')->name('show');
               
            });
        });

    });
    
}
