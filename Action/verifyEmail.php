<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 12/5/2015
 * Time: 11:38 PM
 */

require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Controller/VerifyController.php');


if(isset($_POST['email']) && strlen($_POST['email']) > 0)
{
    $Object = new VerifyController();
    $result = $Object->verifyEmail($_POST['email']);
    echo json_encode($result);
}
else
{
    $array = array();
    array_push($array, ["Status" => "error", "Message"=> "no input provided"]);
    echo json_encode($array);
}