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
Route::get('/', 'ProductController@getIndex');

/*
 * Route to product page
 */
Route::get('product/{modelId}', 'ProductController@getProduct')
        ->where('modelId', '[0-9]+');

/*
 * Route to prodct gallery page
 */
Route::get('gallery', 'ProductController@getGallery');

/*
 * Route to ajax load more products in gallery page
 */
Route::post('gallery/load-more-products', 'ProductController@postShowRemainingModels');

/*
 * Route to login page
 */
Route::get('login', 'MemberController@getLogin');

/*
 * Route to process login
 */
Route::post('login', 'MemberController@postLogin');

/*
 * Route to sign up
 */
Route::get('sign-up', 'MemberController@getSignUp');
Route::get('mobile-sign-up', 'MemberController@getMobileSignUp');


/*
 * Route to send verification code SMS
 */
Route::post('send-verification-code', 'MemberController@postSendVerificationCode');

/*
 * Route to process sign up form submit
 */
Route::post('sign-up', 'MemberController@postSignUp');
Route::post('mobile-sign-up', 'MemberController@postMobileSignUp');

/*
 * Route to resend verification email
 */
Route::get('sign-up/resend-verify-email', 'MemberController@getResendVerifyEmail');

/*
 * Route to verify registration
 */
Route::get('sign-up/verify/{email}/{reg_code}', 'MemberController@verifyRegistration');


Route::group(array('before' => 'auth'), function() {
    /*
     * Route to logout
     */
    Route::get('logout', 'MemberController@getLogout');

    /*
     * Route to shopping cart controler
     */
    Route::get('shopping-cart/my-cart', 'ShoppingCartController@getMyCart');
    /*
     * Route to add item into cart
     */
    Route::get('shopping-cart/add-item', 'ShoppingCartController@getAddItem');
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
     * RESTFUL Route to address controller
     */
    Route::controller('address', 'AddressController');

    /*
     * RESTFUL Route to member account functions
     */
    Route::controller('member', 'MemberAccountController');

    /*
     * Route to submit order into Alipay
     */
    Route::post('alipay/submit-order', 'OrderController@postSubmitOrder');
    /*
     * Route to re-submit the payment
     */
    Route::post('alipay/re-submit-payment', 'OrderController@postReSubmitPayment');

    /*
     * Route to Alipay return
     */
    Route::get('alipay-return/return', 'OrderController@getAlipayReturn');

    /*
     * RESTFUL Route to ambassador controller
     */
    Route::controller('ambassador', 'AmbassadorController');

    /*
     * RESTFUL Route to handle review functions
     */
    Route::controller('review', 'ReviewController');

    /*
     * RESTFUL Route to handle user question functions
     */
    Route::controller('question', 'QuestionController');

});

/*
 * Route to Alipay partner trade notify URL
 */
Route::post('alipay-return/partner-trade-notify', 'OrderController@postAlipayPartnerTradeNotify');
/*
 * Route to Alipay direct pay notify URL
 */
Route::post('alipay-return/direct-pay-notify', 'OrderController@postAlipayDirectPayNotify');

/*
 * Route to about page
 */
Route::controller('info', 'InfoController');

/*
 * Route to remind password controller
 */
Route::controller('password-remind', 'RemindersController');

/*
 * Route for review uploads
 */
Route::post('upload/review/{itemId}', 'UploadController@anyReviewImage');

/*
 * Route for review delete
 */
Route::delete('upload/review/{itemId}', 'UploadController@anyReviewImage');

/*
 * Route to admin account controller
 */
Route::controller('admin', 'AdminController');

Route::group(array('before' => 'admin'), function() {
    /*
     * Route to admin function controller
     */
    Route::controller('admin-dashboard', 'AdminFunctionController');
});


//all routes sent via a post http request will use the csrf filter
Route::when('shopping-cart/*', 'csrf', array('post'));
Route::when('coupon/*', 'csrf', array('post'));
Route::when('address/*', 'csrf', array('post'));
Route::when('member/*', 'csrf', array('post'));
Route::when('ambassador/*', 'csrf', array('post'));
Route::when('review/*', 'csrf', array('post'));
Route::when('question/*', 'csrf', array('post'));
Route::when('alipay/*', 'csrf', array('post'));
Route::when('admin/*', 'csrf', array('post'));
Route::when('share/*', 'csrf', array('post'));


/*
 * Marketing pages
 */
Route::controller('share', 'MarketingController');

