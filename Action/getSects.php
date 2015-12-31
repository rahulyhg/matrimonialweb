<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 12/6/2015
 * Time: 11:15 AM
 */

require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Controller/ReligionController.php');


    $data = array();

   if(isset($_POST['religion']) && $_POST['religion'] > 0 )
   {

       $Object = new ReligionController();
       $result = $Object->getSects($_POST['religion']);
       echo json_encode($result);
   }
  else
  {
      array_push($data, [ "Status"=>"error", "Message"=>"Some error occurred" ]);
      echo json_encode($data);
  }