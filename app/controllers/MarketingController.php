<?php
/**
 * Created by PhpStorm.
 * User: Allen
 * Date: 2/25/2015
 * Time: 9:51 AM
 */

class MarketingController extends BaseController{

    public function getMoments() {
        return View::make('pages.marketing.moments');
    }

}