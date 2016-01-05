<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 1/2/2016
 * Time: 1:01 PM
 */


require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Controller/ProfessionController.php');

 $data  =array();

   if(isset($_POST['notificationId']))
   {
      $notificationId = $_POST['notificationId'];
      if(strlen($notificationId) > 0)
      {
          $Object = new NotificationController();
          $data   = $Object->seenNotification($notificationId);

      }
      else
      {
         array_push($data, ["Status"=>"error", "Message"=>"Incorrect notification Id detected"]);
      }
   }
   else
   {
       array_push($data, ["Status"=>"error", "Message"=>"Something went wrong :("]);
   }

echo json_encode($data);

