<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 12/28/2015
 * Time: 10:38 PM
 */

require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Controller/MartialController.php');


$data = array();

if(isset($_POST['id']))
{
    $id = $_POST['id'];
    if(strlen($id) > 0)
    {
        $Object = new MartialController();
        $data   = $Object->getUserMartialStatus($id);
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