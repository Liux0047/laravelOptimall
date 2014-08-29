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
 * Route to login page
 */
Route::get('login', 'MemberController@showLoginPage');

/*
 * Route to process login
 */
Route::post('login', 'MemberController@login');


/*
 * Route to sign up
 */
Route::get('sign-up', 'MemberController@signUp');

/*
 * Route to process sign up form submit
 */
Route::post('sign-up', 'MemberController@processSignUp');

/*
 * Route to verify registration
 */
Route::get('sign-up/verify/{email}/{com_code}', 'MemberController@verifyRegistration');


Route::group(array('before' => 'auth'), function() {
    /*
     * Route to logout
     */
    Route::get('logout', 'MemberController@logout');

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
    Route::post('shopping-cart/apply-coupon', 'CouponController@applyCoupon');
    
    /*
     * Route to remove coupon
     */
    Route::post('shopping-cart/remove-coupon', 'CouponController@removeCoupon');
    
    /*
     * Route to check tou
     */
    Route::get('checkout','ShoppingCartController@showCheckoutPage');
    
    /*
     * Route to add address
     */
    Route::post('checkout/add-address','AddressController@createAddress');
    
    /*
     * Route to update address
     */
    Route::post('checkout/update-address','AddressController@updateAddress');
    
    /*
     * Route to use address
     */
    Route::post('checkout/use-address','AddressController@useAddress');
    
    /*
     * Route to member shopping history page
     */
    Route::get('shopping-history','MemberAccountController@showShoppingHistory');
    
});

/*
 * Route to help page
 */
Route::get('help', 'HelpController@showHelpPage');

/*
 * View composer to add number of shopping cart items into top banner
 */
View::composer('components.page-frame.top-banner', function($view) {
    $view->with('numCartItems', ShoppingCartController::getNumberOfItems());
});
