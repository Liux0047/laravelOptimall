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
 * Route to show shopping cart page
 */
Route::get('shopping-cart/', 'ShoppingCartController@showShoppingCartPage');


/*
 * Route to add item into cart
 */
Route::post('shopping-cart/add-item', 'ShoppingCartController@AddItem');

/*
 * Route to update prescription
 */
Route::post('shopping-cart/update-prescription', 'ShoppingCartController@updatePrescription');

/*
 * Route to increment quatity
 */
Route::post('shopping-cart/increment-quatity', 'ShoppingCartController@incrementQuatity');

/*
 * Route to decrement quatity
 */
Route::post('shopping-cart/decrement-quatity', 'ShoppingCartController@decrementQuatity');

/*
 * Route to remove item
 */
Route::post('shopping-cart/remove-item', 'ShoppingCartController@removeItem');

/*
 * Route to set plano
 */
Route::post('shopping-cart/set-plano', 'ShoppingCartController@setPlano');

/*
 * Route to apply coupon
 */
Route::post('shopping-cart/apply-coupon', 'ShoppingCartController@applyCoupon');


/*
 * Route to help page
 */
Route::get('help', 'HelpController@showHelpPage');



