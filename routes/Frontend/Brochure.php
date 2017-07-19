<?php

/**
 * Inquiry Frontend
 */
/*
 * These frontend controllers require the user to be logged in
 * All route names are prefixed with 'frontend.'
 */
Route::group(['namespace' => 'Brochure', 'as' => 'Brochure.'], function () {
    /*
     * User Dashboard Specific
     */
    Route::get('Brochures', 'BrochureController@index')->name('index');

});
