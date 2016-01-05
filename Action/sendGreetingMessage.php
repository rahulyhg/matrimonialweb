<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 1/4/2016
 * Time: 6:29 PM
 */
require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Controller/GreetingMessageController.php');

$data = array();

if(isset($_POST['partner']) && isset($_POST['message']))
{
    $partner = $_POST['partner'];
    $message = $_POST['message'];

    if(strlen($partner) > 0 && strlen($message) > 0)
    {
        $Object = new GreetingMessageController();
        $data   = $Object->sendGreetingMessage($partner,$message);
    }
    else
    {
        array_push($data, ["Status"=>"error", "Message"=>"incorrect fields detected"]);
    }
}
else
{
    array_push($data, ["Status"=>"error", "Message"=>"something went wrong"]);
}

echo json_encode($data);
