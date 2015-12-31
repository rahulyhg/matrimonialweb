<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 12/31/2015
 * Time: 1:44 PM
 */
require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Controller/BlockListController.php');

$data = array();

if(isset($_POST['partnerId']) && isset($_POST['reason']))
{
    $partner = $_POST['partnerId'];
    $reason  = $_POST['reason'];

    if(strlen($partner) > 5 && strlen($reason) > 10)
    {
        $Object  = new BlockListController();
        $data    = $Object->BlockUser($partner, $reason);
    }
    else
    {
        array_push($data, ["Status"=>"error", "Message"=>"validation error occurred"]);
    }

}
else
{
    array_push($data, ["Status"=>"error", "Message"=>"Something went wrong"]);
}

echo json_encode($data);