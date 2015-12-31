<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 12/6/2015
 * Time: 2:44 PM
 */

require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Controller/FamilyController.php');


$Object = new FamilyController();
$result = $Object->getsAllFamilyClasses();
echo json_encode($result);