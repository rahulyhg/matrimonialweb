<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 12/6/2015
 * Time: 2:28 PM
 */

require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Entity/MartialStatus.php');


class MartialController {

    /**
     * gets all the martial status
     * @return array
     */
    public function getAllStatus()
    {
        $Object = new MartialStatus();
        $result = $Object->getAllStatus();
        return $result;
    }

    /**
     * Gets the user martial status according to its identification
     * @param $userId
     * @return array
     */
    public function getUserMartialStatus($userId)
    {
        $Object = new MartialStatus();
        $result = $Object->getUerMartialStatus($userId);
        return $result;
    }

    /**
     * update the martial status of the current logged in user
     * @param $martialStatus
     * @return array
     */
    public function updateUserMartialStatus($martialStatus)
    {
        $Object = new MartialStatus();
        $result = $Object->updateUserMartialStatus($martialStatus);
        return $result;
    }
}