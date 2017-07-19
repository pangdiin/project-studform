<?php

/**
 * All route names are prefixed with 'admin.product'.
 */
Route::group([
    'namespace'  => 'Product',
], function () {

    /*
     * User Management
     */
    Route::group([
        'middleware' => 'access.routeNeedsPermission:manage-product',
    ], function () {

        /**
         * Slide CRUD 
         */
        Route::resource('product', 'ProductController');
        
        /**
         * GALLERY
         */
        Route::get('product/gallery/{product}', 'ProductGalleryController@show')->name('gallery.product.index');
        Route::post('product/gallery/{product}/store', 'ProductGalleryController@store')->name('gallery.product.store');

        /**
         * BROCHURE
         */
        Route::get('product/brochure/{product}', 'ProductBrochureController@show')->name('product.brochure.index');
        Route::post('product/brochure/{product}/store', 'ProductBrochureController@store')->name('product.brochure.store');
        Route::get('product/brochure/{brochure}/delete', 'ProductBrochureController@destroy')->name('product.brochure.destroy');

        /**
         * For API
         */
        Route::group(['namespace' => 'Api', 'prefix' => 'api/product', 'as' => 'api.product.'], function () {
            /*
             * For DataTables
             */
            Route::post('index',            'ProductTableController@index')->name('index');

            // Route::patch('restore/{product}', 'ProductStatusController@restore')->name('restore');
            // Route::delete('force/{product}', 'ProductStatusController@force'   )->name('force'  );
           
        });
    });

});
