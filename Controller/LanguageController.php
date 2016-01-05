<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 12/6/2015
 * Time: 11:07 AM
 */

require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Entity/Language.php');

class LanguageController {

    /**
     * Gets the list of all the languages stored
     * @return array
     */
    public function getLanguages()
    {
        $object = new Language();
        $result = $object->getLanguages();
        return $result;
    }

    /**
     * update the user language of the requested logged in user
     * @param $languageId
     * @return array
     */
    public function updateUserLanguage($languageId)
    {
        $object = new Language();
        $result = $object->updateUserLanguage($languageId);
        return $result;
    }
}