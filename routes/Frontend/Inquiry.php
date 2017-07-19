<?php

/**
 * Inquiry Frontend
 */
/*
 * These frontend controllers require the user to be logged in
 * All route names are prefixed with 'frontend.'
 */
Route::group(['namespace' => 'Inquiry', 'as' => 'inquiry.'], function () {
    /*
     * User Dashboard Specific
     */
    Route::post('contact-us', 'InquiryController@store')->name('store');

});
