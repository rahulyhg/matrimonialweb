<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 1/6/2016
 * Time: 6:49 PM
 */

require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Controller/QuickSearchController.php');

$data = array();
if(isset($_POST['gender']) && isset($_POST['ageHigh']) && isset($_POST['ageLow']) && isset($_POST['religion'])
    && isset($_POST['sect']) && isset($_POST['country']) && isset($_POST['city']))
{
    $gender     = $_POST['gender'];
    $ageHigh    = $_POST['ageHigh'];
    $ageLow     = $_POST['ageLow'];
    $religion   = $_POST['religion'];
    $sect       = $_POST['sect'];
    $country    = $_POST['country'];
    $city       = $_POST['city'];

    if(intval($gender) > 0 && intval($ageHigh) > 0 && intval($ageLow) > 0 && intval($religion) > 0
       && intval($sect) > 0 && intval($country) > 0 && intval($city) > 0)
    {
        $Object = new QuickSearchController();
        $data   = $Object->performQuickSearch($gender, $ageHigh, $ageLow, $religion, $sect, $country, $city);
        echo json_encode($data);
    }
    else
    {
        array_push($data, ["Status"=>"error", "Message"=>"Invalid arguments detected...."]);
    }
}
else
{
    array_push($data, ["Status"=>"error", "Message"=>"Something went wrong...."]);
}

echo json_encode($data);
