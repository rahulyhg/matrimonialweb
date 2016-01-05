<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 1/5/2016
 * Time: 3:57 PM
 */

require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Controller/DisabilitiesController.php');

$data  = array();

if(isset($_POST['disability']))
{
    $disability = $_POST['disability'];
    if(intval($disability) > 0)
    {
        $Object = new DisabilitiesController();
        $data   = $Object->addDisability($disability);
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