<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 12/28/2015
 * Time: 5:04 PM
 */

require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Controller/ReligionController.php');


$data = array();

if(isset($_POST['id']))
{
    $id = $_POST['id'];
    if(strlen($id) > 0)
    {
        $Object = new ReligionController();
        $data   = $Object->getUserReligion($id);
    }
    else
    {
        array_push($data, ["Status"=>"error", "Message"=>"user identifacation can't be empty"]);
    }
}
else
{
    array_push($data, ["Status"=>"error", "Message"=>"Please provide user identification id"]);
}

echo json_encode($data);