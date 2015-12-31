<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 12/6/2015
 * Time: 11:07 AM
 */

require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Entity/Language.php');

class LanguageController {

    public function getLanguages()
    {
        $object = new Language();
        $result = $object->getLanguages();
        return $result;
    }


}