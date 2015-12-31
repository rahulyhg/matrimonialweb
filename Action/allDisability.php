<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 12/6/2015
 * Time: 3:17 PM
 */

require_once($_SERVER['DOCUMENT_ROOT'] . '/matrimonialweb/Controller/DisabilitiesController.php');

   $Object = new DisabilitiesController();
   $result = $Object->getAllDisabilities();
   echo json_encode($result);
