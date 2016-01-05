<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 1/4/2016
 * Time: 2:45 PM
 */

require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Controller/CountryController.php');

$data = array();

if(isset($_POST['countryId']) && isset($_POST['cityId']))
{
    $countryId = $_POST['countryId'];
    $cityId    = $_POST['cityId'];

    if(intval($countryId) > 0 && intval($cityId) > 0)
    {
        $Object = new CountryController();
        $data   = $Object->updateUserState($countryId,$cityId);
    }
    else
    {
        array_push($data, ["Status"=>"error", "Message"=>"Incorrect fields detected"]);
    }

}
else
{
    array_push($data, ["Status"=>"error", "Message"=>"Something went wrong"]);
}

   echo json_encode($data);
