<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 12/6/2015
 * Time: 9:49 PM
 */

require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Entity/Field.php');

class FieldController {

    /**
     * Get all fields types
     * @return array
     */
    public function getAllFields()
    {
        $Object = new Field();
        $result = $Object->getAllFields();
        return $result;
    }

    /**
     * get all working types
     * @return array
     */
    public function getWorkingList()
    {
        $Object = new Field();
        $result = $Object->getWorkingWith();
        return $result;
    }

}