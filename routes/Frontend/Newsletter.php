<?php

/**
 * Newsletter Frontend
 */
/*
 * These frontend controllers require the user to be logged in
 * All route names are prefixed with 'frontend.'
 */
Route::group(['namespace' => 'Newsletter'], function () {
    /*
     * Api
     */
    Route::group(['prefix' => 'api/newsletter/', 'as' => 'api.newsletter.', 'namespace' => 'Api'], function() {
	    
    	// Email
	    Route::post('subscribe', 'NewsletterController@store')->name('store');
	    
    });

});
