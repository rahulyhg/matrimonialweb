<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 12/7/2015
 * Time: 1:49 AM
 */

require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Controller/ProfileController.php');


session_start();
$data = array();

if(isset($_POST['partner']) )
{
    $partner = $_POST['partner'];

    if($partner != "" && strlen($partner) <= 100)
    {
        array_push($data, ["Status"=>"ok"]);

        array_push($data, [
            "partner"=>$partner
        ]);

        $_SESSION['partner'] = $data;
        session_write_close();

        $Object = new ProfileController();
        $result = $Object->createProfile();
        //$path = $_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/registrationMail.php?id='.$_SESSION['id'];
        echo json_encode($result);
        //header("Location: $path");
    }
    else
    {
        array_push($data, ["Status"=>"error", "Message"=>"partner preference was empty or exceeded its limited frame "]);
        echo json_encode($data);
    }
}
else
{
    array_push($data, ["Status"=>"error", "Message"=>"Some Error occurred "]);
    echo json_encode($data);

}



