<?php

/*
 * View composer to add number of shopping cart items into top banner
 */
View::composer('components.page-frame.top-banner', function($view) {
    $view->with('numCartItems', ShoppingCartController::getNumberOfItems());
});

View::composer('layouts.base', function($view) {
    $isOldIE = false;
    if(preg_match('/(?i)msie [2-8]/',$_SERVER['HTTP_USER_AGENT']))
    {
        $isOldIE = true;
    }
    $view->with('isLessThanIE9', $isOldIE);
});

