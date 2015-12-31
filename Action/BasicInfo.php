<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 12/6/2015
 * Time: 9:36 AM
 */

session_start();
$data = array();

if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])  && isset($_POST['dob'])
   && isset($_POST['gender']))
{

    $name    =  $_POST['name'];
    $email   =  $_POST['email'];
    $pass    =  $_POST['password'];
    $dob     =  $_POST['dob'];
    $gender  =  $_POST['gender'];

    if($email != "" && filter_var($email,FILTER_VALIDATE_EMAIL))
    {


        if ($name != "" && strlen($name) > 3 && $pass != ""  && $gender > 0 && $dob != "")
        {
            array_push($data, ["Status" => "ok"]);
            array_push($data, [
                "Username" => $name, "Email" => $email, "Password" => $pass,  "DOB" => $dob,
                "Gender" => $gender
            ]);
            array_push($data, ["Status"=>"ok"]);
            $_SESSION['basicInfo'] = $data;
            session_write_close();
            echo json_encode($data);
        }
        else
        {
            array_push($data, ["Status" => "error", "Message" => "Some Error occurred "]);
            echo json_encode($data);
        }
    }
    else
    {

        array_push($data, ["Status" => "error", "Message" => "Email was not in a correct format "]);
        echo json_encode($data);
    }
}
else
{
    array_push($data, ["Status"=>"error", "Message"=>"Some Error occurred "]);
    echo json_encode($data);
}