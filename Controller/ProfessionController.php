<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 12/29/2015
 * Time: 12:40 AM
 */

require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Entity/Profession.php');

class ProfessionController {

    /**
     * Gets the professional information
     * + salary
     * + education
     * + field
     * + workingType
     * @return array
     */
    public function getProfessionalInformation()
    {
        $Object = new Profession();
        $result = $Object->getProfessionalInformation();
        return $result;
    }

    /**
     * Update the professional information of the user
     * @param $educationId
     * @param $fieldId
     * @param $occupationId
     * @param $salary
     * @param $currencyId
     * @return array
     */
    public function updateUserProfessionalInformation($educationId, $fieldId, $occupationId, $salary, $currencyId)
    {
        $Object = new Profession();
        $result = $Object->updateUserProfession($educationId,$fieldId,$occupationId,$salary,$currencyId);
        return $result;
    }



}