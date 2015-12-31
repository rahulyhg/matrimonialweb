<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 12/10/2015
 * Time: 3:55 AM
 */


require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Controller/ChatController.php');

$data = array();

if(isset($_POST['partner']))
{
    $to      = $_POST['partner'];

    if(strlen($to) > 0)
    {
        $Object = new ChatController();
        $data   = $Object->getChatMessages($to);
        echo json_encode($data);
    }
    else
    {
        array_push($this->data, ["Status"=>"error", "Message" => "Improper fields detected" ]);
        echo  json_encode($data);
    }
}
else
{
    array_push($this->data, ["Status"=>"error", "Message" => "Something bad happens" ]);
    echo  json_encode($data);
}