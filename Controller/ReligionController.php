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

    /**
     * Update the user religion and sect attributes
     * @param $religionId
     * @param $sectId
     * @return array
     */
    public function updateUserReligion($religionId, $sectId)
    {
        $Object = new Religion();
        $result = $Object->updateUserReligion($religionId, $sectId);
        return $result;
    }

    public function getUserReligion($userId)
    {
        $Object = new Religion();
        $result = $Object->getUserReligion($userId);
        return $result;
    }
}