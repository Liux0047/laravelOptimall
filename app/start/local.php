<?php

App::before(function($request) {
    if (!Cookie::has('internalTestWarning')) {
        Cookie::queue('internalTestWarning', 1, 60 * 24);
    }
});
//