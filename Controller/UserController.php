<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 12/9/2015
 * Time: 1:21 AM
 */

require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Entity/User.php');

class UserController {

    /**
     * check and login the given fields
     * @param $username
     * @param $password
     * @return array
     */
    public function login($username, $password)
    {
        $Object = new User();
        $result = $Object->login($username, $password);
        return $result;
    }

    /**
     * Activate user because the user has visited our link
     * @param $userId
     * @return array
     */
    public function  activateUserByLink($userId)
    {
        $Object = new User();
        $result = $Object->activateUserByLink($userId);
        return $result;
    }


}