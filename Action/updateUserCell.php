<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 1/4/2016
 * Time: 2:45 PM
 */

require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Controller/CountryController.php');

if(!session_start()){
    session_start();
}

$data = array();
if(!isset($_SESSION['id']) || !empty($_SESSION['id']))
{
    if (isset($_POST['cell']))
    {
        $cell = $_POST['cell'];
        $id   = $_SESSION['id'];
        if (strlen($cell) > 7 && strlen($cell) < 20)
        {
            $Object = new CountryController();
            $data = $Object->updateUserCell($cell, $id);
        }
        else
        {
            array_push($data, ["Status" => "error", "Message" => "Incorrect fields detected"]);
        }
    }
    else
    {
        array_push($data, ["Status" => "error", "Message" => "Something went wrong"]);
    }
}
else
{
    array_push($data, ["Status" => "error", "Message" => "Authorization error occurred"]);
}

echo json_encode($data);
