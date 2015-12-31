<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 12/6/2015
 * Time: 2:29 PM
 */


require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Controller/MartialController.php');

   $Object = new MartialController();
   $result = $Object->getAllStatus();
   echo json_encode($result);