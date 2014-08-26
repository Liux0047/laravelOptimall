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

/*
 * Index page
 */
Route::get('/', 'ProductController@showIndexPage');

/*
 * Route to product page
 */
Route::get('product/{modelId}', 'ProductController@showProductPage')
        ->where('modelId', '[0-9]+');


/* 
 * Route to shopping cart page
 */
Route::get('shopping-cart/', 'ShoppingCartController@showShoppingCartPage');

/*
 * Route to help page
 */
Route::get('help', 'HelpController@showHelpPage');



