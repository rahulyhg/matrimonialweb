<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 1/5/2016
 * Time: 4:34 PM
 */

require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Controller/LanguageController.php');

$data  = array();

if(isset($_POST['language']))
{
    $language = $_POST['language'];
    if(intval($language) > 0)
    {
        $Object = new LanguageController();
        $data   = $Object->updateUserLanguage($language);
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