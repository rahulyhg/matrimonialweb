<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 12/6/2015
 * Time: 10:41 AM
 */

require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Entity/Religion.php');

class ReligionController
{

    /**
     * gets all the religions
     * @return array
     */
    public function getReleigions()
    {
        $Object = new Religion();
        $result = $Object->getReligions();
        return $result;
    }

    /**
     * gets the required sects of the provided religion
     * @param $releigon
     * @return array
     */
    public function getSects($releigon)
    {
        $Object = new Religion();
        $result = $Object->getSects($releigon);
        return $result;
    }

    public function getUserReligion($userId)
    {
        $Object = new Religion();
        $result = $Object->getUserReligion($userId);
        return $result;
    }
}