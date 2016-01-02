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

}