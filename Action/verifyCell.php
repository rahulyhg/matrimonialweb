<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 12/6/2015
 * Time: 12:55 AM
 */

require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Controller/VerifyController.php');


if(isset($_POST['cell']) && strlen($_POST['cell']) > 0)
{
    $Object = new VerifyController();
    $result = $Object->verifyCell($_POST['cell']);
    echo json_encode($result);
}
else
{
    $array = array();
    array_push($array, ["Status" => "error", "Message"=> "no input provided"]);
    echo json_encode($array);
}