<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 12/12/2015
 * Time: 12:01 AM
 */

require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Entity/Partner.php');

class PartnerController {


    /**
     * get the list of all the partner which the user have ever send any Express message and
     * initiated chat with
     * @return array
     */
    public function getAllPartnerList()
    {
        $Object = new Partner();
        $result = $Object->getAllPartnersList();
        return $result;
    }
}