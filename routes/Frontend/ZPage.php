<?php

/**
 * Inquiry Frontend
 */
/*
 * These frontend controllers require the user to be logged in
 * All route names are prefixed with 'frontend.'
 */
Route::group(['namespace' => 'Page', 'as' => 'page.'], function () {
    /*
     * User Dashboard Specific
     */
    Route::get('page/{tag_type_or_node}', 'PageController@node')->name('node.show');
    Route::get('{front_page}', 'PageController@show')->name('show');
    Route::get('{front_page}/{item}/view', 'PageController@viewShow')->name('show.view');

});
