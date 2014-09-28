<?php

/**
 * Description of UploadController
 *
 * @author Allen
 */
class UploadController extends BaseController {

    public function anyReviewImage ($itemId=null) {

        $options = array(
            'script_url' => action('UploadController@anyReviewImage'),
            'upload_dir' => Config::get('optimall.reviewPicPath').$itemId.DIRECTORY_SEPARATOR,
            'upload_url' => asset('images/uploads/reviews/'.$itemId.'/').'/',
            'max_file_size' => Config::get('optimall.maxImageUploadSize') * 1024 * 1024 ,
        );
        $uploadHandler = new UploadHandler($options);

    }


}
