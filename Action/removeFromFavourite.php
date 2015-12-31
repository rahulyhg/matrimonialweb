<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 12/31/2015
 * Time: 12:00 AM
 */

require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Controller/FavouritesListController.php');

$data = array();
if(isset($_POST['partnerId']))
{
    $id = $_POST['partnerId'];
    if(strlen($id) > 0)
    {
        $Object = new FavouritesListController();
        $data   = $Object->removeFromFavouriteList($id);
        echo json_encode($data);
    }
    else
    {
        array_push($data, ["Status"=>"error", "Message"=>"user identification can't be empty"]);
    }
}
else
{
    array_push($data, [ "Status"=>"error", "Message"=>"Some error occurred" ]);
    echo json_encode($data);
}