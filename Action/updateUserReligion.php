<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 1/4/2016
 * Time: 4:15 PM
 */

require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Controller/ReligionController.php');

$data = array();

if(isset($_POST['religionId']) && isset($_POST['sectId']))
{
    $religionId = $_POST['religionId'];
    $sectId     = $_POST['sectId'];

    if(intval($religionId) > 0 && intval($sectId) > 0)
    {
        $Object = new ReligionController();
        $data   = $Object->updateUserReligion($religionId, $sectId);
    }
    else
    {
        array_push($data, ["Status"=>"error", "Message"=>"Incorrect fields detected"]);
    }
}
else
{
    array_push($data, ["Status"=>"error", "Message"=>"something went wrong"]);
}
echo json_encode($data);