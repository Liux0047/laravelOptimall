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
     * Route to shopping cart controler
     */
    Route::get('shopping-cart/my-cart', 'ShoppingCartController@getMyCart');
    /*
     * Route to add item into cart
     */
    Route::post('shopping-cart/add-item', 'ShoppingCartController@postAddItem');
    /*
     * Route to update prescription
     */
    Route::post('shopping-cart/update-prescription', 'ShoppingCartController@postUpdatePrescription');
    /*
     * Route to increment quatity
     */
    Route::post('shopping-cart/update-quatity', 'ShoppingCartController@postUpdateQuatity');
    /*
     * Route to remove item
     */
    Route::post('shopping-cart/remove-item', 'ShoppingCartController@postRemoveItem');
    /*
     * Route to set plano
     */
    Route::post('shopping-cart/set-plano', 'ShoppingCartController@postSetPlano');

    /*
     * Route to checkout
     */
    Route::get('shopping-cart/checkout', 'ShoppingCartController@getCheckout');
    
    /*
     * Route to coupon Controller
     */
    Route::controller('coupon', 'CouponController');
        
    /*
     * Route to address controller
     */
    Route::controller('address','AddressController');
        
    /*
     * Route to member account functions
     */
    Route::controller('member', 'MemberAccountController');
    
    /*
     * Route to submit order into Alipay
     */
    Route::post('alipay/submit-order', 'AlipayController@postSubmitOrder');
    /*
     * Route to Alipay notify URL
     */
    Route::get('alipay/notify', 'AlipayController@getNotify');
    /*
     * Route to Alipay return
     */
    Route::get('alipay/return', 'AlipayController@getReturn');
});

/*
 * Route to help page
 */
Route::get('help', 'HelpController@showHelpPage');

/*
 * Route to remind password controller
 */
Route::controller('password-remind', 'RemindersController');


//all routes sent via a post http request will use the csrf filter
Route::when('shopping-cart/*', 'csrf', array('post'));
Route::when('coupon/*', 'csrf', array('post'));
Route::when('address/*', 'csrf', array('post'));
Route::when('member/*', 'csrf', array('post'));

/*
 * View composer to add number of shopping cart items into top banner
 */
View::composer('components.page-frame.top-banner', function($view) {
    $view->with('numCartItems', ShoppingCartController::getNumberOfItems());
});
