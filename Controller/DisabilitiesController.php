<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 12/6/2015
 * Time: 3:15 PM
 */

require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Entity/Disability.php');

class DisabilitiesController {

    /**
     * gets all the disabilities types
     * @return array
     */
    public function getAllDisabilities()
    {
        $Object = new Disability();
        $result = $Object->getAllDisabilities();
        return $result;

    }

    /**
     * add the disability to the user
     * @param $disabilityId
     * @return array
     */
    public function addDisability($disabilityId)
    {
        $Object = new Disability();
        $result = $Object->addDisability($disabilityId);
        return $result;
    }

}