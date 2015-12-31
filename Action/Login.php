<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 12/9/2015
 * Time: 1:23 AM
 */

require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Controller/UserController.php');

$data = array();

    if(isset($_POST['user']) && isset($_POST['password']))
    {
        $username =  $_POST['user'];
        $password =  $_POST['password'];
        if($username != "" && $password != "")
        {
            $Object = new UserController();
            $data   = $Object->login($username, $password);
            echo json_encode($data);
        }
        else
        {
            array_push($data, ["Status"=>"error", "Message"=>"All fields must be provided"]);
            echo  json_encode($data);
        }
    }
    else
    {
        array_push($data, ["Status"=>"error", "Message"=>"Some error occurred"]);
        echo  json_encode($data);
    }