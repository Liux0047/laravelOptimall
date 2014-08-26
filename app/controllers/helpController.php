<?php

class HelpController extends BaseController {
    
    public function showHelpPage() {
        $params['pageTitle'] = "目光之城帮助";
        return View::make('help', $params);
    }

}
