<?php

/**
 * All route names are prefixed with 'admin.setting'.
 */
Route::group([
    'namespace'  => 'Setting',
], function () {

    /*
     * Setting Management
     */
    Route::group([
        'middleware' => 'access.routeNeedsPermission:manage-setting',
        'as' => 'setting.',
        'prefix' => 'setting/'
    ], function () {

        /**
         * Setting  
         */
        Route::get('index',             'SettingController@index' )->name('index' );
        Route::get('show/{group}',      'SettingController@show'  )->name('show'  );
        Route::patch('update/{group}',  'SettingController@update')->name('update');

    });

});
