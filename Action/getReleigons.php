<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 12/6/2015
 * Time: 10:43 AM
 */

require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Controller/ReligionController.php');

   $Object = new ReligionController();
   $result = $Object->getReleigions();
   echo json_encode($result);