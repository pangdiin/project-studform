<?php

/**
 * Inquiry Frontend
 */
/*
 * These frontend controllers require the user to be logged in
 * All route names are prefixed with 'frontend.'
 */
Route::group(['namespace' => 'Project', 'as' => 'project.'], function () {
    /*
     * User Dashboard Specific
     */
    Route::get('projects', 			 'ProjectController@index')->name('index');
    Route::get('projects/{project}', 'ProjectController@show')->name('show');

});
