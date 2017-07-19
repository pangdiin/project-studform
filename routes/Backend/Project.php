<?php

/**
 * All route names are prefixed with 'admin.project'.
 */
Route::group([
    'namespace'  => 'Project',
], function () {

    /*
     * Project Management
     */
    Route::group([
        'middleware' => 'access.routeNeedsPermission:manage-project',
    ], function () {

        /**
         * Project CRUD 
         */
        Route::resource('project', 'ProjectController', ['except' => ['show']]);
        Route::get('project/deleted',   'ProjectController@deleted')->name('project.deleted');

        /**
         * PROJECT GALLERY
         */
        Route::get('project/gallery/{project}', 'ProjectGalleryController@show')->name('gallery.project.index');
        Route::post('project/gallery/{project}/store', 'ProjectGalleryController@store')->name('gallery.project.store');

        /**
         * For API
         */
        Route::group(['namespace' => 'Api', 'prefix' => 'api/project', 'as' => 'api.project.'], function () {
            /*
             * For DataTables
             */
            Route::post('index', 'ProjectTableController@index')->name('index'  );
            Route::patch('restore/{project}', 'ProjectController@restore')->name('restore');
            Route::delete('force/{project}',  'ProjectController@force'  )->name('force'  );
           
        });
    });

});
