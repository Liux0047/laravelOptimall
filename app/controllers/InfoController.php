<?php

class InfoController extends BaseController {
    
    
    public function getAmbassadorIntro() {
        $params['pageTitle'] = "目光之星";
        return View::make('pages.info.ambassador', $params);
    }
    
    public function getBeginnerGuide () {
        return View::make('pages.info.beginner-guide');
    }

    public function getAboutShoppings () {
        return View::make('pages.info.about-shoppings');
    }

    public function getAboutProducts() {
        $params['pageTitle'] = "关于目光之城";
        return View::make('pages.info.about-products', $params);
    }
    
    public function getMeasurePupilDistance () {
        return View::make('pages.info.measure-pupil-distance');
    }
    
    public function getChooseFrame () {
        return View::make('pages.info.choose-frame');
    }
    
    public function getAboutPrescription () {
        return View::make('pages.info.about-prescription');
    }
    
    public function getWechat() {
        return View::make('pages.info.wechat-QR');
    }

}
