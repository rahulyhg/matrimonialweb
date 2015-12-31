<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 12/6/2015
 * Time: 11:09 PM
 */

require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Controller/FieldController.php');

$Object = new FieldController();
$result = $Object->getWorkingList();
echo json_encode($result);