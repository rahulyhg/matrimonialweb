<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 12/6/2015
 * Time: 1:32 PM
 */


require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Controller/CountryController.php');

$data = array();

if(isset($_POST['country']) && $_POST['country'] > 0 )
{

    $Object = new CountryController();
    $result = $Object->getStates($_POST['country']);
    echo json_encode($result);
}
else
{
    array_push($data, [ "Status"=>"error", "Message"=>"Some error occurred" ]);
    echo json_encode($data);
}