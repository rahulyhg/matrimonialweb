<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 1/5/2016
 * Time: 2:27 PM
 */

require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Controller/FamilyController.php');


$data = array();

if(isset($_POST['FamilyType']) && isset($_POST['FamilyStatus']))
{
    $familyType   = $_POST['FamilyType'];
    $familyStatus = $_POST['FamilyStatus'];

    if(intval($familyStatus) != 0 || intval($familyType) != 0)
    {
        $Object = new FamilyController();
        $data   = $Object->updateUserFamily($familyType, $familyStatus);
    }
    else
    {
        array_push($data, ["Status"=>"error", "Message"=>"Invalid arguments detected"]);
    }
}
else
{
    array_push($data, ["Status"=>"error", "Message"=>"Something wend wrong"]);
}

echo json_encode($data);