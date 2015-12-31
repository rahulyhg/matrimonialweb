<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 12/6/2015
 * Time: 1:47 PM
 */

session_start();
$data = array();

if(isset($_POST['country']) &&isset($_POST['cell'])  && isset($_POST['state']) && isset($_POST['religion']) && isset($_POST['sect'])
    && isset($_POST['language']) && isset($_POST['me']))
{
    $country    = $_POST['country'];
    $state      = $_POST['state'];
    $religion   = $_POST['religion'];
    $sect       = $_POST['sect'];
    $language   = $_POST['language'];
    $me         = $_POST['me'];
    $cell       = $_POST['cell'];

    if($country > 0 && $cell != "" && strlen($cell) > 9  && $state > 0 && $religion > 0 && $language > 0 && strlen($me) <= 110)
    {
        if($sect == "")
        {
            $sect = "";
        }
        array_push($data, ["Status"=>"ok"]);
        array_push($data, [
            "Country"=>$country, "State"=>$state, "Religion"=>$religion, "Sect"=>$sect, "Language"=>$language,
            "Me"=>$me
        ]);
        arrangeShifting($cell);
        $_SESSION['socialInfo'] = $data;
        session_write_close();
        echo json_encode($data);
    }
    else
    {
        array_push($data, ["Status"=>"error", "Message"=>"Some Error occurred "]);
        echo json_encode($data);
    }
}
else
{
    array_push($data, ["Status"=>"error", "Message"=>"Some Error occurred "]);
    echo json_encode($data);

}


function arrangeShifting($cell)
{
    $name     = $_SESSION['basicInfo'][1]['Username'];
    $email    = $_SESSION['basicInfo'][1]['Email'];
    $password = $_SESSION['basicInfo'][1]['Password'];
    $dob      = $_SESSION['basicInfo'][1]['DOB'];
    $gender   = $_SESSION['basicInfo'][1]['Gender'];
    unset($_SESSION['basicInfo']);
    $array = array();
    array_push($array, ["Status"=>"ok"]);
    array_push($array, [
                       "Username"=>$name, "Email"=>$email,"Password"=>$password,"Cell"=>$cell,
                       "DOB"=>$dob, "Gender"=>$gender
    ]);

    $_SESSION['basicInfo'] = $array;
}