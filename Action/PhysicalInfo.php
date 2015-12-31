<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 12/6/2015
 * Time: 4:16 PM
 */

session_start();
$data = array();

   if(isset($_POST['height']) && isset($_POST['weight'])&& isset($_POST['martial']) && isset($_POST['familyType']) &&
       isset($_POST['familyClass']) && isset($_POST['disability']) || isset($_POST['type']))
   {

       $height      =  $_POST['height'];
       $weight      =  $_POST['weight'];
       $martial     =  $_POST['martial'];
       $familyType  =  $_POST['familyType'];
       $familyClass =  $_POST['familyClass'];
       $disability  =  $_POST['disability'];
       $type = "";
       if($disability == "true")
       {
           $type = $_POST['type'];
       }

       if($height != '' && $weight != '' && $martial > 0 && $familyType > 0 && $familyClass > 0)
       {
           array_push($data, ["Status"=>"ok"]);

           if($disability == "true" && $type > 0 )
           {
               array_push($data, [
                          "height"=>$height, "weight"=>$weight, "martial"=>$martial, "familyType"=>$familyType,
                          "familyClass"=>$familyClass, "disability"=>"true", "Type"=> $type
               ]);
           }
           else
           {
               array_push($data, [
                   "height"=>$height, "weight"=>$weight, "martial"=>$martial, "familyType"=>$familyType,
                   "familyClass"=>$familyClass, "disability"=>"false"
               ]);
           }

           $_SESSION['physical'] = $data;
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