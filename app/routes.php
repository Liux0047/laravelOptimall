<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});

/*
 * Route to view-item page
 */
Route::get('product/{modelId}', 'ProductController@showProductPage')
        ->where('modelId', '[0-9]+');

/*
 * Route to help page
 */
Route::get('help', 'HelpController@showHelpPage');



