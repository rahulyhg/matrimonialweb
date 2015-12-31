<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 12/8/2015
 * Time: 12:52 AM
 */

require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Entity/Profile.php');

class ProfileController {

    /**
     * creates the newly registered user and its profile
     * @return array
     */
    public function createProfile()
    {
        $Object = new Profile();
        $result = $Object->createProfile();
        return $result;

    }

    /**
     * Gets the basic profile information such as
     * + age
     * + DOB
     * + height
     * + weight
     * + User description
     * + partner preference information
     * @param $userId
     * @return array
     */
    public function getUserInformation($userId)
    {
        $Object = new Profile();
        $result = $Object->getUserInformation($userId);
        return $result;
    }

}