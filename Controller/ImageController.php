<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 1/5/2016
 * Time: 11:48 AM
 */

require_once($_SERVER['DOCUMENT_ROOT'].'/matrimonialweb/Entity/Image.php');

class ImageController {

    public function  uploadImage($image)
    {
        $Object = new Image();
        $result = $Object->uploadImage($image);
        return $result;
    }

}