<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 12/6/2015
 * Time: 2:40 PM
 */


require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Entity/Family.php');

class FamilyController {


    /**
     * fetches all the family types
     * @return array
     */
    public function getsAllFamilyTypes()
    {
        $Object = new Family();
        $result = $Object->allFamilyTypes();
        return $result;
    }


    /**
     * gets all the family classes
     * @return array
     */
    public function getsAllFamilyClasses()
    {
        $Object = new Family();
        $result = $Object->allFamilyClass();
        return $result;
    }

    /**
     * Gets the user Family information which is as follows
     * + family Type (joint, nucleus)
     * + family type (middleClass, higher class etc)
     * @param $userId
     * @return array
     *
     */
    public function getUserFamilyInformation($userId)
    {
        $Object = new Family();
        $result =$Object->getUserFamilyBackground($userId);
        return $result;
    }

    /**
     * update the family information of the logged in user
     * @param $familyType
     * @param $familyStatus
     * @return array
     */
    public function updateUserFamily($familyType, $familyStatus)
    {
        $Object = new Family();
        $result = $Object->updateFamilyInformation($familyType, $familyStatus);
        return $result;
    }

}