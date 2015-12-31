<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 12/6/2015
 * Time: 9:32 PM
 */

require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Entity/Education.php');


class EducationController {

    /**
     * get all the education types list
     * @return array
     */
    public function getEducationList()
    {
        $Object = new Education();
        $result = $Object->getEducationList();
        return $result;
    }

}