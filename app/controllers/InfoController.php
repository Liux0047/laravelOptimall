<?php

class InfoController extends BaseController {
    
    
    public function getAmbassadorIntro() {
        $params['pageTitle'] = "目光之星";
        return View::make('pages.info.ambassador', $params);
    }
    
    public function getAboutProducts() {
        $params['pageTitle'] = "关于目光之城";
        return View::make('pages.info.about-products', $params);
    }
    
    public function getTips () {
        return View::make('pages.info.tips');
    }
    
    public function getWechat() {
        return View::make('pages.info.wechat-QR');
    }

}
