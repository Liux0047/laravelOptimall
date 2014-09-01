<?php

/**
 * Description of AmbassadorController
 *
 * @author Allen
 */
class AmbassadorController extends BaseController {
    
    public function getAmabassador () {
        $params['pageTitle'] = "目光之城形象大使";
        return View::make('pages.ambassador.ambassador', $params);
    }

    public function postCreateAmbassador() {
        $params['pageTitle'] = "目光之城形象大使";
        if (!isset(Auth::user()->ambassador_code) || strlen(Auth::user()->ambassador_code)==0) {
            $params['isAlreadyAmbassador'] = false;
            $code = $this->generateUniqueId();
            $params['amabassadorCode'] = $code;
            Auth::user()->ambassador_code = $code;
            Auth::user()->save();
            return View::make('pages.ambassador.ambassador-created', $params);
        }
        else {
            $params['isAlreadyAmbassador'] = true;
            return View::make('pages.ambassador.ambassador-created', $params);
        }
    }
    
    public static function createAmbassadorRealtion ($newMemberId, $code) {
        $ambassadorRelation = new AmbassadorRelation;
        $ambassadorId = Member::where('ambassador_code', '=', $code)->first()->member_id;
        if (isset($ambassadorId)){
            $ambassadorRelation->ambassador = $ambassadorId;
            $ambassadorRelation->invited_member = $newMemberId;
            $ambassadorRelation->save();
            return true;
        }
        else {
            return false;
        }        
    }
    
    public static function isAmbassadorCodeValid ($code) {
        return (Member::where('ambassador_code', '=', $code)->count() > 0);
    }

    private function generateUniqueId() {
        return uniqid();
    }

}
