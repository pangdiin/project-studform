<?php

/**
 * All route names are prefixed with 'admin.newsletter'.
 */
Route::group([
    'namespace'  => 'Newsletter',
], function () {

    /*
     * Newsletter Management
     */
    Route::group([
        'middleware' => 'access.routeNeedsPermission:manage-newsletter', 
    ], function () {

        /**
         * Subscribe CRUD
         */
        Route::resource('newsletter', 'NewsletterController', ['only' => ['index', 'store', 'destroy']]);

        Route::group([
            'namespace' => 'Api',
            'as'        => 'api.newsletter.',
            'prefix'    => 'api/newsletter/'
        ], function () {
            Route::post('index',                'NewsletterTableController@index' )->name('index'      );
            Route::post('subscribe',            'NewsletterController@subscribe'  )->name('subscribe'  );
            Route::post('resubscribe/{email}',  'NewsletterController@resubscribe')->name('resubscribe'  );
            Route::post('unsubscribe/{email}',  'NewsletterController@unsubscribe')->name('unsubscribe');
            Route::delete('delete/{email}',     'NewsletterController@delete'     )->name('delete'     );
        });

    });

});
