<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 1/4/2016
 * Time: 5:14 PM
 */

require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Controller/MartialController.php');

$data  = array();

   if(isset($_POST['martialStatus']))
   {
     $martialStatus = $_POST['martialStatus'];
     if(intval($martialStatus) > 0)
     {
         $Object = new MartialController();
         $date   = $Object->updateUserMartialStatus($martialStatus);
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