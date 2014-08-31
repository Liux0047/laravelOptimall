<?php

class HelpController extends BaseController {
    
    public function getHelp() {
        $params['pageTitle'] = "目光之城帮助";
        return View::make('pages.help', $params);
    }
    
    public function getAboutProducts() {
        $params['pageTitle'] = "关于目光之城";
        return View::make('pages.help.about-products', $params);
    }
    
    public function getAboutShopping() {
        $params['pageTitle'] = "关于目光之城";
        return View::make('pages.help.about-shopping', $params);
    }

}
