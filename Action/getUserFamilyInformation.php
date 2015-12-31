<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 12/29/2015
 * Time: 12:22 PM
 */

require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Controller/FamilyController.php');

$data = array();


if(isset($_POST['id']))
{
    $id = $_POST['id'];
    if(strlen($id) > 0)
    {
        $Object = new FamilyController();
        $data   = $Object->getUserFamilyInformation($id);
    }
    else
    {
        array_push($data, ["Status"=>"error", "Message"=>"user identification can't be empty"]);
    }
}
else
{
    array_push($data, ["Status"=>"error", "Message"=>"Please provide user identification id"]);
}

echo json_encode($data);