<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 12/5/2015
 * Time: 11:31 PM
 */

require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Entity/Verifier.php');

class VerifyController {


    /**
     * verify provided Username
     * return 1 if UNIQUE
     * otherwise return 0 if already exists
     * @param $username
     * @return mixed
     */
    public function verifyUserName($username)
    {
        $Object = new Verifier();
        $result = $Object->verifyUserName($username);
        return $result;
    }


    /**
     * verify provided email
     * return 1 if UNIQUE
     * otherwise return 0 if already exists
     * @param $email
     * @return mixed
     */
    public function verifyEmail($email)
    {
        $Object = new Verifier();
        $result = $Object->verifyEmail($email);
        return $result;
    }

    /**
     * verify provided cell
     * return 1 if UNIQUE
     * otherwise return 0 if already exists
     * @param $cell
     * @return mixed
     */
    public function verifyCell($cell)
    {
        $Object = new Verifier();
        $result = $Object->verifyEmail($cell);
        return $result;
    }
}