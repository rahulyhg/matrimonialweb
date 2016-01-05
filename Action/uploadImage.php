<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 1/5/2016
 * Time: 11:50 AM
 */

require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Controller/ImageController.php');

$data = array();
$allowed = array ('image/pjpeg', 'image/jpeg', 'image/JPG', 'image/X-PNG', 'image/PNG', 'image/png', 'image/x-png');

if(isset($_FILES['images']))
{
    //check valid extensions
    if(in_array($_FILES['images']['type'], $allowed))
    {
        //get image size
        $size = $_FILES['images']['size'];
        $size = ($size/1024) / 1024;
        if($size <= 10)
        {
            //get image blob to store in the database
            $binary = file_get_contents($_FILES['images']['tmp_name']);
            $Object = new ImageController();
            $data   = $Object->uploadImage($binary);
        }
        else
        {
            $message = "Image size should not exceed 10 MB";
            array_push($data, ["Status"=>"error", "Message"=>$message]);
        }
    }
    else
    {
        $message = "Incorrect image format. Allowed extensions are  \n  jpeg, png, png";
        array_push($data, ["Status"=>"error", "Message"=>$message]);
    }
}
else
{
    array_push($data, ["Status"=>"error", "Message"=>"some error occurred"]);
}

echo json_encode($data);



